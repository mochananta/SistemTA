<?php

namespace App\Imports;

use App\Models\RumahIbadah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class RumahIbadahImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['nama']) || empty($row['jenis']) || empty($row['alamat'])) {
                continue;
            }

            RumahIbadah::create([
                'nama' => $row['nama'],
                'jenis' => $row['jenis'],
                'alamat' => $row['alamat'],
                'kontak' => $row['kontak'] ?? null,
                'kecamatan' => $row['kecamatan'] ?? null,
            ]);
        }
    }
}
