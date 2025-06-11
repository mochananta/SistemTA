<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Kua;
use App\Models\PengajuanSurat;
use App\Models\RumahIbadah;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRumahIbadah = RumahIbadah::count();
        $totalKua = Kua::count();
        $suratSelesai = PengajuanSurat::where('status', 'Selesai Diambil')->count();
        $konsultasiSelesai = Konsultasi::where('status', 'Selesai')->count();

        $bulanLabels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        // --- Filter Tahun Pengajuan Surat ---
        $tahunPengajuanDipilih = request()->get('tahun_pengajuan', date('Y'));

        $monthlyData = PengajuanSurat::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $tahunPengajuanDipilih)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $jumlahPengajuan = [];
        foreach (range(1, 12) as $bulan) {
            $bulanData = $monthlyData->firstWhere('month', $bulan);
            $jumlahPengajuan[] = $bulanData->total ?? 0;
        }

        $tahunListPengajuan = PengajuanSurat::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $bulanSekarang = date('m');
        $tahunSekarang = date('Y');

        $pengajuanBulanIni = PengajuanSurat::whereMonth('created_at', $bulanSekarang)
            ->whereYear('created_at', $tahunSekarang)
            ->count();

        // --- Filter Tahun Konsultasi ---
        $tahunDipilih = request()->get('tahun_konsultasi', date('Y'));

        $monthlyKonsultasi = Konsultasi::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $tahunDipilih)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $jumlahKonsultasi = [];
        foreach (range(1, 12) as $bulan) {
            $bulanData = $monthlyKonsultasi->firstWhere('month', $bulan);
            $jumlahKonsultasi[] = $bulanData->total ?? 0;
        }

        $tahunListKonsultasi = Konsultasi::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('admin.index', compact(
            'jumlahKonsultasi',
            'tahunListKonsultasi',
            'tahunDipilih',
            'totalRumahIbadah',
            'totalKua',
            'konsultasiSelesai',
            'pengajuanBulanIni',
            'bulanLabels',
            'jumlahPengajuan',
            'suratSelesai',
            'tahunListPengajuan',
            'tahunPengajuanDipilih'
        ));
    }
}
