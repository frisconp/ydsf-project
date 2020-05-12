<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'new_password' => ['required'],
            'confirm_new_password' => ['required', 'same:new_password'],
        ], [
            'current_password.required' => 'Kata sandi sekarang tidak boleh kosong.',
            'new_password.required' => 'Kata sandi baru tidak boleh kosong.',
            'confirm_new_password.required' => 'Konfirmasi kata sandi baru tidak boleh kosong.',
            'confirm_new_password.same' => 'Konfirmasi kata sandi baru tidak sama, harap periksa kembali.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Gagal mengubah kata sandi.', $validator->errors(), 400);
        } else {
            if (! Hash::check($request->current_password, Auth::user()->password)) {
                return $this->sendError('Kata sandi yang Anda masukkan salah, harap periksa kembali.', [], 400);
            } else if (Hash::check($request->new_password, Auth::user()->password)) {
                return $this->sendError('Harap masukkan kata sandi baru yang berbeda dengan kata sandi sekarang.', [], 400);
            } else {
                $user = User::find(Auth::user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return $this->sendResponse($user, 'Kata sandi berhasil diperbarui.');
            }
        }
    }
}
