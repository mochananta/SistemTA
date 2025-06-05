<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Kua;
use App\Models\RumahIbadah;
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
        $totalKonsultasi = Konsultasi::count();
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

        $data = $query
            ->whereNotIn('status', ['ditolak', 'Selesai', 'Tidak Hadir'])
            ->latest()
            ->paginate(10)
            ->withQueryString();
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
            'alamat' => 'required|string',
            'tanggal_konsultasi' => 'required|date',
            'isi_konsultasi' => 'required|string',
            'jenis_konsultasi' => 'required|string',
            'rumah_ibadah_id' => 'nullable|exists:rumah_ibadah,id',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5048',
            'kua_id' => 'required|exists:kuas,id',

        ]);

        $path = $request->file('file_path')->store('konsultasi', 'public');

        $kodeLayanan = now()->format('YmdHis') . uniqid();
        $user = auth()->user();
        $nohp = $user->nohp ?? $request->input('nohp', 'tidak tersedia');


        $konsultasi = Konsultasi::create([
            'user_id' => auth()->id(),
            'kua_id' => $request->kua_id,
            'kode_layanan' => $kodeLayanan,
            'jenis_konsultasi' => $request->jenis_konsultasi,
            'name' => $user->name,
            'nohp' => $nohp,
            'alamat' => $request->alamat,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'isi_konsultasi' => $request->isi_konsultasi,
            'rumah_ibadah_id' => $request->rumah_ibadah_id,
            'file_path' => $path,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->back()->with([
            'success' => 'Pengajuan berhasil dikirim.',
            'kode_layanan' => $konsultasi->kode_layanan,
            'nohp' => $nohp,
        ]);
    }


    public function updatekonsultasiStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'catatan' => 'nullable|string',
            'jadwal_konsultasi_tanggal' => 'nullable|date',
            'jadwal_konsultasi_jam' => 'nullable|date_format:H:i',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $newStatus = $request->status;

        if ($newStatus === 'Ditolak') {
            if (!trim($request->catatan)) {
                return back()->with('error', 'Mohon isi catatan alasan penolakan terlebih dahulu.');
            }

            $konsultasi->update([
                'status' => 'Ditolak',
                'catatan' => $request->catatan,
            ]);

            return back()->with('success', 'Status berhasil diperbarui ke Ditolak.');
        }

        $allowedStatuses = [
            'Menunggu Verifikasi',
            'Diproses',
            'Dijadwalkan',
            'Selesai',
            'Tidak Hadir',
        ];

        $currentIndex = array_search($konsultasi->status, $allowedStatuses);
        $newIndex = array_search($newStatus, $allowedStatuses);

        if ($newIndex === false || $currentIndex === false) {
            return back()->with('error', 'Status tidak valid.');
        }

        $bypassStrictOrder = $konsultasi->status === 'Dijadwalkan' && in_array($newStatus, ['Tidak Hadir', 'Selesai']);

        if (!$bypassStrictOrder) {
            if ($newIndex < $currentIndex) {
                return back()->with('error', 'Tidak bisa kembali ke status sebelumnya.');
            }

            if ($newIndex - $currentIndex > 1) {
                return back()->with('error', 'Status harus mengikuti urutan langkah demi langkah.');
            }
        }

        if ($newStatus === 'Dijadwalkan') {
            if (!$request->jadwal_konsultasi_tanggal || !$request->jadwal_konsultasi_jam) {
                return back()->with('error', 'Tanggal dan jam konsultasi wajib diisi saat menjadwalkan.');
            }

            $konsultasi->jadwal_konsultasi_tanggal = $request->jadwal_konsultasi_tanggal;
            $konsultasi->jadwal_konsultasi_jam = $request->jadwal_konsultasi_jam;
        }

        $konsultasi->catatan = $newStatus === 'Tidak Hadir'
            ? 'Pemohon tidak hadir sesuai jadwal konsultasi.'
            : null;

        $konsultasi->status = $newStatus;
        $konsultasi->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }


    /**
     * Display the specified resource.
     */
    public function rejectKonsultasi(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->status = 'Ditolak';
        $konsultasi->catatan = $request->catatan;
        $konsultasi->save();

        return back()->with('success', 'konsultasi berhasil ditolak.');
    }


    public function reapply($id)
    {
        $konsultasi = Konsultasi::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (!in_array(strtolower($konsultasi->status), ['tidak hadir', 'ditolak'])) {
            return redirect()->back()->with('error', 'Konsultasi ini tidak bisa diajukan ulang.');
        }

        return redirect()->back()
            ->with('show_reapply_modal', $konsultasi->id)
            ->with('info', 'Silakan perbaiki data sebelum mengajukan ulang.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $konsultasi = Konsultasi::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('konsultasi.edit', compact('konsultasi'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string',
            'isi_konsultasi' => 'required|string',
            'tanggal_konsultasi' => 'required|date',
            'kua_id' => 'required|exists:kuas,id',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5048',
        ]);

        $konsultasi = Konsultasi::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $data = [
            'alamat' => $request->alamat,
            'isi_konsultasi' => $request->isi_konsultasi,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'kua_id' => $request->kua_id,
            'updated_at' => now(),
        ];

        if ($request->has('is_reapply')) {
            $data['status'] = 'Menunggu Verifikasi';
            $data['catatan'] = null;
        }

        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('konsultasi', 'public');
            $data['file_path'] = $path;
        }

        $konsultasi->update($data);

        return redirect()->back()->with('success', 'Konsultasi berhasil diperbarui.');
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

        return redirect()->back()->with('error', 'Konsultasi berhasil dihapus.');
    }
}
