<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\PengajuanSurat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // ============================
        // PENGAJUAN SURAT STATISTIK
        // ============================
        $countAllSurat = PengajuanSurat::count();
        $countApprovedSurat = PengajuanSurat::where('status', 'disetujui')->count();
        $countRejectedSurat = PengajuanSurat::where('status', 'ditolak')->count();

        // ============================
        // KONSULTASI STATISTIK
        // ============================
        $countAllKonsultasi = Konsultasi::count();
        $countApprovedKonsultasi = Konsultasi::where('status', 'disetujui')->count();
        $countRejectedKonsultasi = Konsultasi::where('status', 'ditolak')->count();

        // ============================
        // CHART: Pengajuan per Bulan (Surat & Konsultasi)
        // ============================
        $months = collect(range(1, 12))->map(function ($m) {
            return Carbon::create()->month($m)->format('F');
        });

        $monthlyCountsSurat = collect(range(1, 12))->map(function ($m) {
            return PengajuanSurat::whereMonth('created_at', $m)->count();
        });

        $monthlyCountsKonsultasi = collect(range(1, 12))->map(function ($m) {
            return Konsultasi::whereMonth('created_at', $m)->count();
        });

        // ============================
        // CHART: Jenis Surat (Pie)
        // ============================
        $jenisSuratData = PengajuanSurat::select('jenis_surat', DB::raw('count(*) as total'))
            ->groupBy('jenis_surat')
            ->get();

        $jenisSuratLabels = $jenisSuratData->pluck('jenis_surat');
        $jenisSuratCounts = $jenisSuratData->pluck('total');

        $currentMonth = Carbon::now()->month;
        $monthlyCountsSuratSum = PengajuanSurat::whereMonth('created_at', $currentMonth)->count();
        $monthlyCountsKonsultasiSum = Konsultasi::whereMonth('created_at', $currentMonth)->count();

        // Status menunggu (pending)
        $countPendingSurat = PengajuanSurat::where('status', 'Menunggu Verifikasi')->count();
        $countPendingKonsultasi = Konsultasi::where('status', 'Menunggu Verifikasi')->count();
        return view('admin.index', compact(
            'countAllSurat',
            'countApprovedSurat',
            'countRejectedSurat',
            'countAllKonsultasi',
            'countApprovedKonsultasi',
            'countRejectedKonsultasi',
            'months',
            'monthlyCountsSurat',
            'monthlyCountsKonsultasi',
            'jenisSuratLabels',
            'jenisSuratCounts',
            'monthlyCountsSuratSum',
            'monthlyCountsKonsultasiSum',
            'countPendingSurat',
            'countPendingKonsultasi',
        ));
    }
}
