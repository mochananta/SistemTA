<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahIbadah extends Model
{
    use HasFactory;
    protected $table = 'rumah_ibadah';
    protected $fillable = [
        'nama',
        'jenis',
        'alamat',
        'kontak',
        'kecamatan',
    ];

    public function konsultasis()
    {
        return $this->hasMany(Konsultasi::class, 'rumah_ibadah_id');
    }
}
