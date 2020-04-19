<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    protected $fillable = [
        'title', 'address', 'city', 'phone_number'
    ];

    public function admins()
    {
        return $this->hasMany('App\Admin');
    }

    public function accounts()
    {
        return $this->hasMany('App\DonationAccount');
    }
}
