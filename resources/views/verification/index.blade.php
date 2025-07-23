@extends('layouts.superadmin-master')
@section('title', 'Verifikasi Perubahan Data')
@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Verifikasi Perubahan Data</h1>
            <p class="text-sm text-gray-500">Daftar perubahan data yang perlu diverifikasi</p>
        </div>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    <div class="bg-white shadow rounded p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tabel</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID Data</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Data Lama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Data Baru</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Admin Pengaju</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($verifications as $verification)
                    <tr>
                        <td class="px-4 py-2">{{ $verification->id }}</td>
                        <td class="px-4 py-2"><span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $verification->table_name }}</span></td>
                        <td class="px-4 py-2">{{ $verification->data_id }}</td>
                        <td class="px-4 py-2 max-w-xs overflow-x-auto"><pre class="bg-gray-100 rounded p-2 text-xs whitespace-pre-wrap">{{ json_encode($verification->old_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre></td>
                        <td class="px-4 py-2 max-w-xs overflow-x-auto"><pre class="bg-green-50 rounded p-2 text-xs whitespace-pre-wrap">{{ json_encode($verification->new_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre></td>
                        <td class="px-4 py-2"><span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">{{ $verification->admin_id }}</span></td>
                        <td class="px-4 py-2">
                            @if($verification->status == 'pending')
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Pending</span>
                            @elseif($verification->status == 'approved')
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Approved</span>
                            @else
                                <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center flex gap-2 justify-center">
                            <form action="{{ route('super-admin.verification.approve', $verification->id) }}" method="POST" onsubmit="return confirm('Yakin approve perubahan ini?')">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded text-xs font-semibold">Approve</button>
                            </form>
                            <form action="{{ route('super-admin.verification.reject', $verification->id) }}" method="POST" onsubmit="return confirm('Yakin reject perubahan ini?')">
                                @csrf
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-xs font-semibold">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-2 text-center text-gray-500">Tidak ada data verifikasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 