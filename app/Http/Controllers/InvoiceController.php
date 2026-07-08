<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $payments = Pembayaran::where('user_id', $user->id)
            ->with(['konsultasi.ahliBotani'])
            ->orderBy('created_at', 'desc')
            ->get();

        $invoices = $payments->map(function($payment) {
            $konsultasi = $payment->konsultasi;
            $ahli = $konsultasi ? $konsultasi->ahliBotani : null;
            
            $status = strtolower(trim($payment->status_pembayaran ?? ''));
            
            // 👇 Sesuaikan dengan yang diharapkan JavaScript
            if ($status === 'success') {
                $statusLabel = 'Paid';
                $badgeClass = 'badge-paid';
            } elseif ($status === 'pending') {
                $statusLabel = 'Pending';
                $badgeClass = 'badge-pending';
            } else {
                $statusLabel = 'Refund';
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

        // Statistik (case-insensitive)
        $totalPaid = Pembayaran::where('user_id', $user->id)
            ->whereRaw('LOWER(TRIM(status_pembayaran)) = ?', ['success'])
            ->sum('jumlah');

        $totalPending = Pembayaran::where('user_id', $user->id)
            ->whereRaw('LOWER(TRIM(status_pembayaran)) = ?', ['pending'])
            ->count();

        $totalRefund = Pembayaran::where('user_id', $user->id)
            ->whereRaw('LOWER(TRIM(status_pembayaran)) = ?', ['refund'])
            ->sum('jumlah');

        return view('invoice', [
            'invoices' => $invoices,
            'totalPaid' => $totalPaid,
            'totalPending' => $totalPending,
            'totalRefund' => $totalRefund,
        ]);
    }
}