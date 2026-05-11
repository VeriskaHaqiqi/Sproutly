<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AhliBotani;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'ahli') {
                return redirect('/homeExpert');
            }

            return redirect('/homeUser');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:50',
            'phone' => 'required|string|max:16',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'nama_user' => $request->full_name,
            'no_telp_user' => $request->phone,
            'tanggal_lahir_user' => $request->birthdate,
            'email' => $request->email,
            'jenis_kelamin_user' => $this->convertGender($request->gender),
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Registrasi user berhasil. Silakan login.');
    }

    public function registerExpert(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:50',
            'phone' => 'required|string|max:16',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'password' => 'required|confirmed|min:6',
            'institution' => 'required|string|max:50',
            'location' => 'required|string|max:30',
            'bank_account' => 'nullable|string|max:100',
            'experience' => 'nullable|string',
            'certification' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = User::create([
            'nama_user' => $request->full_name,
            'no_telp_user' => $request->phone,
            'tanggal_lahir_user' => $request->birthdate,
            'email' => $request->email,
            'jenis_kelamin_user' => $this->convertGender($request->gender),
            'password' => Hash::make($request->password),
            'role' => 'ahli',
        ]);

        AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $request->full_name,
            'no_telp_ahli' => $request->phone,
            'tanggal_lahir_ahli' => $request->birthdate,
            'jenis_kelamin_ahli' => $this->convertGenderExpert($request->gender),
            'domisili' => $request->location,
            'nama_almamater' => $request->institution,
        ]);

        return redirect('/login')->with('success', 'Registrasi ahli berhasil. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    private function convertGender($gender)
    {
        if ($gender === 'male') {
            return 1;
        }

        if ($gender === 'female') {
            return 2;
        }

        return null;
    }

    private function convertGenderExpert($gender)
    {
        if ($gender === 'male') {
            return 'L';
        }

        if ($gender === 'female') {
            return 'P';
        }

        return null;
    }
}