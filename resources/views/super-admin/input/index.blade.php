@extends('layouts.superadmin-master')

@section('title', 'Input Management')

@section('content')
@include('components.superadmin-navbar')

<style>
    .input-card {
        border-radius: 1.25rem;
        box-shadow: 0 4px 32px 0 rgba(0,0,0,0.08), 0 1.5px 4px 0 rgba(0,0,0,0.03);
        border: none;
        background: #fff;
        transition: box-shadow 0.2s;
    }
    .input-card:hover {
        box-shadow: 0 8px 40px 0 rgba(0,0,0,0.12), 0 2px 8px 0 rgba(0,0,0,0.04);
    }
    .input-header-icon {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 1rem auto;
        box-shadow: 0 2px 12px 0 rgba(16,185,129,0.15);
    }
    .input-label {
        font-weight: 600;
        color: #059669;
        margin-bottom: 0.5rem;
    }
    .form-select-lg {
        font-size: 1.15rem;
        padding: 0.75rem 1.5rem 0.75rem 2.5rem;
        border-radius: 0.75rem;
        background-position: 1rem center;
    }
    .btn-lg {
        font-size: 1.1rem;
        padding: 0.75rem 2.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        box-shadow: 0 2px 8px 0 rgba(5,150,105,0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-lg:active, .btn-lg:focus {
        background: #047857;
        box-shadow: 0 4px 16px 0 rgba(5,150,105,0.12);
    }
    @media (max-width: 600px) {
        .input-card { padding: 1.5rem !important; }
        .input-header-icon { width: 54px; height: 54px; font-size: 1.7rem; }
    }
</style>
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
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg" id="submitBtn" disabled>
                            <i class="fas fa-arrow-right me-2"></i>Lanjutkan
                        </button>
                    </div>
                </form>
                <div class="mt-4 pt-3 border-top text-center">
                    <span class="text-muted small">Tersedia <span class="fw-bold text-success">5</span> jenis input data utama.</span>
                </div>
            </div>
            <div class="alert alert-success text-center mt-3" style="border-radius:0.75rem;">
                <i class="fas fa-info-circle me-2"></i>
                Anda dapat menambahkan data baru sesuai kebutuhan dengan memilih jenis input di atas.
            </div>
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
            'desa': '{{ route('super-admin.input.desa') }}'
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
