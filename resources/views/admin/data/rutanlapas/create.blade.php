@extends('layouts.admin-master')

@section('title', 'Tambah Jaringan Rutan/Lapas')

@section('content')
<div class="container mx-auto px-1 pt-1 pb-2 max-w-7xl">
    <div class="flex justify-between items-center lg:mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Jaringan Rutan/Lapas</h1>
            <p class="text-sm text-gray-500">Form untuk input data jaringan rutan/lapas</p>
        </div>
        <a href="{{ route('admin.input.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            <form action="{{ route('admin.data.rutanlapas.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-network-wired mr-2"></i>Data Jaringan Rutan/Lapas</h6>
                    <div>
                        <label for="nama_napi" class="block text-sm font-medium text-gray-700">Nama Napi <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_napi" name="nama_napi" value="{{ old('nama_napi') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="jenis_napi" class="block text-sm font-medium text-gray-700">Jenis Napi <span class="text-red-500">*</span></label>
                        <select id="jenis_napi" name="jenis_napi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Jenis Napi --</option>
                            @foreach($jenisNapiOptions as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_napi') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="lapas" class="block text-sm font-medium text-gray-700">Lapas <span class="text-red-500">*</span></label>
                        <input type="text" id="lapas" name="lapas" value="{{ old('lapas') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="lokasi_lapas" class="block text-sm font-medium text-gray-700">Lokasi Lapas <span class="text-red-500">*</span></label>
                        <textarea id="lokasi_lapas" name="lokasi_lapas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('lokasi_lapas') }}</textarea>
                    </div>
                    <div>
                        <label for="peran_dalam_jaringan" class="block text-sm font-medium text-gray-700">Peran dalam Jaringan</label>
                        <input type="text" id="peran_dalam_jaringan" name="peran_dalam_jaringan" value="{{ old('peran_dalam_jaringan') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="status_proses" class="block text-sm font-medium text-gray-700">Status Proses <span class="text-red-500">*</span></label>
                        <select id="status_proses" name="status_proses" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Status Proses --</option>
                            @foreach($statusProsesOptions as $status)
                                <option value="{{ $status }}" {{ old('status_proses') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('keterangan') }}</textarea>
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
                        <li>Pastikan semua data jaringan rutan/lapas yang diinput sudah benar</li>
                        <li>Isi status proses dan jenis napi sesuai kondisi sebenarnya</li>
                        <li>Data digunakan untuk keperluan verifikasi dan pelaporan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
