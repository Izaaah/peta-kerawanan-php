<?php

namespace App\Http\Controllers;

use App\Models\Thm;
use Illuminate\Http\Request;

class ThmController extends Controller
{
    public function index()
    {
        $thmList = Thm::latest()->paginate(10);
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