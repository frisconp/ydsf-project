<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function getProfile()
    {
        $user = Auth::user();

        return $this->sendResponse($user, 'Berhasil menampilkan data user.');
    }

    public function updateProfile(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'phone_number.required' => 'Phone number tidak boleh kosong.',
            'address.required' => 'Alamat tidak boleh kosong',
            'email.max' => 'Email tidak boleh kosong.',
        ]);

            if ($validator->fails()) {
                return $this->sendError('Gagal memperbarui data user', $validator->errors(), 400);
            } else {

                $user->name = $request->name;
                $user->phone_number = $request->phone_number;

                if($request->file('avatar')){
                    $user->avatar = $request->file('avatar')->store('avatar');
                }
                
                $user->address = $request->address;
                $user->city = $request->city;
                $user->email = $request->email;
                $user->email_verified_at = $request->email_verified_at;
                $user->google_account_id = $request->google_account_id;
                $user->facebook_account_id = $request->facebook_account_id;
                $user->save();

                return $this->sendResponse($user, 'Berhasil memperbaruhi data user');
            }
    }
}
