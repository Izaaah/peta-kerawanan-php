<?php

namespace App\Http\Controllers;

use App\Models\Thm;
use Illuminate\Http\Request;

class ThmController extends Controller
{
    public function index(Request $request)
    {
        $query = Thm::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_thm', 'like', "%$q%")
                    ->orWhere('ketua_thm', 'like', "%$q%")
                    ->orWhere('no_hp_ketua', 'like', "%$q%");
            });
        }
        $thmList = $query->latest()->paginate(10)->withQueryString();
        return view('super-admin.data.thm.index', compact('thmList'));
    }

    public function create()
    {
        return view('super-admin.data.thm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_thm' => 'required|string|max:255',
            'ketua_thm' => 'required|string|max:255',
            'no_hp_ketua' => 'required|string|max:20',
        ]);
        Thm::create($request->all());
        return redirect()->route('super-admin.data.thm.index')->with('success', 'Data THM berhasil ditambah.');
    }

    public function show($id)
    {
        $thm = Thm::findOrFail($id);
        return view('super-admin.data.thm.show', compact('thm'));
    }

    public function edit($id)
    {
        $thm = Thm::findOrFail($id);
        return view('super-admin.data.thm.edit', compact('thm'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_thm' => 'required|string|max:255',
            'ketua_thm' => 'required|string|max:255',
            'no_hp_ketua' => 'required|string|max:20',
        ]);
        $thm = Thm::findOrFail($id);
        $thm->update($request->all());
        return redirect()->route('super-admin.data.thm.index')->with('success', 'Data THM berhasil diupdate.');
    }
} 