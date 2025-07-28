<?php

namespace App\Http\Controllers\admin;

use App\Models\Thm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class ThmAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Thm::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_thm', 'like', "%$q%")
                    ->orWhere('ketua_thm', 'like', "%$q%")
                    ->orWhere('no_hp_ketua', 'like', "%$q%");
            });
        }
        $thmList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.thm.index', compact('thmList'));
    }

    public function create()
    {
        return view('admin.data.thm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_thm' => 'required|string|max:255',
            'ketua_thm' => 'required|string|max:255',
            'no_hp_ketua' => 'required|string|max:20',
        ]);
        
        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'thm',
            $data,
            $request->user()->id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        Thm::create($data);
        return redirect()->route('admin.data.thm.index')->with('success', 'Data THM berhasil disimpan.');
    }

    public function show($id)
    {
        $thm = Thm::findOrFail($id);
        return view('admin.data.thm.show', compact('thm'));
    }

    public function edit($id)
    {
        $thm = Thm::findOrFail($id);
        return view('admin.data.thm.edit', compact('thm'));
    }

    public function update(Request $request, $id)
    {
        $thm = Thm::findOrFail($id);
        
        $request->validate([
            'nama_thm' => 'required|string|max:255',
            'ketua_thm' => 'required|string|max:255',
            'no_hp_ketua' => 'required|string|max:20',
        ]);
        
        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'thm',
            $data,
            $request->user()->id,
            $id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Perubahan akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        $thm->update($data);
        return redirect()->route('admin.data.thm.index')->with('success', 'Data THM berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $thm = Thm::findOrFail($id);
        $thm->delete();
        return redirect()->route('admin.data.thm.index')->with('success', 'Data THM berhasil dihapus.');
    }
}
