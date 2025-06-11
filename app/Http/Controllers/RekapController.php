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
        $user = auth()->user();
        $tipe = $request->input('tipe', 'surat');
        $kuaId = $request->input('kua_id');

        $suratData = [];
        $konsultasiData = [];

        if ($tipe === 'surat') {
            $query = PengajuanSurat::where('status', 'Selesai Diambil')->with(['user', 'kua']);

            if ($user->role === 'admin_kua') {
                $query->where('kua_id', $user->kua_id);
            }

            if ($kuaId && $user->role === 'admin_sistem') {
                $query->where('kua_id', $kuaId);
            }

            $suratData = $query->get();
        } elseif ($tipe === 'konsultasi') {
            $query = Konsultasi::where('status', 'Selesai')->with(['user', 'kua']);

            if ($user->role === 'admin_kua') {
                $query->where('kua_id', $user->kua_id);
            }

            if ($kuaId && $user->role === 'admin_sistem') {
                $query->where('kua_id', $kuaId);
            }

            $konsultasiData = $query->get();
        }

        $kualist = $user->role === 'admin_sistem' ? Kua::all() : collect();

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
