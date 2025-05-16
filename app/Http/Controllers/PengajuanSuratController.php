<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin_kua') {
            $data = PengajuanSurat::where('kua_id', $user->kua_id)->with(['user', 'kua'])->latest()->get();
        } else {
            $data = PengajuanSurat::with(['user', 'kua'])->latest()->get();
        }

        return view('admin.surat.view', compact('data'));
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'nohp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5048',
            'jenis_surat' => 'required|string',
            'kua_id' => 'required|exists:kuas,id',
        ]);

        $path = $request->file('file_path')->store('pengajuan_surat', 'public');

        $kodeLayanan = 'LYN-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

        $pengajuan = PengajuanSurat::create([
            'user_id' => auth()->id(),
            'kua_id' => $request->kua_id,
            'kode_layanan' => $kodeLayanan,
            'jenis_surat' => $request->jenis_surat,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'file_path' => $path,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->back()->with([
            'success' => 'Pengajuan berhasil dikirim.',
            'kode_layanan' => $pengajuan->kode_layanan,
            'nohp' => $pengajuan->nohp,
        ]);
    }

    public function approveSurat($id, Request $request)
    {
        $surat = PengajuanSurat::findOrFail($id);
        $surat->update([
            'status' => 'disetujui',
            'catatan' => $request->catatan ?? 'Disetujui oleh admin',
        ]);

        return back()->with('success', 'Pengajuan disetujui.');
    }

    public function rejectSurat($id, Request $request)
    {
        $surat = PengajuanSurat::findOrFail($id);
        $surat->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan ?? 'Ditolak oleh admin',
        ]);

        return back()->with('success', 'Pengajuan ditolak.');
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
    public function destroySurat($id)
    {
        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->file_path && \Storage::exists($surat->file_path)) {
            \Storage::delete($surat->file_path);
        }

        $surat->delete();

        return redirect()->back()->with('success', 'Data surat berhasil dihapus.');
    }
}
