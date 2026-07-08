<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalAhli;
use App\Models\AhliBotani;
use Illuminate\Support\Facades\Auth;

class JadwalAhliController extends Controller
{
    /**
     * API: Tampilkan semua jadwal (untuk endpoint API)
     */
    public function index()
    {
        $jadwal = JadwalAhli::with('ahliBotani')->get();

        return response()->json([
            'message' => 'Data jadwal ahli berhasil diambil',
            'data' => $jadwal
        ]);
    }

    /**
     * API: Tambah jadwal baru (via API)
     */
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

    /**
     * Web: Ambil jadwal untuk ahli yang sedang login
     * (digunakan untuk mengisi form Manage Schedule)
     */
    public function getScheduleForCurrentAhli()
    {
        $user = Auth::user();
        $ahliBotani = $user->ahliBotani;

        if (!$ahliBotani) {
            return redirect()->route('manageSchedule')
                ->with('error', 'Data profil ahli botani tidak ditemukan.');
        }

        // Ambil semua jadwal milik ahli ini
        $jadwal = JadwalAhli::where('ahli_botani_id', $ahliBotani->id)->get();

        // Format jadwal per hari untuk memudahkan view
        $days = [
            'monday'    => ['label' => 'Senin',    'slots' => [], 'active' => false],
            'tuesday'   => ['label' => 'Selasa',   'slots' => [], 'active' => false],
            'wednesday' => ['label' => 'Rabu',     'slots' => [], 'active' => false],
            'thursday'  => ['label' => 'Kamis',    'slots' => [], 'active' => false],
            'friday'    => ['label' => 'Jumat',    'slots' => [], 'active' => false],
            'saturday'  => ['label' => 'Sabtu',    'slots' => [], 'active' => false],
            'sunday'    => ['label' => 'Minggu',   'slots' => [], 'active' => false],
        ];

        foreach ($jadwal as $j) {
            $hariKey = array_search($j->hari, array_column($days, 'label'));
            if ($hariKey !== false) {
                $days[$hariKey]['active'] = true;
                $days[$hariKey]['slots'][] = [
                    'start' => $j->jam_mulai,
                    'end'   => $j->jam_selesai,
                ];
            }
        }

        return $days;
    }

    /**
     * Web: Simpan jadwal dari form Manage Schedule.
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

    // DEBUG: Log data yang diterima
    \Log::info('=== SAVE SCHEDULE REQUEST ===');
    \Log::info('Request data:', $request->all());

    // Hapus semua jadwal lama
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

    $savedCount = 0;

    foreach ($dayNames as $key => $hariLabel) {
        // Jika hari tidak aktif, skip
        if (empty($days[$key]['active'])) {
            \Log::info("Hari {$hariLabel} tidak aktif, skip.");
            continue;
        }

        $slots = $days[$key]['slots'] ?? [];

        \Log::info("Hari {$hariLabel} aktif, slot count: " . count($slots));

        foreach ($slots as $slot) {
            $start = $slot['start'] ?? null;
            $end   = $slot['end']   ?? null;

            if (!$start || !$end) continue;
            if ($end <= $start) continue;

            JadwalAhli::create([
                'ahli_botani_id'       => $ahliBotani->id,
                'hari'                 => $hariLabel,
                'jam_mulai'            => $start,
                'jam_selesai'          => $end,
                'status_ketersediaan'  => 'tersedia',
            ]);

            $savedCount++;
        }
    }

    \Log::info("Total jadwal tersimpan: " . $savedCount);

    return redirect()->route('manageSchedule')
        ->with('success', 'Jadwal berhasil disimpan!');
}}