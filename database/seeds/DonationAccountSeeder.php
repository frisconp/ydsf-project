<?php

use App\DonationAccount;
use Illuminate\Database\Seeder;

class DonationAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DonationAccount::create([
            'name' => 'Yayasan Dana Sosial Al-Falah Surabaya',
            'account_number' => '1 021 1789847131 1',
            'type' => 'BANK MANDIRI',
            'branch_office_id' => 1
        ]);
    }
}
