<?php

namespace App\Http\Controllers\operator;

use App\Models\Thm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ThmOperatorController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Thm::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
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
        return view('operator.data.thm.index', compact('thmList'));
    }

    public function create()
    {
        return view('operator.data.thm.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama_thm' => 'required|string|max:255',
            'ketua_thm' => 'required|string|max:255',
            'no_hp_ketua' => 'required|string|max:20',
        ]);
        Thm::create($data);
        return redirect()->route('operator.data.thm.index')->with('success', 'Data THM berhasil disimpan.');
    }

    public function show($id)
    {
        $thm = Thm::findOrFail($id);
        return view('operator.data.thm.show', compact('thm'));
    }

    public function edit($id)
    {
        $thm = Thm::findOrFail($id);
        return view('operator.data.thm.edit', compact('thm'));
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
        return redirect()->route('operator.data.thm.index')->with('success', 'Data THM berhasil diupdate.');
    }
}
