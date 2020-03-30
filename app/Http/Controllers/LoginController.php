<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
