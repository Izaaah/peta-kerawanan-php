@extends('layouts.superadmin-master')

@section('content')
<div class="container-fluid px-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Profil Pengguna</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-sm font-medium text-blue-600">{{ substr(auth()->user()->name, 0, 2) }}</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <h3 class="font-semibold text-blue-800">Role</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ ucfirst(auth()->user()->role ?? 'User') }}</p>
                    <p class="text-sm text-blue-600">Hak akses saat ini</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                    <h3 class="font-semibold text-green-800">Status</h3>
                    <p class="text-2xl font-bold text-green-600">{{ ucfirst(auth()->user()->status ?? 'Active') }}</p>
                    <p class="text-sm text-green-600">Status akun</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                    <h3 class="font-semibold text-purple-800">Terdaftar</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : 'N/A' }}</p>
                    <p class="text-sm text-purple-600">Tanggal registrasi</p>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                    <h3 class="font-semibold text-orange-800">Terakhir Login</h3>
                    <p class="text-2xl font-bold text-orange-600">{{ auth()->user()->updated_at ? auth()->user()->updated_at->format('d M Y') : 'N/A' }}</p>
                    <p class="text-sm text-orange-600">Update terakhir</p>
                </div>
            </div>

            <!-- Profile Information Section -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-blue-900">Informasi Profil</h3>
                    <div class="flex items-center text-sm text-blue-700">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Nama hanya dapat diubah oleh Admin</span>
                    </div>
                </div>
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="bg-green-50 p-4 rounded-lg mb-6 border border-green-200">
                <h3 class="text-lg font-semibold text-green-900 mb-4">Update Password</h3>
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-red-50 p-4 rounded-lg mb-6 border border-red-200">
                <h3 class="text-lg font-semibold text-red-900 mb-4">Hapus Akun</h3>
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

                        <!-- Quick Actions -->
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('super-admin.dashboard') }}" class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Dashboard</p>
                            <p class="text-sm text-gray-500">Kembali ke dashboard</p>
                        </div>
                    </a>

                    @if(auth()->user()->role === 'superadmin')
                    <a href="{{ route('super-admin.user-management.index') }}" class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">User Management</p>
                            <p class="text-sm text-gray-500">Kelola pengguna</p>
                        </div>
                    </a>
                    @else
                    <div class="flex items-center p-3 bg-gray-100 rounded-lg border border-gray-200">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-500">User Management</p>
                            <p class="text-sm text-gray-400">Hanya untuk administrator</p>
                        </div>
                    </div>
                    @endif

                    <a href="{{ route('peta-penyalahgunaan.domisili') }}" class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Peta Kerawanan</p>
                            <p class="text-sm text-gray-500">Lihat peta</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-section {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }

    .form-section h4 {
        color: #374151;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

        .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input[readonly] {
        background-color: #f9fafb;
        color: #6b7280;
        cursor: not-allowed;
        border-color: #e5e7eb;
    }

    .form-input[readonly]:focus {
        border-color: #e5e7eb;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #3b82f6;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-primary:hover {
        background-color: #2563eb;
    }

    .btn-danger {
        background-color: #dc2626;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
    }

    .text-danger {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .text-success {
        color: #059669;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>
@endpush
@endsection
