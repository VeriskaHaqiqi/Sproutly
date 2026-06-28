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
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil semua bookmark user dengan relasi artikel
        $bookmarks = BookmarkArtikel::with('artikel.ahliBotani.user')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Debug: log jumlah bookmark
        \Log::info('Bookmark ditemukan: ' . $bookmarks->count() . ' untuk user: ' . $user->id);

        $bookmarkedArticles = [];

        foreach ($bookmarks as $bookmark) {
            $artikel = $bookmark->artikel;
            
            if ($artikel) {
                $bookmarkedArticles[] = [
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
            }
        }

        // Hitung statistik
        $totalSaved = count($bookmarkedArticles);
        $savedThisWeek = 0;
        
        foreach ($bookmarkedArticles as $item) {
            if (Carbon::parse($item['bookmarked_at'])->diffInDays(Carbon::now()) <= 7) {
                $savedThisWeek++;
            }
        }

        // Hitung kategori terbanyak
        $topCategory = 'No Articles';
        if (!empty($bookmarkedArticles)) {
            $categories = [];
            foreach ($bookmarkedArticles as $article) {
                $topic = $article['topic'] ?? 'General';
                $categories[$topic] = ($categories[$topic] ?? 0) + 1;
            }
            arsort($categories);
            $topCategory = key($categories);
        }

        // Debug: log data yang dikirim
        \Log::info('Data dikirim ke view: ' . json_encode([
            'total' => $totalSaved,
            'this_week' => $savedThisWeek,
            'top_category' => $topCategory,
            'articles_count' => count($bookmarkedArticles)
        ]));

        return view('bookmarkArtikelUser', [
            'bookmarkedArticles' => $bookmarkedArticles,
            'totalSaved' => $totalSaved,
            'savedThisWeek' => $savedThisWeek,
            'topCategory' => $topCategory,
        ]);
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

        $bookmarks = BookmarkArtikel::with('artikel.ahliBotani.user')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $bookmarkedArticles = [];

        foreach ($bookmarks as $bookmark) {
            $artikel = $bookmark->artikel;
            
            if ($artikel) {
                $bookmarkedArticles[] = [
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
            }
        }

        $totalSaved = count($bookmarkedArticles);
        $savedThisWeek = 0;
        
        foreach ($bookmarkedArticles as $item) {
            if (Carbon::parse($item['bookmarked_at'])->diffInDays(Carbon::now()) <= 7) {
                $savedThisWeek++;
            }
        }

        // Hitung kategori terbanyak
        $topCategory = 'No Articles';
        if (!empty($bookmarkedArticles)) {
            $categories = [];
            foreach ($bookmarkedArticles as $article) {
                $topic = $article['topic'] ?? 'General';
                $categories[$topic] = ($categories[$topic] ?? 0) + 1;
            }
            arsort($categories);
            $topCategory = key($categories);
        }

        return response()->json([
            'articles' => $bookmarkedArticles,
            'stats' => [
                'total' => $totalSaved,
                'this_week' => $savedThisWeek,
                'top_category' => $topCategory,
            ]
        ]);
    }
}