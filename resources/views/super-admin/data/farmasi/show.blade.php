@extends('layouts.superadmin-master')
@section('title', 'Detail Perusahaan Farmasi/Prekursor')
@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Perusahaan Farmasi/Prekursor</h2>
        <div class="mb-4"><strong>Jenis:</strong> <div class="text-gray-700">{{ $farmasi->jenis }}</div></div>
        <div class="mb-4"><strong>Nama:</strong> <div class="text-gray-700">{{ $farmasi->nama }}</div></div>
        <div class="mb-4"><strong>Manager:</strong> <div class="text-gray-700">{{ $farmasi->manager }}</div></div>
        <div class="mb-4"><strong>Lokasi:</strong> <div class="text-gray-700">{{ $farmasi->lokasi }}</div></div>
        <div class="mb-4"><strong>No. HP:</strong> <div class="text-gray-700">{{ $farmasi->no_hp }}</div></div>
        <div class="mb-4"><strong>Prekusor:</strong> <div class="text-gray-700">{{ $farmasi->prekusor }}</div></div>
        <div class="mb-4"><strong>Ijin Penerbit:</strong> <div class="text-gray-700">{{ $farmasi->ijin_penerbit }}</div></div>
        <div class="mb-4"><strong>Jumlah:</strong> <div class="text-gray-700">{{ $farmasi->jumlah }}</div></div>
        <div class="mb-4"><strong>Tujuan:</strong> <div class="text-gray-700">{{ $farmasi->tujuan }}</div></div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.farmasi.edit', $farmasi->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.farmasi.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
