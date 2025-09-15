<?php

namespace App\Http\Controllers\admin;

use App\Models\Komposisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KomposisiAdminController extends Controller
{
    public function index()
    {
        $rows = Komposisi::orderBy('bidang')->get();
        return view('admin.komposisi.index', compact('rows'));

        $komposisiList = Komposisi::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bidang' => 'required|string|max:255',
            'jumlah_personil' => 'required|integer|min:0',
            'dsp_jumlah' => 'required|integer|min:0',
            'dsp_terisi' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);
        $data['dsp_kosong'] = max(0, (int)$data['dsp_jumlah'] - (int)$data['dsp_terisi']);
        $data['created_by'] = optional($request->user())->id;
        Komposisi::create($data);
        return back()->with('success', 'Komposisi ditambahkan');
    }

    public function update(Request $request, Komposisi $komposisi)
    {
        $data = $request->validate([
            'bidang' => 'required|string|max:255',
            'jumlah_personil' => 'required|integer|min:0',
            'dsp_jumlah' => 'required|integer|min:0',
            'dsp_terisi' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);
        $data['dsp_kosong'] = max(0, (int)$data['dsp_jumlah'] - (int)$data['dsp_terisi']);
        $komposisi->update($data);
        return back()->with('success', 'Komposisi diperbarui');
    }

    public function destroy(Komposisi $komposisi)
    {
        $komposisi->delete();
        return back()->with('success', 'Komposisi dihapus');
    }

    public function dashboard()
    {
        $rows = Komposisi::orderBy('bidang')->get();
        return view('admin.dashboard', compact('rows'));
    }
}
