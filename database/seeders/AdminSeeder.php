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
            'name' => 'Admin KUA Banyuwangi',
            'email' => 'kua@banyuwangi.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 2,
        ]);

        User::create([
            'name' => 'Admin KUA Genteng',
            'email' => 'kua@genteng.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 3,
        ]);

        User::create([
            'name' => 'Admin KUA Muncar',
            'email' => 'kua@muncar.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 4,
        ]);

        User::create([
            'name' => 'Admin KUA Srono',
            'email' => 'kua@srono.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 5,
        ]);

        User::create([
            'name' => 'Admin KUA Glagah',
            'email' => 'kua@glagah.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 6,
        ]);

        User::create([
            'name' => 'Admin KUA Wongsorejo',
            'email' => 'kua@wongsorejo.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 7,
        ]);

        User::create([
            'name' => 'Admin KUA Siliragung',
            'email' => 'kua@siliragung.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 8,
        ]);

        User::create([
            'name' => 'Admin KUA Songgon',
            'email' => 'kua@songgon.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 9,
        ]);

        User::create([
            'name' => 'Admin KUA Kalibaru',
            'email' => 'kua@kalibaru.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 10,
        ]);

        User::create([
            'name' => 'Admin KUA Bangorejo',
            'email' => 'kua@bangojero.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 11,
        ]);

        User::create([
            'name' => 'Admin KUA Glenmore',
            'email' => 'kua@glenmore.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 12,
        ]);

        User::create([
            'name' => 'Admin KUA Gambiran',
            'email' => 'kua@gambiran.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 13,
        ]);

        User::create([
            'name' => 'Admin KUA Tegalsari',
            'email' => 'kua@tegalsari.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 14,
        ]);

        User::create([
            'name' => 'Admin KUA Purwoharjo',
            'email' => 'kua@purwoharjo.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 15,
        ]);

        User::create([
            'name' => 'Admin KUA Tegaldlimo',
            'email' => 'kua@tegaldlimo.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 16,
        ]);

        User::create([
            'name' => 'Admin KUA Cluring',
            'email' => 'kua@cluring.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 17,
        ]);

        User::create([
            'name' => 'Admin KUA Rogojampi',
            'email' => 'kua@rogojampi.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 18,
        ]);

        User::create([
            'name' => 'Admin KUA Kabat',
            'email' => 'kua@kabat.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 19,
        ]);

        User::create([
            'name' => 'Admin KUA Singojuruh',
            'email' => 'kua@singojuruh.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 20,
        ]);

        User::create([
            'name' => 'Admin KUA Sempu',
            'email' => 'kua@sempu.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 21,
        ]);

        User::create([
            'name' => 'Admin KUA Pesanggaran',
            'email' => 'kua@pesanggaran.com',
            'password' => Hash::make('1234'),
            'role' => 'admin_kua',
            'kua_id' => 22,
        ]);
    }
}
