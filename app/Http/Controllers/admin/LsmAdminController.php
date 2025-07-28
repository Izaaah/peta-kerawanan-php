<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LsmNarkotika;
use App\Services\DuplicateDetectionService;
use Spatie\SimpleExcel\SimpleExcelReader;

class LsmAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = LsmNarkotika::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_lsm', 'like', "%$q%")
                    ->orWhere('ketua_lsm', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->orWhere('no_hp_ketua', 'like', "%$q%");
            });
        }
        $lsmList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.lsm.index', compact('lsmList'));
    }

    public function create()
    {
        return view('admin.data.lsm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lsm' => 'required|string|max:255',
            'ketua_lsm' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp_ketua' => 'required|string|max:20',
        ]);

        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'lsm_narkotika',
            $data,
            $request->user()->id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        try {
            LsmNarkotika::create($data);
            return redirect()->route('admin.data.lsm.index')->with('success', 'Data LSM berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function show($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        return view('admin.data.lsm.show', compact('lsm'));
    }

    public function edit($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        return view('admin.data.lsm.edit', compact('lsm'));
    }

    public function update(Request $request, $id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        $oldData = $lsm->toArray();
        $newData = $request->only(['nama_lsm', 'ketua_lsm', 'alamat', 'no_hp_ketua']);
        $newData['created_by'] = $request->user()->id;

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'lsm_narkotika',
            $newData,
            $request->user()->id,
            $id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Perubahan akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        try {
            $lsm->update($newData);
            return redirect()->route('admin.data.lsm.index')->with('success', 'Data LSM berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.')->withInput();
        }
    }

    public function destroy($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        $lsm->delete();
        return redirect()->route('admin.data.lsm.index')->with('success', 'Data LSM berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        $rows = SimpleExcelReader::create($request->file('file'))->getRows();

        foreach ($rows as $row) {
            $data = [
                'nama_lsm' => $row['nama_lsm'],
                'ketua_lsm' => $row['ketua_lsm'],
                'alamat' => $row['alamat'],
                'no_hp_ketua' => $row['no_hp_ketua'],
                'created_by' => $request->user()->id,
            ];

            // Check for duplicates
            $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                'lsm_narkotika',
                $data,
                $request->user()->id
            );

            if (!$isDuplicate) {
                LsmNarkotika::create($data);
            }
        }

        return back()->with('success', 'Data berhasil diimport! Data duplikat akan diverifikasi.');
    }
}
