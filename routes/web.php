<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

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
}); 

Route::get('/homeUser', function () {
    return view('homeUser');
});

Route::get('/find-experts', function () {
    return view('find-experts');
});

Route::get('/homePublic', function () {
    return view('homePublic');
});

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

Route::get('infoahli', function () {
    return view('infoahli');
})->name('infoahli');

Route::get('/paymentUser', function () {
    return view('paymentUser');
});

Route::get('/articleExpert', function () {
    return view('articleExpert');
});

Route::get('/myarticleExpert', function (){
    return view('myarticleExpert');
});

// buka halaman manage schedule
Route::get('/manageSchedule', function () {
    return view('manageSchedule');
})->name('manageSchedule');

// simpan / update schedule
Route::post('manageSchedule', function () {
    // nanti isi logic simpan ke database di sini
    return redirect()->route('manageSchedule');
})->name('expert.schedule.save');

Route::get('/tulisartikelExpert', function () {
    return view('tulisartikelExpert');
});