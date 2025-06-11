<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\PengajuanSurat;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PelacakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cek(Request $request)
    {
        $request->validate([
            'kode_layanan' => 'required|string',
            'nohp' => 'required|string',
        ]);

        $user = User::where('nohp', $request->nohp)->first();

        if (!$user) {
            return redirect(url('/') . "#lacak")->with('lacak_error', 'Nomor HP tidak ditemukan.');
        }

        $data = PengajuanSurat::where('kode_layanan', $request->kode_layanan)
            ->where('user_id', $user->id)
            ->first();

        if (!$data) {
            $data = Konsultasi::where('kode_layanan', $request->kode_layanan)
                ->where('user_id', $user->id)
                ->first();
        }

        if (!$data) {
            return redirect(url('/') . "#lacak")->with('lacak_error', 'Data layanan tidak ditemukan. Periksa kembali input Anda.');
        }

        $data->load('user');

        return redirect(url('/') . "#lacak")->with('lacak_data', $data);
    }


    public function downloadPDF($kode_layanan)
    {
        $data = PengajuanSurat::with('user')->where('kode_layanan', $kode_layanan)->first()
            ?? Konsultasi::with('user')->where('kode_layanan', $kode_layanan)->first();

        if (!$data) {
            abort(404, 'Data tidak ditemukan');
        }

        // Sesuaikan logika status di sini
        $isSurat = $data instanceof PengajuanSurat;

        if (
            ($isSurat && $data->status !== 'Disetujui') ||
            (!$isSurat && $data->status !== 'Dijadwalkan')
        ) {
            abort(403, 'Status belum memenuhi syarat untuk cetak PDF');
        }

        $pdf = Pdf::loadView('user.pdf.bukti_pengajuan', [
            'data' => $data,
            'isSurat' => $isSurat
        ]);

        return $pdf->download('bukti_pengajuan' . '.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
