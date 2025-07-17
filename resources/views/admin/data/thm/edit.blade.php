@extends('layouts.admin-master')

@section('title', 'Edit THM')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Data Tempat Hiburan Malam (THM)</h2>
        <form action="{{ route('admin.data.thm.update', $thm->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama THM</label>
                <input type="text" name="nama_thm" value="{{ old('nama_thm', $thm->nama_thm) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                @error('nama_thm')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Ketua THM</label>
                <input type="text" name="ketua_thm" value="{{ old('ketua_thm', $thm->ketua_thm) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                @error('ketua_thm')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">No HP Ketua</label>
                <input type="text" name="no_hp_ketua" value="{{ old('no_hp_ketua', $thm->no_hp_ketua) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                @error('no_hp_ketua')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.data.thm.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
