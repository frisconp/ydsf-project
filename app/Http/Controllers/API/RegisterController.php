<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan yang lain.',
            'password.required' => 'Password tidak boleh kosong.',
            'confirm_password.required' => 'Konfirmasi Password tidak boleh kosong.',
            'confirm_password.same' => 'Pastikan Password dan Konfirmasi Password sama.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password'],
        ], $messages);

        if ($validator->fails()) {
            return $this->sendError('Registrasi Gagal.', $validator->errors());
        }

        $userdata = $request->all();
        $userdata['password'] = Hash::make($userdata['password']);
        $user = User::create($userdata);

        return $this->sendResponse($user, 'Berhasil mendaftarkan akun.');
    }
}
