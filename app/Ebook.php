<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ebook extends Model
{
    public function getFileAttribute($file)
    {
        return Storage::url($file);
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
