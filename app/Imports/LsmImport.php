<?php

namespace App\Imports;

use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\LsmNarkotika;
use Illuminate\Http\Request;

class LsmImport
{
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);
        $path = $request->file('file')->getRealPath();
        $extension = $request->file('file')->getClientOriginalExtension();

        $rows = SimpleExcelReader::create($path, $extension)->getRows();

        foreach ($rows as $row) {
            LsmNarkotika::create([
                'nama_lsm' => $row['nama_lsm'],
                'ketua_lsm' => $row['ketua_lsm'],
                'alamat' => $row['alamat'],
                'no_hp_ketua' => $row['no_hp_ketua'],
            ]);
        }

        return back()->with('success', 'Data berhasil diimport!');
    }
}
