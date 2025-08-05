@extends('layouts.admin-master')
@section('title', 'Edit Perusahaan Farmasi/Prekursor')
@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Perusahaan Farmasi/Prekursor</h2>
        <form action="{{ route('admin.data.farmasi.update', $farmasi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-semibold mb-1">Jenis</label>
                <select name="jenis" class="w-full border-gray-300 rounded px-3 py-2" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Perusahaan" {{ old('jenis', $farmasi->jenis) == 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                    <option value="Farmasi" {{ old('jenis', $farmasi->jenis) == 'Farmasi' ? 'selected' : '' }}>Farmasi</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $farmasi->nama) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Manager</label>
                <input type="text" name="manager" value="{{ old('manager', $farmasi->manager) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Lokasi</label>
                <textarea name="lokasi" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('lokasi', $farmasi->lokasi) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $farmasi->no_hp) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Prekusor</label>
                <textarea name="prekusor" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('prekusor', $farmasi->prekusor) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Ijin Penerbit</label>
                <textarea name="ijin_penerbit" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('ijin_penerbit', $farmasi->ijin_penerbit) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Jumlah</label>
                <input type="text" name="jumlah" value="{{ old('jumlah', $farmasi->jumlah) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Tujuan</label>
                <textarea name="tujuan" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('tujuan', $farmasi->tujuan) }}</textarea>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.data.farmasi.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
