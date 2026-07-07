<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Konsultasi;
use App\Models\Pembayaran;
use Carbon\Carbon;

class IncomeHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ahli = $user->ahliBotani;

        if (!$ahli) {
            return redirect()->back()->with('error', 'Data ahli tidak ditemukan');
        }

        // Ambil semua konsultasi selesai yang memiliki pembayaran sukses
        $consultations = Konsultasi::where('ahli_botani_id', $ahli->id)
            ->where('status_konsultasi', 'selesai')
            ->whereHas('pembayaran', function($q) {
                $q->where('status_pembayaran', 'success');
            })
            ->with(['pembayaran', 'user'])
            ->orderBy('tanggal_selesai', 'desc')
            ->get();

        // Summary
        $totalIncome = $consultations->sum(function($k) {
            return $k->pembayaran ? $k->pembayaran->jumlah : 0;
        });

        $thisMonthIncome = $consultations->filter(function($k) {
            return Carbon::parse($k->tanggal_selesai)->isCurrentMonth();
        })->sum(function($k) {
            return $k->pembayaran ? $k->pembayaran->jumlah : 0;
        });

        $totalSessions = $consultations->count();

        // Transactions list
        $transactions = $consultations->map(function($k) {
            $pembayaran = $k->pembayaran;
            $status = $pembayaran->status_pembayaran ?? 'pending';
            $badgeClass = $status === 'success' ? 'badge-paid' : ($status === 'pending' ? 'badge-pending' : 'badge-refund');

            // Tentukan periode untuk filter
            $period = 'all';
            if (Carbon::parse($k->tanggal_selesai)->isCurrentMonth()) {
                $period = 'this-month';
            } elseif (Carbon::parse($k->tanggal_selesai)->isLastMonth()) {
                $period = 'last-month';
            }

            return [
                'id' => $k->id,
                'user_name' => $k->user->nama_user ?? 'User',
                'type' => $k->topik ?? 'Consultation',
                'date' => Carbon::parse($k->tanggal_selesai)->format('M d, Y · h:i A'),
                'amount' => $pembayaran ? $pembayaran->jumlah : 0,
                'status' => ucfirst($status),
                'badge_class' => $badgeClass,
                'period' => $period,
            ];
        });

        return view('incomeHistory', [
            'totalIncome' => $totalIncome,
            'thisMonthIncome' => $thisMonthIncome,
            'totalSessions' => $totalSessions,
            'transactions' => $transactions,
        ]);
    }
}