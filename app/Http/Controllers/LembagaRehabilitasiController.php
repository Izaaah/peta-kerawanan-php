<?php

namespace App\Http\Controllers;

use App\Models\LembagaRehabilitasi;
use Illuminate\Http\Request;

class LembagaRehabilitasiController extends Controller
{
    public function index()
    {
        $lrehabList = LembagaRehabilitasi::latest()->paginate(10);
        return view('super-admin.data.lrehab.index', compact('lrehabList'));
    }

    public function create()
    {
        $jenisOptions = LembagaRehabilitasi::getJenisOptions();
        return view('super-admin.data.lrehab.create', compact('jenisOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:IPWL,Rawat Inap,Non Rawat Inap,SNI Nasional,SNI Reguler',
        ]);
        LembagaRehabilitasi::create($request->all());
        return redirect()->route('super-admin.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil ditambah.');
    }

    public function show($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        return view('super-admin.data.lrehab.show', compact('lrehab'));
    }

    public function edit($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $jenisOptions = LembagaRehabilitasi::getJenisOptions();
        return view('super-admin.data.lrehab.edit', compact('lrehab', 'jenisOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:IPWL,Rawat Inap,Non Rawat Inap,SNI Nasional,SNI Reguler',
        ]);
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $lrehab->update($request->all());
        return redirect()->route('super-admin.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $lrehab->delete();
        return redirect()->route('super-admin.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil dihapus.');
    }
} 