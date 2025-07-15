@extends('layouts.superadmin-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Jaringan Rutan/Lapas</h1>
    <a href="{{ route('super-admin.data.rutanlapas.create') }}" class="btn btn-primary mb-3">Tambah Jaringan Rutan/Lapas</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Napi</th>
                <th>Jenis Napi</th>
                <th>Lapas</th>
                <th>Status Proses</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rutanlapasList as $i => $rutanlapas)
            <tr>
                <td>{{ $rutanlapasList->firstItem() + $i }}</td>
                <td>{{ $rutanlapas->nama_napi }}</td>
                <td>{{ $rutanlapas->jenis_napi }}</td>
                <td>{{ $rutanlapas->lapas }}</td>
                <td>{{ $rutanlapas->status_proses }}</td>
                <td>
                    <a href="{{ route('super-admin.data.rutanlapas.show', $rutanlapas->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('super-admin.data.rutanlapas.edit', $rutanlapas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('super-admin.data.rutanlapas.destroy', $rutanlapas->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $rutanlapasList->links() }}
</div>
@endsection 