<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id', 'program_id', 'donation_account_id', 'donation_unique_number', 'message', 'amount', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function program()
    {
        return $this->belongsTo('App\Program');
    }

    public function donationAccount()
    {
        return $this->belongsTo('App\DonationAccount');
    }
}
