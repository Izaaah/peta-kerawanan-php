@extends('layouts.superadmin-master')

@section('content')
<div class="mx-auto px-4 py-3">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Data Penggiat Narkotika</h2>
        <form action="{{ route('super-admin.data.penggiat.update', $penggiat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $penggiat->nama) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                @error('nama')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Alamat</label>
                <textarea name="alamat" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('alamat', $penggiat->alamat) }}</textarea>
                @error('alamat')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $penggiat->no_hp) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                @error('no_hp')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('super-admin.data.penggiat.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
