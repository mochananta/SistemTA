<?php

namespace App\Http\Controllers;

use App\Models\Kua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showForm($jenis)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login dahulu untuk mengisi formulir.');
        }

        $kuas = Kua::all();
        return match ($jenis) {
        // Form Pengajuan Surat
        'surat-ibadah' => view('user.layanan.form-surat.ibadah', compact('kuas')),
        'surat-ikrar' => view('user.layanan.form-surat.ikrar'),
        'surat-nikah' => view('user.layanan.form-surat.nikah'),
        'surat-rekomendasi-nikah' => view('user.layanan.form-surat.rekomendasi-nikah'),

        // Form Konsultasi
        'konsultasi-ibadah' => view('user.layanan.form-konsultasi.ibadah', compact('kuas')),
        'konsultasi-rekomendasi-pindah' => view('user.layanan.form-konsultasi.rekomendasi-pindah', compact('kuas')),
        'konsultasi-wakaf' => view('user.layanan.form-konsultasi.wakaf', compact('kuas')),
        'konsultasi-rekomendasi-nikah' => view('user.layanan.form-konsultasi.rekomendasi-nikah', compact('kuas')),
        default => abort(404),
        };
    }    

    public function jenissuratview()
    {
        return view('user.layanan.surat');
    }
    public function jeniskonsultasiview()
    {
        return view('user.layanan.konsultasi');
    }
}
