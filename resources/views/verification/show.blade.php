@extends('layouts.superadmin-master')
@section('title', 'Detail Verifikasi Data')
@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Detail Verifikasi Data</h1>
            <p class="text-sm text-gray-500">{{ $tableDisplayName }}</p>
        </div>
        <a href="{{ route('super-admin.verification.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <!-- Warning Box -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">
                    Perhatian
                </h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <p>
                        @if($verification->data_id == 0)
                            Data ini akan ditambahkan sebagai data baru ke sistem.
                        @else
                            <strong>Ketika Anda approve data ini:</strong><br>
                            • Data lama akan <strong>dihapus</strong> dari sistem<br>
                            • Data baru akan <strong>disimpan</strong> sebagai penggantinya<br>
                            • Proses ini tidak dapat dibatalkan
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Data Lama -->
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-database text-blue-500 mr-2"></i>
                Data Lama
                @if($verification->data_id != 0)
                    <span class="ml-2 bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Akan Dihapus</span>
                @endif
            </h2>
            
            @if($verification->data_id == 0)
                <div class="text-gray-500 text-center py-8">
                    <i class="fas fa-plus-circle text-4xl mb-2"></i>
                    <p>Data Baru</p>
                </div>
            @else
                <div class="space-y-3">
                    @php
                        $oldData = $verification->old_data_array;
                    @endphp
                    @if(is_array($oldData))
                        @foreach($oldData as $key => $value)
                            @if(!in_array($key, ['id', 'created_at', 'updated_at', 'created_by']))
                                <div class="border-b border-gray-100 pb-2">
                                    <div class="text-sm font-medium text-gray-600">
                                        {{ $fieldLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}
                                    </div>
                                    <div class="text-sm text-gray-800 mt-1">
                                        {{ $value ?: '-' }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="text-gray-500 text-center py-4">
                            <p>Data tidak tersedia</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Data Baru -->
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-plus text-green-500 mr-2"></i>
                Data Baru
                <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Akan Disimpan</span>
            </h2>
            
            <div class="space-y-3">
                @php
                    $newData = $verification->new_data_array;
                @endphp
                @if(is_array($newData))
                    @foreach($newData as $key => $value)
                        @if(!in_array($key, ['id', 'created_at', 'updated_at', 'created_by']))
                            <div class="border-b border-gray-100 pb-2">
                                <div class="text-sm font-medium text-gray-600">
                                    {{ $fieldLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}
                                </div>
                                <div class="text-sm text-gray-800 mt-1">
                                    {{ $value ?: '-' }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="text-gray-500 text-center py-4">
                        <p>Data tidak tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Informasi Verifikasi -->
    <div class="bg-white shadow rounded p-6 mt-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Verifikasi</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <div class="text-sm font-medium text-gray-600">Admin Pengaju</div>
                <div class="text-sm text-gray-800 mt-1">{{ $verification->admin->name ?? 'Unknown' }}</div>
            </div>
            
            <div>
                <div class="text-sm font-medium text-gray-600">Tanggal Pengajuan</div>
                <div class="text-sm text-gray-800 mt-1">{{ $verification->created_at->format('d/m/Y H:i') }}</div>
            </div>
            
            <div>
                <div class="text-sm font-medium text-gray-600">Status</div>
                <div class="text-sm mt-1">
                    <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">
                        Menunggu Verifikasi
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Aksi -->
    <div class="bg-white shadow rounded p-6 mt-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h2>
        
        <div class="flex gap-4">
            <form action="{{ route('super-admin.verification.approve', $verification->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('{{ $verification->data_id == 0 ? 'Yakin approve data baru ini?' : 'PERHATIAN! Data lama akan dihapus dan diganti dengan data baru. Yakin ingin melanjutkan?' }}')" 
                  class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded font-semibold flex items-center justify-center">
                    <i class="fas fa-check mr-2"></i>
                    @if($verification->data_id == 0)
                        Approve Data Baru
                    @else
                        Approve & Ganti Data
                    @endif
                </button>
            </form>
            
            <form action="{{ route('super-admin.verification.reject', $verification->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('Yakin reject data ini?')" 
                  class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded font-semibold flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>
                    Reject Data
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 