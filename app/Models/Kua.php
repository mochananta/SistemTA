<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kua extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'alamat', 'kecamatan'];

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class);
    }

    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class);
    }
}
