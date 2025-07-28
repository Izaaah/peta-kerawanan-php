<?php

namespace App\Http\Controllers\admin;

use App\Models\ObjekVital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ObjekVitalAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = \App\Models\ObjekVital::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_objek', 'like', "%$q%")
                    ->orWhere('nama_manager', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $objekVitalList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.objekvital.index', compact('objekVitalList'));
    }

    public function create()
    {
        return view('admin.data.objekvital.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        \App\Models\ObjekVital::create($data);
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil disimpan.');
    }

    public function show($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('admin.data.objekvital.show', compact('objekVital'));
    }

    public function edit($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('admin.data.objekvital.edit', compact('objekVital'));
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
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil diupdate.');
    }

    public function destroy($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        $objekVital->delete();
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil dihapus.');
    }
}
