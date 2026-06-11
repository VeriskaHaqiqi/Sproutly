<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\BookmarkArtikel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    // tampil semua artikel (API)
    public function index()
    {
        $artikel = Artikel::all();

        return response()->json([
            'message' => 'Data artikel berhasil diambil',
            'data' => $artikel
        ]);
    }

    // Web: Daftar Artikel User
    public function webDaftarArtikel(Request $request)
    {
        $artikel = Artikel::with(['ahliBotani.user'])->latest()->get();
        return view('daftarArtikel', compact('artikel'));
    }

    // Web: Detail Artikel User
    public function webDetailArtikel(Request $request)
    {
        $id = $request->query('id') ?? $request->query('article');
        
        if (is_numeric($id)) {
            $art = Artikel::with(['ahliBotani.user'])->find($id);
        } else {
            $art = Artikel::with(['ahliBotani.user'])
                ->where('kategori', 'like', "%{$id}%")
                ->orWhere('judul', 'like', "%{$id}%")
                ->first();
        }

        if (!$art) {
            $art = Artikel::with(['ahliBotani.user'])->first();
        }

        // Recommended articles: other articles excluding current
        $recommended = [];
        if ($art) {
            $recommended = Artikel::with(['ahliBotani.user'])
                ->where('id', '!=', $art->id)
                ->limit(3)
                ->get();
        }

        return view('detailArtikelUser', compact('art', 'recommended'));
    }

    // Web: Bookmarked Articles User
    public function webBookmarkArtikel(Request $request)
    {
        $bookmarks = $request->user()->bookmarkedArticles()->with(['ahliBotani.user'])->latest()->get();
        return view('bookmarkArtikelUser', compact('bookmarks'));
    }

    // Web: Toggle Bookmark
    public function toggleBookmark(Request $request, $id)
    {
        $user = $request->user();
        $isBookmarked = $user->bookmarkedArticles()->where('artikel_id', $id)->exists();

        if ($isBookmarked) {
            $user->bookmarkedArticles()->detach($id);
            $status = 'unbookmarked';
        } else {
            $user->bookmarkedArticles()->attach($id);
            $status = 'bookmarked';
        }

        return response()->json([
            'status' => 'success',
            'bookmark_status' => $status
        ]);
    }

    // Web: Expert Articles Catalog
    public function expertIndex(Request $request)
    {
        $query = Artikel::with(['ahliBotani.user']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%");
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('kategori', $request->input('category'));
        }

        $artikel = $query->latest()->get();
        return view('articleExpert', compact('artikel'));
    }

    // Web: My Articles (Expert's own)
    public function expertMyArticles(Request $request)
    {
        $expert = $request->user()->ahliBotani;
        if (!$expert) {
            return redirect()->route('dashboard-ahli')->with('error', 'Ahli Botani profile not found.');
        }

        $artikel = Artikel::where('ahli_botani_id', $expert->id)->latest()->get();
        return view('myarticleExpert', compact('artikel'));
    }

    // Web: Create Article Form
    public function createArticleForm()
    {
        return view('tulisartikelExpert');
    }

    // Web: Store Article (Expert)
    public function storeArticle(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'ahli') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $expert = $user->ahliBotani;
        if (!$expert) {
            return response()->json(['message' => 'Ahli Botani profile not found'], 404);
        }

        $request->validate([
            'judul' => 'required|string|max:100',
            'konten' => 'required|string',
            'kategori' => 'nullable|string|max:50',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        $artikel = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori ?: 'General',
            'thumbnail' => $thumbnailPath,
            'tanggal_unggah' => now(),
        ]);

        return response()->json([
            'message' => 'Artikel berhasil diterbitkan',
            'data' => $artikel
        ], 201);
    }

    // Web: Delete Articles (Expert)
    public function deleteArticles(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'ahli') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $expert = $user->ahliBotani;
        if (!$expert) {
            return response()->json(['message' => 'Ahli Botani profile not found'], 404);
        }

        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No articles selected'], 400);
        }

        Artikel::where('ahli_botani_id', $expert->id)->whereIn('id', $ids)->delete();

        return response()->json([
            'message' => 'Articles deleted successfully'
        ]);
    }

    // tambah artikel (API)
    public function store(Request $request)
    {   
    $user = $request->user();

    if ($user->role !== 'ahli') {
        return response()->json([
            'message' => 'Hanya ahli botani yang bisa membuat artikel'
        ], 403);
    }

    $ahliBotani = $user->ahliBotani;

    if (!$ahliBotani) {
        return response()->json([
            'message' => 'Data ahli botani tidak ditemukan'
        ], 404);
    }

    $validated = $request->validate([
        'judul' => 'required|string|max:100',
        'konten' => 'required|string',
        'thumbnail' => 'nullable|string',
        'kategori' => 'nullable|string|max:50',
    ]);

    $artikel = Artikel::create([
        'ahli_botani_id' => $ahliBotani->id,
        'judul' => $validated['judul'],
        'konten' => $validated['konten'],
        'thumbnail' => $validated['thumbnail'] ?? null,
        'kategori' => $validated['kategori'] ?? null,
    ]);

    return response()->json([
        'message' => 'Artikel berhasil dibuat',
        'data' => $artikel
    ], 201);
    }

    // detail artikel (API)
    public function show($id)
    {
    try {
        $artikel = Artikel::find($id);
        
        if (!$artikel) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }
        
        return response()->json([
            'message' => 'Detail artikel berhasil diambil',
            'data' => $artikel
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan',
            'error' => $e->getMessage()
        ], 500);
    }
    }

    // update artikel (API)
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|string',
            'kategori' => 'nullable|string|max:50',
        ]);

        $artikel->update($validated);

        return response()->json([
            'message' => 'Artikel berhasil diupdate',
            'data' => $artikel
        ]);
    }

    // delete artikel (API)
    public function destroy(Request $request, $id)
    {
    $user = $request->user();

    if ($user->role !== 'ahli') {
        return response()->json([
            'message' => 'Hanya ahli botani yang bisa menghapus artikel'
        ], 403);
    }

    $ahliBotani = $user->ahliBotani;

    $artikel = Artikel::findOrFail($id);

    if ($artikel->ahli_botani_id !== $ahliBotani->id) {
        return response()->json([
            'message' => 'Kamu hanya bisa menghapus artikel milikmu sendiri'
        ], 403);
    }

    $artikel->delete();

    return response()->json([
        'message' => 'Artikel berhasil dihapus'
    ]);
    }

    public function bookmark(Request $request, $id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        $bookmark = BookmarkArtikel::firstOrCreate([
            'user_id' => $request->user()->id,
            'artikel_id' => $id,
        ]);

        return response()->json([
            'message' => 'Artikel berhasil dibookmark',
            'data' => $bookmark
        ], 201);
    }

    public function unbookmark(Request $request, $id)
    {
        BookmarkArtikel::where('user_id', $request->user()->id)
            ->where('artikel_id', $id)
            ->delete();

        return response()->json([
            'message' => 'Bookmark artikel berhasil dihapus'
        ]);
    }

    public function myBookmark(Request $request)
    {
        $bookmark = BookmarkArtikel::with('artikel')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Data bookmark berhasil diambil',
            'data' => $bookmark
        ]);
    }
}