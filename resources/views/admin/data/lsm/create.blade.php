@extends('layouts.admin-master')

@section('title', 'Tambah Data LSM Narkotika')

@section('content')
<div class="container mx-auto px-4 py-3">
    <div class="flex justify-between items-center mb-1">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Data LSM Narkotika</h1>
            <p class="text-sm text-gray-500">Form untuk input data LSM terkait narkotika</p>
        </div>
        <a href="{{ route('admin.data.lsm.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            @if(session('error'))
                <div class="p-4 text-red-700 bg-red-100 rounded">{{ session('error') }}</div>
            @endif
            <form action="{{ route('admin.data.lsm.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-building mr-2"></i>Data LSM</h6>
                    <div>
                        <label for="nama_lsm" class="block text-sm font-medium text-gray-700">Nama LSM <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_lsm" name="nama_lsm" value="{{ old('nama_lsm') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nama_lsm')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="ketua_lsm" class="block text-sm font-medium text-gray-700">Ketua LSM <span class="text-red-500">*</span></label>
                        <input type="text" id="ketua_lsm" name="ketua_lsm" value="{{ old('ketua_lsm') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('ketua_lsm')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                        <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('alamat') }}</textarea>
                        @error('alamat')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="no_hp_ketua" class="block text-sm font-medium text-gray-700">No. HP Ketua <span class="text-red-500">*</span></label>
                        <input type="text" id="no_hp_ketua" name="no_hp_ketua" value="{{ old('no_hp_ketua') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('no_hp_ketua')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
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
                        <li>Pastikan semua data yang diinput sudah benar</li>
                        <li>Pastikan No. HP yang diinputkan berawalan +62-</li>
                        <li>No. HP Ketua harus dapat dihubungi</li>
                        <li>Data LSM akan digunakan untuk keperluan verifikasi dan pelaporan</li>
                    </ul>
                </div>
            </div>
            <div class="mt-4">
                <div class="bg-white shadow rounded p-6">
                    <h6 class="text-lg font-semibold text-green-700 mb-4 flex items-center">
                        <i class="fas fa-file-excel mr-2"></i>Import Data LSM dari Excel
                    </h6>

                    <!-- Download Template CSV -->
                    <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-download text-blue-600 mr-2"></i>
                                <span class="text-sm text-blue-800">Download template untuk format yang benar</span>
                            </div>
                            <a href="{{ route('admin.data.lsm.template') }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                <i class="fas fa-file-csv mr-1"></i>
                                Download
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('admin.data.lsm.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center sm:space-x-4 space-y-4 sm:space-y-0">
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
