<?php

namespace App\Http\Controllers;

use App\Models\ObjekVital;
use Illuminate\Http\Request;

class ObjekVitalController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\ObjekVital::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_objek', 'like', "%$q%")
                    ->orWhere('nama_manager', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%");
            });
        }

        $objekVitalList = $query->paginate(10)->withQueryString();

        return view('super-admin.data.objekvital.index', compact('objekVitalList'));
    }

    public function create()
    {
        return view('super-admin.data.objekvital.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_objek' => 'required|string|max:255',
            'nama_manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        ObjekVital::create($request->all());
        return redirect()->route('super-admin.data.objekvital.index')->with('success', 'Data objek vital berhasil ditambah.');
    }

    public function show($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('super-admin.data.objekvital.show', compact('objekVital'));
    }

    public function edit($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('super-admin.data.objekvital.edit', compact('objekVital'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_objek' => 'required|string|max:255',
            'nama_manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        $objekVital = ObjekVital::findOrFail($id);
        $objekVital->update($request->all());
        return redirect()->route('super-admin.data.objekvital.index')->with('success', 'Data objek vital berhasil diupdate.');
    }

    public function destroy($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        $objekVital->delete();
        return redirect()->route('super-admin.data.objekvital.index')->with('success', 'Data objek vital berhasil dihapus.');
    }
} 