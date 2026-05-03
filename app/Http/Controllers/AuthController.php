<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

class AuthController extends Controller
{
    public function login()
    {
        $role = 'expert'; // coba ganti jadi 'user'

        if ($role == 'expert') {
            return redirect('/homeExpert');
        } else {
            return redirect('/homeUser');
        }
    }
}