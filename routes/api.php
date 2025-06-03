<?php

use App\Http\Controllers\RumahIbadahController;
use App\Models\Konsultasi;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/rumah-ibadah', [RumahIbadahController::class, 'getRumahIbadah']);

Route::get('/status-layanan', function (Request $request) {
    $kode = $request->query('kode_layanan');
    $nohp = $request->query('nohp');

    if (!$kode || !$nohp) {
        return response()->json(['error' => 'Parameter kode_layanan dan nohp diperlukan'], 400);
    }

    // Cari di model PengajuanSurat atau Konsultasi
    $data = PengajuanSurat::with('user')->where('kode_layanan', $kode)->whereHas('user', function($q) use ($nohp) {
        $q->where('nohp', $nohp);
    })->first();

    if (!$data) {
        $data = Konsultasi::with('user')->where('kode_layanan', $kode)->whereHas('user', function($q) use ($nohp) {
            $q->where('nohp', $nohp);
        })->first();
    }

    if (!$data) {
        return response()->json(['error' => 'Data layanan tidak ditemukan'], 404);
    }

    return response()->json([
        'status' => $data->status,
        'updated_at' => $data->updated_at->format('d-m-Y H:i'),
        'catatan' => $data->catatan ?? '',
    ]);
});