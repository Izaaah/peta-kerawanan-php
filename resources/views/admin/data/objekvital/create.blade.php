@extends('layouts.admin-master')

@section('title', 'Tambah Objek Vital')

@section('content')
<div class="container mx-auto pt-1 pb-2 px-1 max-w-7xl">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Objek Vital</h1>
            <p class="text-sm text-gray-500">Form untuk input data objek vital</p>
        </div>
        <a href="{{ route('admin.data.objekvital.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            <form action="{{ route('admin.data.objekvital.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-landmark mr-2"></i>Data Objek Vital</h6>
                    <div>
                        <label for="nama_objek" class="block text-sm font-medium text-gray-700">Nama Objek <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_objek" name="nama_objek" value="{{ old('nama_objek') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="nama_manager" class="block text-sm font-medium text-gray-700">Nama Manager <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_manager" name="nama_manager" value="{{ old('nama_manager') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi <span class="text-red-500">*</span></label>
                        <textarea id="lokasi" name="lokasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('lokasi') }}</textarea>
                    </div>
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP <span class="text-red-500">*</span></label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
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
                        <li>Pastikan semua data objek vital yang diinput sudah benar</li>
                        <li>Nama manager dan nomor HP harus valid</li>
                        <li>Data digunakan untuk keperluan verifikasi dan pelaporan</li>
                    </ul>
                </div>
            </div>
            <div class="mt-4">
                <div class="bg-white shadow rounded p-6">
                    <h6 class="text-lg font-semibold text-green-700 mb-4 flex items-center">
                        <i class="fas fa-file-excel mr-2"></i>Import Data
                    </h6>

                    <!-- Download Template CSV -->
                    <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-download text-blue-600 mr-2"></i>
                                <span class="text-sm text-blue-800">Download template untuk format yang benar</span>
                            </div>
                            <a href="{{ route('admin.data.objekvital.template') }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                <i class="fas fa-file-csv mr-1"></i>
                                Download
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('admin.data.objekvital.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center sm:space-x-4 space-y-4 sm:space-y-0">
                        @csrf
                        <input type="file" name="file" accept=".csv,.txt" required class="block w-full text-sm text-gray-500">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center">
                            <i class="fas fa-file-csv mr-2"></i>Input
                        </button>
                    </form>

                    @error('file')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                    @if(session('success'))
                        <div class="mt-2 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mt-2 p-2 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
