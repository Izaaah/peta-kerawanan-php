@extends('layouts.superadmin-master')

@section('title', 'Input Management')

@section('content')
@include('components.superadmin-navbar')

<!-- Main Content: Card List Pilihan -->
<div class="container-fluid px-2 px-md-4 py-5">
    <div class="max-w-2xl mx-auto">
        <div class="grid grid-cols-1 gap-4">
            <!-- Individu TSK -->
            <a href="{{ route('super-admin.input.individu') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-green-500 mr-2"></span>
                        <span class="text-sm font-semibold text-green-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-600 text-2xl mr-6">
                        <i class="fas fa-user-friends"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-green-700">Individu TSK</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Individu</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-green-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Pendukung -->
            <a href="{{ route('super-admin.input.pendukung') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-gray-300 mr-2"></span>
                        <span class="text-sm font-semibold text-gray-400">Inactive</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 text-yellow-600 text-2xl mr-6">
                        <i class="fas fa-archive"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-yellow-700">Pendukung</div>
                        <div class="text-sm text-gray-500 truncate">Data Pendukung Kasus</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-yellow-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Lanjutan -->
            <a href="{{ route('super-admin.input.lanjutan') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-green-500 mr-2"></span>
                        <span class="text-sm font-semibold text-green-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-green-100 text-green-600 text-2xl mr-6">
                        <i class="fas fa-forward"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-green-700">Lanjutan</div>
                        <div class="text-sm text-gray-500 truncate">Data Lanjutan Penanganan</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-green-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Kasus Narkoba -->
            <a href="{{ route('super-admin.input.kasus') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-pink-500 mr-2"></span>
                        <span class="text-sm font-semibold text-pink-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-pink-100 text-pink-600 text-2xl mr-6">
                        <i class="fas fa-biohazard"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-pink-700">Kasus Narkoba</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Kasus</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-pink-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Desa Geojson -->
            <a href="{{ route('super-admin.input.desa') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-blue-500 mr-2"></span>
                        <span class="text-sm font-semibold text-blue-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-600 text-2xl mr-6">
                        <i class="fas fa-map-marked-alt"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-blue-700">Desa Geojson</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Desa</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-blue-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- LSM Narkotika -->
            <a href="{{ route('super-admin.data.lsm.create') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-purple-500 mr-2"></span>
                        <span class="text-sm font-semibold text-purple-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 text-purple-600 text-2xl mr-6">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-purple-700">LSM Narkotika</div>
                        <div class="text-sm text-gray-500 truncate">Input Data LSM</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-purple-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Akun Sosmed -->
            <a href="{{ route('super-admin.data.medsos.create') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-teal-500 mr-2"></span>
                        <span class="text-sm font-semibold text-teal-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-teal-100 text-teal-600 text-2xl mr-6">
                        <i class="fab fa-instagram"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-teal-700">Akun Sosmed</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Medsos</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-teal-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Penjual Vape -->
            <a href="{{ route('super-admin.data.vape.create') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-yellow-500 mr-2"></span>
                        <span class="text-sm font-semibold text-yellow-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 text-yellow-600 text-2xl mr-6">
                        <i class="fas fa-smoking"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-yellow-700">Penjual Vape</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Vape</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-yellow-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Farmasi/Prekursor -->
            <a href="{{ route('super-admin.data.farmasi.create') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-rose-500 mr-2"></span>
                        <span class="text-sm font-semibold text-rose-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-rose-100 text-rose-600 text-2xl mr-6">
                        <i class="fas fa-pills"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-rose-700">Farmasi/Prekursor</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Farmasi</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-rose-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
        </div>
        <div class="bg-green-50 border border-green-100 text-green-700 text-center mt-8 rounded-lg py-3 px-4 flex items-center justify-center gap-2">
            <i class="fas fa-info-circle"></i>
            <span>Anda dapat menambahkan data baru sesuai kebutuhan dengan memilih jenis input di atas.</span>
        </div>
    </div>
</div>
@endsection
