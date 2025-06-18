<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'address' => 'bukit cimanggu city v7 no 8',
                'phone' => '08123456789',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'status' => '1',
            ],
            [
                'name' => 'Instructor',
                'username' => 'instructor',
                'email' => 'instructor@gmail.com',
                'address' => 'bukit cimanggu city v7 no 8',
                'phone' => '08123456789',
                'password' => Hash::make('123'),
                'role' => 'instructor',
                'status' => '1',
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'address' => 'bukit cimanggu city v7 no 8',
                'phone' => '08123456789',
                'password' => Hash::make('123'),
                'role' => 'user',
                'status' => '1',
            ],
        ]);
    }
}
