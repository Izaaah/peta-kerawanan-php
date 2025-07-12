<?php

namespace App\Http\Controllers;

use App\Models\PerusahaanFarmasiPrekursor;
use Illuminate\Http\Request;

class PerusahaanFarmasiPrekursorController extends Controller
{
    public function index()
    {
        $farmasiList = PerusahaanFarmasiPrekursor::latest()->paginate(10);
        return view('super-admin.data.farmasi.index', compact('farmasiList'));
    }

    public function create()
    {
        return view('super-admin.data.farmasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Perusahaan,Farmasi',
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'prekusor' => 'required|string',
            'ijin_penerbit' => 'required|string',
            'jumlah' => 'required|string',
            'tujuan' => 'required|string',
        ]);
        PerusahaanFarmasiPrekursor::create($request->all());
        return redirect()->route('super-admin.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil ditambah.');
    }

    public function show($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        return view('super-admin.data.farmasi.show', compact('farmasi'));
    }

    public function edit($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        return view('super-admin.data.farmasi.edit', compact('farmasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:Perusahaan,Farmasi',
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'prekusor' => 'required|string',
            'ijin_penerbit' => 'required|string',
            'jumlah' => 'required|string',
            'tujuan' => 'required|string',
        ]);
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        $farmasi->update($request->all());
        return redirect()->route('super-admin.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        $farmasi->delete();
        return redirect()->route('super-admin.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil dihapus.');
    }
}
