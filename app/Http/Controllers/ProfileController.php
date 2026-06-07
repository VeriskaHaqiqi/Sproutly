<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Get profile data
    public function index()
    {
    try {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'error' => 'User not authenticated',
                'message' => 'Please login first'
            ], 401);
        }
        
        return response()->json([
            'success' => true,
            'user_id' => $user->id,
            'email' => $user->email,
            'nama' => $user->nama_user
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine()
        ], 500);
    }
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
        
        $ratings = Rating::where('id_user', $user->id)
            ->with('ahliBotani')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($rating) {
                return [
                    'id_rating' => $rating->id_rating,
                    'bintang' => $rating->bintang,
                    'bintang_display' => $rating->bintang . '/5',
                    'ahli_botani_name' => $rating->ahliBotani->nama_ahli ?? 'Ahli Botani',
                    'id_konsultasi' => $rating->id_konsultasi,
                    'ulasan' => $rating->ulasan,
                    'tanggal' => $rating->created_at->format('d M Y H:i'),
                    'rating_stars' => str_repeat('⭐', $rating->bintang) . str_repeat('☆', 5 - $rating->bintang)
                ];
            });

        $averageRating = $ratings->avg('bintang') ?? 0;

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