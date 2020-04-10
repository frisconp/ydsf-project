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
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Registrasi Gagal.', $validator->errors());
        }

        $userdata = $request->all();
        $userdata['password'] = Hash::make($userdata['password']);
        $user = User::create($userdata);

        return $this->sendResponse($user, 'Berhasil mendaftarkan akun.');
    }
}
