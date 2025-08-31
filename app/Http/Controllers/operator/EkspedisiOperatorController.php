<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EkspedisiOperatorController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Ekspedisi::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        $query = Ekspedisi::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('manager', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%")
                    ->orWhere('jenis', 'like', "%$q%");
            });
        }
        // $ekspedisiList = $query->latest()->paginate(10)->withQueryString();
        $ekspedisiList = Ekspedisi::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('operator.data.ekspedisi.index', compact('ekspedisiList'));
    }

    public function create()
    {
        $jenisOptions = Ekspedisi::getJenisOptions();
        return view('operator.data.ekspedisi.create', compact('jenisOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jenis' => 'required|in:Asperindo,Non Asperindo',
        ]);
        Ekspedisi::create($data);
        return redirect()->route('operator.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil disimpan.');
    }

    public function show($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        return view('operator.data.ekspedisi.show', compact('ekspedisi'));
    }

    public function edit($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $jenisOptions = Ekspedisi::getJenisOptions();
        return view('operator.data.ekspedisi.edit', compact('ekspedisi', 'jenisOptions'));
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
        return redirect()->route('operator.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->delete();
        return redirect()->route('operator.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil dihapus.');
    }
}
