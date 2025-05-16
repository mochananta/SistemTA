<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
