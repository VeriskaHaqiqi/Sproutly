<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Konsultasi;
use App\Models\AhliBotani;
use App\Models\JadwalAhli;
use App\Models\TarifAhli;

class KonsultasiController extends Controller
{
    /**
     * Ambil daftar konsultasi user yang login.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($user->role === 'ahli') {
            $ahli = $user->ahliBotani;
            $konsultasi = Konsultasi::where('ahli_botani_id', $ahli?->id)
                ->with(['user', 'ahliBotani.user'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $konsultasi = Konsultasi::where('user_id', $user->id)
                ->with(['user', 'ahliBotani.user'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return response()->json([
            'message' => 'Data konsultasi berhasil diambil',
            'data'    => $konsultasi
        ]);
    }

    /**
     * Buat konsultasi baru (langsung active)
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'user') {
            return response()->json(['message' => 'Hanya user yang dapat membuat konsultasi'], 403);
        }

        $validated = $request->validate([
            'ahli_botani_id' => 'required|exists:ahli_botani,id',
            'topik'          => 'nullable|string|max:100',
        ]);

        // Cek apakah sudah ada konsultasi aktif dengan ahli yang sama
        $existing = Konsultasi::where('user_id', $user->id)
            ->where('ahli_botani_id', $validated['ahli_botani_id'])
            ->where('status_konsultasi', 'active')
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Anda masih memiliki konsultasi aktif dengan ahli ini',
                'data' => $existing
            ], 400);
        }

        $konsultasi = Konsultasi::create([
            'user_id'           => $user->id,
            'ahli_botani_id'    => $validated['ahli_botani_id'],
            'tanggal_mulai'     => now(),
            'status_konsultasi' => 'active', // LANGSUNG ACTIVE
            'topik'             => $validated['topik'] ?? 'Konsultasi Pertanian',
        ]);

        return response()->json([
            'message' => 'Konsultasi berhasil dibuat',
            'data'    => $konsultasi->load('ahliBotani.user')
        ], 201);
    }

    /**
     * Detail satu konsultasi
     */
    public function show($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $konsultasi = Konsultasi::with(['user', 'ahliBotani.user'])->findOrFail($id);

        // Cek ownership
        if ($user->role === 'user' && $konsultasi->user_id !== $user->id) {
            return response()->json(['message' => 'Tidak diizinkan'], 403);
        }
        if ($user->role === 'ahli') {
            $ahli = $user->ahliBotani;
            if ($konsultasi->ahli_botani_id !== $ahli?->id) {
                return response()->json(['message' => 'Tidak diizinkan'], 403);
            }
        }

        return response()->json(['data' => $konsultasi]);
    }

    /**
     * END CHAT - Diakses oleh Ahli
     * TAMBAHKAN METHOD INI
     */
    public function endChat($id)
    {
        $user = Auth::user();
        $konsultasi = Konsultasi::with(['user', 'ahliBotani'])->findOrFail($id);

        // Cek apakah user adalah ahli yang terlibat
        $ahli = $user->ahliBotani;
        if (!$ahli || $konsultasi->ahli_botani_id !== $ahli->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Cek apakah sudah selesai
        if ($konsultasi->status_konsultasi === 'selesai') {
            return response()->json(['message' => 'Konsultasi sudah selesai'], 400);
        }

        // Update status
        $konsultasi->status_konsultasi = 'selesai';
        $konsultasi->tanggal_selesai = now();
        $konsultasi->save();

        return response()->json([
            'success' => true,
            'message' => 'Konsultasi berhasil diakhiri',
            'data' => $konsultasi
        ]);
    }

    /**
     * Update status konsultasi
     */
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        $konsultasi = Konsultasi::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:active,selesai,cancelled'
        ]);

        if ($validated['status'] === 'selesai') {
            $konsultasi->tanggal_selesai = now();
        }

        $konsultasi->status_konsultasi = $validated['status'];
        $konsultasi->save();

        return response()->json([
            'message' => 'Status konsultasi diperbarui',
            'data'    => $konsultasi
        ]);
    }

    /**
     * Ambil daftar ahli botani yang tersedia
     */
    public function getAvailableExperts(Request $request)
    {
        $experts = AhliBotani::with(['user', 'ratings'])
            ->whereHas('jadwalAhli', function($q) {
                $q->where('status_ketersediaan', 'tersedia');
            })
            ->get()
            ->map(function($ahli) {
                $avgRating = $ahli->ratings->avg('nilai') ?? 0;
                $tarif = TarifAhli::where('ahli_botani_id', $ahli->id)->first();
                return [
                    'id'              => $ahli->id,
                    'nama_ahli'       => $ahli->nama_ahli,
                    'spesialisasi'    => $ahli->spesialisasi ?? 'General',
                    'bio'             => $ahli->bio ?? '',
                    'pengalaman'      => $ahli->pengalaman_tahun ?? 0,
                    'rating'          => round($avgRating, 1),
                    'total_rating'    => $ahli->ratings->count(),
                    'tarif'           => $tarif ? $tarif->tarif : 0,
                    'profile_picture' => $ahli->user?->profile_picture
                        ? asset('storage/' . $ahli->user->profile_picture)
                        : null,
                ];
            });

        return response()->json([
            'message' => 'Daftar ahli berhasil diambil',
            'data'    => $experts
        ]);
    }
}