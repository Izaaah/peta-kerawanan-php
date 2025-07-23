@extends('layouts.operator')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Jaringan Rutan/Lapas</h1>
    <div class="mb-3">
        <label class="form-label">Nama Napi</label>
        <div class="form-control">{{ $rutanlapas->nama_napi }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis Napi</label>
        <div class="form-control">{{ $rutanlapas->jenis_napi }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Lapas</label>
        <div class="form-control">{{ $rutanlapas->lapas }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Lokasi Lapas</label>
        <div class="form-control">{{ $rutanlapas->lokasi_lapas }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Peran dalam Jaringan</label>
        <div class="form-control">{{ $rutanlapas->peran_dalam_jaringan }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Status Proses</label>
        <div class="form-control">{{ $rutanlapas->status_proses }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <div class="form-control">{{ $rutanlapas->keterangan }}</div>
    </div>
    <a href="{{ route('super-admin.data.rutanlapas.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('super-admin.data.rutanlapas.edit', $rutanlapas->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection 