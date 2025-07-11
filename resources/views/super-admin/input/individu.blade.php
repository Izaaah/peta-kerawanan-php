@extends('layouts.superadmin-master')

@section('title', 'Input Data Individu TSK')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-user-plus me-2"></i>
                    <span class="fw-bold">Form Input Data Individu TSK</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('super-admin.data.individu.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <!-- Data Pribadi -->
                        <h5 class="mb-3 mt-2"><i class="fas fa-id-card me-2 text-primary"></i>Data Pribadi</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control" required placeholder="Nama lengkap TSK">
                                <div class="invalid-feedback">Nama wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control" maxlength="16" required placeholder="Nomor Induk Kependudukan">
                                <div class="invalid-feedback">NIK wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Agama</label>
                                <select name="agama" class="form-select">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        </div>
                        <!-- Alamat -->
                        <h5 class="mb-3 mt-4"><i class="fas fa-map-marker-alt me-2 text-success"></i>Alamat</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Kabupaten/Kota</label>
                                <select name="kabupaten" id="kabupaten" class="form-select">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Malang">Malang</option>
                                    <option value="Sidoarjo">Sidoarjo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Desa/Kelurahan</label>
                                <select name="desa_id" id="desa" class="form-select">
                                    <option value="">Pilih Desa/Kelurahan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" rows="2" class="form-control" placeholder="Alamat lengkap"></textarea>
                            </div>
                        </div>
                        <!-- Data Kasus -->
                        <h5 class="mb-3 mt-4"><i class="fas fa-balance-scale me-2 text-warning"></i>Data Kasus</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kasus</label>
                                <select name="jenis_kasus" class="form-select">
                                    <option value="">Pilih Jenis Kasus</option>
                                    <option value="Narkoba">Narkoba</option>
                                    <option value="Narkotika">Narkotika</option>
                                    <option value="Psikotropika">Psikotropika</option>
                                    <option value="Prekursor">Prekursor</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status Kasus</label>
                                <select name="status_kasus" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="Proses">Dalam Proses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Batal">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Penangkapan</label>
                                <input type="date" name="tanggal_penangkapan" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Lokasi Penangkapan</label>
                                <input type="text" name="lokasi_penangkapan" class="form-control" placeholder="Lokasi penangkapan">
                            </div>
                        </div>
                        <!-- Keterangan -->
                        <h5 class="mb-3 mt-4"><i class="fas fa-info-circle me-2 text-info"></i>Keterangan Tambahan</h5>
                        <div class="mb-4">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="form-control" placeholder="Masukkan keterangan tambahan jika diperlukan..."></textarea>
                        </div>
                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('super-admin.input.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sidebar Info -->
        <div class="col-lg-4 d-none d-lg-block">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-info-circle me-2"></i>Petunjuk Pengisian
                </div>
                <div class="card-body">
                    <ul class="mb-0 small">
                        <li>Isi data individu TSK dengan lengkap dan benar.</li>
                        <li>Pastikan NIK dan nama sesuai dokumen resmi.</li>
                        <li>Alamat dan lokasi penangkapan harus detail.</li>
                        <li>Data ini akan digunakan untuk analisis dan peta kerawanan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Validasi Bootstrap
(function () {
    'use strict';
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
// Dynamic select (kabupaten -> kecamatan -> desa)
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('kabupaten').addEventListener('change', function() {
        const kabupaten = this.value;
        const kecamatanSelect = document.getElementById('kecamatan');
        const desaSelect = document.getElementById('desa');
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
        if (kabupaten) {
            const kecamatanOptions = {
                'Surabaya': ['Tegalsari', 'Genteng', 'Bubutan', 'Simokerto', 'Pabean Cantian'],
                'Malang': ['Klojen', 'Blimbing', 'Kedungkandang', 'Sukun', 'Lowokwaru'],
                'Sidoarjo': ['Tarik', 'Prambon', 'Krembung', 'Porong', 'Jabon']
            };
            const kecamatanList = kecamatanOptions[kabupaten] || [];
            kecamatanList.forEach(kecamatan => {
                const option = document.createElement('option');
                option.value = kecamatan;
                option.textContent = kecamatan;
                kecamatanSelect.appendChild(option);
            });
        }
    });
    document.getElementById('kecamatan').addEventListener('change', function() {
        const kecamatan = this.value;
        const desaSelect = document.getElementById('desa');
        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
        if (kecamatan) {
            const desaOptions = ['Desa A', 'Desa B', 'Desa C', 'Desa D', 'Desa E'];
            desaOptions.forEach(desa => {
                const option = document.createElement('option');
                option.value = desa;
                option.textContent = desa;
                desaSelect.appendChild(option);
            });
        }
    });
});
</script>
@endsection
