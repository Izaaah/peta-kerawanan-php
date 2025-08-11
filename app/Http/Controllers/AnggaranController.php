<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggaran;

class AnggaranController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'akun' => 'required|string|max:100',
            'kegiatan' => 'required|string',
            'anggaran_sebelum' => 'required|numeric|min:0',
            'blokir' => 'nullable|numeric|min:0',
        ]);

        $validated['created_by'] = optional($request->user())->id;

        Anggaran::create($validated);

        return back()->with('success', 'Anggaran berhasil disimpan.');
    }
}
