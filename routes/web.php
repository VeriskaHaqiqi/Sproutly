<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\JadwalAhliController;
use App\Http\Controllers\ArtikelController;
use App\Models\AhliBotani;
use App\Models\TarifAhli;
use Illuminate\Support\Facades\Password;    



/*
|--------------------------------------------------------------------------
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

Route::get('/reset-password/{token}', function ($token) {
    return view('inputPassword', ['token' => $token]);
})->name('password.reset');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register-user', [AuthController::class, 'registerUser'])
    ->name('registerUser.submit');

Route::post('/register-expert', [AuthController::class, 'registerExpert'])
    ->name('registerExpert.submit');

Route::get('/daftarArtikel', function () {
    $artikels = \App\Models\Artikel::with('ahliBotani.user')->latest()->get();
    return view('daftarArtikel', compact('artikels'));
})->middleware('auth')->name('daftarArtikel');

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
    // Ambil ahli botani dari DB yang punya jadwal tersedia
    $dbExperts = AhliBotani::with(['user', 'ratings', 'jadwalAhli'])
        ->whereHas('jadwalAhli', function($q) {
            $q->where('status_ketersediaan', 'tersedia');
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
                // Advanced filter flags
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

    Route::get('/dashboard-user', function () {
        return view('dashboard-user');
    })->name('dashboard-user');

    Route::get('/dashboard-ahli', function () {
        return view('dashboard-ahli');
    })->name('dashboard-ahli');

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

    Route::get('/bookmarkArtikelUser', function () {
        $allArticles = \App\Models\Artikel::with('ahliBotani.user')->latest()->get()->map(function ($artikel) {
            $authorName = $artikel->ahliBotani->nama_ahli ?? 'Expert';
            return [
                'id' => (string)$artikel->id,
                'title' => $artikel->judul,
                'topic' => ucwords($artikel->kategori),
                'date' => $artikel->tanggal_unggah ? \Carbon\Carbon::parse($artikel->tanggal_unggah)->format('Y-m-d') : $artikel->created_at->format('Y-m-d'),
                'displayDate' => $artikel->tanggal_unggah ? \Carbon\Carbon::parse($artikel->tanggal_unggah)->format('M d, Y') : $artikel->created_at->format('M d, Y'),
                'author' => $authorName,
                'description' => \Illuminate\Support\Str::limit(strip_tags($artikel->konten), 120),
                'image' => $artikel->thumbnail ? (str_starts_with($artikel->thumbnail, 'http') ? $artikel->thumbnail : asset('storage/' . $artikel->thumbnail)) : 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6'
            ];
        })->values();
        return view('bookmarkArtikelUser', compact('allArticles'));
    })->name('bookmarkArtikelUser');

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

    Route::get('/inputPassword', function () {
        return view('inputPassword');
    })->name('inputPassword');

    Route::get('/infoahli', function () {
        return view('infoahli');
    })->name('infoahli');

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
        $request->validate([
            'expert_id' => 'required|exists:ahli_botani,id',
            'bukti_transfer' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120'
        ]);

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
        $ahliBotani = auth()->user()->ahliBotani;
        $artikels = [];
        if ($ahliBotani) {
            $artikels = \App\Models\Artikel::where('ahli_botani_id', $ahliBotani->id)->latest()->get();
        }
        return view('myarticleExpert', compact('artikels'));
    })->name('myarticleExpert');

    Route::get('/manageSchedule', function () {
        return view('manageSchedule');
    })->name('manageSchedule');

    Route::post('/manageSchedule', [JadwalAhliController::class, 'saveSchedule'])
        ->name('expert.schedule.save');

    Route::get('/tulisartikelExpert', function () {
        return view('tulisartikelExpert');
    })->name('tulisartikelExpert');

    Route::post('/tulisartikelExpert', [ArtikelController::class, 'storeWeb'])->name('article.store');
    Route::delete('/tulisartikelExpert/{id}', [ArtikelController::class, 'destroy'])->name('article.destroy');

    Route::get('/consulexpert', function () {
        return view('consulexpert');
    })->name('consulexpert');

    Route::get('/setpricingexpert', function () {
        $ahliBotani = auth()->user()->ahliBotani;
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
                    return $k->pembayaran->jumlah;
                });
        }
        
        $currentTarif = $tarif ? $tarif->tarif : 0;
        return view('setpricingexpert', compact('currentTarif', 'totalEarnings'));
    })->name('setpricingexpert');

    Route::post('/setpricingexpert', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'tarif' => 'required|string'
        ]);

        $ahliBotani = auth()->user()->ahliBotani;
        if (!$ahliBotani) {
            return response()->json(['message' => 'Data ahli botani tidak ditemukan'], 404);
        }

        // Clean the format (e.g. from 12,000 to 12000)
        $cleanTarif = str_replace([',', '.'], '', $request->tarif);
        $cleanTarif = (float)$cleanTarif;

        // Deactivate old tariffs
        \App\Models\TarifAhli::where('ahli_botani_id', $ahliBotani->id)
            ->update(['status_aktif' => 'tidak_aktif', 'tgl_akhir_berlaku' => now()]);

        // Create new tariff
        \App\Models\TarifAhli::create([
            'ahli_botani_id' => $ahliBotani->id,
            'tarif' => $cleanTarif,
            'tgl_mulai_berlaku' => now(),
            'status_aktif' => 'aktif'
        ]);

        return response()->json([
            'message' => 'Tarif berhasil diperbarui',
            'tarif' => number_format($cleanTarif, 0, ',', ',')
        ]);
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

    Route::get('/roomChatExpert', function () {
        return view('roomChatExpert');
    })->name('roomChatExpert');

    Route::get('/ConsultationhistoryUser', function () {
        return view('ConsultationhistoryUser');
    })->name('ConsultationhistoryUser');

    Route::get('/ConsultationhistoryExpert', function () {
        return view('ConsultationhistoryExpert');
    })->name('ConsultationhistoryExpert');

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

    Route::get('/incomeHistory', function () {
        return view('incomeHistory');
    })->name('incomeHistory');

    Route::get('/invoice', function () {
        return view('invoice');
    })->name('invoice');

    Route::get('/setPayMethod', function () {
        return view('setPayMethod');
    })->name('setPayMethod');

    Route::get('/endedRoomUser', function () {
        return view('endedRoomUser');
    })->name('endedRoomUser');

    Route::get('/userInfo', function () {
        return view('userInfo');
    })->name('userInfo');
});
