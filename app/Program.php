<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Program extends Model
{
    public function getFeaturedImageAttribute($image)
    {
        return Storage::url($image);
    }

    public function updates()
    {
        return $this->hasMany('App\ProgramUpdate');
    }

    public function office()
    {
        return $this->belongsTo('App\BranchOffice', 'branch_office_id');
    }
}
