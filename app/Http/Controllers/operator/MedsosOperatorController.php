<?php

namespace App\Http\Controllers\operator;

use App\Models\Medsos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MedsosOperatorController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Medsos::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        $query = Medsos::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_media_sosial', 'like', "%$q%")
                    ->orWhere('nama_akun', 'like', "%$q%")
                    ->orWhere('link_akun', 'like', "%$q%");
            });
        }
        $medsosList = Medsos::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('operator.data.medsos.index', compact('medsosList'));
    }

    public function create()
    {
        return view('admin.data.medsos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_media_sosial' => 'required|string|max:255',
            'nama_akun' => 'required|string|max:255',
            'link_akun' => 'nullable|string|max:255',
            'nama_media_sosial_lainnya' => 'required_if:nama_media_sosial,lainnya',
        ]);
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        if ($data['nama_media_sosial'] === 'lainnya') {
            $data['nama_media_sosial'] = $data['nama_media_sosial_lainnya'];
        }
        unset($data['nama_media_sosial_lainnya']); // pastikan field ini tidak ikut disimpan

        Medsos::create($data);
        return redirect()->route('operator.data.medsos.index')->with('success', 'Data medsos berhasil disimpan.');
    }

    public function show($id)
    {
        $medsos = Medsos::findOrFail($id);
        return view('operator.data.medsos.show', compact('medsos'));
    }

    public function edit($id)
    {
        $medsos = Medsos::findOrFail($id);
        return view('operator.data.medsos.edit', compact('medsos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_media_sosial' => 'required|string|max:255',
            'nama_akun' => 'required|string|max:255',
            'link_akun' => 'nullable|string|max:255',
        ]);
        $medsos = Medsos::findOrFail($id);
        $medsos->update($request->all());
        return redirect()->route('operator.data.medsos.index')->with('success', 'Akun medsos berhasil diupdate.');
    }

    public function destroy($id)
    {
        $medsos = Medsos::findOrFail($id);
        $medsos->delete();
        return redirect()->route('operator.data.medsos.index')->with('success', 'Akun medsos berhasil dihapus.');
    }
}
