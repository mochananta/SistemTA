<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Kua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Konsultasi::with(['user', 'kua']);

        if ($user->role === 'admin_kua') {
            $query->where('kua_id', $user->kua_id);
        }

        if ($request->filled('kua_id') && $user->role === 'admin_sistem') {
            $query->where('kua_id', $request->kua_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%");
        }

        $data = $query->latest()->paginate(10)->withQueryString();
        $kualist = $user->role === 'admin_sistem' ? Kua::all() : collect();

        return view('admin.konsultasi.view', compact('data', 'kualist'));
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
            'tanggal_konsultasi' => 'required|date',
            'jam_konsultasi' => 'required|string',
            'isi_konsultasi' => 'required|string',
            'jenis_konsultasi' => 'required|string',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5048',
            'kua_id' => 'required|exists:kuas,id',
        ]);

        $path = $request->file('file_path')->store('konsultasi', 'public');

        $kodeLayanan = 'LYN-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

        $konsultasi = Konsultasi::create([
            'user_id' => auth()->id(),
            'kua_id' => $request->kua_id,
            'kode_layanan' => $kodeLayanan,
            'jenis_konsultasi' => $request->jenis_konsultasi,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'jam_konsultasi' => $request->jam_konsultasi,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'isi_konsultasi' => $request->isi_konsultasi,
            'file_path' => $path,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->back()->with([
            'success' => 'Pengajuan berhasil dikirim.',
            'kode_layanan' => $konsultasi->kode_layanan,
            'nohp' => $konsultasi->nohp,
        ]);
    }


    public function approveKonsultasi($id, Request $request)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update([
            'status' => 'disetujui',
            'catatan' => $request->catatan ?? 'Disetujui oleh admin',
        ]);

        return back()->with('success', 'Pengajuan disetujui.');
    }

    public function rejectKonsultasi($id, Request $request)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update([
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
    public function destroyKonsultasi($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi->file_path && Storage::exists($konsultasi->file_path)) {
            Storage::delete($konsultasi->file_path);
        }

        $konsultasi->delete();

        return redirect()->back()->with('success', 'Data surat berhasil dihapus.');
    }
}
