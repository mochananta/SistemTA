<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Kua;
use App\Models\PengajuanSurat;
use App\Models\RumahIbadah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRumahIbadah = RumahIbadah::count();
        $totalKua = Kua::count();
        $nikahBulanIni = PengajuanSurat::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();
        $konsultasiSelesai = Konsultasi::where('status', 'Selesai')->count();

        // Data untuk chart: jumlah pengajuan masuk & selesai tiap bulan
        $monthlyData = PengajuanSurat::selectRaw('MONTH(created_at) as month, 
                COUNT(*) as total,
                SUM(CASE WHEN status = "Selesai Diambil" THEN 1 ELSE 0 END) as selesai')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $bulanLabels = [];
        $jumlahPengajuan = [];
        $jumlahSelesai = [];

        foreach (range(1, 12) as $bulan) {
            $bulanLabels[] = date('M', mktime(0, 0, 0, $bulan, 1));
            $bulanData = $monthlyData->firstWhere('month', $bulan);
            $jumlahPengajuan[] = $bulanData->total ?? 0;
            $jumlahSelesai[] = $bulanData->selesai ?? 0;
        }

        return view('admin.index', compact(
            'totalRumahIbadah',
            'totalKua',
            'nikahBulanIni',
            'konsultasiSelesai',
            'bulanLabels',
            'jumlahPengajuan',
            'jumlahSelesai'
        ));
    }
}
