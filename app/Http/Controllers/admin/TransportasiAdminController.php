<?php

namespace App\Http\Controllers\admin;

use App\Models\Transportasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportasiAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Transportasi::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('jenis_transportasi', 'like', "%$q%")
                    ->orWhere('nama_pihak', 'like', "%$q%")
                    ->orWhere('posisi', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $transportasiList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.transportasi.index', compact('transportasiList'));
    }

    public function create()
    {
        $jenisTransportasiOptions = Transportasi::getJenisTransportasiOptions();
        return view('admin.data.transportasi.create', compact('jenisTransportasiOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_pihak' => 'required|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            Transportasi::create($data);
            return redirect()->route('admin.data.transportasi.index')
                ->with('success', 'Data transportasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        return view('admin.data.transportasi.show', compact('transportasi'));
    }

    public function edit($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        $jenisTransportasiOptions = Transportasi::getJenisTransportasiOptions();
        return view('admin.data.transportasi.edit', compact('transportasi', 'jenisTransportasiOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_pihak' => 'required|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            $transportasi = Transportasi::findOrFail($id);
            $transportasi->update($request->all());

            return redirect()->route('admin.data.transportasi.index')
                ->with('success', 'Data transportasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $transportasi = Transportasi::findOrFail($id);
            $transportasi->delete();

            return redirect()->route('admin.data.transportasi.index')
                ->with('success', 'Data transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
