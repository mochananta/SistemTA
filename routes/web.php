<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PelacakanController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\RumahIbadahController;
use App\Http\Controllers\UserController;
use App\Models\PengajuanSurat;
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

Route::get('/pengajuan-surat', [UserController::class, 'jenissuratview'])->name('user.layanan.surat');
Route::get('/konsultasi', [UserController::class, 'jeniskonsultasiview'])->name('user.layanan.konsultasi');
Route::post('/lacak-layanan', [PelacakanController::class, 'cek'])->name('lacak.cek');
Route::get('/lacak/download/{kode_layanan}', [PelacakanController::class, 'downloadPDF'])->name('lacak.download');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

//form pengajuan surat & konsultasi
Route::middleware(['auth'])->group(function () {
    Route::post('/pengajuan-surat/store', [PengajuanSuratController::class, 'store'])->name('pengajuan.store');
    Route::post('/konsultasi/store', [KonsultasiController::class, 'store'])->name('konsultasi.store');
    Route::get('/form/{jenis}', [UserController::class, 'showForm']);
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
    Route::post('/Surat/{id}/approve', [PengajuanSuratController::class, 'approveSurat'])->name('Surat.approve');
    Route::post('/Surat/{id}/reject', [PengajuanSuratController::class, 'rejectSurat'])->name('Surat.reject');
    Route::delete('/Surat/{id}', [PengajuanSuratController::class, 'destroySurat'])->name('Surat.delete');


    Route::get('/konsultasiview', [KonsultasiController::class, 'index'])->name('admin.konsultasi.view');
    Route::post('/Konsultasi/{id}/approve', [KonsultasiController::class, 'approveKonsultasi'])->name('Konsultasi.approve');
    Route::post('/Konsultasi/{id}/reject', [KonsultasiController::class, 'rejectKonsultasi'])->name('Konsultasi.reject');
    Route::delete('/Konsultasi/{id}', [KonsultasiController::class, 'destroyKonsultasi'])->name('Konsultasi.delete');

    Route::get('/ibadahview', [RumahIbadahController::class, 'index'])->name('admin.ibadah.view');
    Route::post('/import-rumah-ibadah', [RumahIbadahController::class, 'import'])->name('rumah-ibadah.import');
});


Route::get('/redirect-after-login', function () {
    $user = auth()->user();

    if ($user->role === 'admin_sistem' || $user->role === 'admin_kua') {
        return redirect()->route('admin.index');
    }

    return redirect('/');
});
