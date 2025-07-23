<?php

namespace App\Http\Controllers\operator;

use App\Models\PerusahaanFarmasiPrekursor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PerusahaanFarmasiPrekursorOperatorController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = PerusahaanFarmasiPrekursor::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }

        $query = PerusahaanFarmasiPrekursor::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('jenis', 'like', "%$q%")
                    ->orWhere('nama', 'like', "%$q%")
                    ->orWhere('manager', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%")
                    ->orWhere('prekusor', 'like', "%$q%")
                    ->orWhere('tujuan', 'like', "%$q%");
            });
        }
        $farmasiList = $query->latest()->paginate(10)->withQueryString();
        return view('operator.data.farmasi.index', compact('farmasiList'));
    }

    public function create()
    {
        return view('operator.data.farmasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Perusahaan,Farmasi',
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'prekusor' => 'required|string',
            'ijin_penerbit' => 'required|string',
            'jumlah' => 'required|string',
            'tujuan' => 'required|string',
        ]);
        PerusahaanFarmasiPrekursor::create($request->all());
        return redirect()->route('operator.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil ditambah.');
    }

    public function show($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        return view('operator.data.farmasi.show', compact('farmasi'));
    }

    public function edit($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        return view('operator.data.farmasi.edit', compact('farmasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:Perusahaan,Farmasi',
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'prekusor' => 'required|string',
            'ijin_penerbit' => 'required|string',
            'jumlah' => 'required|string',
            'tujuan' => 'required|string',
        ]);
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        $farmasi->update($request->all());
        return redirect()->route('operator.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        $farmasi->delete();
        return redirect()->route('operator.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil dihapus.');
    }
}
