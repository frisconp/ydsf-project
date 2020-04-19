<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function validateLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            $data = [
                'user' => $user,
                'token' => $user->createToken('nApp')->accessToken,
            ];

            return $this->sendResponse($data, 'Login berhasil.');
        } else {
            return $this->sendError('Login gagal');
        }
    }
}
