<?php

namespace App\Http\Controllers;

use App\Models\PenggiatNarkotika;
use Illuminate\Http\Request;

class PenggiatNarkotikaController extends Controller
{
    public function index(Request $request)
    {
        $query = PenggiatNarkotika::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $penggiatList = $query->latest()->paginate(10)->withQueryString();
        return view('super-admin.data.penggiat.index', compact('penggiatList'));
    }

    public function create()
    {
        return view('super-admin.data.penggiat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        PenggiatNarkotika::create($request->all());
        return redirect()->route('super-admin.data.penggiat.index')->with('success', 'Data penggiat narkotika berhasil ditambah.');
    }

    public function show($id)
    {
        $penggiat = PenggiatNarkotika::findOrFail($id);
        return view('super-admin.data.penggiat.show', compact('penggiat'));
    }

    public function edit($id)
    {
        $penggiat = PenggiatNarkotika::findOrFail($id);
        return view('super-admin.data.penggiat.edit', compact('penggiat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        $penggiat = PenggiatNarkotika::findOrFail($id);
        $penggiat->update($request->all());
        return redirect()->route('super-admin.data.penggiat.index')->with('success', 'Data penggiat narkotika berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penggiat = PenggiatNarkotika::findOrFail($id);
        $penggiat->delete();
        return redirect()->route('super-admin.data.penggiat.index')->with('success', 'Data penggiat narkotika berhasil dihapus.');
    }
}
