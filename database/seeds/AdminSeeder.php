<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'YDSF Superadmin',
            'email' => 'admin@ydsf.org',
            'password' => Hash::make('danasosial'),
            'role_id' => 1
        ]);
    }
}
