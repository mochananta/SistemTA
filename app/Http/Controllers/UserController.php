<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Kua;
use App\Models\PengajuanSurat;
use App\Models\RumahIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $totalSurat = PengajuanSurat::count();
        $totalKonsultasi = Konsultasi::count();
        $totalLayanan = $totalSurat + $totalKonsultasi;

        $jenisLayanan = ['Pendaftaran Pernikahan', 'Wakaf', 'Rumah Ibadah', 'Rekomendasi Pernikahan'];

        $statistikLayanan = [];

        foreach ($jenisLayanan as $jenis) {
            $totalSuratJenis = PengajuanSurat::where('jenis_surat', $jenis)->count();
            $totalKonsultasiJenis = Konsultasi::where('jenis_konsultasi', $jenis)->count();
            $statistikLayanan[$jenis] = $totalSuratJenis + $totalKonsultasiJenis;
        }

        $pengajuanPerJenis = PengajuanSurat::selectRaw('jenis_surat, COUNT(*) as total')
            ->groupBy('jenis_surat')
            ->pluck('total', 'jenis_surat')
            ->toArray();

        $konsultasiPerJenis = Konsultasi::selectRaw('jenis_konsultasi, COUNT(*) as total')
            ->groupBy('jenis_konsultasi')
            ->pluck('total', 'jenis_konsultasi')
            ->toArray();

        $labels = array_merge(
            array_map(fn($label) => 'Surat ' . $label, array_keys($pengajuanPerJenis)),
            array_map(fn($label) => 'Konsultasi ' . $label, array_keys($konsultasiPerJenis))
        );

        $donutSeries = array_merge(
            array_values($pengajuanPerJenis),
            array_values($konsultasiPerJenis)
        );

        $tahunList = range(date('Y') - 4, date('Y'));
        $suratPerTahun = [];
        $konsultasiPerTahun = [];

        foreach ($tahunList as $tahun) {
            $suratPerTahun[] = PengajuanSurat::whereYear('created_at', $tahun)->count();
            $konsultasiPerTahun[] = Konsultasi::whereYear('created_at', $tahun)->count();
        }

        $rumahIbadah = RumahIbadah::limit(10)->get();

        return view('user.home', compact(
            'labels',
            'donutSeries',
            'tahunList',
            'suratPerTahun',
            'konsultasiPerTahun',
            'rumahIbadah',
            'totalSurat',
            'totalKonsultasi',
            'totalLayanan',
            'statistikLayanan'
        ));
    }


    public function showForm($jenis)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login dahulu untuk mengisi formulir.');
        }

        $kuas = Kua::all();
        $kecamatans = DB::table('rumah_ibadah')
            ->select('kecamatan')
            ->whereNotNull('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->get();

        return match ($jenis) {
            // Form Pengajuan Surat
            'surat-ibadah' => view('user.layanan.form-surat.ibadah', compact('kuas')),
            'surat-wakaf' => view('user.layanan.form-surat.wakaf', compact('kuas')),
            'surat-pendaftaran-pernikahan' => view('user.layanan.form-surat.pendaftaran-pernikahan', compact('kuas')),
            'surat-rekomendasi-nikah' => view('user.layanan.form-surat.rekomendasi-nikah', compact('kuas')),

            // Form Konsultasi
            'konsultasi-ibadah' => view('user.layanan.form-konsultasi.ibadah', compact('kuas', 'kecamatans')),
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
