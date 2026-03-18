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

<<<<<<< Updated upstream
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
});

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
=======
Route::get('/inputPassword', function () {
    return view('inputPassword');
>>>>>>> Stashed changes
});