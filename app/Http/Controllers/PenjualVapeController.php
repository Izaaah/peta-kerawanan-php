<?php

namespace App\Http\Controllers;

use App\Models\PenjualVape;
use Illuminate\Http\Request;

class PenjualVapeController extends Controller
{
    public function index()
    {
        $vapeList = PenjualVape::latest()->paginate(10);
        return view('super-admin.data.vape.index', compact('vapeList'));
    }

    public function create()
    {
        return view('super-admin.data.vape.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'liquid_dicurigai' => 'nullable|string',
            'distributor' => 'nullable|string',
        ]);
        PenjualVape::create($request->all());
        return redirect()->route('super-admin.data.vape.index')->with('success', 'Data penjual vape berhasil ditambah.');
    }

    public function show($id)
    {
        $vape = PenjualVape::findOrFail($id);
        return view('super-admin.data.vape.show', compact('vape'));
    }

    public function edit($id)
    {
        $vape = PenjualVape::findOrFail($id);
        return view('super-admin.data.vape.edit', compact('vape'));
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
        return redirect()->route('super-admin.data.vape.index')->with('success', 'Data penjual vape berhasil diupdate.');
    }

    public function destroy($id)
    {
        $vape = PenjualVape::findOrFail($id);
        $vape->delete();
        return redirect()->route('super-admin.data.vape.index')->with('success', 'Data penjual vape berhasil dihapus.');
    }
}
