<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kuas')->insert([
            [
                'nama' => 'KUA Giri',
                'alamat' => 'Jl. Kenari No.19, Lingkungan Karangete, Penganjuran, Kec. Giri, Kabupaten Banyuwangi, Jawa Timur 68416',
                'kecamatan' => 'Giri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Banyuwangi',
                'alamat' => 'Jl. Agung Suprapto No.30, Penganjuran, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416',
                'kecamatan' => 'Banyuwangi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Genteng',
                'alamat' => 'Jl. KH. Wahid Hasyim No.13, Genteng Kulon, Genteng, Kabupaten Banyuwangi, Jawa Timur 68465',
                'kecamatan' => 'Genteng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Muncar',
                'alamat' => 'Jl. Brawijaya No.23, Blambangan, Muncar, Kabupaten Banyuwangi, Jawa Timur 68472',
                'kecamatan' => 'Muncar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Srono',
                'alamat' => 'JL. Raya Rogojampi, No. 55, Srono, Karanglo, Sukonatar, Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68471',
                'kecamatan' => 'Srono',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Glagah',
                'alamat' => 'Jl. Licin No. 121, Glagah, Bakungan, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68431',
                'kecamatan' => 'Glagah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Wongsorejo',
                'alamat' => 'Jl. Raya Situbondo No.61, Dusun Krajan, Wongsorejo, Kec. Wongsorejo, Kabupaten Banyuwangi, Jawa Timur 68453',
                'kecamatan' => 'Wongsorejo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Siliragung',
                'alamat' => 'Jl. Ali Sakti No.01, Krajan, Kesilir, Kec. Siliragung, Kabupaten Banyuwangi, Jawa Timur 68488',
                'kecamatan' => 'Siliragung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Songgon',
                'alamat' => 'Jalan Jenderal Ahmad Yani No.18, Mangaran, Sumberarum, Kec. Songgon, Kabupaten Banyuwangi, Jawa Timur 68463',
                'kecamatan' => 'Songgon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Kalibaru',
                'alamat' => 'Dusun Sumber Beringin, Kalibaru Manis, Kec. Kalibaru, Kabupaten Banyuwangi, Jawa Timur 68467',
                'kecamatan' => 'Kalibaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Bangorejo',
                'alamat' => 'Jl. Blokagung No.1, Sendangrejo, Kebondalem, Kec. Bangorejo, Kabupaten Banyuwangi, Jawa Timur 68487',
                'kecamatan' => 'Bangorejo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Glenmore',
                'alamat' => 'Jl. Jember, Karangharjo, Kec. Glenmore, Kabupaten Banyuwangi, Jawa Timur 68466',
                'kecamatan' => 'Glenmore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Gambiran',
                'alamat' => 'Jl. Ahmad Yani No.24, Sumberjaya, Wringin Agung, Kec. Gambiran, Kabupaten Banyuwangi, Jawa Timur 68486',
                'kecamatan' => 'Gambiran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Tegalsari',
                'alamat' => 'Jl. KH. Hasyim Asyari, Bulurejo, Tegalrejo, Kec. Tegalsari, Kabupaten Banyuwangi, Jawa Timur 68485',
                'kecamatan' => 'Tegalsari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Purwoharjo',
                'alamat' => 'Jl. Raya Grajagan No.74, Krajan, Purwoharjo, Kec. Purwoharjo, Kabupaten Banyuwangi, Jawa Timur 68483',
                'kecamatan' => 'Purwoharjo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Tegaldlimo',
                'alamat' => 'Sumbermulyo, Tegaldlimo, Kec. Tegaldlimo, Kabupaten Banyuwangi, Jawa Timur 68484',
                'kecamatan' => 'Tegaldlimo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Cluring',
                'alamat' => 'Jl. Sembulung - Cluring, Dusun Kepatihan, Cluring, Kec. Cluring, Kabupaten Banyuwangi, Jawa Timur 68482',
                'kecamatan' => 'Cluring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Rogojampi',
                'alamat' => 'Karang Bendo, Rogojampi, Pancoran, Karangbendo, Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68462',
                'kecamatan' => 'Rogojampi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Kabat',
                'alamat' => 'Jl. Tambong No.2, Krajan, Kabat, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
                'kecamatan' => 'Kabat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Singojuruh',
                'alamat' => 'Jl. Aruji Karta Winata, Suruh, Singojuruh, Kec. Singojuruh, Kabupaten Banyuwangi, Jawa Timur 68464',
                'kecamatan' => 'Singojuruh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Sempu',
                'alamat' => 'Jl. Kihajar Dewantoro, Mangli, Karangsari, Kec. Sempu, Kabupaten Banyuwangi, Jawa Timur 68468',
                'kecamatan' => 'Sempu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Pesanggaran',
                'alamat' => 'Jl. Ahmad Kusnan, Dusun Krajan, Pesanggaran, Kec. Pesanggaran, Kabupaten Banyuwangi, Jawa Timur 68488',
                'kecamatan' => 'Pesanggaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
