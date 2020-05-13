<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'string'],
        ], [
            'email.required' => 'Silakan masukkan alamat email terlebih dahulu.',
            'email.email' => 'Alamat email yang Anda masukkan tidak valid.',
            'email.string' => 'Harap masukkan alamat email dengan benar.'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Reset Password gagal.', $validator->errors(), 400);
        } else {
            $user = User::where('email', $request->email)->first();

            if (! $user) {
                return $this->sendError('Akun tidak ditemukan, harap periksa kembali alamat email Anda.');
            } else {
                $passwordReset = PasswordReset::updateOrCreate([
                    'email' => $user->email,
                ], [
                    'email' => $user->email,
                    'token' => Str::random(60),
                ]);

                if ($user && $passwordReset) {
                    $user->notify(new PasswordResetRequest($passwordReset->token));
                }

                return $this->sendResponse($user, 'Silakan cek kotak masuk email Anda untuk melakukan reset password.');
            }
        }
    }

    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (! $passwordReset) {
            return $this->sendError('Token tidak valid.');
        } else if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return $this->sendError('Token sudah tidak valid.');
        } else {
            return $this->sendResponse($passwordReset, 'Permintaan Reset Password berhasil ditemukan.');
        }
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed'],
            'token' => ['required', 'string'],
        ]);

        $passwordReset = PasswordReset::where([
            'token' => $request->token,
            'email' => $request->email,
        ])->first();

        if (! $passwordReset) {
            return $this->sendError('Token sudah tidak valid.');
        } else {
            $user = User::where('email', $passwordReset->email)->first();

            if (! $user) {
                return $this->sendError('Tidak ditemukan akun dengan alamat email tersebut.');
            } else {
                $user->password = Hash::make($request->password);
                $user->save();

                $passwordReset->delete();
                $user->notify(new PasswordResetSuccess($passwordReset));

                return $this->sendResponse($user, 'Kata sandi berhasil diperbarui.');
            }
        }
    }
}
