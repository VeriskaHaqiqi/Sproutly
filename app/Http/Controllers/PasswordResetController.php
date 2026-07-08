<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    /**
     * Step 1: Validasi email, langsung arahkan ke inputPassword
     */
    public function forgotPasswordWeb(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route('password.reset.form', ['email' => $request->email])
        ], 200);
    }

    /**
     * Step 2: Update password tanpa token (hanya email)
     */
    public function resetPasswordWeb(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil direset'
        ], 200);
    }
}