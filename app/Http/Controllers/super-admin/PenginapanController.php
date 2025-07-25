<?php

namespace App\Http\Controllers;

use App\Models\Penginapan;
use Illuminate\Http\Request;

class PenginapanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penginapan::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('jenis', 'like', "%$q%")
                    ->orWhere('nama_pengelola', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $penginapanList = $query->latest()->paginate(10)->withQueryString();
        return view('super-admin.data.penginapan.index', compact('penginapanList'));
    }

    public function create()
    {
        $jenisOptions = Penginapan::getJenisOptions();
        return view('super-admin.data.penginapan.create', compact('jenisOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:Hotel,Apartemen,Losmen,Kontrakan,Kost',
            'nama_pengelola' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        Penginapan::create($request->all());
        return redirect()->route('super-admin.data.penginapan.index')->with('success', 'Data penginapan berhasil ditambah.');
    }

    public function show($id)
    {
        $penginapan = Penginapan::findOrFail($id);
        return view('super-admin.data.penginapan.show', compact('penginapan'));
    }

    public function edit($id)
    {
        $penginapan = Penginapan::findOrFail($id);
        $jenisOptions = Penginapan::getJenisOptions();
        return view('super-admin.data.penginapan.edit', compact('penginapan', 'jenisOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:Hotel,Apartemen,Losmen,Kontrakan,Kost',
            'nama_pengelola' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        $penginapan = Penginapan::findOrFail($id);
        $penginapan->update($request->all());
        return redirect()->route('super-admin.data.penginapan.index')->with('success', 'Data penginapan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penginapan = Penginapan::findOrFail($id);
        $penginapan->delete();
        return redirect()->route('super-admin.data.penginapan.index')->with('success', 'Data penginapan berhasil dihapus.');
    }
} 