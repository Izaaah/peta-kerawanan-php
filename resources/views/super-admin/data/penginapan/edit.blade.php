@extends('layouts.superadmin-master')

@section('title', 'Edit Penginapan')

@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Edit Data Penginapan</h2>
        <a href="{{ route('super-admin.data.penginapan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="bg-white rounded shadow p-6">
        <form action="{{ route('super-admin.data.penginapan.update', $penginapan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Penginapan *</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $penginapan->nama) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis *</label>
                    <select name="jenis" id="jenis" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($jenisOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('jenis', $penginapan->jenis) == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('jenis')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nama_pengelola" class="block text-sm font-medium text-gray-700 mb-2">Nama Pengelola *</label>
                    <input type="text" name="nama_pengelola" id="nama_pengelola" value="{{ old('nama_pengelola', $penginapan->nama_pengelola) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_pengelola')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $penginapan->no_hp) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('no_hp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                    <textarea name="lokasi" id="lokasi" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('lokasi', $penginapan->lokasi) }}</textarea>
                    @error('lokasi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('super-admin.data.penginapan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
