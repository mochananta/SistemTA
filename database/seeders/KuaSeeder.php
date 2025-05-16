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
                'alamat' => 'Jl. Merdeka No. 12, Kec. Giri, Kab. Banyuwangi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KUA Rogojampi',
                'alamat' => 'Jl. Letjen Sutoyo No. 45, Kec. Rogojampi, Kab. Banyuwangi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }    
}
