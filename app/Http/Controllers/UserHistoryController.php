<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Konsultasi;
use Carbon\Carbon;

class UserHistoryController extends Controller
{
    /**
     * Mengambil data history user dalam format JSON
     */
    public function getHistoryData()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([], 401);
        }

        $histories = Konsultasi::with(['ahliBotani.user', 'pembayaran'])
            ->where('user_id', $user->id)
            ->where('status_konsultasi', 'selesai')
            ->orderBy('tanggal_selesai', 'desc')
            ->get()
            ->map(function ($konsultasi) {
                $ahli = $konsultasi->ahliBotani;

                return [
                    'id' => '#CS' . str_pad($konsultasi->id, 3, '0', STR_PAD_LEFT),
                    'expert' => $ahli ? $ahli->nama_ahli : 'Unknown Expert',
                    'role' => $ahli ? ($ahli->spesialisasi ?? 'Botany Expert') : 'Expert',
                    'expert_id' => $ahli ? $ahli->id : null,
                    'konsultasi_id' => $konsultasi->id,
                    // HAPUS avatar/profile picture
                    'topic' => $konsultasi->topik ?? '-',
                    'date' => $konsultasi->tanggal_mulai
                        ? Carbon::parse($konsultasi->tanggal_mulai)->format('d M Y')
                        : '-',
                    'status' => 'Completed',
                    'payment' => $konsultasi->pembayaran
                        ? ucfirst($konsultasi->pembayaran->status_pembayaran)
                        : 'Paid',
                    'fee' => $konsultasi->pembayaran
                        ? 'Rp ' . number_format($konsultasi->pembayaran->jumlah, 0, ',', '.')
                        : '-',
                    'notes' => 'Consultation completed successfully',
                    'duration' => $konsultasi->tanggal_mulai && $konsultasi->tanggal_selesai
                        ? Carbon::parse($konsultasi->tanggal_mulai)->diffInMinutes(Carbon::parse($konsultasi->tanggal_selesai)) . ' min'
                        : '—',
                    'can_review' => !$konsultasi->rating()->exists(),
                ];
            });

        return response()->json($histories);
    }
}