<?php

namespace App\Http\Controllers\admin;

use App\Models\Medsos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class MedsosAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Medsos::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_media_sosial', 'like', "%$q%")
                    ->orWhere('nama_akun', 'like', "%$q%")
                    ->orWhere('link_akun', 'like', "%$q%");
            });
        }
        $medsosList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.medsos.index', compact('medsosList'));
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
        unset($data['nama_media_sosial_lainnya']);

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'medsos',
            $data,
            $request->user()->id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        Medsos::create($data);
        return redirect()->route('admin.data.medsos.index')->with('success', 'Data medsos berhasil disimpan.');
    }

    public function show($id)
    {
        $medsos = Medsos::findOrFail($id);
        return view('admin.data.medsos.show', compact('medsos'));
    }

    public function edit($id)
    {
        $medsos = Medsos::findOrFail($id);
        return view('admin.data.medsos.edit', compact('medsos'));
    }

    public function update(Request $request, $id)
    {
        $medsos = Medsos::findOrFail($id);
        
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
        unset($data['nama_media_sosial_lainnya']);

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'medsos',
            $data,
            $request->user()->id,
            $id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Perubahan akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        $medsos->update($data);
        return redirect()->route('admin.data.medsos.index')->with('success', 'Data medsos berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $medsos = Medsos::findOrFail($id);
        $medsos->delete();
        return redirect()->route('admin.data.medsos.index')->with('success', 'Data medsos berhasil dihapus.');
    }
}
