@extends('layouts.superadmin-master')

@section('title', 'Input Management')

@section('content')
@include('components.superadmin-navbar')

<!-- Main Content: Card List Pilihan -->
<div class="container-fluid px-2 px-md-4 py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <div class="input-header-icon mb-3">
            <i class="fas fa-plus-circle"></i>
        </div>
        <h1 class="fw-bold mb-1" style="color:#059669; letter-spacing:1px;">Input Management</h1>
        <div class="text-muted mb-2">Tambah data baru ke dalam sistem SIJAGAD</div>
        <div class="small text-secondary">Pilih jenis data yang ingin Anda input di bawah ini</div>
    </div>

    <!-- Main Content -->
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <div class="card input-card p-4 p-md-5 mb-4">
                <form id="inputTypeForm" method="GET" autocomplete="off">
                    <label for="inputType" class="input-label">
                        <i class="fas fa-list me-2"></i>Jenis Input
                    </label>
                    <div class="input-group mb-4">
                        <span class="input-group-text bg-white border-end-0" style="border-radius:0.75rem 0 0 0.75rem;">
                            <i class="fas fa-layer-group text-success"></i>
                        </span>
                        <select class="form-select form-select-lg border-start-0" id="inputType" name="type" required style="border-radius:0 0.75rem 0.75rem 0;">
                            <option value="">-- Pilih Jenis Input --</option>
                            <option value="individu">Input Data Individu TSK</option>
                            <option value="pendukung">Input Data Pendukung Kasus</option>
                            <option value="lanjutan">Input Data Lanjutan Penanganan</option>
                            <option value="kasus">Input Data Kasus Narkoba</option>
                            <option value="desa">Input Data Desa Geojson</option>
                            {{-- <option value="penyalahguna">Input Data Daerah Penyalahguna</option>
                            <option value="penelundupan">Input Data Daerah Penyelundupan</option>
                            <option value="thm">Input Data THM dan Manager</option>
                            <option value="jaringan">Input Data Jaringan di Rutan dan Lapas</option>
                            <option value="objek">Input Data Objek Vital</option>
                            <option value="penggiat">Input Data Jaringan Penggiat</option>
                            <option value="informasi">Input Data Jaringan Informasi (Orang)</option> --}}
                            <option value="lsm">Input Data LSM Narkotika</option>
                            <option value="rehabilitasi">Input Data Lembaga Rehabilitasi</option>
                            <option value="ekspedisi">Input Data Ekspedisi</option>
                            <option value="transportasi">Input Data Jasa Transportasi</option>
                            <option value="penginapan">Input Data Penginapan (Hotel & Kost)</option>
                            <option value="medsos">Input Data Akun Sosmed</option>
                            <option value="transportasi">Input Data Umum Tempat Transportasi</option>
                            <option value="farmasi">Input Data Perusahan/Farmasi Prekursor</option>
                            <option value="vape">Input Data Penjual Vape</option>
                        </select>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-teal-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Penjual Vape -->
            <a href="{{ route('super-admin.data.vape.create') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-yellow-500 mr-2"></span>
                        <span class="text-sm font-semibold text-yellow-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 text-yellow-600 text-2xl mr-6">
                        <i class="fas fa-smoking"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-yellow-700">Penjual Vape</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Vape</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-yellow-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
            <!-- Farmasi/Prekursor -->
            <a href="{{ route('super-admin.data.farmasi.create') }}" class="block group">
                <div class="flex items-center bg-white rounded-xl shadow-sm px-6 py-4 hover:shadow-md transition">
                    <span class="flex items-center mr-6">
                        <span class="h-3 w-3 rounded-full bg-rose-500 mr-2"></span>
                        <span class="text-sm font-semibold text-rose-600">Active</span>
                    </span>
                    <span class="flex items-center justify-center h-12 w-12 rounded-full bg-rose-100 text-rose-600 text-2xl mr-6">
                        <i class="fas fa-pills"></i>
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-800 group-hover:text-rose-700">Farmasi/Prekursor</div>
                        <div class="text-sm text-gray-500 truncate">Input Data Farmasi</div>
                    </div>
                    <span class="ml-6 text-gray-400 group-hover:text-rose-600 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </a>
        </div>
        <div class="bg-green-50 border border-green-100 text-green-700 text-center mt-8 rounded-lg py-3 px-4 flex items-center justify-center gap-2">
            <i class="fas fa-info-circle"></i>
            <span>Anda dapat menambahkan data baru sesuai kebutuhan dengan memilih jenis input di atas.</span>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputTypeSelect = document.getElementById('inputType');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('inputTypeForm');

    // Enable/disable submit button based on selection
    inputTypeSelect.addEventListener('change', function() {
        submitBtn.disabled = !this.value;
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const selectedType = inputTypeSelect.value;
        if (!selectedType) return;
        const routes = {
            'individu': '{{ route('super-admin.input.individu') }}',
            'pendukung': '{{ route('super-admin.input.pendukung') }}',
            'lanjutan': '{{ route('super-admin.input.lanjutan') }}',
            'kasus': '{{ route('super-admin.input.kasus') }}',
            'desa': '{{ route('super-admin.input.desa') }}',
            'lsm': '{{ route('super-admin.data.lsm.create') }}',
            'medsos': '{{ route('super-admin.data.medsos.create') }}',
            'vape': '{{ route('super-admin.data.vape.create') }}',
            'farmasi': '{{ route('super-admin.data.farmasi.create') }}',
        };
        if (routes[selectedType]) {
            window.location.href = routes[selectedType];
        }
    });
    // Set initial state based on URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const typeParam = urlParams.get('type');
    if (typeParam && inputTypeSelect.querySelector(`option[value="${typeParam}"]`)) {
        inputTypeSelect.value = typeParam;
        submitBtn.disabled = false;
    }
});
</script>
@endsection
