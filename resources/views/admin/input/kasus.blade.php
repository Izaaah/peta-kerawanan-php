@extends('layouts.superadmin-master')

@section('title', 'Input Data Kasus Narkoba')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4 py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Input Data Kasus Narkoba</h1>
            <p class="text-muted mb-0">Tambah data kasus narkoba baru</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('super-admin.data.kasus') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Kasus Narkoba</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="kasusForm">
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
                                <label for="tanggal_kasus" class="form-label">Tanggal Kasus <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_kasus" name="tanggal_kasus" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jenis_kasus" class="form-label">Jenis Kasus <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_kasus" name="jenis_kasus" required>
                                    <option value="">Pilih Jenis Kasus</option>
                                    <option value="penyalahgunaan">Penyalahgunaan Narkotika</option>
                                    <option value="peredaran">Peredaran Gelap Narkotika</option>
                                    <option value="produksi">Produksi Narkotika</option>
                                    <option value="pengangkutan">Pengangkutan Narkotika</option>
                                    <option value="penyimpanan">Penyimpanan Narkotika</option>
                                    <option value="pengedaran">Pengedaran Narkotika</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status_kasus" class="form-label">Status Kasus <span class="text-danger">*</span></label>
                                <select class="form-select" id="status_kasus" name="status_kasus" required>
                                    <option value="">Pilih Status</option>
                                    <option value="penyidikan">Penyidikan</option>
                                    <option value="penuntutan">Penuntutan</option>
                                    <option value="persidangan">Persidangan</option>
                                    <option value="putusan">Putusan</option>
                                    <option value="eksekusi">Eksekusi</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>

                        <!-- Lokasi Kejadian -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi Kejadian
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi" value="Jawa Timur" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten <span class="text-danger">*</span></label>
                                <select class="form-select" id="kabupaten" name="kabupaten" required>
                                    <option value="">Pilih Kabupaten</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Malang">Malang</option>
                                    <option value="Sidoarjo">Sidoarjo</option>
                                    <option value="Gresik">Gresik</option>
                                    <option value="Mojokerto">Mojokerto</option>
                                    <option value="Pasuruan">Pasuruan</option>
                                    <option value="Probolinggo">Probolinggo</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select" id="kecamatan" name="kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_desa" class="form-label">Nama Desa <span class="text-danger">*</span></label>
                                <select class="form-select" id="nama_desa" name="nama_desa" required>
                                    <option value="">Pilih Desa</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="alamat_detail" class="form-label">Alamat Detail</label>
                                <textarea class="form-control" id="alamat_detail" name="alamat_detail" rows="3"></textarea>
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
                                <label for="nik" class="form-label">NIK TSK</label>
                                <input type="text" class="form-control" id="nik" name="nik" maxlength="16">
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

                            <div class="col-md-6 mb-3">
                                <label for="pekerjaan_tsk" class="form-label">Pekerjaan TSK</label>
                                <input type="text" class="form-control" id="pekerjaan_tsk" name="pekerjaan_tsk">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="pendidikan_tsk" class="form-label">Pendidikan TSK</label>
                                <select class="form-select" id="pendidikan_tsk" name="pendidikan_tsk">
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                        </div>

                        <!-- Barang Bukti -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-box me-2"></i>Barang Bukti
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jenis_narkotika" class="form-label">Jenis Narkotika <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_narkotika" name="jenis_narkotika" required>
                                    <option value="">Pilih Jenis Narkotika</option>
                                    <option value="Ganja">Ganja</option>
                                    <option value="Sabu">Sabu</option>
                                    <option value="Ekstasi">Ekstasi</option>
                                    <option value="Heroin">Heroin</option>
                                    <option value="Kokain">Kokain</option>
                                    <option value="Methadone">Methadone</option>
                                    <option value="Tramadol">Tramadol</option>
                                    <option value="Dextro">Dextro</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="skala_kelas" class="form-label">Skala Kelas <span class="text-danger">*</span></label>
                                <select class="form-select" id="skala_kelas" name="skala_kelas" required>
                                    <option value="">Pilih Skala</option>
                                    <option value="dibawah 10gr">Dibawah 10gr</option>
                                    <option value="dibawah1ons">Dibawah 1 ons</option>
                                    <option value="dibawah1kg">Dibawah 1kg</option>
                                    <option value="diatas1kg">Diatas 1kg</option>
                                    <option value="tidak tahu">Tidak Tahu</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jumlah_barang" class="form-label">Jumlah Barang <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" step="0.01" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="gram">Gram</option>
                                    <option value="kilogram">Kilogram</option>
                                    <option value="butir">Butir</option>
                                    <option value="strip">Strip</option>
                                    <option value="botol">Botol</option>
                                    <option value="lembar">Lembar</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nilai_barang" class="form-label">Nilai Barang (Rp)</label>
                                <input type="number" class="form-control" id="nilai_barang" name="nilai_barang" step="1000">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Napi">Napi</option>
                                    <option value="Non napi">Non napi</option>
                                </select>
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
                                <label for="peran_jaringan" class="form-label">Peran dalam Jaringan</label>
                                <select class="form-select" id="peran_jaringan" name="peran_jaringan">
                                    <option value="">Pilih Peran</option>
                                    <option value="koordinator informan">Koordinator Informan</option>
                                    <option value="informan">Informan</option>
                                    <option value="kurir">Kurir</option>
                                    <option value="gudang">Gudang</option>
                                    <option value="broker">Broker</option>
                                    <option value="bandar">Bandar</option>
                                    <option value="beking">Beking</option>
                                    <option value="tidak tahu">Tidak Tahu</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="residivis" class="form-label">Residivis</label>
                                <select class="form-select" id="residivis" name="residivis">
                                    <option value="">Pilih Status</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sumber_informasi" class="form-label">Sumber Informasi</label>
                                <select class="form-select" id="sumber_informasi" name="sumber_informasi">
                                    <option value="">Pilih Sumber</option>
                                    <option value="informan">Informan</option>
                                    <option value="analisa sosmed">Analisa Sosmed</option>
                                    <option value="analisa aliran dana">Analisa Aliran Dana</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="penyidik" class="form-label">Penyidik</label>
                                <input type="text" class="form-control" id="penyidik" name="penyidik">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="modus_operasi" class="form-label">Modus Operasi</label>
                                <textarea class="form-control" id="modus_operasi" name="modus_operasi" rows="3"></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
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
                            <li>Data kasus akan mempengaruhi tingkat kerawanan desa</li>
                            <li>Terhubung dengan data individu TSK</li>
                            <li>Data akan ditampilkan di peta kerawanan</li>
                            <li>Untuk analisis dan laporan</li>
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
    // Load kecamatan when kabupaten changes
    document.getElementById('kabupaten').addEventListener('change', function() {
        const kabupaten = this.value;
        const kecamatanSelect = document.getElementById('kecamatan');
        const namaDesaSelect = document.getElementById('nama_desa');

        // Reset kecamatan and nama desa
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        namaDesaSelect.innerHTML = '<option value="">Pilih Desa</option>';

        if (kabupaten) {
            // Sample kecamatan data - in real app, fetch from API
            const kecamatanData = {
                'Surabaya': ['Tegalsari', 'Genteng', 'Bubutan', 'Simokerto', 'Pabean Cantian'],
                'Malang': ['Klojen', 'Blimbing', 'Kedungkandang', 'Sukun', 'Lowokwaru'],
                'Sidoarjo': ['Sidoarjo', 'Buduran', 'Tarik', 'Tulangan', 'Candi'],
                'Gresik': ['Gresik', 'Kebomas', 'Manyar', 'Bungah', 'Driyorejo'],
                'Mojokerto': ['Mojokerto', 'Prajurit Kulon', 'Magersari', 'Kranggan']
            };

            if (kecamatanData[kabupaten]) {
                kecamatanData[kabupaten].forEach(kecamatan => {
                    const option = document.createElement('option');
                    option.value = kecamatan;
                    option.textContent = kecamatan;
                    kecamatanSelect.appendChild(option);
                });
            }
        }
    });

    // Load nama desa when kecamatan changes
    document.getElementById('kecamatan').addEventListener('change', function() {
        const kecamatan = this.value;
        const namaDesaSelect = document.getElementById('nama_desa');

        // Reset nama desa
        namaDesaSelect.innerHTML = '<option value="">Pilih Desa</option>';

        if (kecamatan) {
            // Sample nama desa data - in real app, fetch from API
            const namaDesaData = {
                'Tegalsari': ['Kedungdoro', 'Pacarkeling', 'Dr. Soetomo', 'Keputran'],
                'Genteng': ['Genteng', 'Kapasari', 'Ketabang', 'Embong Kaliasin'],
                'Bubutan': ['Bubutan', 'Alun-alun Contong', 'Gundih', 'Keputran'],
                'Simokerto': ['Simokerto', 'Simolawang', 'Tambakrejo', 'Kemlayan'],
                'Pabean Cantian': ['Pabean Cantian', 'Perak Utara', 'Perak Barat', 'Kemayoran']
            };

            if (namaDesaData[kecamatan]) {
                namaDesaData[kecamatan].forEach(desa => {
                    const option = document.createElement('option');
                    option.value = desa;
                    option.textContent = desa;
                    namaDesaSelect.appendChild(option);
                });
            }
        }
    });

    // NIK validation
    document.getElementById('nik').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });

    // Form submission
    document.getElementById('kasusForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Show success message
        alert('Data kasus narkoba berhasil disimpan!');

        // Reset form
        this.reset();
    });
});
</script>
@endsection
