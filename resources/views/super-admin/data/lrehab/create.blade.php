@extends('layouts.superadmin-master')

@section('title', 'Tambah Lembaga Rehabilitasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Lembaga Rehabilitasi</h1>
            <p class="text-sm text-gray-500">Form untuk input data lembaga rehabilitasi</p>
        </div>
        <a href="{{ route('super-admin.data.lrehab.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            <form action="{{ route('super-admin.data.lrehab.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-hospital-user mr-2"></i>Data Lembaga Rehabilitasi</h6>
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis <span class="text-red-500">*</span></label>
                        <select id="jenis" name="jenis" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenisOptions as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <button type="reset" class="px-6 py-2 text-gray-800 bg-gray-200 rounded hover:bg-gray-300">
                        <i class="fas fa-undo mr-2"></i>Reset
                    </button>
                </div>
            </form>
        </div>
        <div class="order-1 lg:order-2">
            <div class="bg-white shadow rounded p-4 space-y-4">
                <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-400">
                    <h6 class="font-semibold text-blue-700 mb-2"><i class="fas fa-info-circle mr-2"></i>Informasi</h6>
                    <ul class="list-disc list-inside text-sm text-blue-800 space-y-1">
                        <li>Pastikan semua data lembaga rehabilitasi yang diinput sudah benar</li>
                        <li>Pilih jenis lembaga sesuai kategori yang tersedia</li>
                        <li>Data digunakan untuk keperluan verifikasi dan pelaporan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 