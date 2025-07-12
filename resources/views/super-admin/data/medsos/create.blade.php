@extends('layouts.superadmin-master')

@section('title', 'Tambah Akun Media Sosial')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Tambah Akun Media Sosial</h2>
        <form action="{{ route('super-admin.data.medsos.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Media Sosial</label>
                <input type="text" name="nama_media_sosial" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Akun</label>
                <input type="text" name="nama_akun" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Link Akun</label>
                <input type="url" name="link_akun" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('super-admin.data.medsos.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
