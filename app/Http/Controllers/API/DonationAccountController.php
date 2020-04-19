<?php

namespace App\Http\Controllers\API;

use App\DonationAccount;
use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;

class DonationAccountController extends Controller
{
    public function getByBranchOfficeId($branch_office_id)
    {
        $donationAccounts = DonationAccount::where('branch_office_id', $branch_office_id)->get();

        return $this->sendResponse($donationAccounts, 'Rekening donasi berhasil didapatkan.');
    }
}
