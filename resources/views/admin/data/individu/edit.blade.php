@extends('layouts.admin-master')

@section('title', 'Edit Data Individu TSK')

@section('content')
<div class="px-4 pt-2 pb-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 light:text-white">Edit Data Individu TSK</h1>
            <p class="text-sm text-gray-500">Perbarui data individu di bawah ini.</p>
        </div>
        <a href="{{ route('admin.data.individu') }}" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-10 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
            <div class="lg:col-span-5">
                <!-- Form Edit -->
                <div class="bg-white light:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-blue-600 mb-4">Formulir Edit Data Individu</h2>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan saat mengisi form:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @include('admin.data.individu.form', ['mode' => 'edit', 'individu' => $individu, 'kabupatenList' => $kabupatenList])
                </div>
            </div>
            <!-- Sidebar Info -->
            <div class="lg:col-span-2">
                <div class="bg-white light:bg-gray-800 shadow rounded-lg p-4 text-xs">
                    <h2 class="text-base font-semibold text-blue-600 mb-3">Informasi Penting</h2>
                    <div class="bg-blue-50 text-blue-700 text-xs p-2 rounded mb-3">
                        <ul class="list-disc pl-4">
                            <li>Data akan terhubung dengan data kasus narkoba secara otomatis.</li>
                            <li>Pilih status "Napi" jika individu terlibat kasus.</li>
                            <li>Desa akan dipetakan berdasarkan kecamatan dan kelurahan.</li>
                        </ul>
                    </div>
                    <div class="bg-yellow-50 text-yellow-700 text-xs p-2 rounded flex items-center">
                        <i class="fas fa-exclamation-triangle mr-1"></i> NIK harus unik dan tidak boleh duplikat.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
