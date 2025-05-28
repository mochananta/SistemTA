<?php

namespace App\Http\Controllers;

use App\Imports\RumahIbadahImport;
use App\Models\RumahIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class RumahIbadahController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        Excel::import(new RumahIbadahImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimport!!.');
    }

    public function index(Request $request)
    {
        $query = RumahIbadah::query();

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        $data = $query->paginate(15)->withQueryString();

        $jenisList = RumahIbadah::select('jenis')->distinct()->pluck('jenis');
        $kecamatanList = RumahIbadah::select('kecamatan')->distinct()->pluck('kecamatan');

        return view('admin.ibadah.view', compact('data', 'jenisList', 'kecamatanList'));
    }


    public function getRumahIbadah(Request $request)
    {
        $query = DB::table('rumah_ibadah');

        if ($request->has('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->has('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $rumahIbadah = $query->select('id', 'nama', 'alamat')->orderBy('nama')->get();

        return response()->json($rumahIbadah);
    }
}
