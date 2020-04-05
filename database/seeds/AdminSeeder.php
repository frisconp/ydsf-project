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
        // Superadmin
        Admin::create([
            'name' => 'YDSF Superadmin',
            'email' => 'admin@ydsf.org',
            'password' => Hash::make('danasosial'),
            'role_id' => 1
        ]);

        // Regular Admin
        Admin::create([
            'name' => 'Admin YDSF Surabaya',
            'email' => 'surabaya@ydsf.org',
            'password' => Hash::make('ydsfsurabaya'),
            'branch_office_id' => 1,
            'role_id' => 2
        ]);
    }
}
