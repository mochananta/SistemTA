<?php

namespace App\Http\Controllers;

use App\Imports\RumahIbadahImport;
use App\Models\RumahIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    public function searchRumahIbadah(Request $request)
    {
        $query = $request->get('q');

        $data = RumahIbadah::when($query, function ($q) use ($query) {
            $q->where('nama', 'like', '%' . $query . '%');
        })
            ->orderBy('nama')
            ->limit(15)
            ->get();

        return response()->json($data);
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

    public function filterRumahIbadah(Request $request)
    {
        $kecamatan = $request->query('kecamatan');
        dd('Kecamatan diterima:', $kecamatan);

        if (!$kecamatan) {
            return response()->json([]);
        }

        $rumahIbadah = RumahIbadah::where('kecamatan', $kecamatan)->get(['id', 'nama']);
        return response()->json($rumahIbadah);
    }

    public function edit($id)
    {
        $item = RumahIbadah::findOrFail($id);
        return view('admin.ibadah.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kecamatan' => 'nullable|string',
            'kontak' => 'nullable|string|max:20',
        ]);

        $item = RumahIbadah::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.ibadah.view')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = RumahIbadah::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.ibadah.view')->with('success', 'Data berhasil dihapus.');
    }
}
