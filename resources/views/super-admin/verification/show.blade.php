@extends('layouts.superadmin-master')
@section('title', 'Detail Verifikasi Data')
@section('content')
    <div class="mx-auto px-4 py-6">
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

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <!-- Warning Box -->
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
                            @if ($verification->data_id == 0)
                                Data ini akan ditambahkan sebagai data baru ke sistem setelah disetujui.
                            @else
                                <strong>Ketika Anda approve data ini:</strong><br>
                                • Data akan <strong>disetujui</strong> dan tersimpan di sistem<br>
                                • Data lama akan <strong>diganti</strong> dengan data baru<br>
                                • Proses ini <strong>tidak dapat dibatalkan</strong>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Lengkap -->
        <div class="bg-white shadow rounded p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-database text-blue-500 mr-2"></i>
                Data Lengkap
                <span class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Data Verifikasi</span>
            </h2>

            <div class="space-y-4">
                @if ($verification->data_id == 0)
                    <!-- Data Baru -->
                    @php $dataToShow = $verification->new_data_array; @endphp
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-plus-circle text-green-500 mr-2"></i>
                            <span class="text-sm font-medium text-green-800">Data Baru yang akan ditambahkan</span>
                        </div>
                    </div>
                @else
                    <!-- Data Lama -->
                    @php $dataToShow = $verification->old_data_array; @endphp
                    <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-database text-yellow-500 mr-2"></i>
                            <span class="text-sm font-medium text-yellow-800">Data Lama yang akan diganti</span>
                        </div>
                    </div>
                @endif

                @if (is_array($dataToShow) && count($dataToShow) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($dataToShow as $key => $value)
                            @if (!in_array($key, ['id', 'created_at', 'updated_at', 'created_by']))
                                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                    <div class="text-sm font-medium text-gray-600 mb-2">
                                        {{ $fieldLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}
                                    </div>
                                    <div class="text-sm text-gray-800 break-words">
                                        @if (is_array($value))
                                            {{ json_encode($value) }}
                                        @elseif (is_bool($value))
                                            {{ $value ? 'Ya' : 'Tidak' }}
                                        @elseif (is_null($value) || $value === '' || $value === '0')
                                            <span class="text-gray-400 italic">Belum diisi</span>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Summary Information -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                <span class="text-sm text-blue-700">
                                    Total {{ count($dataToShow) }} field data ditampilkan
                                </span>
                            </div>
                            <div class="text-sm text-blue-600">
                                @php
                                    $filledFields = 0;
                                    foreach ($dataToShow as $key => $value) {
                                        if (
                                            !in_array($key, ['id', 'created_at', 'updated_at', 'created_by']) &&
                                            !is_null($value) &&
                                            $value !== '' &&
                                            $value !== '0'
                                        ) {
                                            $filledFields++;
                                        }
                                    }
                                @endphp
                                {{ $filledFields }} field terisi
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-gray-500 text-center py-8">
                        <i class="fas fa-exclamation-circle text-4xl mb-2"></i>
                        <p>Data tidak tersedia</p>
                    </div>
                @endif
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
                <form action="{{ route('super-admin.verification.approve', $verification->id) }}" method="POST"
                    onsubmit="return confirm('{{ $verification->data_id == 0 ? 'Yakin approve data baru ini? Data akan tersimpan di sistem.' : 'Yakin approve data ini? Data lama akan diganti dengan data baru dan tidak dapat dibatalkan.' }}')"
                    class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded font-semibold flex items-center justify-center">
                        <i class="fas fa-check mr-2"></i>
                        @if ($verification->data_id == 0)
                            Approve Data Baru
                        @else
                            Approve & Ganti Data
                        @endif
                    </button>
                </form>

                <form action="{{ route('super-admin.verification.reject', $verification->id) }}" method="POST"
                    onsubmit="return confirm('Yakin reject data ini?')" class="flex-1">
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
