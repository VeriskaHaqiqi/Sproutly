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
     * Jika role user → konsultasi yang dia buat
     * Jika role ahli → konsultasi yang ditujukan ke dia
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
                ->with(['user', 'ahliBotani'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $konsultasi = Konsultasi::where('user_id', $user->id)
                ->with(['user', 'ahliBotani'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return response()->json([
            'message' => 'Data konsultasi berhasil diambil',
            'data'    => $konsultasi
        ]);
    }

    /**
     * Buat konsultasi baru (dipanggil dari lockRoomUser setelah pilih ahli)
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

        $konsultasi = Konsultasi::create([
            'user_id'           => $user->id,
            'ahli_botani_id'    => $validated['ahli_botani_id'],
            'tanggal_mulai'     => now(),
            'status_konsultasi' => 'pending',
            'topik'             => $validated['topik'] ?? 'Konsultasi Pertanian',
        ]);

        return response()->json([
            'message' => 'Konsultasi berhasil dibuat',
            'data'    => $konsultasi->load('ahliBotani')
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
        $konsultasi = Konsultasi::with(['user', 'ahliBotani'])->findOrFail($id);

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
     * Update status konsultasi (accept, reject, complete)
     */
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        $konsultasi = Konsultasi::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,active,selesai,cancelled'
        ]);

        $konsultasi->status_konsultasi = $validated['status'];
        if ($validated['status'] === 'selesai') {
            $konsultasi->tanggal_selesai = now();
        }
        $konsultasi->save();

        return response()->json([
            'message' => 'Status konsultasi diperbarui',
            'data'    => $konsultasi
        ]);
    }

    /**
     * Ambil daftar ahli botani yang tersedia (dengan jadwal)
     * Digunakan oleh find-experts page
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