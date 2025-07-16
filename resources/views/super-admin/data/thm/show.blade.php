@extends('layouts.superadmin-master')

@section('title', 'Detail THM')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Tempat Hiburan Malam (THM)</h2>
        <div class="mb-4">
            <strong>Nama THM:</strong>
            <div class="text-gray-700">{{ $thm->nama_thm }}</div>
        </div>
        <div class="mb-4">
            <strong>Ketua THM:</strong>
            <div class="text-gray-700">{{ $thm->ketua_thm }}</div>
        </div>
        <div class="mb-4">
            <strong>No. HP Ketua:</strong>
            <div class="text-gray-700">{{ $thm->no_hp_ketua }}</div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.thm.edit', $thm->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.thm.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection 