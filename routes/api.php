<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\JadwalAhliController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ArtikelController;

Route::post('/register', [AuthController::class, 'apiRegister']);
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
Route::get('/jadwal-ahli', [JadwalAhliController::class, 'index']);
Route::post('/jadwal-ahli', [JadwalAhliController::class, 'store']);
Route::get('/konsultasi', [KonsultasiController::class, 'index']);
Route::post('/konsultasi', [KonsultasiController::class, 'store']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::post('/artikel', [ArtikelController::class, 'store']);
Route::put('/artikel/{id}', [ArtikelController::class, 'update']);
Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy']);