<?php

namespace App\Http\Controllers\operator;

use App\Models\JaringanRutanLapas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class JaringanRutanLapasOperatorController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = JaringanRutanLapas::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        $query = JaringanRutanLapas::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_napi', 'like', "%$q%")
                    ->orWhere('jenis_napi', 'like', "%$q%")
                    ->orWhere('lapas', 'like', "%$q%")
                    ->orWhere('status_proses', 'like', "%$q%");
            });
        }
        $rutanlapasList = $query->latest()->paginate(10)->withQueryString();
        return view('operator.data.rutanlapas.index', compact('rutanlapasList'));
    }

    public function create()
    {
        $jenisNapiOptions = JaringanRutanLapas::getJenisNapiOptions();
        $statusProsesOptions = JaringanRutanLapas::getStatusProsesOptions();
        return view('operator.data.rutanlapas.create', compact('jenisNapiOptions', 'statusProsesOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama_napi' => 'required|string|max:255',
            'jenis_napi' => 'required|in:Napi Narkotika,Napi Non Narkotika',
            'lapas' => 'required|string|max:255',
            'lokasi_lapas' => 'required|string',
            'peran_dalam_jaringan' => 'nullable|string|max:255',
            'status_proses' => 'required|in:Ditahan,Bebas,Dalam proses,Tidak diketahui',
            'keterangan' => 'nullable|string',
        ]);
        JaringanRutanLapas::create($data);
        return redirect()->route('operator.data.rutanlapas.index')->with('success', 'Data jaringan rutan/lapas berhasil disimpan.');
    }

    public function show($id)
    {
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        return view('operator.data.rutanlapas.show', compact('rutanlapas'));
    }

    public function edit($id)
    {
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        $jenisNapiOptions = JaringanRutanLapas::getJenisNapiOptions();
        $statusProsesOptions = JaringanRutanLapas::getStatusProsesOptions();
        return view('operator.data.rutanlapas.edit', compact('rutanlapas', 'jenisNapiOptions', 'statusProsesOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_napi' => 'required|string|max:255',
            'jenis_napi' => 'required|in:Napi Narkotika,Napi Non Narkotika',
            'lapas' => 'required|string|max:255',
            'lokasi_lapas' => 'required|string',
            'peran_dalam_jaringan' => 'nullable|string|max:255',
            'status_proses' => 'required|in:Ditahan,Bebas,Dalam proses,Tidak diketahui',
            'keterangan' => 'nullable|string',
        ]);
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        $rutanlapas->update($request->all());
        return redirect()->route('operator.data.rutanlapas.index')->with('success', 'Data jaringan rutan/lapas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        $rutanlapas->delete();
        return redirect()->route('operator.data.rutanlapas.index')->with('success', 'Data jaringan rutan/lapas berhasil dihapus.');
    }
}
