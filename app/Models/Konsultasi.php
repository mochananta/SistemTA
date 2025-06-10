<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kua_id',
        'kode_layanan',
        'jenis_konsultasi',
        'rumah_ibadah_id',
        'alamat',
        'tanggal_konsultasi',
        'isi_konsultasi',
        'file_path',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kua()
    {
        return $this->belongsTo(Kua::class);
    }

    public function rumahIbadah()
    {
        return $this->belongsTo(RumahIbadah::class, 'rumah_ibadah_id');
    }
    
}
