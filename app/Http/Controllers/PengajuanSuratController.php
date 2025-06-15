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

        $data = $query
            ->whereNotIn('status', ['ditolak', 'Selesai Diambil', 'gagal diambil'])
            ->latest()
            ->paginate(10)
            ->withQueryString();
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
            'alamat' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5048',
            'jenis_surat' => 'required|string',
            'kua_id' => 'required|exists:kuas,id',
        ]);

        $path = $request->file('file_path')->store('pengajuan_surat', 'public');

        $kodeLayanan = now()->format('YmdHis') . uniqid();
        $user = auth()->user();
        $nohp = $user->nohp ?? $request->input('nohp', 'tidak tersedia');


        $pengajuan = PengajuanSurat::create([
            'user_id' => $user->id,
            'kua_id' => $request->kua_id,
            'kode_layanan' => $kodeLayanan,
            'name' => $user->name,
            'nohp' => $nohp,
            'jenis_surat' => $request->jenis_surat,
            'alamat' => $request->alamat,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'file_path' => $path,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->back()->with([
            'success' => 'Pengajuan berhasil dikirim.',
            'kode_layanan' => $pengajuan->kode_layanan,
            'nohp' => $nohp,
        ]);
    }

    public function updatesuratStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $surat = PengajuanSurat::findOrFail($id);

        if ($request->status === 'ditolak') {
            if (!$request->has('catatan') || trim($request->catatan) === '') {
                return back()->with('error', 'Mohon isi catatan alasan penolakan terlebih dahulu.');
            }

            $surat->status = 'ditolak';
            $surat->catatan = $request->catatan;
            $surat->save();

            return back()->with('success', 'Status berhasil diperbarui ke Ditolak.');
        }

        if ($request->status === 'gagal diambil') {
            if ($surat->status !== 'Disetujui') {
                return back()->with('error', 'Status gagal diambil hanya bisa diterapkan setelah disetujui.');
            }

            $surat->status = 'gagal diambil';
            $surat->catatan = 'Pemohon tidak datang pada jadwal pengambilan yang telah ditentukan.';
            $surat->jadwal_pengambilan = null;
            $surat->diambil_pada = null;
            $surat->save();

            return back()->with('success', 'Status berhasil diperbarui ke Gagal Diambil.');
        }

        $allowedStatuses = [
            'Menunggu Verifikasi',
            'Diverifikasi',
            'Dokumen Lengkap',
            'Disetujui',
            'Selesai Diambil',
            'gagal diambil',
        ];

        $currentIndex = array_search($surat->status, $allowedStatuses);
        $newIndex = array_search($request->status, $allowedStatuses);

        if ($newIndex === false || $currentIndex === false) {
            return back()->with('error', 'Status tidak valid.');
        }

        $isLangsungGagalDiambil = $surat->status === 'Disetujui' && $request->status === 'gagal diambil';

        if ($newIndex < $currentIndex && !$isLangsungGagalDiambil) {
            return back()->with('error', 'Tidak bisa kembali ke status sebelumnya.');
        }

        if (($newIndex - $currentIndex > 1) && !$isLangsungGagalDiambil) {
            return back()->with('error', 'Status harus mengikuti urutan langkah demi langkah.');
        }

        if ($request->status === 'Dokumen Lengkap' && !$surat->file_path) {
            return back()->with('error', 'Tidak bisa melanjutkan, file dokumen belum tersedia.');
        }

        switch ($request->status) {
            case 'Disetujui':
                if (!$request->filled('jadwal_pengambilan')) {
                    return back()->with('error', 'Mohon tentukan jadwal pengambilan.');
                }
                $surat->jadwal_pengambilan = $request->jadwal_pengambilan;
                $surat->diambil_pada = null;
                break;

            case 'Selesai Diambil':
                if (!$request->filled('diambil_pada')) {
                    return back()->with('error', 'Mohon tentukan tanggal pengambilan.');
                }
                $surat->diambil_pada = $request->diambil_pada;
                break;

            default:
                $surat->jadwal_pengambilan = null;
                $surat->diambil_pada = null;
                break;
        }

        $surat->status = $request->status;
        $surat->catatan = null;
        $surat->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }


    public function rejectSurat(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
            'dokumen_penolakan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $surat = PengajuanSurat::findOrFail($id);

        $surat->status = 'ditolak';
        $surat->catatan = $request->catatan;

        if ($request->hasFile('dokumen_penolakan')) {
            $file = $request->file('dokumen_penolakan');
            $filename = 'penolakan_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('penolakan', $filename, 'public');
            $surat->dokumen_penolakan = $path;
        }

        $surat->status = 'ditolak';
        $surat->catatan = $request->catatan;
        $surat->save();

        return back()->with('success', 'Pengajuan surat berhasil ditolak dengan catatan.');
    }


    /**
     * Display the specified resource.
     */
    public function reapply($id)
    {
        $surat = PengajuanSurat::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (!in_array(strtolower($surat->status), ['gagal diambil', 'ditolak'])) {
            return redirect()->back()->with('error', 'Surat ini tidak bisa diajukan ulang.');
        }

        if ($surat->dokumen_penolakan && Storage::disk('public')->exists($surat->dokumen_penolakan)) {
            Storage::disk('public')->delete($surat->dokumen_penolakan);
        }

        $surat->update([
            'catatan' => null,
            'dokumen_penolakan' => null,
        ]);

        $surat->refresh();

        return redirect()->route('pengajuan.edit', $surat->id)
            ->with('success', 'Silakan perbaiki data sebelum mengajukan ulang.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $surat = PengajuanSurat::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('pengajuan.edit', compact('surat'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'kua_id' => 'required|exists:kuas,id',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5048',
        ]);

        $surat = PengajuanSurat::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $data = [
            'alamat' => $request->alamat,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'kua_id' => $request->kua_id,
            'status' => 'Menunggu Verifikasi',
            'updated_at' => now(),
        ];

        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('pengajuan_surat', 'public');
            $data['file_path'] = $path;
        }

        $surat->update($data);

        return redirect()->back()->with('success', 'Pengajuan berhasil diperbarui.');
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
