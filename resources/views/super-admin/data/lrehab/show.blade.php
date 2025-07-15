@extends('layouts.superadmin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Lembaga Rehabilitasi</h1>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <div class="form-control">{{ $lrehab->nama }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis</label>
        <div class="form-control">{{ $lrehab->jenis }}</div>
    </div>
    <a href="{{ route('super-admin.data.lrehab.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('super-admin.data.lrehab.edit', $lrehab->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection 