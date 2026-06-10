<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\WebProfileController;
use Illuminate\Support\Facades\Password;    

Route::get('/reset-password/{token}', function ($token) {
    return view('inputPassword', ['token' => $token]);
})->name('password.reset');

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

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register-user', [AuthController::class, 'registerUser'])
    ->name('registerUser.submit');

Route::post('/register-expert', [AuthController::class, 'registerExpert'])
    ->name('registerExpert.submit');

Route::get('/inputPassword', function () {
    return view('inputPassword');
})->name('inputPassword');

// User Protected Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard-user', function () {
        return view('dashboard-user');
    });

    Route::get('/homeUser', function () {
        return view('homeUser');
    });

    Route::get('/find-experts', function () {
        return view('find-experts');
    });

    Route::get('/accountUser', [WebProfileController::class, 'accountUser'])
        ->name('accountUser');

    Route::get('/editProfileUser', [WebProfileController::class, 'editProfileUser'])
        ->name('editProfileUser');

    Route::put('/profile/update', [WebProfileController::class, 'updateProfileUser'])
        ->name('profile.update');

    Route::get('/daftarArtikel', function () {
        return view('daftarArtikel');
    });

    Route::get('/detailArtikelUser', function () {
        return view('detailArtikelUser');
    });

    Route::get('/bookmarkArtikelUser', function () {
        return view('bookmarkArtikelUser');
    });

    Route::get('/consultationUser', function () {
        return view('consultationUser');
    });

    Route::get('/infoahli', function () {
        return view('infoahli');
    })->name('infoahli');

    Route::get('/paymentUser', function () {
        return view('paymentUser');
    });

    Route::get('/roomChatUser', function () {
        return view('roomChatUser');
    });

    Route::get('/ConsultationhistoryUser', function () {
        return view('ConsultationhistoryUser');
    });

    Route::get('/supportUser', function () {
        return view('supportUser');
    });

    Route::get('/reviewsUser', function () {
        return view('reviewsUser');
    });

    Route::get('/lockRoomUser', function () {
        return view('lockRoomUser');
    });

    Route::get('/paymentVerified', function () {
        return view('paymentVerified');
    });

    Route::get('/payment-failed', function () {
        return view('payment-failed');
    });

    Route::get('/sidebar-user', function () {
        return view('sidebar-user');
    });

    Route::get('/invoice', function () {
        return view('invoice');
    });

    Route::get('/setPayMethod', function () {
        return view('setPayMethod');
    })->name('setPayMethod');

    Route::get('/endedRoomUser', function () {
        return view('endedRoomUser');
    });

    Route::get('/userInfo', function () {
        return view('userInfo');
    })->name('userInfo');
});

// Expert Protected Routes
Route::middleware(['auth', 'role:ahli'])->group(function () {
    Route::get('/dashboard-ahli', function () {
        return view('dashboard-ahli');
    })->name('dashboard-ahli');

    Route::get('/homeExpert', function () {
        return view('homeExpert');
    })->name('homeExpert');

    Route::get('/accountExpert', [WebProfileController::class, 'accountExpert'])
        ->name('accountExpert');

    Route::get('/editProfileExpert', [WebProfileController::class, 'editProfileExpert'])
        ->name('editProfileExpert');

    Route::put('/expert/profile/update', [WebProfileController::class, 'updateProfileExpert'])
        ->name('expert.profile.update');

    Route::get('/articleExpert', function () {
        return view('articleExpert');
    })->name('articleExpert');

    Route::get('/myarticleExpert', function () {
        return view('myarticleExpert');
    })->name('myarticleExpert');

    Route::get('/manageSchedule', [WebProfileController::class, 'getSchedule'])
        ->name('manageSchedule');

    Route::post('/manageSchedule', [WebProfileController::class, 'saveSchedule'])
        ->name('expert.schedule.save');

    Route::get('/tulisartikelExpert', function () {
        return view('tulisartikelExpert');
    });

    Route::get('/consulexpert', function () {
        return view('consulexpert');
    })->name('consultexpert');

    Route::get('/setpricingexpert', [WebProfileController::class, 'getPricing'])
        ->name('setpricingexpert');

    Route::post('/expert/pricing/update', [WebProfileController::class, 'updatePricing'])
        ->name('expert.pricing.update');

    Route::get('/ratinghistoryExpert', function () {
        return view('ratinghistoryExpert');
    });

    Route::get('/roomChatExpert', function () {
        return view('roomChatExpert');
    });

    Route::get('/ConsultationhistoryExpert', function () {
        return view('ConsultationhistoryExpert');
    })->name('ConsultationhistoryExpert');

    Route::get('/supportExpert', function () {
        return view('supportExpert');
    })->name('supportExpert');

    Route::get('/sidebar-expert', function () {
        return view('sidebar-expert');
    });

    Route::get('/incomeHistory', function () {
        return view('incomeHistory');
    });
});


