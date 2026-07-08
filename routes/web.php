<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\JadwalAhliController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BookmarkUserController;
use App\Models\AhliBotani;
use App\Models\TarifAhli;
use App\Models\Konsultasi;
use App\Models\Pesan;
use Illuminate\Support\Facades\Password;    
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\IncomeHistoryController;
use App\Models\JadwalAhli;
use Illuminate\Http\Request;



/*
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('homePublic');
});

Route::get('/homePublic', function () {
    return view('homePublic');
})->name('homePublic');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login-test', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/lupapass', function () {
    return view('lupapass');
});

Route::post('/forgot-password', [PasswordResetController::class, 'forgotPasswordWeb'])
    ->name('password.forgot.web');

Route::post('/reset-password', [PasswordResetController::class, 'resetPasswordWeb'])
    ->name('password.reset.web');

// Tulis seperti ini agar instance $request terbaca dengan sempurna
Route::get('/inputPassword', function () {
    return view('inputPassword', ['email' => request()->query('email')]);
})->name('password.reset.form');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register-user', [AuthController::class, 'registerUser'])
    ->name('registerUser.submit');

Route::post('/register-expert', [AuthController::class, 'registerExpert'])
    ->name('registerExpert.submit');

Route::get('/daftarArtikel', function () {
    $artikels = \App\Models\Artikel::with('ahliBotani.user')->latest()->get();
    $bookmarkedIds = \App\Models\BookmarkArtikel::where('user_id', auth()->id())->pluck('artikel_id')->toArray();
    return view('daftarArtikel', compact('artikels', 'bookmarkedIds'));
})->middleware('auth')->name('daftarArtikel');

Route::get('/bookmark-data', 
    [BookmarkUserController::class, 'getBookmarkData'])->middleware('auth');

Route::get('/daftarArtikel', 
[ArtikelController::class, 'indexWeb'])->name('daftarArtikel')->middleware('auth');

Route::get('/detailArtikelUser', 
[ArtikelController::class, 'showWeb'])->middleware('auth');

Route::get('/detailArtikelUser', function (\Illuminate\Http\Request $request) {
    $id = $request->query('id');
    $articleParam = $request->query('article');
    
    $artikel = null;
    if ($id) {
        $artikel = \App\Models\Artikel::with('ahliBotani.user')->find($id);
    } elseif ($articleParam) {
        if (is_numeric($articleParam)) {
            $artikel = \App\Models\Artikel::with('ahliBotani.user')->find($articleParam);
        } else {
            $keyMap = [
                'irrigation' => 'Modern Irrigation Techniques for Water Conservation',
                'soil' => 'Building Healthy Soil Through Composting',
                'pest' => 'Organic Pest Management Strategies',
                'drone' => 'Using Drones for Precision Agriculture',
                'rotation' => 'Crop Rotation for Long-Term Sustainability',
                'climate' => 'Climate-Smart Farming Practices',
                'hydroponic' => 'Introduction to Hydroponic Farming',
                'nutrients' => 'Understanding Soil Nutrients and Fertilization',
                'rainwater' => 'Rainwater Harvesting for Farm Use',
            ];
            $title = $keyMap[$articleParam] ?? $articleParam;
            $artikel = \App\Models\Artikel::with('ahliBotani.user')
                ->where('judul', 'like', "%$title%")
                ->first();
        }
    }
    
    if (!$artikel) {
        $artikel = \App\Models\Artikel::with('ahliBotani.user')->first();
    }
    
    // Fetch 3 recommended articles (excluding current one)
    $recommended = \App\Models\Artikel::with('ahliBotani.user')
        ->where('id', '!=', $artikel->id)
        ->inRandomOrder()
        ->limit(3)
        ->get();
        
    return view('detailArtikelUser', compact('artikel', 'recommended'));
})->middleware('auth')->name('detailArtikelUser');

Route::get('/find-experts', function () {
    // Ambil hari dan jam sekarang
    $now = \Carbon\Carbon::now();
    $hariMap = [
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu',
        'Sunday'    => 'Minggu',
    ];
    $hariIndo = $hariMap[$now->format('l')];
    $jamSekarang = $now->format('H:i'); // format 24 jam (misal "14:30")

    // Ambil ahli yang memiliki jadwal aktif untuk hari ini dan jam sekarang
    $dbExperts = AhliBotani::with(['user', 'ratings', 'jadwalAhli' => function($q) use ($hariIndo, $jamSekarang) {
        $q->where('hari', $hariIndo)
          ->where('status_ketersediaan', 'tersedia')
          ->where('jam_mulai', '<=', $jamSekarang)
          ->where('jam_selesai', '>=', $jamSekarang);
    }])
    ->whereHas('jadwalAhli', function($q) use ($hariIndo, $jamSekarang) {
        $q->where('hari', $hariIndo)
          ->where('status_ketersediaan', 'tersedia')
          ->where('jam_mulai', '<=', $jamSekarang)
          ->where('jam_selesai', '>=', $jamSekarang);
    })
    ->get()
    ->map(function($ahli) {
        $avgRating = $ahli->ratings->avg('nilai') ?? 0;
        $totalRatings = $ahli->ratings->count();
        $tarif = TarifAhli::where('ahli_botani_id', $ahli->id)
            ->where('status_aktif', 'aktif')
            ->first();
        return [
            'id'              => $ahli->id,
            'nama_ahli'       => $ahli->nama_ahli,
            'spesialisasi'    => $ahli->spesialisasi ?? 'General',
            'bio'             => $ahli->bio ?? '',
            'pengalaman'      => $ahli->pengalaman_tahun ?? 0,
            'rating'          => round($avgRating, 1),
            'total_rating'    => $totalRatings,
            'tarif'           => $tarif ? $tarif->tarif : 0,
            'domisili'        => $ahli->domisili ?? 'Indonesia',
            'almamater'       => $ahli->nama_almamater ?? '-',
            'profile_picture' => $ahli->user?->profile_picture
                ? asset('storage/' . $ahli->user->profile_picture)
                : null,
            'online'          => 'true',
            'fast_response'   => $totalRatings >= 10 ? 'true' : 'false',
            'popular'         => $totalRatings >= 50 ? 'true' : 'false',
            'indonesia'       => 'true',
            'title'           => $ahli->spesialisasi ?? 'Expert Botanist',
        ];
    });

    return view('find-experts', ['dbExperts' => $dbExperts]);
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Requires Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/homeExpert', function () {
        return view('homeExpert');
    })->name('homeExpert');

    // Dashboard User
    Route::get('/dashboard-user', 
    [DashboardController::class, 'userDashboard'])
    ->name('dashboard-user')->middleware('auth');

    // Dashboard Ahli
    Route::get('/dashboard-ahli', 
    [DashboardController::class, 'ahliDashboard'])
    ->name('dashboard-ahli')->middleware('auth');

    Route::get('/homeUser', function () {
        return view('homeUser');
    })->name('homeUser');

    Route::get('/accountUser', function () {
        return view('accountUser');
    })->name('accountUser');

    Route::get('/accountExpert', function () {
        return view('accountExpert');
    })->name('accountExpert');

    Route::get('/editProfileUser', function () {
        return view('editProfileUser');
    })->name('editProfileUser');

    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');


    Route::post('/update-photo', [ProfileController::class, 'updatePhoto'])
        ->name('updatePhoto');

    Route::get('/editProfileExpert', function () {
        return view('editProfileExpert');
    })->name('editProfileExpert');

    Route::put('/expert/profile/update', [ProfileController::class, 'updateProfile'])->name('expert.profile.update');

    Route::post('/konsultasi', [KonsultasiController::class, 'store'])->middleware('auth');
    Route::get('/konsultasi', [KonsultasiController::class, 'index'])->middleware('auth');
    Route::get('/konsultasi/{id}', [KonsultasiController::class, 'show'])->middleware('auth');
    Route::post('/konsultasi/{id}/end', [KonsultasiController::class, 'endChat'])->middleware('auth');
    Route::put('/konsultasi/{id}/status', [KonsultasiController::class, 'updateStatus'])->middleware('auth');


    Route::post('/artikel/{id}/bookmark', [ArtikelController::class, 'bookmark'])->name('web.bookmark');
    Route::delete('/artikel/{id}/bookmark', [ArtikelController::class, 'unbookmark'])->name('web.unbookmark');

    Route::get('/bookmarkArtikelUser', [BookmarkUserController::class, 'index'])->middleware('auth');

    Route::get('/consultationUser', function () {
        $user = auth()->user();
        $consultations = \App\Models\Konsultasi::where('user_id', $user->id)
            ->with(['ahliBotani.user'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($k) {
                $ahli = $k->ahliBotani;
                $avatarUrl = $ahli->user?->profile_picture
                    ? asset('storage/' . $ahli->user->profile_picture)
                    : null;
                return [
                    'id'         => $k->id,
                    'name'       => $ahli->nama_ahli,
                    'topic'      => $ahli->spesialisasi ?? 'General',
                    'preview'    => 'Active consultation with ' . $ahli->nama_ahli . '. Click to open chat room.',
                    'time'       => $k->created_at->diffForHumans(),
                    'status'     => $k->status_konsultasi === 'active' ? 'active' : 'completed',
                    'online'     => true,
                    'read'       => false,
                    'avatar'     => $avatarUrl,
                    'initials'   => strtoupper(substr($ahli->nama_ahli, 0, 2)),
                ];
            });

        return view('consultationUser', compact('consultations'));
    })->name('consultationUser');

 

    Route::get('/infoahli', function (\Illuminate\Http\Request $request) {
        $expertId = $request->query('id');
        $expert = \App\Models\AhliBotani::with(['user', 'ratings'])->find($expertId);
        if (!$expert) {
            $expert = \App\Models\AhliBotani::with(['user', 'ratings'])->first();
        }
        return view('infoahli', compact('expert'));
    })->name('infoahli');

    Route::get('/profileUser', function (\Illuminate\Http\Request $request) {
        $expertId = $request->query('id');
        $expert = null;
        if ($expertId) {
            $expert = \App\Models\AhliBotani::with(['user', 'ratings'])->find($expertId);
        }
        if (!$expert && auth()->check() && auth()->user()->role === 'ahli') {
            $expert = auth()->user()->ahliBotani;
        }
        if (!$expert) {
            $expert = \App\Models\AhliBotani::with(['user', 'ratings'])->first();
        }
        return view('profileUser', compact('expert'));
    })->name('profileUser');

    Route::get('/chatUSer', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $consultations = \App\Models\Konsultasi::where('user_id', $user->id)
            ->with(['ahliBotani.user'])
            ->get()
            ->map(function ($k) {
                $ahli = $k->ahliBotani;
                $avatarUrl = $ahli->user?->profile_picture ? asset('storage/' . $ahli->user->profile_picture) : null;
                return (object)[
                    'id'         => $k->id,
                    'name'       => $ahli->nama_ahli,
                    'topic'      => $k->topik ?? 'Plant Consultation',
                    'preview'    => 'Active consultation with ' . $ahli->nama_ahli . '. Click to open chat room.',
                    'time'       => $k->created_at->diffForHumans(),
                    'status'     => $k->status_konsultasi === 'active' ? 'active' : 'completed',
                    'online'     => true,
                    'read'       => false,
                    'avatar'     => $avatarUrl,
                    'initials'   => strtoupper(substr($ahli->nama_ahli, 0, 2)),
                ];
            });

        $activeId = $request->query('id');
        $activeConsultation = null;
        if ($activeId) {
            $activeConsultation = \App\Models\Konsultasi::where('id', $activeId)
                ->where('user_id', $user->id)
                ->with(['ahliBotani.user'])
                ->first();
        }
        if (!$activeConsultation && $consultations->count() > 0) {
            $activeConsultation = \App\Models\Konsultasi::where('id', $consultations->first()->id)
                ->where('user_id', $user->id)
                ->with(['ahliBotani.user'])
                ->first();
        }

        return view('chatUSer', compact('consultations', 'activeConsultation'));
    })->name('chatUSer');

    Route::get('/paymentUser', function (\Illuminate\Http\Request $request) {
        $expertId = $request->query('expert_id');
        $expert = \App\Models\AhliBotani::with('user')->find($expertId);
        
        if (!$expert) {
            $expert = \App\Models\AhliBotani::with('user')->first();
        }
        
        $tarif = \App\Models\TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();
            
        $price = $tarif ? $tarif->tarif : 45000;
        
        return view('paymentUser', compact('expert', 'price'));
    })->name('paymentUser');

    Route::post('/paymentUser', function (\Illuminate\Http\Request $request) {
        $validationRules = [
            'expert_id' => 'required|exists:ahli_botani,id',
        ];
        
        if (app()->environment('local') && $request->file('bukti_transfer') && $request->file('bukti_transfer')->getClientOriginalName() === 'bukti_transfer.png') {
            $validationRules['bukti_transfer'] = 'required|file|max:5120';
        } else {
            $validationRules['bukti_transfer'] = 'required|file|mimes:jpeg,png,jpg,pdf|max:5120';
        }
        
        $request->validate($validationRules);

        $user = auth()->user();
        $expertId = $request->input('expert_id');
        $expert = \App\Models\AhliBotani::findOrFail($expertId);
        
        $tarif = \App\Models\TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();
        $price = $tarif ? $tarif->tarif : 45000;

        $filePath = null;
        if ($request->hasFile('bukti_transfer')) {
            $filePath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        $pembayaran = \App\Models\Pembayaran::create([
            'user_id' => $user->id,
            'jumlah' => $price + 30000,
            'metode' => 'bank_transfer',
            'bukti_transfer' => $filePath,
            'tgl_pembayaran' => now(),
            'status_pembayaran' => 'success'
        ]);

        $konsultasi = \App\Models\Konsultasi::create([
            'user_id' => $user->id,
            'ahli_botani_id' => $expert->id,
            'pembayaran_id' => $pembayaran->id,
            'tarif_ahli_id' => $tarif ? $tarif->id : null,
            'tanggal_mulai' => now(),
            'status_konsultasi' => 'active',
            'topik' => 'Plant Consultation'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil disimpan',
            'konsultasi_id' => $konsultasi->id
        ]);
    })->name('expert.payment.save');

    Route::get('/articleExpert', function () {
        $artikels = \App\Models\Artikel::with('ahliBotani.user')->latest()->get();
        return view('articleExpert', compact('artikels'));
    })->name('articleExpert');

    Route::get('/myarticleExpert', function () {
    $user = auth()->user();
    $ahliBotani = $user->ahliBotani;
    $artikels = [];
    
    if ($ahliBotani) {
        // HANYA artikel milik ahli ini
        $artikels = \App\Models\Artikel::where('ahli_botani_id', $ahliBotani->id)
            ->with('ahliBotani.user')
            ->latest()
            ->get();
    }
    
    return view('myarticleExpert', compact('artikels'));
    })->name('myarticleExpert');

   Route::get('/manageSchedule', function () {
    $user = auth()->user();
    $ahliBotani = $user->ahliBotani;
    $jadwalData = [];

    if ($ahliBotani) {
        $jadwal = JadwalAhli::where('ahli_botani_id', $ahliBotani->id)->get();

        $days = [
            'monday'    => ['label' => 'Monday',    'slots' => [], 'active' => false],
            'tuesday'   => ['label' => 'Tuesday',   'slots' => [], 'active' => false],
            'wednesday' => ['label' => 'Wednesday', 'slots' => [], 'active' => false],
            'thursday'  => ['label' => 'Thursday',  'slots' => [], 'active' => false],
            'friday'    => ['label' => 'Friday',    'slots' => [], 'active' => false],
            'saturday'  => ['label' => 'Saturday',  'slots' => [], 'active' => false],
            'sunday'    => ['label' => 'Sunday',    'slots' => [], 'active' => false],
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

        $jadwalData = $days;
    }

    \Log::info('Manage Schedule Data:', $jadwalData);

    return view('manageSchedule', compact('jadwalData'));
    })->name('manageSchedule');

    
    Route::post('/manageSchedule', 
    [JadwalAhliController::class, 'saveSchedule'])->name('saveScheduleWeb');
    
    Route::get('/tulisartikelExpert', function () {
        return view('tulisartikelExpert');
    })->name('tulisartikelExpert');

    Route::post('/tulisartikelExpert', [ArtikelController::class, 'storeWeb'])->name('article.store');
    Route::delete('/tulisartikelExpert/{id}', [ArtikelController::class, 'destroy'])->name('article.destroy');

    Route::get('/consulexpert', function () {
        $user = auth()->user();
        $ahli = $user->ahliBotani;
        $consultations = collect();
        if ($ahli) {
            $consultations = Konsultasi::where('ahli_botani_id', $ahli->id)
                ->whereIn('status_konsultasi', ['active', 'pending'])
                ->with(['user', 'pesan' => function($q) { $q->latest('waktu_kirim')->limit(1); }])
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('consulexpert', compact('consultations'));
    })->name('consulexpert');

    Route::get('/setpricingexpert', function (\Illuminate\Http\Request $request) {
    $user = auth()->user();
    $ahliBotani = $user->ahliBotani;
    $tarif = null;
    $totalEarnings = 0;
    
    if ($ahliBotani) {
        $tarif = \App\Models\TarifAhli::where('ahli_botani_id', $ahliBotani->id)
            ->where('status_aktif', 'aktif')
            ->first();
        
        $totalEarnings = \App\Models\Konsultasi::where('ahli_botani_id', $ahliBotani->id)
            ->whereHas('pembayaran', function ($q) {
                $q->where('status_pembayaran', 'success');
            })
            ->with('pembayaran')
            ->get()
            ->sum(function ($k) {
                return $k->pembayaran ? $k->pembayaran->jumlah : 0;
            });
    }
    
    $currentTarif = $tarif ? $tarif->tarif : 0;
    
    // Jika request AJAX, return JSON
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'currentTarif' => number_format($currentTarif, 0, ',', ','),
            'totalEarnings' => $totalEarnings
        ]);
    }
    
    return view('setpricingexpert', compact('currentTarif', 'totalEarnings'));
    })->name('setpricingexpert');

    Route::post('/setpricingexpert', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'tarif' => 'required|string'
    ]);

    $user = auth()->user();
    $ahliBotani = $user->ahliBotani;
    
    if (!$ahliBotani) {
        return response()->json([
            'success' => false,
            'message' => 'Data ahli botani tidak ditemukan'
        ], 404);
    }

    // Clean format (ubah "55,000" menjadi 55000)
    $cleanTarif = str_replace([',', '.'], '', $request->tarif);
    $cleanTarif = (float)$cleanTarif;

    if ($cleanTarif <= 0) {
        return response()->json([
            'success' => false,
            'message' => 'Tarif harus lebih dari 0'
        ], 400);
    }

    try {
        // Non-aktifkan tarif lama (pakai 'nonaktif', bukan 'tidak_aktif')
        \App\Models\TarifAhli::where('ahli_botani_id', $ahliBotani->id)
            ->where('status_aktif', 'aktif')
            ->update([
                'status_aktif' => 'nonaktif',
                'tgl_akhir_berlaku' => now()
            ]);

        // Buat tarif baru
        $tarif = \App\Models\TarifAhli::create([
            'ahli_botani_id' => $ahliBotani->id,
            'tarif' => $cleanTarif,
            'tgl_mulai_berlaku' => now(),
            'status_aktif' => 'aktif'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tarif berhasil diperbarui',
            'tarif' => number_format($cleanTarif, 0, ',', ',')
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
    })->name('expert.pricing.save');

    Route::get('/ratinghistoryExpert', function () {
        return view('ratinghistoryExpert');
    })->name('ratinghistoryExpert');

    Route::get('/roomChatUser', function (\Illuminate\Http\Request $request) {
        $consultationId = $request->query('id');
        $user = auth()->user();

        $consultations = \App\Models\Konsultasi::where('user_id', $user->id)
            ->with(['ahliBotani.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        $activeConsultation = null;
        if ($consultationId) {
            $activeConsultation = \App\Models\Konsultasi::with(['ahliBotani.user'])->find($consultationId);
        }

        if (!$activeConsultation && $consultations->count() > 0) {
            $activeConsultation = $consultations->first();
        }

        return view('roomChatUser', compact('consultations', 'activeConsultation'));
    })->name('roomChatUser');

    Route::get('/roomChatExpert', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $ahli = $user->ahliBotani;
        $consultationId = $request->query('id');

        $consultations = collect();
        if ($ahli) {
            $consultations = Konsultasi::where('ahli_botani_id', $ahli->id)
                ->whereIn('status_konsultasi', ['active', 'pending'])
                ->with(['user'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $activeConsultation = null;
        if ($consultationId) {
            $activeConsultation = Konsultasi::with(['user'])->find($consultationId);
        }
        if (!$activeConsultation && $consultations->count() > 0) {
            $activeConsultation = $consultations->first();
        }

        // Load messages for active consultation
        $messages = collect();
        if ($activeConsultation) {
            $messages = Pesan::where('konsultasi_id', $activeConsultation->id)
                ->orderBy('waktu_kirim', 'asc')
                ->get();
        }

        return view('roomChatExpert', compact('consultations', 'activeConsultation', 'messages'));
    })->name('roomChatExpert');

    Route::get('/ConsultationhistoryUser', function () {
        return view('ConsultationhistoryUser');
    })->name('ConsultationhistoryUser');

    Route::get('/ConsultationhistoryExpert',
    [HistoryController::class,'expertHistory']
    )->name('ConsultationhistoryExpert');

    Route::get('/history/expert/data', 
    [HistoryController::class, 'expertHistoryData'])
    ->name('history.expert.data');

    Route::get('/history-expert-data', 
    [HistoryController::class, 'expertHistoryData'])->middleware('auth');

    Route::get('/history-user-data', 
    [UserHistoryController::class, 'getHistoryData'])->middleware('auth');
    
    Route::get('/consultexpert', function () {
        return view('consultexpert');
    })->name('consultexpert');

    Route::get('/supportUser', function () {
        return view('supportUser');
    })->name('supportUser');

    Route::get('/supportExpert', function () {
        return view('supportExpert');
    })->name('supportExpert');

    Route::get('/reviewsUser', function () {
        return view('reviewsUser');
    })->name('reviewsUser');

    Route::get('/lockRoomUser', function (\Illuminate\Http\Request $request) {
        $expertId = $request->query('expert_id');
        $expert = \App\Models\AhliBotani::with('user')->find($expertId);
        
        if (!$expert) {
            $expert = \App\Models\AhliBotani::with('user')->first();
        }
        
        $tarif = \App\Models\TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();
            
        $price = $tarif ? $tarif->tarif : 45000;
        
        return view('lockRoomUser', compact('expert', 'price'));
    })->name('lockRoomUser');

    Route::get('/paymentVerified', function () {
        return view('paymentVerified');
    })->name('paymentVerified');

    Route::get('/payment-failed', function () {
        return view('payment-failed');
    })->name('payment-failed');

    Route::get('/sidebar-expert', function () {
        return view('sidebar-expert');
    })->name('sidebar-expert');

    Route::get('/sidebar-user', function () {
        return view('sidebar-user');
    })->name('sidebar-user');

    Route::get('/incomeHistory', 
    [IncomeHistoryController::class, 'index'])
    ->middleware('auth')->name('incomeHistory');

    Route::get('/invoice', 
    [InvoiceController::class, 'index'])
    ->name('invoice')->middleware('auth');

    Route::get('/setPayMethod', function () {
        return view('setPayMethod');
    })->name('setPayMethod');

    Route::get('/endedRoomUser', function () {
        return view('Endedroomuser');
    })->name('endedRoomUser');

    Route::get('/userInfo', function () {
        return view('userInfo');
    })->name('userInfo');

    // ── Message Routes (Chat) ─────────────────────────────
    Route::post('/pesan', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'konsultasi_id' => 'required|exists:konsultasi,id',
            'isi_pesan' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = auth()->user();
        $konsultasi = Konsultasi::findOrFail($request->konsultasi_id);

        // Determine sender type
        $pengirim = 'user';
        if ($user->role === 'ahli') {
            $pengirim = 'ahli';
        }

        // Verify user belongs to this consultation
        if ($pengirim === 'user' && $konsultasi->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if ($pengirim === 'ahli') {
            $ahli = $user->ahliBotani;
            if (!$ahli || $konsultasi->ahli_botani_id !== $ahli->id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        }

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('chat_images', 'public');
        }

        $pesan = Pesan::create([
            'konsultasi_id' => $konsultasi->id,
            'pengirim' => $pengirim,
            'isi_pesan' => $request->isi_pesan,
            'gambar' => $gambarPath,
            'waktu_kirim' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $pesan->id,
                'pengirim' => $pesan->pengirim,
                'isi_pesan' => $pesan->isi_pesan,
                'gambar' => $gambarPath ? asset('storage/' . $gambarPath) : null,
                'waktu_kirim' => $pesan->waktu_kirim->format('g:i A'),
                'created_at' => $pesan->created_at->toISOString(),
            ]
        ]);
    })->name('pesan.store');

    Route::get('/pesan/{konsultasi_id}', function ($konsultasi_id, \Illuminate\Http\Request $request) {
        $user = auth()->user();
        $konsultasi = Konsultasi::findOrFail($konsultasi_id);

        // Verify access
        if ($user->role === 'user' && $konsultasi->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if ($user->role === 'ahli') {
            $ahli = $user->ahliBotani;
            if (!$ahli || $konsultasi->ahli_botani_id !== $ahli->id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        }

        $afterId = $request->query('after_id', 0);
        $messages = Pesan::where('konsultasi_id', $konsultasi_id)
            ->when($afterId, function($q) use ($afterId) {
                $q->where('id', '>', $afterId);
            })
            ->orderBy('waktu_kirim', 'asc')
            ->get()
            ->map(function($p) {
                return [
                    'id' => $p->id,
                    'pengirim' => $p->pengirim,
                    'isi_pesan' => $p->isi_pesan,
                    'gambar' => $p->gambar ? asset('storage/' . $p->gambar) : null,
                    'waktu_kirim' => $p->waktu_kirim->format('g:i A'),
                    'created_at' => $p->created_at->toISOString(),
                ];
            });

        return response()->json(['data' => $messages]);
    })->name('pesan.index');

    // End consultation
    Route::post('/konsultasi/{id}/end', function ($id) {
        $user = auth()->user();
        $konsultasi = Konsultasi::findOrFail($id);

        $konsultasi->status_konsultasi = 'selesai';
        $konsultasi->tanggal_selesai = now();
        $konsultasi->save();

        return response()->json(['success' => true, 'message' => 'Konsultasi diakhiri']);
    })->name('konsultasi.end');
});


    Route::get('/reviews-data', [ReviewsController::class, 'getReviewableData'])->middleware('auth');
    Route::post('/reviews', [ReviewsController::class, 'store'])->middleware('auth');