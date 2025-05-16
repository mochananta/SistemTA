<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@system.com',
            'password' => Hash::make('123'),
            'role' => 'admin_sistem',
        ]);

        User::create([
            'name' => 'Admin KUA Giri',
            'email' => 'kua@giri.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 1,
        ]);
    
        User::create([
            'name' => 'Admin KUA Rogojampi',
            'email' => 'kua@rogojampi.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 2,
        ]);
    }
}
