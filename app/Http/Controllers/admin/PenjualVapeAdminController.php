<?php

namespace App\Http\Controllers\admin;

use App\Models\PenjualVape;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenjualVapeAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = PenjualVape::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_toko', 'like', "%$q%")
                    ->orWhere('pemilik', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $vapeList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.vape.index', compact('vapeList'));
    }

    public function create()
    {
        return view('admin.data.vape.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'liquid_dicurigai' => 'nullable|string',
            'distributor' => 'nullable|string',
        ]);
        PenjualVape::create($data);
        return redirect()->route('admin.data.vape.index')->with('success', 'Data penjual vape berhasil disimpan.');
    }

    public function show($id)
    {
        $vape = PenjualVape::findOrFail($id);
        return view('admin.data.vape.show', compact('vape'));
    }

    public function edit($id)
    {
        $vape = PenjualVape::findOrFail($id);
        return view('admin.data.vape.edit', compact('vape'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'liquid_dicurigai' => 'nullable|string',
            'distributor' => 'nullable|string',
        ]);
        $vape = PenjualVape::findOrFail($id);
        $vape->update($request->all());
        return redirect()->route('admin.data.vape.index')->with('success', 'Data penjual vape berhasil diupdate.');
    }

    public function destroy($id)
    {
        $vape = PenjualVape::findOrFail($id);
        $vape->delete();
        return redirect()->route('admin.data.vape.index')->with('success', 'Data penjual vape berhasil dihapus.');
    }
}
