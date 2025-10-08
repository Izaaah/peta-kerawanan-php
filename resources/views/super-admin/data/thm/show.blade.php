@extends('layouts.superadmin-master')

@section('title', 'Detail THM')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Detail Tempat Hiburan Malam (THM)</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai THM</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('super-admin.data.thm.edit', $thm->id) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('super-admin.data.thm.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded shadow p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Data THM -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">
                        <i class="fas fa-building mr-2 text-blue-600"></i>Data THM
                    </h3>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama THM</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->nama_thm }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ketua THM</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->ketua_thm }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP Ketua</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->no_hp_ketua }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dibuat Oleh</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->user->name ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Alamat -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>Data Alamat
                    </h3>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->provinsi ?? '-' }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->kabupaten ?? '-' }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->kecamatan ?? '-' }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->kelurahan ?? '-' }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border">
                                <span class="text-gray-900">{{ $thm->alamat ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat Lengkap (jika ada) -->
            @if ($thm->alamat)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                        <i class="fas fa-home mr-2 text-purple-600"></i>Alamat Lengkap
                    </h3>
                    <div class="p-4 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                        <p class="text-gray-800">{{ $thm->alamat }}</p>
                    </div>
                </div>
            @endif

            <!-- Informasi Tambahan -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-green-50 rounded-lg border-l-4 border-green-400">
                    <h4 class="font-semibold text-green-800 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Informasi
                    </h4>
                    <p class="text-sm text-green-700">
                        Data THM ini digunakan untuk keperluan monitoring dan pelaporan kegiatan hiburan malam di wilayah
                        tersebut.
                    </p>
                </div>

                <div class="p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-400">
                    <h4 class="font-semibold text-yellow-800 mb-2">
                        <i class="fas fa-clock mr-2"></i>Terakhir Diperbarui
                    </h4>
                    <p class="text-sm text-yellow-700">
                        {{ $thm->updated_at ? $thm->updated_at->format('d M Y H:i') : 'Belum pernah diperbarui' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
