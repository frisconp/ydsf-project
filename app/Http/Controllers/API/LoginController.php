<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Alamat email tidak boleh kosong.',
            'email.email' => 'Alamat email tidak valid.',
            'password.required' => 'Harap masukkan kata sandi.'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal.', $validator->errors(), 400);
        } else {
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
}
