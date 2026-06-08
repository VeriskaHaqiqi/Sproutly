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