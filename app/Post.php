<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    //
    public function getFeaturedImageAttribute($image)
    {
        return Storage::url($image);
    }
}
