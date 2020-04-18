<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function updates()
    {
        return $this->hasMany('App\ProgramUpdate');
    }
}
