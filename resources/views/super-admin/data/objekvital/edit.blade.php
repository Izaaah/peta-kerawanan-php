@extends('layouts.superadmin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Objek Vital</h1>
    <form action="{{ route('super-admin.data.objekvital.update', $objekVital->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_objek" class="form-label">Nama Objek</label>
            <input type="text" class="form-control" id="nama_objek" name="nama_objek" value="{{ old('nama_objek', $objekVital->nama_objek) }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_manager" class="form-label">Nama Manager</label>
            <input type="text" class="form-control" id="nama_manager" name="nama_manager" value="{{ old('nama_manager', $objekVital->nama_manager) }}" required>
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <textarea class="form-control" id="lokasi" name="lokasi" required>{{ old('lokasi', $objekVital->lokasi) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $objekVital->no_hp) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('super-admin.data.objekvital.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 