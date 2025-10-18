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
                                • Data lama akan <strong>tetap tersimpan</strong> dan dapat diedit<br>
                                • Data baru akan <strong>ditambahkan</strong> sebagai record terpisah<br>
                                • Anda dapat mengedit dan menyempurnakan data sebelum disimpan
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Verifikasi -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mr-3 mt-1"></i>
                <div>
                    <h3 class="text-sm font-medium text-blue-800 mb-2">Informasi Verifikasi</h3>
                    <div class="text-sm text-blue-700">
                        <p class="mb-2">Ketika Anda approve data ini:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @if ($verification->data_id == 0)
                                <li>Data baru akan ditambahkan ke sistem</li>
                                <li>Data akan tersimpan dan dapat diedit di kemudian hari</li>
                            @else
                                <li>Data yang sudah ada akan diperbarui dengan informasi terbaru</li>
                                <li>Data lama akan diganti dengan data baru yang telah diverifikasi</li>
                            @endif
                            <li>Proses ini memastikan kualitas dan akurasi data</li>
                        </ul>
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
                @php
                    // Untuk data baru (data_id == 0), gunakan data baru saja
                    // Untuk data update (data_id != 0), ambil data lengkap dari database dan timpa dengan perubahan
                    if ($verification->data_id == 0) {
                        $dataToShow = $verification->new_data_array ?? [];
                    } else {
                        // Ambil data lengkap dari database
                        $dataToShow = $currentData ? $currentData->toArray() : [];

                        // Timpa dengan data baru yang diubah
                        $newData = $verification->new_data_array ?? [];
                        foreach ($newData as $key => $value) {
                            if (!empty($value) || $value === '0' || $value === 0) {
                                $dataToShow[$key] = $value;
                            }
                        }
                    }
                @endphp

                @if ($verification->data_id == 0)
                    <!-- Data Baru -->
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-plus-circle text-green-500 mr-2"></i>
                            <span class="text-sm font-medium text-green-800">Data Baru yang akan ditambahkan</span>
                        </div>
                    </div>
                @else
                    <!-- Data Update -->
                    <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-edit text-blue-500 mr-2"></i>
                            <span class="text-sm font-medium text-blue-800">Data yang akan diperbarui</span>
                        </div>
                    </div>
                @endif

                @if (is_array($dataToShow) && count($dataToShow) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($dataToShow as $key => $value)
                            @if (!in_array($key, ['id', 'created_at', 'updated_at', 'created_by']))
                                @php
                                    // Cek apakah field ini berubah (hanya untuk data update)
                                    $isChanged = false;
                                    if ($verification->data_id != 0 && $currentData) {
                                        $currentValue = $currentData->$key ?? null;
                                        $newValue = $verification->new_data_array[$key] ?? null;
                                        $isChanged = $currentValue !== $newValue && !empty($newValue);
                                    }
                                @endphp

                                <div
                                    class="border border-gray-200 rounded-lg p-4 {{ $isChanged ? 'bg-blue-50 border-blue-300' : 'bg-gray-50' }}">
                                    <div class="text-sm font-medium text-gray-600 mb-2 flex items-center">
                                        {{ $fieldLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}
                                        @if ($isChanged)
                                            <span
                                                class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Diubah</span>
                                        @endif
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
                <button type="button" onclick="showApproveModal()"
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded font-semibold flex items-center justify-center">
                    <i class="fas fa-check mr-2"></i>
                    @if ($verification->data_id == 0)
                        Approve Data Baru
                    @else
                        Approve & Update Data
                    @endif
                </button>

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

    <!-- Approve Confirmation Modal -->
    <div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-question-circle text-blue-500 text-2xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-gray-900">Konfirmasi Approve</h3>
                    </div>
                </div>
                <button type="button" onclick="closeApproveModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="mb-4">
                    @if ($verification->data_id == 0)
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-700">
                                    <strong>Data Baru</strong><br>
                                    Data ini akan ditambahkan sebagai record baru ke sistem.
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start">
                            <i class="fas fa-edit text-blue-500 mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-700">
                                    <strong>Update Data</strong><br>
                                    Data lama akan diperbarui dengan data baru yang telah diverifikasi.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-blue-500 mr-2"></i>
                        <span class="text-sm font-medium text-blue-800">Perhatian</span>
                    </div>
                    <p class="text-sm text-blue-700 mt-1">
                        Proses ini tidak dapat dibatalkan setelah disetujui.
                    </p>
                </div>

                <p class="text-sm text-gray-600 mb-4">
                    Apakah Anda yakin ingin melanjutkan proses approve?
                </p>
            </div>

            <!-- Modal Footer -->
            <div class="flex gap-3 p-6 border-t border-gray-200">
                <button type="button" onclick="closeApproveModal()"
                    class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded font-medium">
                    Batal
                </button>
                <form action="{{ route('super-admin.verification.approve', $verification->id) }}" method="POST"
                    class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-medium">
                        <i class="fas fa-check mr-2"></i>
                        Ya, Approve
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showApproveModal() {
            document.getElementById('approveModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeApproveModal() {
            document.getElementById('approveModal').style.display = 'none';
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        document.getElementById('approveModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeApproveModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeApproveModal();
            }
        });
    </script>
@endsection
