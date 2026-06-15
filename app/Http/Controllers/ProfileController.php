<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\AhliBotani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
        */

    // Get profile data
    public function index()
    {
        $user = Auth::user();
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->nama_user,
                'email' => $user->email,
                'phone' => $user->no_telp_user,
                'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null,
            ]
        ]);
    }  
    
    // Update profile photo
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');
        
        $user->update(['profile_picture' => $path]);

        return response()->json([
            'message' => 'Profile photo updated successfully',
            'profile_picture' => asset('storage/' . $path)
        ]);
    }

    // Get payment history
    public function paymentHistory()
    {
        $payments = Auth::user()->pembayaran()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'payments' => $payments,
            'total_spent' => $payments->where('status_pembayaran', 'success')->sum('jumlah')
        ]);
    }

    // Get ratings list (rating yang diberikan user ke ahli botani)
    public function ratingsList()
    {
        $user = Auth::user();
        
        $ratings = Rating::where('user_id', $user->id)
            ->with('ahliBotani')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'nilai' => $rating->nilai,
                    'bintang_display' => $rating->nilai . '/5',
                    'ahli_botani_name' => $rating->ahliBotani->nama_ahli ?? 'Ahli Botani',
                    'konsultasi_id' => $rating->konsultasi_id,
                    'ulasan' => $rating->ulasan,
                    'tanggal' => $rating->tanggal ? $rating->tanggal->format('d M Y H:i') : $rating->created_at->format('d M Y H:i'),
                    'rating_stars' => str_repeat('⭐', $rating->nilai) . str_repeat('☆', 5 - $rating->nilai)
                ];
            });

        $averageRating = $ratings->avg('nilai') ?? 0;

        return response()->json([
            'success' => true,
            'ratings' => $ratings,
            'total_ratings' => $ratings->count(),
            'average_rating' => round($averageRating, 1),
            'average_stars' => str_repeat('⭐', round($averageRating)) . str_repeat('☆', 5 - round($averageRating)),
            'message' => $ratings->isEmpty() ? 'Belum ada rating yang diberikan' : null
        ]);
    }

    // Update Profile (User & Expert)
    public function updateProfile(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        
        $rules = [
            'full_name' => 'required|string|max:50',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'phone'     => 'nullable|string|max:16',
            'gender'    => 'nullable|in:male,female,other',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        if ($user->role === 'ahli') {
            $rules['specialization'] = 'nullable|string|max:100';
            $rules['experience']     = 'nullable|integer|min:0';
            $rules['bio']            = 'nullable|string|max:1000';
        }

        $validated = $request->validate($rules);

        $genderMap = [
            'male'   => 1,
            'female' => 2,
            'other'  => null
        ];

        // Update kolom User
        $user->nama_user        = $request->full_name;
        $user->email            = $request->email;
        $user->no_telp_user     = $request->phone;
        $user->jenis_kelamin_user = $genderMap[$request->gender] ?? null;

        // Update foto profil jika ada upload baru
        if ($request->hasFile('photo')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        // Jika role ahli, update tabel ahli_botani
        if ($user->role === 'ahli') {
            // Ambil atau buat record baru untuk ahli_botani
            $ahli = AhliBotani::firstOrNew(['user_id' => $user->id]);
            
            $ahli->nama_ahli        = $request->full_name;
            $ahli->no_telp_ahli     = $request->phone;
            $ahli->jenis_kelamin_ahli = $request->gender === 'male' ? 'L' : ($request->gender === 'female' ? 'P' : null);
            $ahli->spesialisasi     = $request->specialization;
            $ahli->pengalaman_tahun = $request->experience ? (int)$request->experience : 0;
            $ahli->bio              = $request->bio;
            $ahli->save();
            
            return redirect()->route('accountExpert')->with('success', 'Profil berhasil diperbarui!');
        }

        return redirect()->route('accountUser')->with('success', 'Profil berhasil diperbarui!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}