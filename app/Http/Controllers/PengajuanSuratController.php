<?php

namespace App\Http\Controllers;

use App\Models\Kua;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = PengajuanSurat::with(['user', 'kua']);

        if ($user->role === 'admin_kua') {
            $query->where('kua_id', $user->kua_id);
        }

        if ($request->filled('kua_id') && $user->role === 'admin_sistem') {
            $query->where('kua_id', $request->kua_id);
        }

        if ($request->filled('search')) {
            $search = strtolower(trim($request->search));
            $letters = str_split($search);

            $query->where(function ($q) use ($letters) {
                foreach ($letters as $letter) {
                    $q->whereRaw('LOWER(nama) LIKE ?', ["%$letter%"]);
                }
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();
        $kualist = $user->role === 'admin_sistem' ? Kua::all() : collect();

        return view('admin.surat.view', compact('data', 'kualist'));
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

        return redirect()->back()->with('success', 'Pengajuan surat berhasil disetujui.');
    }

    public function rejectSurat($id, Request $request)
    {
        $surat = PengajuanSurat::findOrFail($id);
        $surat->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan ?? 'Ditolak oleh admin',
        ]);

        return redirect()->back()->with('warning', 'Pengajuan surat telah ditolak.');
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

        if ($surat->file_path && Storage::exists($surat->file_path)) {
            Storage::delete($surat->file_path);
        }

        $surat->delete();

        return redirect()->back()->with('error', 'Pengajuan surat berhasil dihapus.');
    }
}
