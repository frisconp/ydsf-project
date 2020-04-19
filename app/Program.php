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
}
