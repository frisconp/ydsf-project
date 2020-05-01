<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Program extends Model
{
    public function getHeldOnAttribute($date)
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

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

        $dayName = date('l', strtotime($date));

        $splitedDate = explode('-', $date);

        return $days[$dayName] . ', ' . $splitedDate[2] . ' ' . $months[(int) $splitedDate[1]] . ' ' . $splitedDate[0];
    }

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
