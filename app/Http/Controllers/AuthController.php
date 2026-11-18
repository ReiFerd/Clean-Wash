<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login')
    }

    public function login()
    {
        $request->validate([
            'email'->'required|email'
            'password'->'required|min:6'
        ])

        
        $credentials = $request->only('email','password');
        
        
    }
}
