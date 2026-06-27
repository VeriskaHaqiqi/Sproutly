<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Konsultasi;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Menampilkan halaman Client History Expert
     */
    public function expertHistory()
    {
        return view('ConsultationhistoryExpert');
    }

    /**
     * Mengambil data Client History dalam format JSON
     */
    public function expertHistoryData()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([], 401);
        }

        $ahli = $user->ahliBotani;

        if (!$ahli) {
            return response()->json([]);
        }

        $histories = Konsultasi::with(['user', 'pembayaran'])
            ->where('ahli_botani_id', $ahli->id)
            ->where('status_konsultasi', 'selesai')
            ->orderBy('tanggal_selesai', 'desc')
            ->get()
            ->map(function ($konsultasi) {
                return [
                    'id' => '#CS' . str_pad($konsultasi->id, 3, '0', STR_PAD_LEFT),
                    'client' => $konsultasi->user->nama_user ?? 'Unknown Client',
                    'role' => 'Client',
                    'avatar' => $konsultasi->user->profile_picture
                        ? asset('storage/' . $konsultasi->user->profile_picture)
                        : asset('images/fotoprofile.png'),
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
                    'notes' => 'Consultation completed',
                    'duration' => $konsultasi->tanggal_mulai && $konsultasi->tanggal_selesai
                        ? Carbon::parse($konsultasi->tanggal_mulai)->diffInMinutes(Carbon::parse($konsultasi->tanggal_selesai)) . ' min'
                        : '—'
                ];
            });

        return response()->json($histories);
    }
}