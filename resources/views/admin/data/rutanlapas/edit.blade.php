@extends('layouts.admin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Jaringan Rutan/Lapas</h1>
    <form action="{{ route('admin.data.rutanlapas.update', $rutanlapas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_napi" class="form-label">Nama Napi</label>
            <input type="text" class="form-control" id="nama_napi" name="nama_napi" value="{{ old('nama_napi', $rutanlapas->nama_napi) }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_napi" class="form-label">Jenis Napi</label>
            <select class="form-control" id="jenis_napi" name="jenis_napi" required>
                <option value="">-- Pilih Jenis Napi --</option>
                @foreach($jenisNapiOptions as $jenis)
                    <option value="{{ $jenis }}" {{ (old('jenis_napi', $rutanlapas->jenis_napi) == $jenis) ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="lapas" class="form-label">Lapas</label>
            <input type="text" class="form-control" id="lapas" name="lapas" value="{{ old('lapas', $rutanlapas->lapas) }}" required>
        </div>
        <div class="mb-3">
            <label for="lokasi_lapas" class="form-label">Lokasi Lapas</label>
            <textarea class="form-control" id="lokasi_lapas" name="lokasi_lapas" required>{{ old('lokasi_lapas', $rutanlapas->lokasi_lapas) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="peran_dalam_jaringan" class="form-label">Peran dalam Jaringan</label>
            <input type="text" class="form-control" id="peran_dalam_jaringan" name="peran_dalam_jaringan" value="{{ old('peran_dalam_jaringan', $rutanlapas->peran_dalam_jaringan) }}">
        </div>
        <div class="mb-3">
            <label for="status_proses" class="form-label">Status Proses</label>
            <select class="form-control" id="status_proses" name="status_proses" required>
                <option value="">-- Pilih Status Proses --</option>
                @foreach($statusProsesOptions as $status)
                    <option value="{{ $status }}" {{ (old('status_proses', $rutanlapas->status_proses) == $status) ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan', $rutanlapas->keterangan) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.data.rutanlapas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
