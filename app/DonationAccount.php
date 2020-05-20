<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationAccount extends Model
{
    //

    public function office()
    {
        return $this->belongsTo('App\BranchOffice', 'branch_office_id');
    }

    public function donation()
    {
        return $this->hasMany('App\Donation');
    }
}
