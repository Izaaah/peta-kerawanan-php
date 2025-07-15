@extends('layouts.superadmin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Objek Vital</h1>
    <div class="mb-3">
        <label class="form-label">Nama Objek</label>
        <div class="form-control">{{ $objekVital->nama_objek }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Manager</label>
        <div class="form-control">{{ $objekVital->nama_manager }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Lokasi</label>
        <div class="form-control">{{ $objekVital->lokasi }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">No HP</label>
        <div class="form-control">{{ $objekVital->no_hp }}</div>
    </div>
    <a href="{{ route('super-admin.data.objekvital.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('super-admin.data.objekvital.edit', $objekVital->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection 