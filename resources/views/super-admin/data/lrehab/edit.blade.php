@extends('layouts.superadmin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Lembaga Rehabilitasi</h1>
    <form action="{{ route('super-admin.data.lrehab.update', $lrehab->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $lrehab->nama) }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-control" id="jenis" name="jenis" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach($jenisOptions as $jenis)
                    <option value="{{ $jenis }}" {{ (old('jenis', $lrehab->jenis) == $jenis) ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('super-admin.data.lrehab.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 