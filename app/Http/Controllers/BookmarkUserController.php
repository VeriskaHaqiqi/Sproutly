<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookmarkArtikel;
use App\Models\Artikel;
use Carbon\Carbon;

class BookmarkUserController extends Controller
{
    /**
     * Tampilkan halaman bookmark user
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil semua artikel yang di-bookmark oleh user
        $bookmarkedArticles = BookmarkArtikel::with('artikel.ahliBotani.user')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function($bookmark) {
                $artikel = $bookmark->artikel;
                return [
                    'id' => $artikel->id,
                    'title' => $artikel->judul,
                    'topic' => $artikel->kategori ?? 'General',
                    'date' => $artikel->tanggal_unggah ? Carbon::parse($artikel->tanggal_unggah)->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
                    'displayDate' => $artikel->tanggal_unggah ? Carbon::parse($artikel->tanggal_unggah)->format('M d, Y') : Carbon::now()->format('M d, Y'),
                    'author' => $artikel->ahliBotani ? $artikel->ahliBotani->nama_ahli : 'Unknown Author',
                    'description' => $artikel->konten ? substr(strip_tags($artikel->konten), 0, 120) . '...' : 'No description available',
                    'image' => $artikel->thumbnail ? asset('storage/' . $artikel->thumbnail) : null,
                    'bookmarked_at' => $bookmark->created_at,
                ];
            });

        // Kirim data ke view
        return view('bookmarkArtikelUser', [
            'bookmarkedArticles' => $bookmarkedArticles,
            'totalSaved' => $bookmarkedArticles->count(),
            'savedThisWeek' => $bookmarkedArticles->filter(function($item) {
                return Carbon::parse($item['bookmarked_at'])->diffInDays(Carbon::now()) <= 7;
            })->count(),
            'topCategory' => $this->getTopCategory($bookmarkedArticles),
        ]);
    }

    /**
     * Hitung kategori terbanyak
     */
    private function getTopCategory($articles)
    {
        $categories = [];
        foreach ($articles as $article) {
            $topic = $article['topic'] ?? 'General';
            $categories[$topic] = ($categories[$topic] ?? 0) + 1;
        }
        
        if (empty($categories)) {
            return 'No Articles';
        }
        
        arsort($categories);
        return key($categories);
    }

    /**
     * API: Ambil data bookmark dalam format JSON
     */
    public function getBookmarkData()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([], 401);
        }

        $bookmarkedArticles = BookmarkArtikel::with('artikel.ahliBotani.user')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function($bookmark) {
                $artikel = $bookmark->artikel;
                return [
                    'id' => $artikel->id,
                    'title' => $artikel->judul,
                    'topic' => $artikel->kategori ?? 'General',
                    'date' => $artikel->tanggal_unggah ? Carbon::parse($artikel->tanggal_unggah)->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
                    'displayDate' => $artikel->tanggal_unggah ? Carbon::parse($artikel->tanggal_unggah)->format('M d, Y') : Carbon::now()->format('M d, Y'),
                    'author' => $artikel->ahliBotani ? $artikel->ahliBotani->nama_ahli : 'Unknown Author',
                    'description' => $artikel->konten ? substr(strip_tags($artikel->konten), 0, 120) . '...' : 'No description available',
                    'image' => $artikel->thumbnail ? asset('storage/' . $artikel->thumbnail) : null,
                    'bookmarked_at' => $bookmark->created_at,
                ];
            });

        $totalSaved = $bookmarkedArticles->count();
        $savedThisWeek = $bookmarkedArticles->filter(function($item) {
            return Carbon::parse($item['bookmarked_at'])->diffInDays(Carbon::now()) <= 7;
        })->count();

        return response()->json([
            'articles' => $bookmarkedArticles,
            'stats' => [
                'total' => $totalSaved,
                'this_week' => $savedThisWeek,
                'top_category' => $this->getTopCategory($bookmarkedArticles),
            ]
        ]);
    }
}