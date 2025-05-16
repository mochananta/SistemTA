<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'kua_id',
        'kode_layanan',
        'jenis_surat',
        'nama',
        'nik',
        'nohp',
        'alamat',
        'tanggal_pengajuan',
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
}
