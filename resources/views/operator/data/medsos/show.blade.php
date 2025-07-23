@extends('layouts.operator')

@section('title', 'Detail Akun Media Sosial')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Akun Media Sosial</h2>
        <div class="mb-4">
            <strong>Nama Media Sosial:</strong>
            <div class="text-gray-700">{{ $medsos->nama_media_sosial }}</div>
        </div>
        <div class="mb-4">
            <strong>Nama Akun:</strong>
            <div class="text-gray-700">{{ $medsos->nama_akun }}</div>
        </div>
        <div class="mb-4">
            <strong>Link Akun:</strong>
            <div class="text-gray-700">
                <a href="{{ $medsos->link_akun }}" class="text-blue-600 underline" target="_blank">{{ $medsos->link_akun }}</a>
            </div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.medsos.edit', $medsos->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.medsos.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection