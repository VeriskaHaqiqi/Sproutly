<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TarifAhli;

class TarifAhliController extends Controller
{
    // tampil semua tarif
    public function index()
    {
        $tarif = TarifAhli::all();

        return response()->json([
            'message' => 'Data tarif berhasil diambil',
            'data' => $tarif
        ]);
    }

    // tambah tarif
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ahli_botani_id' => 'required|exists:ahli_botani,id',
            'tarif' => 'required|numeric|min:0',
            'tgl_mulai_berlaku' => 'required|date',
            'tgl_akhir_berlaku' => 'nullable|date',
            'status_aktif' => 'nullable|string|max:10',
        ]);

        $tarif = TarifAhli::create([
            'ahli_botani_id' => $validated['ahli_botani_id'],
            'tarif' => $validated['tarif'],
            'tgl_mulai_berlaku' => $validated['tgl_mulai_berlaku'],
            'tgl_akhir_berlaku' => $validated['tgl_akhir_berlaku'] ?? null,
            'status_aktif' => $validated['status_aktif'] ?? 'aktif',
        ]);

        return response()->json([
            'message' => 'Tarif berhasil ditambahkan',
            'data' => $tarif
        ], 201);
    }

    // detail tarif
    public function show($id)
    {
        $tarif = TarifAhli::findOrFail($id);

        return response()->json([
            'data' => $tarif
        ]);
    }

    // update tarif
    public function update(Request $request, $id)
    {
        $tarif = TarifAhli::findOrFail($id);

        $validated = $request->validate([
            'tarif' => 'required|numeric|min:0',
            'tgl_mulai_berlaku' => 'required|date',
            'tgl_akhir_berlaku' => 'nullable|date',
            'status_aktif' => 'nullable|string|max:10',
        ]);

        $tarif->update($validated);

        return response()->json([
            'message' => 'Tarif berhasil diupdate',
            'data' => $tarif
        ]);
    }

    // hapus tarif
    public function destroy($id)
    {
        $tarif = TarifAhli::findOrFail($id);

        $tarif->delete();

        return response()->json([
            'message' => 'Tarif berhasil dihapus'
        ]);
    }
}