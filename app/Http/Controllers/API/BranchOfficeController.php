<?php

namespace App\Http\Controllers\API;

use App\BranchOffice;
use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;

class BranchOfficeController extends Controller
{
    public function index()
    {
        $offices = BranchOffice::all();

        return $this->sendResponse($offices, 'Berhasil mendapatkan data kantor cabang.');
    }

    public function show(BranchOffice $branchOffice)
    {
        return $this->sendResponse($branchOffice->load('accounts'), 'Berhasil mendapatkan detail kantor cabang.');
    }
}
