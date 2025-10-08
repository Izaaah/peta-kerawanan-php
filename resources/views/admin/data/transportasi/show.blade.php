@extends('layouts.admin-master')

@section('title', 'Detail Data Transportasi')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Detail Data Transportasi</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.data.transportasi.edit', $transportasi->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('admin.data.transportasi.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            </div>
        </div>

        <div class="bg-white rounded shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Informasi Transportasi</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Transportasi</label>
                            <div class="mt-1">
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if ($transportasi->jenis_transportasi == 'Darat') bg-blue-100 text-blue-800
                                @elseif($transportasi->jenis_transportasi == 'Laut') bg-green-100 text-green-800
                                @else bg-purple-100 text-purple-800 @endif">
                                    {{ $transportasi->jenis_transportasi }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Pihak</label>
                            <p class="mt-1 text-gray-900">{{ $transportasi->nama_pihak }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kepala/Manager</label>
                            <p class="mt-1 text-gray-900">{{ $transportasi->nama_manager ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <p class="mt-1 text-gray-900">{{ $transportasi->jabatan ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP</label>
                            <p class="mt-1 text-gray-900">{{ $transportasi->no_hp }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Alamat</h3>
                    <div class="bg-gray-50 p-4 rounded space-y-1">
                        <div class="text-gray-900">
                            @if ($transportasi->provinsi === 'Jawa Timur')
                                {{ trim(($transportasi->kabupaten ? $transportasi->kabupaten . ', ' : '') . ($transportasi->kecamatan ? $transportasi->kecamatan . ', ' : '') . ($transportasi->kelurahan ?? '')) ?: '-' }}
                            @elseif($transportasi->provinsi === 'lainnya')
                                {{ trim(($transportasi->provinsi_lain ? $transportasi->provinsi_lain . ', ' : '') . ($transportasi->kabupaten_lain ? $transportasi->kabupaten_lain . ', ' : '') . ($transportasi->kecamatan_lain ? $transportasi->kecamatan_lain . ', ' : '') . ($transportasi->kelurahan_lain ?? '')) ?: '-' }}
                            @else
                                -
                            @endif
                        </div>
                        @if ($transportasi->alamat)
                            <div class="text-gray-700 whitespace-pre-wrap">{{ $transportasi->alamat }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Informasi Sistem</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dibuat Pada</label>
                        <p class="mt-1 text-gray-900">{{ $transportasi->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                        <p class="mt-1 text-gray-900">{{ $transportasi->updated_at->format('d F Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <form action="{{ route('admin.data.transportasi.destroy', $transportasi->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus
                        Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
