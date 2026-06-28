<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\BookmarkArtikel;
class ArtikelController extends Controller
{
    // tampil semua artikel
    public function index()
    {
        $artikel = Artikel::all();

        return response()->json([
            'message' => 'Data artikel berhasil diambil',
            'data' => $artikel
        ]);
    }

    // tambah artikel
    public function store(Request $request)
    {   
    $user = $request->user();

    if (!$user || $user->role !== 'ahli') {
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

    // web tambah artikel
    public function storeWeb(Request $request)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'ahli') {
            return redirect()->back()->with('error', 'Hanya ahli botani yang bisa membuat artikel');
        }

        $ahliBotani = $user->ahliBotani;

        if (!$ahliBotani) {
            return redirect()->back()->with('error', 'Data ahli botani tidak ditemukan');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'nullable|string|max:50',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        Artikel::create([
            'ahli_botani_id' => $ahliBotani->id,
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'thumbnail' => $thumbnailPath,
            'kategori' => $validated['kategori'] ?? 'Hydroponics',
        ]);

        return redirect()->route('myarticleExpert')->with('success', 'Artikel berhasil dibuat');
    }

    // detail artikel
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

    // update artikel
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

    // delete artikel
    public function destroy(Request $request, $id)
    {
    $user = $request->user();

    if (!$user || $user->role !== 'ahli') {
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
    $user = $request->user();
    
    if (!$user) {
        return response()->json([
            'message' => 'Silakan login terlebih dahulu'
        ], 401);
    }

    $artikel = Artikel::find($id);

    if (!$artikel) {
        return response()->json([
            'message' => 'Artikel tidak ditemukan'
        ], 404);
    }

    // Cek apakah sudah di-bookmark
    $existing = BookmarkArtikel::where('user_id', $user->id)
        ->where('artikel_id', $id)
        ->first();

    if ($existing) {
        return response()->json([
            'message' => 'Artikel sudah di-bookmark'
        ], 400);
    }

    // Buat bookmark
    $bookmark = BookmarkArtikel::create([
        'user_id' => $user->id,
        'artikel_id' => $id,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Artikel berhasil dibookmark',
        'data' => $bookmark
    ], 201);
    }

    public function unbookmark(Request $request, $id)
    {
    $user = $request->user();
    
    if (!$user) {
        return response()->json([
            'message' => 'Silakan login terlebih dahulu'
        ], 401);
    }

    $deleted = BookmarkArtikel::where('user_id', $user->id)
        ->where('artikel_id', $id)
        ->delete();

    if ($deleted) {
        return response()->json([
            'success' => true,
            'message' => 'Bookmark berhasil dihapus'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Bookmark tidak ditemukan'
    ], 404);
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
    /**
 * Toggle bookmark (web) - untuk user
 */
    public function toggleBookmarkWeb(Request $request, $id)
    {
    $user = auth()->user();
    
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Silakan login terlebih dahulu'
        ], 401);
    }

    $artikel = Artikel::find($id);
    
    if (!$artikel) {
        return response()->json([
            'success' => false,
            'message' => 'Artikel tidak ditemukan'
        ], 404);
    }

    // Cek apakah sudah di-bookmark
    $bookmark = BookmarkArtikel::where('user_id', $user->id)
        ->where('artikel_id', $id)
        ->first();

    if ($bookmark) {
        // Hapus bookmark
        $bookmark->delete();
        return response()->json([
            'success' => true,
            'message' => 'Bookmark berhasil dihapus',
            'isBookmarked' => false,
        ]);
    } else {
        // Tambah bookmark
        BookmarkArtikel::create([
            'user_id' => $user->id,
            'artikel_id' => $id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil di-bookmark',
            'isBookmarked' => true,
        ]);
    }
    }
    /**
 * Tampilkan halaman daftar artikel (web)
 */
    public function indexWeb()
    {
    $artikels = Artikel::with('ahliBotani.user')->latest()->get();
    
    // Ambil ID artikel yang sudah di-bookmark oleh user
    $user = auth()->user();
    $bookmarkedIds = [];
    if ($user) {
        $bookmarkedIds = BookmarkArtikel::where('user_id', $user->id)
            ->pluck('artikel_id')
            ->toArray();
    }
    
    return view('daftarArtikel', [
        'artikels' => $artikels,
        'bookmarkedIds' => $bookmarkedIds,
    ]);
    }

/**
 * Tampilkan detail artikel (web)
 */
    public function showWeb(Request $request)
    {
    $id = $request->query('article');
    $artikel = Artikel::with('ahliBotani.user')->findOrFail($id);
    
    // Cek apakah user sudah bookmark artikel ini
    $user = auth()->user();
    $isBookmarked = false;
    if ($user) {
        $isBookmarked = BookmarkArtikel::where('user_id', $user->id)
            ->where('artikel_id', $id)
            ->exists();
    }
    
    return view('detailArtikelUser', [
        'artikel' => $artikel,
        'isBookmarked' => $isBookmarked,
    ]);
    }
}