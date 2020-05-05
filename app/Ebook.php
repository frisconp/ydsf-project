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

    public function getCreatedAtAttribute($date)
    {
        $formattedDate = date('Y-m-d', strtotime($date));

        $months = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $splitedDate = explode('-', $formattedDate);

        return $splitedDate[2] . ' ' . $months[(int) $splitedDate[1]] . ' ' . $splitedDate[0];
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
