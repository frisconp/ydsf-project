<?php

use App\BranchOffice;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchOffice::create([
            'title' => 'Yayasan Dana Sosial Al-Falah Surabaya',
            'address' => 'Jl. Kertajaya 8C/17',
            'city' => 'Kota Surabaya',
            'phone_number' => '081615445556'
        ]);
    }
}
