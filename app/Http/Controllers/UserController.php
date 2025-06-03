<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Kua;
use App\Models\PengajuanSurat;
use App\Models\RumahIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $totalSurat = PengajuanSurat::count();
        $totalKonsultasi = Konsultasi::count();
        $totalLayanan = $totalSurat + $totalKonsultasi;

        $jenisLayanan = ['Pendaftaran Pernikahan', 'Wakaf', 'Rumah Ibadah', 'Rekomendasi Pernikahan'];
        $statistikLayanan = [];

        foreach ($jenisLayanan as $jenis) {
            $totalSuratJenis = PengajuanSurat::where('jenis_surat', $jenis)->count();
            $totalKonsultasiJenis = Konsultasi::where('jenis_konsultasi', $jenis)->count();
            $statistikLayanan[$jenis] = $totalSuratJenis + $totalKonsultasiJenis;
        }

        $pengajuanPerJenis = PengajuanSurat::selectRaw('jenis_surat, COUNT(*) as total')
            ->groupBy('jenis_surat')
            ->pluck('total', 'jenis_surat')
            ->toArray();

        $konsultasiPerJenis = Konsultasi::selectRaw('jenis_konsultasi, COUNT(*) as total')
            ->groupBy('jenis_konsultasi')
            ->pluck('total', 'jenis_konsultasi')
            ->toArray();

        $labels = array_merge(
            array_map(fn($label) => 'Surat ' . $label, array_keys($pengajuanPerJenis)),
            array_map(fn($label) => 'Konsultasi ' . $label, array_keys($konsultasiPerJenis))
        );

        $donutSeries = array_merge(
            array_values($pengajuanPerJenis),
            array_values($konsultasiPerJenis)
        );

        $bulanList = range(1, 12);
        $tahun = date('Y');

        $suratPerBulan = [];
        $konsultasiPerBulan = [];

        foreach ($bulanList as $bulan) {
            $suratPerBulan[] = PengajuanSurat::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->count();

            $konsultasiPerBulan[] = Konsultasi::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->count();
        }

        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $rumahIbadah = RumahIbadah::limit(10)->get();

        return view('user.home', [
            'labels' => $labels,
            'donutSeries' => $donutSeries,
            'lineLabels' => $bulanLabels,
            'lineSurat' => $suratPerBulan,
            'lineKonsultasi' => $konsultasiPerBulan,
            'rumahIbadah' => $rumahIbadah,
            'totalSurat' => $totalSurat,
            'totalKonsultasi' => $totalKonsultasi,
            'totalLayanan' => $totalLayanan,
            'statistikLayanan' => $statistikLayanan,
        ]);
    }

    public function showForm($jenis)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login dahulu untuk mengisi formulir.');
        }

        $kuas = Kua::all();
        $kecamatans = DB::table('rumah_ibadah')
            ->select('kecamatan')
            ->whereNotNull('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->get();

        return match ($jenis) {
            'surat-ibadah' => view('user.layanan.form-surat.ibadah', compact('kuas')),
            'surat-wakaf' => view('user.layanan.form-surat.wakaf', compact('kuas')),
            'surat-pendaftaran-pernikahan' => view('user.layanan.form-surat.pendaftaran-pernikahan', compact('kuas')),
            'surat-rekomendasi-nikah' => view('user.layanan.form-surat.rekomendasi-nikah', compact('kuas')),

            'konsultasi-ibadah' => view('user.layanan.form-konsultasi.ibadah', compact('kuas', 'kecamatans')),
            'konsultasi-pendaftaran-pernikahan' => view('user.layanan.form-konsultasi.pendaftaran-pernikahan', compact('kuas')),
            'konsultasi-wakaf' => view('user.layanan.form-konsultasi.wakaf', compact('kuas')),
            'konsultasi-rekomendasi-nikah' => view('user.layanan.form-konsultasi.rekomendasi-nikah', compact('kuas')),
            default => abort(404),
        };
    }

    public function jenissuratview()
    {
        return view('user.layanan.surat');
    }

    public function jeniskonsultasiview()
    {
        return view('user.layanan.konsultasi');
    }

    public function profile()
    {
        $user = auth()->user();

        $pengajuanSurat = [
            'diproses' => $user->pengajuanSurat()->whereIn('status', ['Menunggu Verifikasi', 'Diverifikasi', 'Dokumen Lengkap'])->latest()->get(),
            'disetujui' => $user->pengajuanSurat()->where('status', 'Disetujui')->latest()->get(),
            'selesai' => $user->pengajuanSurat()->where('status', 'Selesai Diambil')->latest()->get(),
            'gagal' => $user->pengajuanSurat()->where('status', 'gagal diambil')->latest()->get(),
            'ditolak' => $user->pengajuanSurat()->where('status', 'Ditolak')->get(),
        ];
        $konsultasi = [
            'diproses' => $user->konsultasi()->where('status', ['Menunggu Verifikasi','Diproses'])->latest()->get(),
            'dijadwalkan' => $user->konsultasi()->where('status', 'Dijadwalkan')->latest()->get(),
            'selesai' => $user->konsultasi()->where('status', 'Selesai')->latest()->get(),
            'tidak_hadir' => $user->konsultasi()->where('status', 'Tidak Hadir')->latest()->get(),
            'ditolak' => $user->konsultasi()->where('status', 'Ditolak')->latest()->get(),
        ];

        return view('profile.profile', compact('user', 'pengajuanSurat', 'konsultasi'));
    }

    public function edit()
    {
        return view('profile.edit-profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nohp' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nohp = $request->nohp;

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }
        $user->save();
        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function editPassword()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('password.edit')->with('success', 'Password berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun Anda berhasil dihapus.');
    }
}
