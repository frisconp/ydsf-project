<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donation;

class DonationController extends Controller
{
    public function showInvoice($token)
    {
        $donation = Donation::where('token', $token)->first();

        return view('others.invoice', compact('donation'));
    }
}
