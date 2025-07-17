@extends('layouts.admin-master')

@section('title', 'Edit Penjual Vape')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Penjual Vape</h2>
        <form action="{{ route('admin.data.vape.update', $vape->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Toko</label>
                <input type="text" name="nama_toko" value="{{ old('nama_toko', $vape->nama_toko) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Pemilik</label>
                <input type="text" name="pemilik" value="{{ old('pemilik', $vape->pemilik) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Lokasi</label>
                <textarea name="lokasi" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('lokasi', $vape->lokasi) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $vape->no_hp) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Liquid Dicurigai</label>
                <textarea name="liquid_dicurigai" class="w-full border-gray-300 rounded px-3 py-2">{{ old('liquid_dicurigai', $vape->liquid_dicurigai) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Distributor</label>
                <textarea name="distributor" class="w-full border-gray-300 rounded px-3 py-2">{{ old('distributor', $vape->distributor) }}</textarea>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.data.vape.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
