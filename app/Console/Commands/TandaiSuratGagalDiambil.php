<?php

namespace App\Console\Commands;

use App\Models\PengajuanSurat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TandaiSuratGagalDiambil extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surat:cek-gagal-diambil';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tandai otomatis surat yang tidak diambil setelah jadwal pengambilan lewat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $surats = PengajuanSurat::where('status', 'disetujui')
            ->whereDate('jadwal_pengambilan', '<', $now->toDateString())
            ->get();

        foreach ($surats as $surat) {
            $surat->status = 'Gagal Diambil';
            $surat->catatan = 'Pemohon tidak datang saat jadwal pengambilan.';
            $surat->save();
            $this->info("Surat ID {$surat->id} ditandai gagal diambil.");
        }

        return Command::SUCCESS;
    }
}
