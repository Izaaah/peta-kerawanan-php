<?php

namespace App\Http\Controllers\admin;

use App\Models\JalurMasuk;
use App\Models\DesaGeojson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TitikMasukAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = JalurMasuk::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('jenis_transportasi', 'like', "%$q%")
                    ->orWhere('nama_tempat', 'like', "%$q%")
                    ->orWhere('provinsi', 'like', "%$q%")
                    ->orWhere('kabupaten', 'like', "%$q%")
                    ->orWhere('kecamatan', 'like', "%$q%")
                    ->orWhere('kelurahan', 'like', "%$q%");
            });
        }
        $titikMasukList = $query->latest()->paginate(10)->withQueryString();
            return view('admin.data.titik-masuk.index', compact('titikMasukList'));
    }

    public function create()
    {
        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();
        $desaList = DesaGeojson::all();

        $jenisTitikMasukOptions = JalurMasuk::getJenisTitikMasukOptions();
        return view('admin.data.titik-masuk.create', compact('jenisTitikMasukOptions', 'kabupatenList', 'kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_tempat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        try {
            JalurMasuk::create($request->all());
            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $jalurMasuk = JalurMasuk::findOrFail($id);
        return view('admin.data.titik-masuk.show', compact('jalurMasuk'));
    }

    public function edit($id)
    {
        $jalurMasuk = JalurMasuk::findOrFail($id);
        $jenisTitikMasukOptions = JalurMasuk::getJenisTitikMasukOptions();
        return view('admin.data.titik-masuk.edit', compact('jalurMasuk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_tempat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        try {
            $jalurMasuk = JalurMasuk::findOrFail($id);
            $jalurMasuk->update($request->all());

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $jalurMasuk = JalurMasuk::findOrFail($id);
            $jalurMasuk->delete();

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
