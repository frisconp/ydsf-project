<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id', 'program_id', 'donation_account_id', 'donation_unique_number', 'message', 'amount', 'status'
    ];

    protected $appends = [
        'payment_deadline',
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

    public function getPaymentDeadlineAttribute()
    {
        return Carbon::parse($this->created_at)->addDay();
    }
}
