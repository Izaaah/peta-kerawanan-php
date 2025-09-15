<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $jabatanList = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Divisi Humas', 'Divisi Keuangan', 'Divisi Acara', 'Anggota'];

        $q = Pegawai::query();
        if ($request->filled('filter_jabatan')) {
            $q->where('jabatan', $request->get('filter_jabatan'));
        }
        $pegawai = $q->orderBy('jabatan')->orderBy('nama')->get();

        $struktur = [
            'name' => 'Kepala BNNP Jatim',
            'children' => $pegawai->where('jabatan', 'Kabid Pemberantasan')->map(function ($item) {
                return [
                    'name' => $item->nama,
                    'children' => $item->children()->map(function ($child) {
                        return ['name' => $child->nama];
                    })->toArray()
                ];
            })->toArray(),
        ];

        return view('super-admin.dashboard', compact('pegawai', 'jabatanList', 'struktur'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|array|min:1',
            'nama.*' => 'required|string|max:255',
        ]);

        foreach ($data['nama'] as $n) {
            Pegawai::create(['nama' => $n, 'jabatan' => $data['jabatan']]);
        }
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);
        $pegawai->update($data);
        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
