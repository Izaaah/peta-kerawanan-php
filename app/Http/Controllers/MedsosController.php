<?php

namespace App\Http\Controllers;

use App\Models\Medsos;
use Illuminate\Http\Request;

class MedsosController extends Controller
{
    public function index(Request $request)
    {
        $query = Medsos::with('individu', 'user');
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_media_sosial', 'like', "%$q%")
                    ->orWhere('nama_akun', 'like', "%$q%")
                    ->orWhere('link_akun', 'like', "%$q%")
                    ->orWhere('jenis_akun', 'like', "%$q%");
            });
        }
        $medsosList = $query->latest()->paginate(10)->withQueryString();
        return view('super-admin.data.medsos.index', compact('medsosList'));
    }

    public function create()
    {
        return view('super-admin.data.medsos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_media_sosial' => 'required|string|max:255',
            'nama_media_sosial_lainnya' => 'nullable|string|max:255',
            'jenis_akun' => 'required|in:personal,kelompok',
            'individu_id' => 'nullable|exists:data_individu_tsk,id',
            'nama_akun' => 'required|string|max:255',
            'link_akun' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Handle "Lainnya" option
        if ($data['nama_media_sosial'] === 'Lainnya') {
            if (empty($data['nama_media_sosial_lainnya'])) {
                return redirect()->back()
                    ->withErrors(['nama_media_sosial_lainnya' => 'Nama media sosial harus diisi jika memilih "Lainnya"'])
                    ->withInput();
            }
            $data['nama_media_sosial'] = $data['nama_media_sosial_lainnya'];
        }

        // Handle "Personal" jenis akun validation
        if ($data['jenis_akun'] === 'personal' && empty($data['individu_id'])) {
            return redirect()->back()
                ->withErrors(['individu_id' => 'Profil individu harus dipilih untuk akun personal'])
                ->withInput();
        }

        unset($data['nama_media_sosial_lainnya']);
        unset($data['search_nik']);

        Medsos::create($data);
        return redirect()->route('super-admin.data.medsos.index')->with('success', 'Data medsos berhasil ditambah.');
    }

    public function show($id)
    {
        $medsos = Medsos::with('individu', 'user')->findOrFail($id);
        return view('super-admin.data.medsos.show', compact('medsos'));
    }

    public function edit($id)
    {
        $medsos = Medsos::with('individu', 'user')->findOrFail($id);
        return view('super-admin.data.medsos.edit', compact('medsos'));
    }

    public function update(Request $request, $id)
    {
        $medsos = Medsos::findOrFail($id);

        $request->validate([
            'nama_media_sosial' => 'required|string|max:255',
            'nama_media_sosial_lainnya' => 'nullable|string|max:255',
            'jenis_akun' => 'required|in:personal,kelompok',
            'individu_id' => 'nullable|exists:data_individu_tsk,id',
            'nama_akun' => 'required|string|max:255',
            'link_akun' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Handle "Lainnya" option
        if ($data['nama_media_sosial'] === 'Lainnya') {
            if (empty($data['nama_media_sosial_lainnya'])) {
                return redirect()->back()
                    ->withErrors(['nama_media_sosial_lainnya' => 'Nama media sosial harus diisi jika memilih "Lainnya"'])
                    ->withInput();
            }
            $data['nama_media_sosial'] = $data['nama_media_sosial_lainnya'];
        }

        // Handle "Personal" jenis akun validation
        if ($data['jenis_akun'] === 'personal' && empty($data['individu_id'])) {
            return redirect()->back()
                ->withErrors(['individu_id' => 'Profil individu harus dipilih untuk akun personal'])
                ->withInput();
        }

        unset($data['nama_media_sosial_lainnya']);
        unset($data['search_nik']);

        $medsos->update($data);
        return redirect()->route('super-admin.data.medsos.index')->with('success', 'Data medsos berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $medsos = Medsos::findOrFail($id);
        $medsos->delete();
        return redirect()->route('super-admin.data.medsos.index')->with('success', 'Data medsos berhasil dihapus.');
    }
}
