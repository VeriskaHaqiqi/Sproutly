<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\AhliBotani;
use App\Models\TarifAhli;
use App\Models\JadwalAhli;
use App\Models\Pembayaran;

class WebProfileController extends Controller
{
    // === USER PROFILE ===

    public function accountUser()
    {
        $user = Auth::user();
        return view('accountUser', compact('user'));
    }

    public function editProfileUser()
    {
        $user = Auth::user();
        return view('editProfileUser', compact('user'));
    }

    public function updateProfileUser(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:16',
            'gender' => 'nullable|string|in:male,female,other',
            'photo' => 'nullable|image|max:2048',
        ]);

        $genderMap = [
            'male' => 'L',
            'female' => 'P',
            'other' => null,
        ];

        $user->nama_user = $validated['full_name'];
        $user->email = $validated['email'];
        $user->no_telp_user = $validated['phone'];
        $user->phone = $validated['phone'];
        if (array_key_exists('gender', $validated)) {
            $user->jenis_kelamin_user = $genderMap[$validated['gender']] ?? null;
        }

        if ($request->hasFile('photo')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('accountUser')->with('success', 'Profile updated successfully.');
    }

    // === EXPERT PROFILE ===

    public function accountExpert()
    {
        $user = Auth::user();
        $expert = $user->ahliBotani;
        return view('accountExpert', compact('user', 'expert'));
    }

    public function editProfileExpert()
    {
        $user = Auth::user();
        $expert = $user->ahliBotani;
        return view('editProfileExpert', compact('user', 'expert'));
    }

    public function updateProfileExpert(Request $request)
    {
        $user = Auth::user();
        $expert = $user->ahliBotani;

        $validated = $request->validate([
            'full_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:16',
            'gender' => 'nullable|string|in:male,female,other',
            'photo' => 'nullable|image|max:2048',
            'domisili' => 'nullable|string|max:30',
            'nama_almamater' => 'nullable|string|max:50',
        ]);

        $genderMap = [
            'male' => 'L',
            'female' => 'P',
            'other' => null,
        ];

        // Update User
        $user->nama_user = $validated['full_name'];
        $user->email = $validated['email'];
        $user->no_telp_user = $validated['phone'];
        $user->phone = $validated['phone'];
        if (array_key_exists('gender', $validated)) {
            $user->jenis_kelamin_user = $genderMap[$validated['gender']] ?? null;
        }

        if ($request->hasFile('photo')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_picture = $path;
        }
        $user->save();

        // Update Expert Detail
        if ($expert) {
            $expert->nama_ahli = $validated['full_name'];
            $expert->no_telp_ahli = $validated['phone'];
            if (array_key_exists('gender', $validated)) {
                $expert->jenis_kelamin_ahli = $genderMap[$validated['gender']] ?? null;
            }
            if (isset($validated['domisili'])) {
                $expert->domisili = $validated['domisili'];
            }
            if (isset($validated['nama_almamater'])) {
                $expert->nama_almamater = $validated['nama_almamater'];
            }
            $expert->save();
        }

        return redirect()->route('accountExpert')->with('success', 'Profile updated successfully.');
    }

    // === EXPERT PRICING ===

    public function getPricing()
    {
        $user = Auth::user();
        $expert = $user->ahliBotani;
        if (!$expert) {
            return redirect()->route('dashboard-ahli')->with('error', 'Expert profile not found.');
        }

        $activeTarif = TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();
        $fee = $activeTarif ? (int)$activeTarif->tarif : 0;

        $earnings = Pembayaran::where('status_pembayaran', 'success')
            ->whereIn('id', function ($query) use ($expert) {
                $query->select('pembayaran_id')
                    ->from('konsultasi')
                    ->where('ahli_botani_id', $expert->id)
                    ->whereNotNull('pembayaran_id');
            })
            ->sum('jumlah');

        return view('setpricingexpert', compact('fee', 'earnings'));
    }

    public function updatePricing(Request $request)
    {
        $user = Auth::user();
        $expert = $user->ahliBotani;
        if (!$expert) {
            return response()->json(['success' => false, 'message' => 'Expert profile not found.'], 404);
        }

        $validated = $request->validate([
            'tarif' => 'required|numeric|min:0',
        ]);

        // Deactivate old active fees
        TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->update(['status_aktif' => 'nonaktif', 'tgl_akhir_berlaku' => now()]);

        // Create new fee
        TarifAhli::create([
            'ahli_botani_id' => $expert->id,
            'tarif' => $validated['tarif'],
            'tgl_mulai_berlaku' => now(),
            'status_aktif' => 'aktif',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Consultation fee updated successfully.'
        ]);
    }

    // === EXPERT SCHEDULE ===

    public function getSchedule()
    {
        $user = Auth::user();
        $expert = $user->ahliBotani;
        if (!$expert) {
            return redirect()->route('dashboard-ahli')->with('error', 'Expert profile not found.');
        }

        $schedules = JadwalAhli::where('ahli_botani_id', $expert->id)->get();

        // Group by day for easier reference in view
        $scheduleByDay = [];
        foreach ($schedules as $sched) {
            $day = strtolower($sched->hari);
            $scheduleByDay[$day][] = [
                'start' => substr($sched->jam_mulai, 0, 5),
                'end' => substr($sched->jam_selesai, 0, 5),
            ];
        }

        return view('manageSchedule', compact('scheduleByDay'));
    }

    public function saveSchedule(Request $request)
    {
        $user = Auth::user();
        $expert = $user->ahliBotani;
        if (!$expert) {
            return redirect()->route('dashboard-ahli')->with('error', 'Expert profile not found.');
        }

        // Clear existing schedule
        JadwalAhli::where('ahli_botani_id', $expert->id)->delete();

        $days = $request->input('days', []);

        foreach ($days as $dayName => $dayData) {
            if (isset($dayData['active']) && $dayData['active'] == '1') {
                if (isset($dayData['slots']) && is_array($dayData['slots'])) {
                    foreach ($dayData['slots'] as $slot) {
                        if (isset($slot['start']) && isset($slot['end'])) {
                            JadwalAhli::create([
                                'ahli_botani_id' => $expert->id,
                                'hari' => $dayName,
                                'jam_mulai' => $slot['start'],
                                'jam_selesai' => $slot['end'],
                                'status_ketersediaan' => 'tersedia'
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('manageSchedule')->with('success', 'Schedule saved successfully!');
    }
}
