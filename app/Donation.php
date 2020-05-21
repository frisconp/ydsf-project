<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id', 'program_id', 'donation_account_id', 'donation_unique_number', 'message', 'amount', 'status'
    ];

    protected $appends = [
        'payment_deadline', 'donation_date',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function program()
    {
        return $this->belongsTo('App\Program');
    }

    public function donationAccount()
    {
        return $this->belongsTo('App\DonationAccount');
    }

    public function getPaymentDeadlineAttribute()
    {
        $paymentDeadline = Carbon::parse($this->created_at)->addDay();

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

        $dayName = date('l', strtotime($paymentDeadline));

        $splitedDate = explode('-', date('Y-m-d', strtotime($paymentDeadline)));
        $splitedTime = explode(':', date('H:i', strtotime($paymentDeadline)));

        return $days[$dayName] . ', ' . $splitedDate[2] . ' ' . $months[(int) $splitedDate[1]] . ' ' . $splitedDate[0] . ' ' . $splitedTime[0] . ':' . $splitedTime[1] . ' WIB';
    }

    public function getDonationDateAttribute()
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

        $splitedDate = explode('-', date('Y-m-d', strtotime($this->created_at)));

        return $splitedDate[2] . ' ' . $months[(int) $splitedDate[1]] . ' ' . $splitedDate[0];
    }
}
