<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User Test',
            'email' => 'user@mail.io',
            'password' => Hash::make('12345678'),
            'phone_number' => '081234567890'
        ]);
    }
}
