@extends('layouts.superadmin-master')
@section('title', 'Tambah Perusahaan Farmasi/Prekursor')
@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Tambah Perusahaan Farmasi/Prekursor</h2>
        <form action="{{ route('super-admin.data.farmasi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Jenis</label>
                <select name="jenis" class="w-full border-gray-300 rounded px-3 py-2" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Perusahaan">Perusahaan</option>
                    <option value="Farmasi">Farmasi</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Manager</label>
                <input type="text" name="manager" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Lokasi</label>
                <textarea name="lokasi" class="w-full border-gray-300 rounded px-3 py-2" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">No. HP</label>
                <input type="text" name="no_hp" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Prekusor</label>
                <textarea name="prekusor" class="w-full border-gray-300 rounded px-3 py-2" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Ijin Penerbit</label>
                <textarea name="ijin_penerbit" class="w-full border-gray-300 rounded px-3 py-2" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Jumlah</label>
                <input type="text" name="jumlah" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Tujuan</label>
                <textarea name="tujuan" class="w-full border-gray-300 rounded px-3 py-2" required></textarea>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('super-admin.data.farmasi.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
