<?php

namespace App\Http\Controllers\operator;

use App\Models\LembagaRehabilitasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LembagaRehabilitasiOperatorController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = LembagaRehabilitasi::query();
        if (!$user->isOperator()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_objek', 'like', "%$q%")
                    ->orWhere('nama_manager', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $sampleData = LembagaRehabilitasi::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('operator.data.lrehab.index', compact('lrehabList'));
    }

    public function create()
    {
        $jenisOptions = LembagaRehabilitasi::getJenisOptions();
        return view('operator.data.lrehab.create', compact('jenisOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:IPWL,Rawat Inap,Non Rawat Inap,SNI Nasional,SNI Reguler',
        ]);
        LembagaRehabilitasi::create($data);
        return redirect()->route('operator.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil disimpan.');
    }

    public function show($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        return view('operator.data.lrehab.show', compact('lrehab'));
    }

    public function edit($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $jenisOptions = LembagaRehabilitasi::getJenisOptions();
        return view('operator.data.lrehab.edit', compact('lrehab', 'jenisOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:IPWL,Rawat Inap,Non Rawat Inap,SNI Nasional,SNI Reguler',
        ]);
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $lrehab->update($request->all());
        return redirect()->route('operator.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $lrehab->delete();
        return redirect()->route('operator.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil dihapus.');
    }
}
