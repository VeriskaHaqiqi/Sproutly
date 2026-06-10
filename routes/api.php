<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\JadwalAhliController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\TarifAhliController;
use App\Http\Controllers\ProfileController; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// ENDPOINT LOGIN SEMENTARA (untuk testing)
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Email atau password salah'
        ], 401);
    }

    // Buat token (pastikan sudah install laravel/sanctum)
    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json([
        'success' => true,
        'user' => [
            'id' => $user->id,
            'nama' => $user->nama_user,
            'email' => $user->email,
            'role' => $user->role
        ],
        'token' => $token
    ]);
});

Route::post('/register', [AuthController::class, 'apiRegister']);
//Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

Route::get('/konsultasi', [KonsultasiController::class, 'index']);
Route::post('/konsultasi', [KonsultasiController::class, 'store']);

Route::get('/tarif-ahli', [TarifAhliController::class, 'index']);
Route::get('/tarif-ahli/{id}', [TarifAhliController::class, 'show']);
Route::post('/tarif-ahli', [TarifAhliController::class, 'store']);
Route::put('/tarif-ahli/{id}', [TarifAhliController::class, 'update']);
Route::delete('/tarif-ahli/{id}', [TarifAhliController::class, 'destroy']);Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy']);

Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/artikel', [ArtikelController::class, 'store']);
    Route::put('/artikel/{id}', [ArtikelController::class, 'update']);
    Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto']);
    Route::get('/profile/payments', [ProfileController::class, 'paymentHistory']);
    Route::get('/profile/ratings', [ProfileController::class, 'ratingsList']); // endpoint rating list
    Route::post('/profile/logout', [ProfileController::class, 'logout']);
    Route::post('/artikel/{id}/bookmark', [ArtikelController::class, 'bookmark']);
    Route::delete('/artikel/{id}/bookmark', [ArtikelController::class, 'unbookmark']);
    Route::get('/bookmark-artikel', [ArtikelController::class, 'myBookmark']);
    
    Route::get('/jadwal-ahli', [JadwalAhliController::class, 'index']);
    Route::post('/jadwal-ahli', [JadwalAhliController::class, 'store']);
});