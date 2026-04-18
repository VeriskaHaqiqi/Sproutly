<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homePublic');
});

Route::get('/homeExpert', function () {
    return view('homeExpert');
})->name('homeExpert');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');

Route::get('/lupapass', function () {
    return view('lupapass');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard-user', function () {
    return view('dashboard-user');
});

Route::get('/dashboard-ahli', function () {
    return view('dashboard-ahli');
})->name('dashboard-ahli');

Route::get('/homeUser', function () {
    return view('homeUser');
});

Route::get('/find-experts', function () {
    return view('find-experts');
});

Route::get('/homePublic', function () {
    return view('homePublic');
})->name('homePublic');

Route::get('/registerExpert', function () {
    return view('registerExpert');
});

Route::get('/registerUser', function () {
    return view('registerUser');
})->name('registerUser');

Route::post('/registerUser', function () {
    return 'Form berhasil dikirim';
})->name('registerUser.submit');

Route::get('/accountUser', function () {
    return view('accountUser');
})->name('accountUser');

Route::get('/accountExpert', function () {
    return view('accountExpert');
})->name('accountExpert');

Route::get('/editProfileUser', function () {
    return view('editProfileUser');
})->name('editProfileUser');

Route::put('/profile/update', function () {
    return redirect()->route('accountUser');
})->name('profile.update');

Route::get('/editProfileExpert', function () {
    return view('editProfileExpert');
})->name('editProfileExpert');

Route::put('/expert/profile/update', function () {
    return redirect()->route('accountExpert');
})->name('expert.profile.update');

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

Route::get('/inputPassword', function () {
    return view('inputPassword');
})->name('inputPassword');

Route::get('/infoahli', function () {
    return view('infoahli');
})->name('infoahli');

Route::get('/paymentUser', function () {
    return view('paymentUser');
});

Route::get('/articleExpert', function () {
    return view('articleExpert');
})->name('articleExpert');

Route::get('/myarticleExpert', function () {
    return view('myarticleExpert');
})->name('myarticleExpert');

Route::get('/manageSchedule', function () {
    return view('manageSchedule');
})->name('manageSchedule');

Route::post('/manageSchedule', function () {
    return redirect()->route('manageSchedule');
})->name('expert.schedule.save');

Route::get('/tulisartikelExpert', function () {
    return view('tulisartikelExpert');
});

Route::get('/consulexpert', function () {
    return view('consulexpert');
});

Route::get('/setpricingexpert', function () {
    return view('setpricingexpert');
})->name('setpricingexpert');

Route::get('/ratinghistoryExpert', function () {
    return view('ratinghistoryExpert');
});

Route::get('/roomChatUser', function () {
    return view('roomChatUser');
});

Route::get('/roomChatExpert', function () {
    return view('roomChatExpert');
});

Route::get('/ConsultationhistoryUser', function () {
    return view('ConsultationhistoryUser');
});

Route::get('/consultexpert', function () {
    return view('consultexpert');
})->name('consultexpert');

Route::get('/supportUser', function () {
    return view('supportUser');
});

Route::get('/supportExpert', function () {
    return view('supportExpert');
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

Route::get('/sidebar-expert', function () {
    return view('sidebar-expert');
});

Route::get('/sidebar-user', function () {
    return view('sidebar-user');
});

Route::get('/incomeHistory', function () {
    return view('incomeHistory');
});

Route::get('/ConsultationhistoryExpert', function () {
    return view('ConsultationhistoryExpert');
})->name('ConsultationhistoryExpert');

Route::get('/invoice', function () {
    return view('invoice');
});
