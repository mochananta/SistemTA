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
        'surat-wakaf' => view('user.layanan.form-surat.wakaf', compact('kuas')),
        'surat-pendaftaran-pernikahan' => view('user.layanan.form-surat.pendaftaran-pernikahan', compact('kuas')),
        'surat-rekomendasi-nikah' => view('user.layanan.form-surat.rekomendasi-nikah', compact('kuas')),

        // Form Konsultasi
        'konsultasi-ibadah' => view('user.layanan.form-konsultasi.ibadah', compact('kuas')),
        'konsultasi-pendaftaran-pernikahan' => view('user.layanan.form-konsultasi.pendaftaran-pernikahan', compact('kuas')),
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
