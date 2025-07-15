<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    public function index()
    {
        $ekspedisiList = Ekspedisi::latest()->paginate(10);
        return view('super-admin.data.ekspedisi.index', compact('ekspedisiList'));
    }

    public function create()
    {
        $jenisOptions = Ekspedisi::getJenisOptions();
        return view('super-admin.data.ekspedisi.create', compact('jenisOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jenis' => 'required|in:Asperindo,Non Asperindo',
        ]);
        Ekspedisi::create($request->all());
        return redirect()->route('super-admin.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil ditambah.');
    }

    public function show($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        return view('super-admin.data.ekspedisi.show', compact('ekspedisi'));
    }

    public function edit($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $jenisOptions = Ekspedisi::getJenisOptions();
        return view('super-admin.data.ekspedisi.edit', compact('ekspedisi', 'jenisOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jenis' => 'required|in:Asperindo,Non Asperindo',
        ]);
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->update($request->all());
        return redirect()->route('super-admin.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->delete();
        return redirect()->route('super-admin.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil dihapus.');
    }
} 