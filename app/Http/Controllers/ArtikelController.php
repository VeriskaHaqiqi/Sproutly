<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

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
        $validated = $request->validate([
            'ahli_botani_id' => 'required|exists:ahli_botani,id',
            'judul' => 'required|string|max:100',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|string',
            'kategori' => 'nullable|string|max:50',
        ]);

        $artikel = Artikel::create([
            'ahli_botani_id' => $validated['ahli_botani_id'],
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
        $artikel = Artikel::findOrFail($id);

        return response()->json([
            'data' => $artikel
        ]);
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
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        $artikel->delete();

        return response()->json([
            'message' => 'Artikel berhasil dihapus'
        ]);
    }
}