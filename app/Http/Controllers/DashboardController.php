<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Konsultasi;
use App\Models\Rating;
use App\Models\Artikel;
use App\Models\BookmarkArtikel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Dashboard User
     */
    public function userDashboard()
    {
        $user = Auth::user();
        
        // Total bookmark (sebagai "articles viewed")
        $totalBookmarks = BookmarkArtikel::where('user_id', $user->id)->count();
        
        // Total konsultasi selesai
        $completedConsultations = Konsultasi::where('user_id', $user->id)
            ->where('status_konsultasi', 'selesai')
            ->count();
        
        // Recent activities (5 terakhir)
        $recentActivities = Konsultasi::where('user_id', $user->id)
            ->with(['ahliBotani', 'pembayaran'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($k) {
                $status = $k->status_konsultasi;
                $icon = $status === 'selesai' ? 'completed' : ($status === 'active' ? 'green' : 'yellow');
                $title = $status === 'selesai' ? 'Consultation completed' : 'Consultation active';
                $desc = $k->topik ?? 'Consultation with ' . ($k->ahliBotani->nama_ahli ?? 'Expert');
                
                return [
                    'id' => $k->id,
                    'icon' => $icon,
                    'title' => $title,
                    'description' => $desc,
                    'time' => $k->updated_at->diffForHumans(),
                    'status_label' => $status === 'selesai' ? 'Completed' : 'Active',
                ];
            });
        
        return view('dashboard-user', [
            'totalBookmarks' => $totalBookmarks,
            'completedConsultations' => $completedConsultations,
            'recentActivities' => $recentActivities,
        ]);
    }

    /**
     * Dashboard Ahli
     */
    public function ahliDashboard()
    {
        $user = Auth::user();
        $ahli = $user->ahliBotani;
        
        if (!$ahli) {
            return redirect()->back()->with('error', 'Data ahli tidak ditemukan');
        }
        
        // Konsultasi bulan ini (status active atau selesai)
        $consultationsThisMonth = Konsultasi::where('ahli_botani_id', $ahli->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        // Rata-rata rating
        $avgRating = Rating::where('ahli_botani_id', $ahli->id)->avg('nilai') ?? 0;
        
        // Total artikel diterbitkan
        $totalArticles = Artikel::where('ahli_botani_id', $ahli->id)->count();
        
        // Active consultations (3 terakhir)
        $activeConsultations = Konsultasi::where('ahli_botani_id', $ahli->id)
            ->where('status_konsultasi', 'active')
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function($k) {
                return [
                    'id' => $k->id,
                    'user_name' => $k->user->nama_user ?? 'User',
                    'topic' => $k->topik ?? 'Consultation',
                    'time' => $k->created_at->diffForHumans(),
                    'avatar' => $k->user->profile_picture 
                        ? asset('storage/' . $k->user->profile_picture) 
                        : asset('images/fotoprofile.png'),
                ];
            });
        
        return view('dashboard-ahli', [
            'consultationsThisMonth' => $consultationsThisMonth,
            'avgRating' => round($avgRating, 1),
            'totalArticles' => $totalArticles,
            'activeConsultations' => $activeConsultations,
        ]);
    }
}