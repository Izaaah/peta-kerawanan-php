<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JalurTransportasi;
use App\Models\JalurMasuk;
use Illuminate\Http\Request;

class JalurTransportasiAdminController extends Controller
{
    public function index()
    {
        $jalurTransportasi = JalurTransportasi::with(['titikAwal', 'titikTujuan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.data.jalur-transportasi.index', compact('jalurTransportasi'));
    }

    public function create()
    {
        $titikMasukList = JalurMasuk::orderBy('nama_tempat')->get();
        $jenisTransportasiOptions = JalurTransportasi::getJenisTransportasiOptions();
        $statusOptions = JalurTransportasi::getStatusOptions();
        
        return view('admin.data.jalur-transportasi.create', compact(
            'titikMasukList', 
            'jenisTransportasiOptions', 
            'statusOptions'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'titik_awal_id' => 'required|exists:jalur_masuk,id',
            'titik_tujuan_id' => 'required|exists:jalur_masuk,id|different:titik_awal_id',
            'jenis_transportasi' => 'required|in:kereta,bus,pesawat,kapal,mobil,motor',
            'estimasi_waktu' => 'required|integer|min:1',
            'jarak_km' => 'required|numeric|min:0.01',
            'status' => 'required|in:aktif,nonaktif,maintenance',
            'keterangan' => 'nullable|string',
        ]);

        try {
            JalurTransportasi::create($request->all());
            return redirect()->route('admin.data.jalur-transportasi.index')
                ->with('success', 'Jalur transportasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $jalurTransportasi = JalurTransportasi::with(['titikAwal', 'titikTujuan'])->findOrFail($id);
        return view('admin.data.jalur-transportasi.show', compact('jalurTransportasi'));
    }

    public function edit($id)
    {
        $jalurTransportasi = JalurTransportasi::findOrFail($id);
        $titikMasukList = JalurMasuk::orderBy('nama_tempat')->get();
        $jenisTransportasiOptions = JalurTransportasi::getJenisTransportasiOptions();
        $statusOptions = JalurTransportasi::getStatusOptions();
        
        return view('admin.data.jalur-transportasi.edit', compact(
            'jalurTransportasi',
            'titikMasukList', 
            'jenisTransportasiOptions', 
            'statusOptions'
        ));
    }

    public function update(Request $request, $id)
    {
        $jalurTransportasi = JalurTransportasi::findOrFail($id);
        
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'titik_awal_id' => 'required|exists:jalur_masuk,id',
            'titik_tujuan_id' => 'required|exists:jalur_masuk,id|different:titik_awal_id',
            'jenis_transportasi' => 'required|in:kereta,bus,pesawat,kapal,mobil,motor',
            'estimasi_waktu' => 'required|integer|min:1',
            'jarak_km' => 'required|numeric|min:0.01',
            'status' => 'required|in:aktif,nonaktif,maintenance',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $jalurTransportasi->update($request->all());
            return redirect()->route('admin.data.jalur-transportasi.index')
                ->with('success', 'Jalur transportasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $jalurTransportasi = JalurTransportasi::findOrFail($id);
            $jalurTransportasi->delete();
            return redirect()->route('admin.data.jalur-transportasi.index')
                ->with('success', 'Jalur transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}