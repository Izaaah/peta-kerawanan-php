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
            'tipe_anggaran' => 'required|in:main,sub',
            'parent_id' => 'nullable|exists:anggarans,id',
        ]);

        // Additional validation for sub activities
        if ($validated['tipe_anggaran'] === 'sub' && empty($validated['parent_id'])) {
            return back()->withErrors(['parent_id' => 'Parent activity harus dipilih untuk sub activity.'])->withInput();
        }

        // Set hierarchical fields based on type
        if ($validated['tipe_anggaran'] === 'main') {
            $validated['is_main_activity'] = true;
            $validated['level'] = 0;
            $validated['parent_id'] = null;
        } else {
            $validated['is_main_activity'] = false;
            $validated['level'] = 1;
            // parent_id is already set from request
        }

        $validated['created_by'] = optional($request->user())->id;

        // Remove tipe_anggaran from validated data as it's not a database field
        unset($validated['tipe_anggaran']);

        Anggaran::create($validated);

        return back()->with('success', 'Anggaran berhasil disimpan.');
    }

    public function show(Anggaran $anggaran)
    {
        return response()->json($anggaran);
    }

    public function update(Request $request, Anggaran $anggaran)
    {
        $validated = $request->validate([
            'akun' => 'required|string|max:100',
            'kegiatan' => 'required|string',
            'anggaran_sebelum' => 'required|numeric|min:0',
            'blokir' => 'nullable|numeric|min:0',
            'tipe_anggaran' => 'required|in:main,sub',
            'parent_id' => 'nullable|exists:anggarans,id',
        ]);

        // Additional validation for sub activities
        if ($validated['tipe_anggaran'] === 'sub' && empty($validated['parent_id'])) {
            return back()->withErrors(['parent_id' => 'Parent activity harus dipilih untuk sub activity.'])->withInput();
        }

        // Set hierarchical fields based on type
        if ($validated['tipe_anggaran'] === 'main') {
            $validated['is_main_activity'] = true;
            $validated['level'] = 0;
            $validated['parent_id'] = null;
        } else {
            $validated['is_main_activity'] = false;
            $validated['level'] = 1;
            // parent_id is already set from request
        }

        // Remove tipe_anggaran from validated data as it's not a database field
        unset($validated['tipe_anggaran']);

        $anggaran->update($validated);

        return back()->with('success', 'Anggaran berhasil diperbarui.');
    }

    public function destroy(Anggaran $anggaran)
    {
        $anggaran->delete();
        return back()->with('success', 'Anggaran dihapus');
    }
}
