<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();

        return $this->sendResponse($user, 'Berhasil menampilkan data user.');
    }
}
