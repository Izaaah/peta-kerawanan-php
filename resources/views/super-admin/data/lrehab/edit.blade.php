@extends('layouts.superadmin-master')

@section('content')
<div class="mx-auto px-4 py-3">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Data Lembaga Rehabilitasi</h2>
        <form action="{{ route('super-admin.data.lrehab.update', $lrehab->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $lrehab->nama) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Jenis</label>
                <select name="jenis" class="w-full border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenisOptions as $jenis)
                        <option value="{{ $jenis }}" {{ (old('jenis', $lrehab->jenis) == $jenis) ? 'selected' : '' }}>{{ $jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('super-admin.data.lrehab.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
