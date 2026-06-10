<?php

namespace App\Http\Controllers;

use App\Models\Rating;
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
    // Get ratings list (rating yang diberikan user ke ahli botani)
    public function ratingsList()
    {
    $user = Auth::user();
    
    $ratings = Rating::where('user_id', $user->id)  // ← user_id, bukan id_user
        ->with('ahliBotani')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($rating) {
            return [
                'id' => $rating->id,
                'nilai' => $rating->nilai,  // ← nilai, bukan bintang
                'bintang_display' => $rating->nilai . '/5',
                'ahli_botani_name' => $rating->ahliBotani->nama_ahli ?? 'Ahli Botani',
                'konsultasi_id' => $rating->konsultasi_id,
                'ulasan' => $rating->ulasan,
                'tanggal' => $rating->tanggal ? $rating->tanggal->format('d M Y H:i') : $rating->created_at->format('d M Y H:i'),
                'rating_stars' => str_repeat('⭐', $rating->nilai) . str_repeat('☆', 5 - $rating->nilai)
            ];
        });

    $averageRating = $ratings->avg('nilai') ?? 0;  // ← nilai, bukan bintang

    return response()->json([
        'success' => true,
        'ratings' => $ratings,
        'total_ratings' => $ratings->count(),
        'average_rating' => round($averageRating, 1),
        'average_stars' => str_repeat('⭐', round($averageRating)) . str_repeat('☆', 5 - round($averageRating)),
        'message' => $ratings->isEmpty() ? 'Belum ada rating yang diberikan' : null
    ]);
    }
    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}