@extends('layouts.superadmin-master')

@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Jaringan Rutan/Lapas</h2>
        <form action="{{ route('super-admin.data.rutanlapas.update', $rutanlapas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama_napi" class="block font-semibold mb-1">Nama Napi</label>
                <input type="text" class="form-input w-full border rounded px-3 py-2" id="nama_napi" name="nama_napi" value="{{ old('nama_napi', $rutanlapas->nama_napi) }}" required>
            </div>
            <div class="mb-4">
                <label for="jenis_napi" class="block font-semibold mb-1">Jenis Napi</label>
                <select class="form-select w-full border rounded px-3 py-2" id="jenis_napi" name="jenis_napi" required>
                    <option value="">-- Pilih Jenis Napi --</option>
                    @foreach($jenisNapiOptions as $jenis)
                        <option value="{{ $jenis }}" {{ (old('jenis_napi', $rutanlapas->jenis_napi) == $jenis) ? 'selected' : '' }}>{{ $jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="lapas" class="block font-semibold mb-1">Lapas</label>
                <input type="text" class="form-input w-full border rounded px-3 py-2" id="lapas" name="lapas" value="{{ old('lapas', $rutanlapas->lapas) }}" required>
            </div>
            <div class="mb-4">
                <label for="lokasi_lapas" class="block font-semibold mb-1">Lokasi Lapas</label>
                <textarea class="form-input w-full border rounded px-3 py-2" id="lokasi_lapas" name="lokasi_lapas" required>{{ old('lokasi_lapas', $rutanlapas->lokasi_lapas) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="peran_dalam_jaringan" class="block font-semibold mb-1">Peran dalam Jaringan</label>
                <input type="text" class="form-input w-full border rounded px-3 py-2" id="peran_dalam_jaringan" name="peran_dalam_jaringan" value="{{ old('peran_dalam_jaringan', $rutanlapas->peran_dalam_jaringan) }}">
            </div>
            <div class="mb-4">
                <label for="status_proses" class="block font-semibold mb-1">Status Proses</label>
                <select class="form-select w-full border rounded px-3 py-2" id="status_proses" name="status_proses" required>
                    <option value="">-- Pilih Status Proses --</option>
                    @foreach($statusProsesOptions as $status)
                        <option value="{{ $status }}" {{ (old('status_proses', $rutanlapas->status_proses) == $status) ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="keterangan" class="block font-semibold mb-1">Keterangan</label>
                <textarea class="form-input w-full border rounded px-3 py-2" id="keterangan" name="keterangan">{{ old('keterangan', $rutanlapas->keterangan) }}</textarea>
            </div>
            <div class="flex gap-2 justify-end mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('super-admin.data.rutanlapas.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
