@extends('layouts.superadmin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Lembaga Rehabilitasi</h1>
    <a href="{{ route('super-admin.data.lrehab.create') }}" class="btn btn-primary mb-3">Tambah Lembaga Rehabilitasi</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lrehabList as $i => $lrehab)
            <tr>
                <td>{{ $lrehabList->firstItem() + $i }}</td>
                <td>{{ $lrehab->nama }}</td>
                <td>{{ $lrehab->jenis }}</td>
                <td>
                    <a href="{{ route('super-admin.data.lrehab.show', $lrehab->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('super-admin.data.lrehab.edit', $lrehab->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('super-admin.data.lrehab.destroy', $lrehab->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $lrehabList->links() }}
</div>
@endsection 