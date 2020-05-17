<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    protected $fillable = [
        'title', 'address', 'city', 'phone_number'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function admins()
    {
        return $this->hasMany('App\Admin');
    }

    public function accounts()
    {
        return $this->hasMany('App\DonationAccount');
    }

    public function programs()
    {
        return $this->hasMany('App\Program');
    }
}
