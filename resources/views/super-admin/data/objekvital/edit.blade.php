@extends('layouts.superadmin-master')

@section('content')
<div class="mx-auto px-4 py-3">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Data Objek Vital</h2>
        <form action="{{ route('super-admin.data.objekvital.update', $objekVital->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Objek</label>
                <input type="text" name="nama_objek" value="{{ old('nama_objek', $objekVital->nama_objek) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Manager</label>
                <input type="text" name="nama_manager" value="{{ old('nama_manager', $objekVital->nama_manager) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Lokasi</label>
                <textarea name="lokasi" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('lokasi', $objekVital->lokasi) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $objekVital->no_hp) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('super-admin.data.objekvital.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
