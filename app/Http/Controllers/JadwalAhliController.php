<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalAhli;

class JadwalAhliController extends Controller
{
    public function index()
    {
        return response()->json(JadwalAhli::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ahli_botani_id' => 'required|exists:ahli_botani,id',
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status_ketersediaan' => 'nullable|string|max:15',
        ]);

        $jadwal = JadwalAhli::create([
            'ahli_botani_id' => $validated['ahli_botani_id'],
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'status_ketersediaan' => $validated['status_ketersediaan'] ?? 'tersedia',
        ]);

        return response()->json([
            'message' => 'Jadwal berhasil ditambahkan',
            'data' => $jadwal
        ], 201);
    }
}