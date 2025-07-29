@extends('layouts.superadmin-master')
@section('title', 'Verifikasi Data Duplikat')
@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Verifikasi Data Duplikat</h1>
            <p class="text-sm text-gray-500">Daftar data yang terdeteksi duplikat dan memerlukan verifikasi</p>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">
                    Informasi Verifikasi
                </h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>
                        • <strong>Approve:</strong> Data lama akan dihapus dan data baru akan disimpan<br>
                        • <strong>Reject:</strong> Data akan ditolak dan tidak disimpan ke sistem<br>
                        • <strong>Data Baru:</strong> Data yang belum ada di sistem sebelumnya
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis Data</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Data Lama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Data Baru</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Admin Pengaju</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($verifications as $verification)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm">{{ $verification->id }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                {{ $verification->table_display_name }}
                            </span>
                            @if($verification->data_id == 0)
                                <span class="ml-1 inline-block bg-green-100 text-green-800 text-xs px-1 py-0.5 rounded">Baru</span>
                            @else
                                <span class="ml-1 inline-block bg-orange-100 text-orange-800 text-xs px-1 py-0.5 rounded">Update</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 max-w-xs">
                            <div class="bg-gray-100 rounded p-2 text-xs">
                                @if($verification->data_id == 0)
                                    <span class="text-gray-500">Data Baru</span>
                                @else
                                    @php
                                        $oldData = $verification->old_data_array;
                                    @endphp
                                    @if(is_array($oldData))
                                        @foreach($oldData as $key => $value)
                                            @if(in_array($key, ['nama', 'nama_lsm', 'nama_thm', 'nama_toko', 'nama_objek', 'nama_akun', 'ketua_lsm', 'ketua_thm', 'pemilik', 'manager', 'nama_pengelola', 'nama_pihak', 'nik', 'nkk']))
                                                <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</div>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-gray-500">Data tidak tersedia</span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-2 max-w-xs">
                            <div class="bg-green-50 rounded p-2 text-xs">
                                @php
                                    $newData = $verification->new_data_array;
                                @endphp
                                @if(is_array($newData))
                                    @foreach($newData as $key => $value)
                                        @if(in_array($key, ['nama', 'nama_lsm', 'nama_thm', 'nama_toko', 'nama_objek', 'nama_akun', 'ketua_lsm', 'ketua_thm', 'pemilik', 'manager', 'nama_pengelola', 'nama_pihak', 'nik', 'nkk']))
                                            <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</div>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-gray-500">Data tidak tersedia</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">
                                {{ $verification->admin->name ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-500">
                            {{ $verification->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('super-admin.verification.show', $verification->id) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs text-blue-600 border border-blue-600 rounded hover:bg-blue-50" 
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('super-admin.verification.approve', $verification->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('{{ $verification->data_id == 0 ? 'Yakin approve data baru ini?' : 'PERHATIAN! Data lama akan dihapus dan diganti dengan data baru. Yakin ingin melanjutkan?' }}')" 
                                      class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center px-2 py-1 text-xs text-green-600 border border-green-600 rounded hover:bg-green-50" 
                                            title="{{ $verification->data_id == 0 ? 'Approve Data Baru' : 'Approve & Ganti Data' }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('super-admin.verification.reject', $verification->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin reject data ini?')" 
                                      class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center px-2 py-1 text-xs text-red-600 border border-red-600 rounded hover:bg-red-50" 
                                            title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-check-circle text-4xl text-green-300 mb-2"></i>
                                <p>Tidak ada data yang memerlukan verifikasi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 