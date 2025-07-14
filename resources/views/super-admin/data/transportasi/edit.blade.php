@extends('layouts.superadmin-master')

@section('title', 'Edit Data Transportasi')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Edit Data Transportasi</h2>
        <a href="{{ route('super-admin.data.transportasi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded shadow p-6">
        <form action="{{ route('super-admin.data.transportasi.update', $transportasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="jenis_transportasi" class="block text-sm font-medium text-gray-700 mb-2">Jenis Transportasi *</label>
                    <select name="jenis_transportasi" id="jenis_transportasi" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Jenis Transportasi</option>
                        @foreach($jenisTransportasiOptions as $value => $label)
                        <option value="{{ $value }}" {{ old('jenis_transportasi', $transportasi->jenis_transportasi) == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('jenis_transportasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_pihak" class="block text-sm font-medium text-gray-700 mb-2">Nama Pihak *</label>
                    <input type="text" name="nama_pihak" id="nama_pihak" value="{{ old('nama_pihak', $transportasi->nama_pihak) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_pihak')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="posisi" class="block text-sm font-medium text-gray-700 mb-2">Posisi</label>
                    <input type="text" name="posisi" id="posisi" value="{{ old('posisi', $transportasi->posisi) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('posisi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $transportasi->no_hp) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('no_hp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                    <textarea name="lokasi" id="lokasi" rows="3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('lokasi', $transportasi->lokasi) }}</textarea>
                    @error('lokasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('super-admin.data.transportasi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection