<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LsmNarkotika;

class LsmController extends Controller
{
    public function index(Request $request)
    {
        $query = LsmNarkotika::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_lsm', 'like', "%$q%")
                    ->orWhere('ketua_lsm', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->orWhere('no_hp_ketua', 'like', "%$q%");
            });
        }
        $lsmList = $query->latest()->paginate(10)->withQueryString();
        return view('super-admin.data.lsm.index', compact('lsmList'));
    }

    public function create()
    {
        return view('super-admin.data.lsm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lsm' => 'required|string|max:255',
            'ketua_lsm' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp_ketua' => 'required|string|max:20',
        ]);

        try {
            LsmNarkotika::create($request->all());

            return redirect()->route('super-admin.data.lsm.index')->with('success', 'Data LSM berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function show($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        return view('super-admin.data.lsm.show', compact('lsm'));
    }

    public function edit($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        return view('super-admin.data.lsm.edit', compact('lsm'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lsm' => 'required|string|max:255',
            'ketua_lsm' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp_ketua' => 'required|string|max:20',
        ]);
        $lsm = LsmNarkotika::findOrFail($id);
        $lsm->update($request->all());
        return redirect()->route('super-admin.data.lsm.index')->with('success', 'Data LSM berhasil diupdate.');
    }

    public function destroy($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        $lsm->delete();
        return redirect()->route('super-admin.data.lsm.index')->with('success', 'Data LSM berhasil dihapus.');
    }
}
