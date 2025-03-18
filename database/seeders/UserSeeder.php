<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'fname' => 'Admin',
            'lname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@eventdictionary.com',
            'email_verified_at' => NOW(),
            'password' => Hash::make('66666666'),
            'phone' => '01231236666',
            'image_path' => null,
            'gender' => 'M',
            'role' => 'admin',
        ]);
        User::firstOrCreate([
            'fname' => 'User',
            'lname' => 'User',
            'username' => 'user',
            'email' => 'user@eventdictionary.com',
            'email_verified_at' => NOW(),
            'password' => Hash::make('66666666'),
            'phone' => '01231236667',
            'image_path' => null,
            'gender' => 'M',
            'role' => 'customer',
        ]);
        User::firstOrCreate([
            'fname' => 'Mohamed',
            'lname' => 'Nayef',
            'username' => 'nayef',
            'email' => 'nayef@eventdictionary.com',
            'email_verified_at' => NOW(),
            'password' => Hash::make('01026660223'),
            'phone' => '01026660223',
            'image_path' => null,
            'gender' => 'M',
            'role' => 'admin',
        ]);
    }
}
