<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

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
