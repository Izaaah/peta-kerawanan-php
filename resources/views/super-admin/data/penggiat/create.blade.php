@extends('layouts.superadmin-master')

@section('title', 'Tambah Penggiat Narkotika')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Penggiat Narkotika</h1>
            <p class="text-sm text-gray-500">Form untuk input data penggiat narkotika</p>
        </div>
        <a href="{{ route('super-admin.data.penggiat.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            <form action="{{ route('super-admin.data.penggiat.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-user-friends mr-2"></i>Data Penggiat Narkotika</h6>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('nama') }}" required>
                        @error('nama')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" id="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('alamat') }}</textarea>
                        @error('alamat')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No HP <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" id="no_hp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('no_hp') }}" required>
                        @error('no_hp')<div class="text-danger">{{ $message }}</div>@enderror
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
        <div class="mt-6 order-1 lg:order-2">
            <div class="bg-white shadow rounded p-4 space-y-4">
                <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-400">
                    <h6 class="font-semibold text-blue-700 mb-2"><i class="fas fa-info-circle mr-2"></i>Informasi</h6>
                    <ul class="list-disc list-inside text-sm text-blue-800 space-y-1">
                        <li>Pastikan data penggiat narkotika yang diinput sudah benar dan lengkap</li>
                        <li>Nama dan nomor HP harus valid untuk keperluan komunikasi</li>
                        <li>Alamat diisi selengkap mungkin untuk memudahkan verifikasi</li>
                        <li>Data digunakan untuk keperluan monitoring dan pelaporan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 