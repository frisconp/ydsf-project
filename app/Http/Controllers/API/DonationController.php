<?php

namespace App\Http\Controllers\API;

use App\Donation;
use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function addDonation(Request $request)
    {
        $donation = Donation::create([
            'user_id' => $request->user_id,
            'program_id' => $request->program_id,
            'donation_account_id' => $request->donation_account_id,
            'donation_unique_number' => Str::random(8),
            'message' => $request->message,
            'amount' => $request->amount,
            'status' => 'waiting'
        ]);

        return $this->sendResponse($donation, 'Data donasi berhasil ditambahkan.');
    }
}
