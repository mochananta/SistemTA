<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('user.home'); 
});
Route::get('/formlayanan', [UserController::class,'formview'])->name('user.layanan.form-surat.form');
Route::get('/pengajuan surat', [UserController::class,'jenissuratview'])->name('user.layanan.surat');
Route::get('/formlayanan2', [UserController::class,'formview2'])->name('user.layanan.form-konsultasi.form2');
Route::get('/pengajuan surat2', [UserController::class,'jenissuratview2'])->name('user.layanan.konsultasi');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.index');

});




