<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalAhli;

class JadwalAhliController extends Controller
{
    public function index()
    {
        $jadwal = JadwalAhli::with('ahliBotani')->get();

        return response()->json([
            'message' => 'Data jadwal ahli berhasil diambil',
            'data' => $jadwal
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'ahli') {
            return response()->json([
                'message' => 'Hanya ahli botani yang bisa menambahkan jadwal'
            ], 403);
        }

        $ahliBotani = $user->ahliBotani;

        if (!$ahliBotani) {
            return response()->json([
                'message' => 'Data ahli botani tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status_ketersediaan' => 'nullable|string|max:15',
        ]);

        $jadwal = JadwalAhli::create([
            'ahli_botani_id' => $ahliBotani->id,
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