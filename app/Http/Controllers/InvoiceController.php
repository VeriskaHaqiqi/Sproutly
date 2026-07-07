<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\Konsultasi;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Tampilkan halaman invoice user
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil semua pembayaran user
        $payments = Pembayaran::where('user_id', $user->id)
            ->with(['konsultasi.ahliBotani'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Format data untuk invoice
        $invoices = $payments->map(function($payment) {
            $konsultasi = $payment->konsultasi;
            $ahli = $konsultasi ? $konsultasi->ahliBotani : null;
            
            // Tentukan status
            $status = $payment->status_pembayaran;
            $statusLabel = ucfirst($status);
            
            // Mapping status untuk badge
            if ($status === 'success') {
                $badgeClass = 'badge-paid';
            } elseif ($status === 'pending') {
                $badgeClass = 'badge-pending';
            } else {
                $badgeClass = 'badge-refund';
            }

            return [
                'id' => '#INV-' . str_pad($payment->id, 3, '0', STR_PAD_LEFT),
                'expert' => $ahli ? $ahli->nama_ahli : 'Unknown Expert',
                'role' => $ahli ? ($ahli->spesialisasi ?? 'Botany Expert') : 'Expert',
                'avatar' => $ahli && $ahli->user && $ahli->user->profile_picture
                    ? asset('storage/' . $ahli->user->profile_picture)
                    : asset('images/fotoprofile.png'),
                'consultation' => $konsultasi ? ($konsultasi->topik ?? 'Plant Consultation') : 'Consultation',
                'amount' => (float) $payment->jumlah,
                'due' => $payment->tgl_pembayaran 
                    ? Carbon::parse($payment->tgl_pembayaran)->format('M d, Y')
                    : Carbon::parse($payment->created_at)->format('M d, Y'),
                'status' => $statusLabel,
                'badge_class' => $badgeClass,
            ];
        });

        // Statistik
        $totalPaid = $payments->where('status_pembayaran', 'success')->sum('jumlah');
        $totalPending = $payments->where('status_pembayaran', 'pending')->count();
        $totalRefund = $payments->where('status_pembayaran', 'refund')->sum('jumlah');

        return view('invoice', [
            'invoices' => $invoices,
            'totalPaid' => $totalPaid,
            'totalPending' => $totalPending,
            'totalRefund' => $totalRefund,
        ]);
    }
}