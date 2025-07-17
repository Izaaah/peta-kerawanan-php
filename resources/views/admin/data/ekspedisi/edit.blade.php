@extends('layouts.admin-master')

@section('title', 'Edit Ekspedisi')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Edit Data Ekspedisi</h2>
        <a href="{{ route('admin.data.ekspedisi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="bg-white rounded shadow p-6">
        <form action="{{ route('admin.data.ekspedisi.update', $ekspedisi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Ekspedisi *</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $ekspedisi->nama) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="manager" class="block text-sm font-medium text-gray-700 mb-2">Manager *</label>
                    <input type="text" name="manager" id="manager" value="{{ old('manager', $ekspedisi->manager) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('manager')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $ekspedisi->no_hp) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('no_hp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis *</label>
                    <select name="jenis" id="jenis" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($jenisOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('jenis', $ekspedisi->jenis) == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('jenis')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                    <textarea name="alamat" id="alamat" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('alamat', $ekspedisi->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('admin.data.ekspedisi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
