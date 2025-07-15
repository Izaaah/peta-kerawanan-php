@extends('layouts.superadmin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Objek Vital</h1>
    <a href="{{ route('super-admin.data.objekvital.create') }}" class="btn btn-primary mb-3">Tambah Objek Vital</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Objek</th>
                <th>Nama Manager</th>
                <th>Lokasi</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objekVitalList as $i => $objekVital)
            <tr>
                <td>{{ $objekVitalList->firstItem() + $i }}</td>
                <td>{{ $objekVital->nama_objek }}</td>
                <td>{{ $objekVital->nama_manager }}</td>
                <td>{{ $objekVital->lokasi }}</td>
                <td>{{ $objekVital->no_hp }}</td>
                <td>
                    <a href="{{ route('super-admin.data.objekvital.show', $objekVital->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('super-admin.data.objekvital.edit', $objekVital->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('super-admin.data.objekvital.destroy', $objekVital->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $objekVitalList->links() }}
</div>
@endsection 