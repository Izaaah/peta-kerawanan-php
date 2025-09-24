@extends('layouts.admin-master')

@section('content')
<div class="mx-auto px-4 py-3">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Data LSM Narkotika</h2>
        <form action="{{ route('admin.data.lsm.update', $lsm->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama LSM</label>
                <input type="text" name="nama_lsm" value="{{ old('nama_lsm', $lsm->nama_lsm) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Ketua LSM</label>
                <input type="text" name="ketua_lsm" value="{{ old('ketua_lsm', $lsm->ketua_lsm) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">No. HP Ketua</label>
                <input type="text" name="no_hp_ketua" value="{{ old('no_hp_ketua', $lsm->no_hp_ketua) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Alamat</label>
                <textarea name="alamat" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('alamat', $lsm->alamat) }}</textarea>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.data.lsm.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
