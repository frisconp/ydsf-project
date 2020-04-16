<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function authenticate(Request $request)
    {
        $remember = $request->filled('remember_me');
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->intended('/');
        } else {
            return redirect()->route('login')->with('error', 'Email atau kata sandi tidak cocok.');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
