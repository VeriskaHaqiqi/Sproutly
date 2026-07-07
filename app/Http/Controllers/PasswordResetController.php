<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Kirim link reset password (web) – via AJAX
     */
    public function forgotPasswordWeb(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Link reset password telah dikirim ke email Anda'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengirim link reset password'
        ], 400);
    }

    /**
     * Reset password (web) – via AJAX
     */
    public function resetPasswordWeb(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Token tidak valid atau email salah'
        ], 400);
    }

    // ==== API methods (jika masih digunakan) ====
    public function forgotPassword(Request $request) { /* ... */ }
    public function resetPassword(Request $request) { /* ... */ }
}