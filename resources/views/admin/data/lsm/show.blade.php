@extends('layouts.admin-master')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Detail LSM Narkotika</h2>
            <div class="mb-4">
                <strong>Nama LSM:</strong>
                <div class="text-gray-700">{{ $lsm->nama_lsm }}</div>
            </div>

            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <strong>Provinsi:</strong>
                    <div class="text-gray-700">{{ $lsm->provinsi ?? '-' }}</div>
                </div>
                <div>
                    <strong>Kabupaten/Kota:</strong>
                    <div class="text-gray-700">{{ $lsm->kabupaten ?? '-' }}</div>
                </div>
                <div>
                    <strong>Kecamatan:</strong>
                    <div class="text-gray-700">{{ $lsm->kecamatan ?? '-' }}</div>
                </div>
                <div>
                    <strong>Kelurahan/Desa:</strong>
                    <div class="text-gray-700">{{ $lsm->kelurahan ?? '-' }}</div>
                </div>
            </div>
            <div class="mb-4">
                <strong>Alamat:</strong>
                <div class="text-gray-700">{{ $lsm->alamat }}</div>
            </div>
            <div class="mb-4">
                <strong>No. Telp:</strong>
                <div class="text-gray-700">{{ $lsm->no_telp ?? '-' }}</div>
            </div>
            <div class="mb-4">
                <strong>Ketua LSM:</strong>
                <div class="text-gray-700">{{ $lsm->ketua_lsm }}</div>
            </div>
            <div class="mb-4">
                <strong>No. HP Ketua:</strong>
                <div class="text-gray-700">{{ $lsm->no_hp_ketua }}</div>
            </div>
            <div class="flex gap-2 mt-6">
                <a href="{{ route('admin.data.lsm.edit', $lsm->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('admin.data.lsm.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
            </div>
        </div>
    </div>
@endsection
