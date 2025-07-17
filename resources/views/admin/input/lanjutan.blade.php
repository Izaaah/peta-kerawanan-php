@extends('layouts.superadmin-master')

@section('title', 'Input Data Lanjutan Penanganan')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4 py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Input Data Lanjutan Penanganan</h1>
            <p class="text-muted mb-0">Tambah data lanjutan penanganan kasus narkoba</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('super-admin.data.lanjutan') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Lanjutan Penanganan</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="lanjutanForm">
                        @csrf

                        <!-- Informasi Kasus -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-file-alt me-2"></i>Informasi Kasus
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nomor_kasus" class="form-label">Nomor Kasus <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nomor_kasus" name="nomor_kasus" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggal_penanganan" class="form-label">Tanggal Penanganan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_penanganan" name="tanggal_penanganan" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jenis_penanganan" class="form-label">Jenis Penanganan <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_penanganan" name="jenis_penanganan" required>
                                    <option value="">Pilih Jenis Penanganan</option>
                                    <option value="rehabilitasi">Rehabilitasi</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="pelatihan">Pelatihan Kerja</option>
                                    <option value="pendampingan">Pendampingan</option>
                                    <option value="pemantauan">Pemantauan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status_penanganan" class="form-label">Status Penanganan <span class="text-danger">*</span></label>
                                <select class="form-select" id="status_penanganan" name="status_penanganan" required>
                                    <option value="">Pilih Status</option>
                                    <option value="belum_mulai">Belum Mulai</option>
                                    <option value="sedang_berjalan">Sedang Berjalan</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="gagal">Gagal</option>
                                    <option value="putus">Putus</option>
                                </select>
                            </div>
                        </div>

                        <!-- Data TSK -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user me-2"></i>Data Tersangka (TSK)
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_tsk" class="form-label">Nama TSK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_tsk" name="nama_tsk" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nik_tsk" class="form-label">NIK TSK</label>
                                <input type="text" class="form-control" id="nik_tsk" name="nik_tsk" maxlength="16">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="umur_tsk" class="form-label">Umur TSK</label>
                                <input type="number" class="form-control" id="umur_tsk" name="umur_tsk" min="1" max="100">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin_tsk" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin_tsk" name="jenis_kelamin_tsk">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Detail Penanganan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-clipboard-list me-2"></i>Detail Penanganan
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lembaga_penanganan" class="form-label">Lembaga Penanganan <span class="text-danger">*</span></label>
                                <select class="form-select" id="lembaga_penanganan" name="lembaga_penanganan" required>
                                    <option value="">Pilih Lembaga</option>
                                    <option value="BNN">BNN</option>
                                    <option value="RSJ">Rumah Sakit Jiwa</option>
                                    <option value="Panti">Panti Rehabilitasi</option>
                                    <option value="Klinik">Klinik</option>
                                    <option value="Lembaga_Sosial">Lembaga Sosial</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_lembaga" class="form-label">Nama Lembaga</label>
                                <input type="text" class="form-control" id="nama_lembaga" name="nama_lembaga">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="alamat_lembaga" class="form-label">Alamat Lembaga</label>
                                <textarea class="form-control" id="alamat_lembaga" name="alamat_lembaga" rows="2"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telepon_lembaga" class="form-label">Telepon Lembaga</label>
                                <input type="text" class="form-control" id="telepon_lembaga" name="telepon_lembaga">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="durasi_penanganan" class="form-label">Durasi Penanganan (Hari)</label>
                                <input type="number" class="form-control" id="durasi_penanganan" name="durasi_penanganan" min="1">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="biaya_penanganan" class="form-label">Biaya Penanganan (Rp)</label>
                                <input type="number" class="form-control" id="biaya_penanganan" name="biaya_penanganan" step="1000">
                            </div>
                        </div>

                        <!-- Hasil Penanganan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-chart-line me-2"></i>Hasil Penanganan
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="hasil_penanganan" class="form-label">Hasil Penanganan</label>
                                <select class="form-select" id="hasil_penanganan" name="hasil_penanganan">
                                    <option value="">Pilih Hasil</option>
                                    <option value="berhasil">Berhasil</option>
                                    <option value="sebagian_berhasil">Sebagian Berhasil</option>
                                    <option value="gagal">Gagal</option>
                                    <option value="belum_diketahui">Belum Diketahui</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                                <select class="form-select" id="tindak_lanjut" name="tindak_lanjut">
                                    <option value="">Pilih Tindak Lanjut</option>
                                    <option value="pemantauan">Pemantauan Rutin</option>
                                    <option value="pendampingan">Pendampingan Lanjutan</option>
                                    <option value="pelatihan">Pelatihan Kerja</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="tidak_ada">Tidak Ada</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="keterangan_hasil" class="form-label">Keterangan Hasil</label>
                                <textarea class="form-control" id="keterangan_hasil" name="keterangan_hasil" rows="4"></textarea>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Tambahan
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="petugas_penanganan" class="form-label">Petugas Penanganan</label>
                                <input type="text" class="form-control" id="petugas_penanganan" name="petugas_penanganan">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="koordinator" class="form-label">Koordinator</label>
                                <input type="text" class="form-control" id="koordinator" name="koordinator">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="4"></textarea>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Data
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>Penting!</h6>
                        <ul class="mb-0">
                            <li>Data lanjutan penanganan untuk monitoring kasus</li>
                            <li>Terhubung dengan data individu TSK</li>
                            <li>Membantu evaluasi efektivitas penanganan</li>
                            <li>Data untuk laporan dan analisis</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian</h6>
                        <p class="mb-0">Pastikan semua field yang wajib (*) sudah diisi dengan benar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // NIK validation
    document.getElementById('nik_tsk').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });

    // Form submission
    document.getElementById('lanjutanForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Show success message
        alert('Data lanjutan penanganan berhasil disimpan!');

        // Reset form
        this.reset();
    });
});
</script>
@endsection
