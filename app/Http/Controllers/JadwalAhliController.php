<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalAhli;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Simpan jadwal dari form ManageSchedule.
     * Form mengirim: days[monday][active]=1, days[monday][slots][0][start]=09:00, dst.
     */
    public function saveSchedule(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'ahli') {
            return redirect()->route('manageSchedule')
                ->with('error', 'Hanya ahli botani yang dapat mengatur jadwal.');
        }

        $ahliBotani = $user->ahliBotani;

        if (!$ahliBotani) {
            return redirect()->route('manageSchedule')
                ->with('error', 'Data profil ahli botani tidak ditemukan.');
        }

        // Hapus semua jadwal lama milik ahli ini
        JadwalAhli::where('ahli_botani_id', $ahliBotani->id)->delete();

        $days = $request->input('days', []);
        $dayNames = [
            'monday'    => 'Senin',
            'tuesday'   => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday'  => 'Kamis',
            'friday'    => 'Jumat',
            'saturday'  => 'Sabtu',
            'sunday'    => 'Minggu',
        ];

        foreach ($dayNames as $key => $hariLabel) {
            // Jika hari tidak aktif, skip
            if (empty($days[$key]['active'])) {
                continue;
            }

            $slots = $days[$key]['slots'] ?? [];

            foreach ($slots as $slot) {
                $start = $slot['start'] ?? null;
                $end   = $slot['end']   ?? null;

                if (!$start || !$end) continue;

                // Validasi: end harus lebih dari start
                if ($end <= $start) continue;

                JadwalAhli::create([
                    'ahli_botani_id'       => $ahliBotani->id,
                    'hari'                 => $hariLabel,
                    'jam_mulai'            => $start,
                    'jam_selesai'          => $end,
                    'status_ketersediaan'  => 'tersedia',
                ]);
            }
        }

        return redirect()->route('manageSchedule')
            ->with('success', 'Jadwal berhasil disimpan!');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user || $user->role !== 'ahli') {
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
            'hari'                 => 'required|string|max:10',
            'jam_mulai'            => 'required|date_format:H:i',
            'jam_selesai'          => 'required|date_format:H:i|after:jam_mulai',
            'status_ketersediaan'  => 'nullable|string|max:15',
        ]);

        $jadwal = JadwalAhli::create([
            'ahli_botani_id'      => $ahliBotani->id,
            'hari'                => $validated['hari'],
            'jam_mulai'           => $validated['jam_mulai'],
            'jam_selesai'         => $validated['jam_selesai'],
            'status_ketersediaan' => $validated['status_ketersediaan'] ?? 'tersedia',
        ]);

        return response()->json([
            'message' => 'Jadwal berhasil ditambahkan',
            'data'    => $jadwal
        ], 201);
    }
}