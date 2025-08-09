@extends('layouts.superadmin-master')

@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail LSM Narkotika</h2>
        <div class="mb-4">
            <strong>Nama LSM:</strong>
            <div class="text-gray-700">{{ $lsm->nama_lsm }}</div>
        </div>
        <div class="mb-4">
            <strong>Ketua LSM:</strong>
            <div class="text-gray-700">{{ $lsm->ketua_lsm }}</div>
        </div>
        <div class="mb-4">
            <strong>No. HP Ketua:</strong>
            <div class="text-gray-700">{{ $lsm->no_hp_ketua }}</div>
        </div>
        <div class="mb-4">
            <strong>Alamat:</strong>
            <div class="text-gray-700">{{ $lsm->alamat }}</div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.lsm.edit', $lsm->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.lsm.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
