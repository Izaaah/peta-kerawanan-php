@extends('layouts.admin-master')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Detail Lembaga Rehabilitasi</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai lembaga rehabilitasi</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.data.lrehab.edit', $lrehab->id) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.data.lrehab.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Data Utama -->
            <div class="bg-white shadow rounded p-6">
                <h6 class="text-lg font-semibold text-primary mb-4"><i class="fas fa-hospital-user mr-2"></i>Data Lembaga
                </h6>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Lembaga Rehabilitasi</label>
                        <div class="mt-1">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $lrehab->jenis_lrehab == 'LRIP' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ $lrehab->jenis_lrehab == 'LRIP' ? 'LRIP (Lembaga Rehabilitasi Instansi Pemerintah)' : 'LRKM (Lembaga Rehabilitasi Komunitas Masyarakat)' }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lembaga</label>
                        <div class="mt-1 text-gray-900">{{ $lrehab->nama }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ketua</label>
                        <div class="mt-1 text-gray-900">{{ $lrehab->nama_ketua ?? 'N/A' }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                        <div class="mt-1 text-gray-900">{{ $lrehab->no_hp ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="bg-white shadow rounded p-6">
                <h6 class="text-lg font-semibold text-primary mb-4"><i class="fas fa-map-marker-alt mr-2"></i>Alamat</h6>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <div class="mt-1 text-gray-900">{{ $lrehab->provinsi ?? 'N/A' }}</div>
                    </div>

                    @if ($lrehab->provinsi == 'Jawa Timur')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                            <div class="mt-1 text-gray-900">{{ $lrehab->kabupaten ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <div class="mt-1 text-gray-900">{{ $lrehab->kecamatan ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                            <div class="mt-1 text-gray-900">{{ $lrehab->kelurahan ?? 'N/A' }}</div>
                        </div>
                    @else
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <div class="mt-1 text-gray-900">{{ $lrehab->provinsi_lain ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                            <div class="mt-1 text-gray-900">{{ $lrehab->kabupaten_lain ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <div class="mt-1 text-gray-900">{{ $lrehab->kecamatan_lain ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                            <div class="mt-1 text-gray-900">{{ $lrehab->kelurahan_lain ?? 'N/A' }}</div>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <div class="mt-1 text-gray-900">{{ $lrehab->alamat ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Sertifikasi -->
            <div class="bg-white shadow rounded p-6 lg:col-span-2">
                <h6 class="text-lg font-semibold text-primary mb-4"><i class="fas fa-certificate mr-2"></i>Sertifikasi</h6>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <input type="checkbox" {{ in_array('IPWL', $lrehab->sertifikasi ?? []) ? 'checked' : '' }}
                                disabled class="mr-2">
                            <label class="text-sm font-medium text-gray-700">IPWL</label>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="flex items-center">
                            <input type="checkbox"
                                {{ in_array('SNI_Nasional', $lrehab->sertifikasi ?? []) ? 'checked' : '' }} disabled
                                class="mr-2">
                            <label class="text-sm font-medium text-gray-700">SNI Nasional</label>
                        </div>
                        @if (in_array('SNI_Nasional', $lrehab->sertifikasi ?? []))
                            <div class="ml-4">
                                <label class="block text-xs text-gray-500">Nomor Sertifikat</label>
                                <div class="text-sm text-gray-900">{{ $lrehab->nomor_sni_nasional ?? 'N/A' }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center">
                        <div class="flex items-center">
                            <input type="checkbox"
                                {{ in_array('SNI_Reguler', $lrehab->sertifikasi ?? []) ? 'checked' : '' }} disabled
                                class="mr-2">
                            <label class="text-sm font-medium text-gray-700">SNI Reguler</label>
                        </div>
                        @if (in_array('SNI_Reguler', $lrehab->sertifikasi ?? []))
                            <div class="ml-4">
                                <label class="block text-xs text-gray-500">Nomor Sertifikat</label>
                                <div class="text-sm text-gray-900">{{ $lrehab->nomor_sni_reguler ?? 'N/A' }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer dengan informasi terakhir diperbarui -->
        <div class="mt-8 bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <span>Data ini terakhir diperbarui pada
                        {{ $lrehab->updated_at ? $lrehab->updated_at->format('d F Y, H:i') : 'N/A' }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    <span>Dibuat pada {{ $lrehab->created_at ? $lrehab->created_at->format('d F Y, H:i') : 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
