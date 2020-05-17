<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Program extends Model
{
    protected $appends = [
        'days_left', 'held_on_formatted', 'progress_percentage'
    ];

    public function getHeldOnFormattedAttribute()
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

        $dayName = date('l', strtotime($this->held_on));

        $splitedDate = explode('-', $this->held_on);

        return $days[$dayName] . ', ' . $splitedDate[2] . ' ' . $months[(int) $splitedDate[1]] . ' ' . $splitedDate[0];
    }

    public function getFeaturedImageAttribute($image)
    {
        return Storage::url($image);
    }

    public function getCreatedAtAttribute($date)
    {
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

        $splitedDate = explode('-', date('Y-m-d', strtotime($date)));

        return $splitedDate[2] . ' ' . $months[(int) $splitedDate[1]] . ' ' . $splitedDate[0];
    }

    public function getDaysLeftAttribute()
    {
        $today = Carbon::now();

        return date_diff($today, Carbon::make($this->held_on))->days;
    }

    public function updates()
    {
        return $this->hasMany('App\ProgramUpdate');
    }

    public function office()
    {
        return $this->belongsTo('App\BranchOffice', 'branch_office_id');
    }

    public function getProgressPercentageAttribute()
    {
        $donationTarget = $this->amount;
        $donationTotal = Donation::where(['program_id' => $this->id, 'status' => 'accepted'])->get();

        $donationTotal = $donationTotal->sum('amount');

        $progressPercentage = ($donationTotal/$donationTarget) * 100;

        if ($progressPercentage > 100) {
            $progressPercentage = 100;
        }

        return (int) $progressPercentage;
    }
}
