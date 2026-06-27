<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Konsultasi;
use App\Models\Rating;
use Carbon\Carbon;

class ReviewsController extends Controller
{
    /**
     * Tampilkan halaman reviews
     */
    public function index()
    {
        return view('reviewsUser');
    }

    /**
     * Ambil data konsultasi yang bisa direview
     */
    public function getReviewableData()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([], 401);
        }

        $consultations = Konsultasi::with(['ahliBotani.user', 'rating'])
            ->where('user_id', $user->id)
            ->where('status_konsultasi', 'selesai')
            ->orderBy('tanggal_selesai', 'desc')
            ->get()
            ->map(function ($konsultasi) {
                $ahli = $konsultasi->ahliBotani;
                $rating = $konsultasi->rating;
                
                return [
                    'id' => $konsultasi->id,
                    'expert_name' => $ahli ? $ahli->nama_ahli : 'Unknown',
                    'expert_specialty' => $ahli ? ($ahli->spesialisasi ?? 'Botany Expert') : 'Expert',
                    'expert_id' => $ahli ? $ahli->id : null,
                    'consultation_topic' => $konsultasi->topik ?? 'General Consultation',
                    'consultation_date' => $konsultasi->tanggal_selesai
                        ? Carbon::parse($konsultasi->tanggal_selesai)->format('d M Y')
                        : '-',
                    'can_review' => !$rating,
                    'has_reviewed' => $rating ? true : false,
                    'rating_value' => $rating ? $rating->nilai : null,
                    'review_text' => $rating ? $rating->ulasan : null,
                ];
            });

        // PASTIKAN MENGEMBALIKAN ARRAY (bukan object)
        return response()->json($consultations->values());
    }

    /**
     * Simpan rating dan ulasan
     */
    public function store(Request $request)
    {
        $request->validate([
            'konsultasi_id' => 'required|exists:konsultasi,id',
            'nilai' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $konsultasi = Konsultasi::findOrFail($request->konsultasi_id);

        // Cek kepemilikan
        if ($konsultasi->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Cek apakah sudah direview
        if ($konsultasi->rating()->exists()) {
            return response()->json(['message' => 'Already reviewed'], 400);
        }

        // Cek status harus selesai
        if ($konsultasi->status_konsultasi !== 'selesai') {
            return response()->json(['message' => 'Konsultasi belum selesai'], 400);
        }

        $rating = Rating::create([
            'user_id' => $user->id,
            'ahli_botani_id' => $konsultasi->ahli_botani_id,
            'konsultasi_id' => $konsultasi->id,
            'nilai' => $request->nilai,
            'ulasan' => $request->ulasan,
            'tanggal' => now(),
        ]);

        return response()->json([
            'message' => 'Review submitted successfully',
            'data' => $rating
        ], 201);
    }
}