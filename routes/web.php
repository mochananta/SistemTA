<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\CustomNewPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PelacakanController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\RumahIbadahController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('user.home');
Route::post('/lacak-layanan', [PelacakanController::class, 'cek'])->name('lacak.cek');
Route::get('/lacak/download/{kode_layanan}', [PelacakanController::class, 'downloadPDF'])->name('lacak.download');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/search-rumah-ibadah', [RumahIbadahController::class, 'searchRumahIbadah']);

Route::get('/rumah-ibadah', [UserController::class, 'rumahibadah'])->name('user.partical.rumahibadahdetail');

Route::middleware(['auth', 'check.phone'])->group(function () {
    Route::get('/pengajuan-surat', [UserController::class, 'jenissuratview'])->name('user.layanan.surat');
    Route::get('/konsultasi', [UserController::class, 'jeniskonsultasiview'])->name('user.layanan.konsultasi');
});

Route::post('/reset-password', [CustomNewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

//form pengajuan surat & konsultasi
Route::middleware(['auth'])->group(function () {
    Route::post('/pengajuan-surat/store', [PengajuanSuratController::class, 'store'])->name('pengajuan.store');
    Route::post('/konsultasi/store', [KonsultasiController::class, 'store'])->name('konsultasi.store');
    Route::get('/form/{jenis}', [UserController::class, 'showForm'])->name('form.jenis');
    Route::get('/get-rumah-ibadah', [RumahIbadahController::class, 'filterRumahIbadah']);

    Route::get('/profil', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [UserController::class, 'editPassword'])->name('password.edit');
    Route::post('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile/delete', [UserController::class, 'destroy'])->name('profile.destroy');

    Route::post('/surat/{id}/reapply', [PengajuanSuratController::class, 'reapply'])->name('surat.reapply');
    Route::get('/pengajuan/{id}/edit', [PengajuanSuratController::class, 'edit'])->name('pengajuan.edit');
    Route::post('/pengajuan/{id}/update', [PengajuanSuratController::class, 'update'])->name('pengajuan.update');

    Route::post('/konsultasi/{id}/reapply', [KonsultasiController::class, 'reapply'])->name('konsultasi.reapply');
    Route::get('/konsultasi/{id}/edit', [KonsultasiController::class, 'edit'])->name('konsultasi.edit');
    Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');

    Route::get('/api/kuas/{id}', function ($id) {
        $kua = \App\Models\Kua::findOrFail($id);
        return response()->json(['kecamatan' => $kua->kecamatan]);
    });
});

//admin kua & sistem
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin.role'
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.index');

    Route::get('/suratview', [PengajuanSuratController::class, 'index'])->name('admin.surat.view');
    Route::post('/Surat/{id}/updatesuratStatus', [PengajuanSuratController::class, 'updatesuratStatus'])->name('Surat.updateStatus');
    Route::post('/Surat/{id}/reject', [PengajuanSuratController::class, 'rejectSurat'])->name('Surat.reject');
    Route::delete('/Surat/{id}', [PengajuanSuratController::class, 'destroySurat'])->name('Surat.delete');


    Route::get('/konsultasiview', [KonsultasiController::class, 'index'])->name('admin.konsultasi.view');
    Route::post('/Konsultasi/{id}/updatekonsultasiStatus', [KonsultasiController::class, 'updatekonsultasiStatus'])->name('Konsultasi.updateStatus');
    Route::post('/Konsultasi/{id}/reject', [KonsultasiController::class, 'rejectKonsultasi'])->name('Konsultasi.reject');
    Route::delete('/Konsultasi/{id}', [KonsultasiController::class, 'destroyKonsultasi'])->name('Konsultasi.delete');

    Route::get('/ibadahview', [RumahIbadahController::class, 'index'])->name('admin.ibadah.view');
    Route::get('rumahibadah/{id}/edit', [RumahIbadahController::class, 'edit'])->name('admin.ibadah.edit');
    Route::put('/rumahibadah/{id}', [RumahIbadahController::class, 'update'])->name('admin.ibadah.update');
    Route::delete('rumahibadah/{id}', [RumahIbadahController::class, 'destroy'])->name('admin.ibadah.delete');

    Route::post('/import-rumah-ibadah', [RumahIbadahController::class, 'import'])->name('rumah-ibadah.import');
    Route::get('/rekapview', [RekapController::class, 'index'])->name('admin.rekap.view');
});


Route::get('/redirect-after-login', function () {
    $user = auth()->user();

    if ($user->role === 'admin_sistem' || $user->role === 'admin_kua') {
        return redirect()->route('admin.index');
    }

    return redirect('/');
});
