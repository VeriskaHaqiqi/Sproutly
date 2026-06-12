<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::all();

        return response()->json([
            'message' => 'Data konsultasi berhasil diambil',
            'data' => $konsultasi
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ahli_botani_id' => 'required|exists:ahli_botani,id',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'status_konsultasi' => 'nullable|string|max:20',
            'topik' => 'nullable|string|max:100',
        ]);

        $konsultasi = Konsultasi::create([
            'user_id' => $validated['user_id'],
            'ahli_botani_id' => $validated['ahli_botani_id'],
            'tanggal_mulai' => $validated['tanggal_mulai'] ?? null,
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
            'status_konsultasi' => $validated['status_konsultasi'] ?? 'pending',
            'topik' => $validated['topik'] ?? null,
        ]);

        return response()->json([
            'message' => 'Konsultasi berhasil dibuat',
            'data' => $konsultasi
        ], 201);
    }
}