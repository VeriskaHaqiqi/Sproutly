<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\WebProfileController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ArtikelController;
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

    Route::get('/find-experts', [KonsultasiController::class, 'findExperts'])
        ->name('find-experts');

    Route::get('/accountUser', [WebProfileController::class, 'accountUser'])
        ->name('accountUser');

    Route::get('/editProfileUser', [WebProfileController::class, 'editProfileUser'])
        ->name('editProfileUser');

    Route::put('/profile/update', [WebProfileController::class, 'updateProfileUser'])
        ->name('profile.update');

    Route::get('/daftarArtikel', [ArtikelController::class, 'webDaftarArtikel'])
        ->name('daftarArtikel');

    Route::get('/detailArtikelUser', [ArtikelController::class, 'webDetailArtikel'])
        ->name('detailArtikelUser');

    Route::get('/bookmarkArtikelUser', [ArtikelController::class, 'webBookmarkArtikel'])
        ->name('bookmarkArtikelUser');

    Route::post('/bookmark/toggle/{id}', [ArtikelController::class, 'toggleBookmark'])
        ->name('bookmark.toggle');

    Route::get('/consultationUser', [KonsultasiController::class, 'consultationUser'])
        ->name('consultationUser');

    Route::get('/infoahli', [KonsultasiController::class, 'infoAhli'])
        ->name('infoahli');

    Route::get('/paymentUser', [KonsultasiController::class, 'paymentUser'])
        ->name('paymentUser');

    Route::get('/roomChatUser', [KonsultasiController::class, 'roomChatUser'])
        ->name('roomChatUser');

    Route::get('/ConsultationhistoryUser', [KonsultasiController::class, 'consultationUser'])
        ->name('ConsultationhistoryUser');

    Route::get('/supportUser', function () {
        return view('supportUser');
    });

    Route::get('/reviewsUser', function () {
        return view('reviewsUser');
    });

    Route::get('/lockRoomUser', [KonsultasiController::class, 'lockRoomUser'])
        ->name('lockRoomUser');

    Route::get('/paymentVerified', [KonsultasiController::class, 'paymentVerified'])
        ->name('paymentVerified');

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

    Route::get('/endedRoomUser', [KonsultasiController::class, 'endedRoomUser'])
        ->name('endedRoomUser');

    Route::get('/userInfo', function () {
        return view('userInfo');
    })->name('userInfo');

    // New Booking & Chat AJAX endpoints
    Route::get('/consultation/book/{expert_id}', [KonsultasiController::class, 'book'])
        ->name('consultation.book');
    Route::post('/consultation/{id}/payment', [KonsultasiController::class, 'submitPayment'])
        ->name('consultation.submitPayment');
    Route::post('/consultation/{id}/review', [KonsultasiController::class, 'submitReview'])
        ->name('consultation.submitReview');
    Route::get('/consultation/{id}/messages', [KonsultasiController::class, 'getMessages'])
        ->name('consultation.messages');
    Route::post('/consultation/{id}/messages', [KonsultasiController::class, 'sendMessage'])
        ->name('consultation.sendMessage');
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

    Route::get('/articleExpert', [ArtikelController::class, 'expertIndex'])
        ->name('articleExpert');

    Route::get('/myarticleExpert', [ArtikelController::class, 'expertMyArticles'])
        ->name('myarticleExpert');

    Route::get('/manageSchedule', [WebProfileController::class, 'getSchedule'])
        ->name('manageSchedule');

    Route::post('/manageSchedule', [WebProfileController::class, 'saveSchedule'])
        ->name('expert.schedule.save');

    Route::get('/tulisartikelExpert', [ArtikelController::class, 'createArticleForm'])
        ->name('tulisartikelExpert');

    Route::post('/tulisartikelExpert/store', [ArtikelController::class, 'storeArticle'])
        ->name('tulisartikelExpert.store');

    Route::post('/myarticleExpert/delete', [ArtikelController::class, 'deleteArticles'])
        ->name('myarticleExpert.delete');

    Route::get('/consulexpert', [KonsultasiController::class, 'consultexpert'])
        ->name('consultexpert');

    Route::get('/setpricingexpert', [WebProfileController::class, 'getPricing'])
        ->name('setpricingexpert');

    Route::post('/expert/pricing/update', [WebProfileController::class, 'updatePricing'])
        ->name('expert.pricing.update');

    Route::get('/ratinghistoryExpert', function () {
        return view('ratinghistoryExpert');
    });

    Route::get('/roomChatExpert', [KonsultasiController::class, 'roomChatExpert'])
        ->name('roomChatExpert');

    Route::get('/ConsultationhistoryExpert', [KonsultasiController::class, 'consultexpert'])
        ->name('ConsultationhistoryExpert');

    // Expert AJAX chat routes
    Route::get('/expert/consultation/{id}/messages', [KonsultasiController::class, 'getMessages'])
        ->name('expert.consultation.messages');
    Route::post('/expert/consultation/{id}/messages', [KonsultasiController::class, 'sendMessage'])
        ->name('expert.consultation.sendMessage');
    Route::post('/expert/consultation/{id}/end', [KonsultasiController::class, 'endChat'])
        ->name('expert.consultation.end');

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


