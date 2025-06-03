<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Kua;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tipe = $request->input('tipe', 'surat');
        $kuaId = $request->input('kua_id');

        $suratData = [];
        $konsultasiData = [];

        if ($tipe === 'surat') {
            $query = PengajuanSurat::where('status', 'Selesai Diambil');

            if ($kuaId) {
                $query->where('kua_id', $kuaId);
            }

            $suratData = $query->with('kua')->get();
        } elseif ($tipe === 'konsultasi') {
            $query = Konsultasi::where('status', 'Selesai');

            if ($kuaId) {
                $query->where('kua_id', $kuaId);
            }

            $konsultasiData = $query->with('kua')->get();
        }

        $kualist = Kua::all();
        return view('admin.rekap.view', compact('tipe', 'kuaId', 'suratData', 'konsultasiData', 'kualist'));
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
