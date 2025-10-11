@extends('layouts.superadmin-master')

@section('content')
    <div class="mx-auto px-2 pt-1">
        <!-- Tab Navigation -->
        <div class="mb-2">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <!-- Tab Statistik (Active) -->
                    <button class="tab-button active" id="statistikTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            <span class="text-blue-600 font-medium">Statistik</span>
                        </div>
                    </button>

                    <!-- Tab Profil Organisasi (Inactive) -->
                    <button class="tab-button inactive" id="profilTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Profil Organisasi</span>
                        </div>
                    </button>

                    <!-- Tab Anggaran (Inactive) -->
                    <button class="tab-button inactive" id="anggaranTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Anggaran</span>
                        </div>
                    </button>

                    <!-- Tab Data Kabupaten (Hidden by default) -->
                    <button class="tab-button inactive hidden" id="dataKabupatenTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Data Kabupaten</span>
                        </div>
                    </button>

                    <!-- Tab Data Kecamatan (Hidden by default) -->
                    <button class="tab-button inactive hidden" id="dataKecamatanTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Data Kecamatan</span>
                        </div>
                    </button>

                    <!-- Tab Data Kabupaten NIK (Hidden by default) -->
                    <button class="tab-button inactive hidden" id="dataKabupatenNikTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Data Kabupaten NIK</span>
                        </div>
                    </button>

                    <!-- Tab Data Kecamatan NIK (Hidden by default) -->
                    <button class="tab-button inactive hidden" id="dataKecamatanNikTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Data Kecamatan NIK</span>
                        </div>
                    </button>
                </nav>
            </div>
        </div>

        {{-- Tab Contents --}}
        @include('super-admin.dashboard.statistik')
        @include('super-admin.dashboard.anggaran')
        @include('super-admin.dashboard.profil')

        {{-- Data Detail Tabs --}}
        @include('super-admin.dashboard.data-kabupaten')
        @include('super-admin.dashboard.data-kecamatan')
        @include('super-admin.dashboard.data-kabupaten-nik')
        @include('super-admin.dashboard.data-kecamatan-nik')

    </div>

    {{-- Styles --}}
    @include('super-admin.dashboard.styles')

    {{-- Modals --}}
    @include('super-admin.dashboard.modals')

    {{-- Scripts --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @include('super-admin.dashboard.scripts')
    @endpush
@endsection
