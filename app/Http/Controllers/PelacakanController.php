<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\PengajuanSurat;
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

        $data = \App\Models\PengajuanSurat::where('kode_layanan', $request->kode_layanan)
            ->where('nohp', $request->nohp)
            ->first();

        if (!$data) {
            $data = \App\Models\Konsultasi::where('kode_layanan', $request->kode_layanan)
                ->where('nohp', $request->nohp)
                ->first();
        }

        if (!$data) {
            return redirect(url('/') . "#lacak")->with('lacak_error', 'Data layanan tidak ditemukan. Periksa kembali input Anda.');
        }

        return redirect(url('/') . "#lacak")->with('lacak_data', $data);
    }


    public function downloadPDF($kode_layanan)
    {
        $data = PengajuanSurat::where('kode_layanan', $kode_layanan)->first()
            ?? Konsultasi::where('kode_layanan', $kode_layanan)->first();

        if (!$data || $data->status !== 'disetujui') {
            abort(404);
        }

        $isSurat = get_class($data) === PengajuanSurat::class;

        $pdf = Pdf::loadView('user.pdf.bukti_pengajuan', [
            'data' => $data,
            'isSurat' => $isSurat
        ]);

        return $pdf->download('bukti_pengajuan_' . $kode_layanan . '.pdf');
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
