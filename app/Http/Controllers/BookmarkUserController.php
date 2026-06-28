<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookmarkArtikel;
use App\Models\Artikel;
use Carbon\Carbon;

class BookmarkUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // DEBUG: Log user
        \Log::info('=== BOOKMARK PAGE LOADED ===');
        \Log::info('User ID: ' . $user->id);
        \Log::info('User Name: ' . $user->nama_user);

        // Ambil semua bookmark user
        $bookmarks = BookmarkArtikel::with('artikel.ahliBotani.user')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        \Log::info('Jumlah bookmark di database: ' . $bookmarks->count());

        $bookmarkedArticles = [];

        foreach ($bookmarks as $bookmark) {
            $artikel = $bookmark->artikel;
            
            \Log::info('Processing bookmark ID: ' . $bookmark->id . ', Artikel ID: ' . ($artikel ? $artikel->id : 'NULL'));
            
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

        // DEBUG: Log data yang akan dikirim
        \Log::info('Data yang akan dikirim ke view:');
        \Log::info('Total Saved: ' . $totalSaved);
        \Log::info('This Week: ' . $savedThisWeek);
        \Log::info('Top Category: ' . $topCategory);
        \Log::info('Jumlah Artikel: ' . count($bookmarkedArticles));

        // DEBUG: Cek apakah data ada
        if (count($bookmarkedArticles) > 0) {
            \Log::info('Contoh artikel pertama: ' . json_encode($bookmarkedArticles[0]));
        } else {
            \Log::info('TIDAK ADA ARTIKEL!');
        }

        return view('bookmarkArtikelUser', [
            'bookmarkedArticles' => $bookmarkedArticles,
            'totalSaved' => $totalSaved,
            'savedThisWeek' => $savedThisWeek,
            'topCategory' => $topCategory,
        ]);
    }

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