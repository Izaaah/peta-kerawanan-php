@extends('layouts.superadmin-master')

@section('title', 'Detail Titik Masuk')

@section('content')
<div class="mx-auto px-4 py-3">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Titik Masuk</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-4">
            <strong>Jenis Transportasi:</strong>
            <div class="text-gray-700">{{ $jalurMasuk->jenis_transportasi }}</div>
        </div>
        <div class="mb-4">
            <strong>Nama Tempat:</strong>
            <div class="text-gray-700">{{ $jalurMasuk->nama_tempat }}</div>
        </div>
        <div class="mb-4">
            <strong>Nama Tempat:</strong>
            <div class="text-gray-700">{{ $jalurMasuk->nama_tempat }}</div>
        </div>
        <div class="mb-4">
            <strong>Provinsi:</strong>
            <div class="text-gray-700">{{ $jalurMasuk->provinsi }}</div>
        </div>
        <div class="mb-4">
            <strong>Kabupaten/Kota:</strong>
            <div class="text-gray-700">{{ $jalurMasuk->kabupaten }}</div>
        </div>
        <div class="mb-4">
            <strong>Kecamatan:</strong>
            <div class="text-gray-700">{{ $jalurMasuk->kecamatan }}</div>
        </div>
        <div class="mb-4">
            <strong>Desa/Kelurahan:</strong>
                <div class="text-gray-700">{{ $jalurMasuk->kelurahan }}</div>
            </div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.titik-masuk.edit', $jalurMasuk->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.titik-masuk.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
