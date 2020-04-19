<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id', 'program_id', 'donation_account_id', 'donation_unique_number', 'message', 'amount', 'status'
    ];
}
