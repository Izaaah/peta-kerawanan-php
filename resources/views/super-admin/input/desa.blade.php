@extends('layouts.superadmin-master')

@section('title', 'Input Data Desa Geojson')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4 py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Input Data Desa Geojson</h1>
            <p class="text-muted mb-0">Tambah data desa untuk peta kerawanan</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('super-admin.data.desa') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Desa Geojson</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="desaForm">
                        @csrf

                        <!-- Informasi Desa -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Informasi Desa
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_desa" class="form-label">Nama Desa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_desa" name="nama_desa" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
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
                                    <option value="Lamongan">Lamongan</option>
                                    <option value="Tuban">Tuban</option>
                                    <option value="Bojonegoro">Bojonegoro</option>
                                    <option value="Tulungagung">Tulungagung</option>
                                    <option value="Blitar">Blitar</option>
                                    <option value="Kediri">Kediri</option>
                                    <option value="Nganjuk">Nganjuk</option>
                                    <option value="Jombang">Jombang</option>
                                    <option value="Madiun">Madiun</option>
                                    <option value="Magetan">Magetan</option>
                                    <option value="Ngawi">Ngawi</option>
                                    <option value="Ponorogo">Ponorogo</option>
                                    <option value="Pacitan">Pacitan</option>
                                    <option value="Trenggalek">Trenggalek</option>
                                    <option value="Lumajang">Lumajang</option>
                                    <option value="Jember">Jember</option>
                                    <option value="Banyuwangi">Banyuwangi</option>
                                    <option value="Bondowoso">Bondowoso</option>
                                    <option value="Situbondo">Situbondo</option>
                                    <option value="Probolinggo">Probolinggo</option>
                                    <option value="Pamekasan">Pamekasan</option>
                                    <option value="Sampang">Sampang</option>
                                    <option value="Sumenep">Sumenep</option>
                                    <option value="Bangkalan">Bangkalan</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi" value="Jawa Timur" required>
                            </div>
                        </div>

                        <!-- Koordinat Geografis -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-globe me-2"></i>Koordinat Geografis
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label">Latitude (Garis Lintang) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="latitude" name="latitude" step="0.000001" required>
                                <small class="text-muted">Contoh: -7.983908</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label">Longitude (Garis Bujur) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="longitude" name="longitude" step="0.000001" required>
                                <small class="text-muted">Contoh: 112.621391</small>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="geometry" class="form-label">Geometry (GeoJSON) <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="geometry" name="geometry" rows="6" placeholder='{"type": "Polygon", "coordinates": [[[longitude1, latitude1], [longitude2, latitude2], ...]]}' required></textarea>
                                <small class="text-muted">Format GeoJSON Polygon untuk batas desa</small>
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
                                <label for="luas_wilayah" class="form-label">Luas Wilayah (km²)</label>
                                <input type="number" class="form-control" id="luas_wilayah" name="luas_wilayah" step="0.01">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                <input type="number" class="form-control" id="jumlah_penduduk" name="jumlah_penduduk">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kepadatan_penduduk" class="form-label">Kepadatan Penduduk (jiwa/km²)</label>
                                <input type="number" class="form-control" id="kepadatan_penduduk" name="kepadatan_penduduk" step="0.01">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tingkat_kerawanan" class="form-label">Tingkat Kerawanan</label>
                                <select class="form-select" id="tingkat_kerawanan" name="tingkat_kerawanan">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="Rendah">Rendah</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Tinggi">Tinggi</option>
                                    <option value="Sangat Tinggi">Sangat Tinggi</option>
                                </select>
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
                            <li>Data desa akan ditampilkan di peta kerawanan</li>
                            <li>Geometry harus dalam format GeoJSON yang valid</li>
                            <li>Koordinat harus akurat untuk tampilan peta</li>
                            <li>Data akan mempengaruhi analisis kerawanan</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian</h6>
                        <p class="mb-0">Pastikan format GeoJSON sudah benar dan valid</p>
                    </div>

                    <div class="alert alert-success">
                        <h6><i class="fas fa-lightbulb me-2"></i>Tips</h6>
                        <p class="mb-0">Gunakan tools seperti QGIS atau GeoJSON.io untuk membuat geometry yang akurat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calculate kepadatan penduduk automatically
    document.getElementById('luas_wilayah').addEventListener('input', calculateKepadatan);
    document.getElementById('jumlah_penduduk').addEventListener('input', calculateKepadatan);

    function calculateKepadatan() {
        const luas = parseFloat(document.getElementById('luas_wilayah').value) || 0;
        const penduduk = parseFloat(document.getElementById('jumlah_penduduk').value) || 0;

        if (luas > 0 && penduduk > 0) {
            const kepadatan = penduduk / luas;
            document.getElementById('kepadatan_penduduk').value = kepadatan.toFixed(2);
        }
    }

    // Validate geometry format
    document.getElementById('geometry').addEventListener('input', function() {
        const geometry = this.value;
        if (geometry) {
            try {
                JSON.parse(geometry);
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } catch (e) {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        }
    });

    // Form submission
    document.getElementById('desaForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate geometry
        const geometry = document.getElementById('geometry').value;
        if (geometry) {
            try {
                JSON.parse(geometry);
            } catch (e) {
                alert('Format Geometry tidak valid! Pastikan format GeoJSON sudah benar.');
                return;
            }
        }

        // Show success message
        alert('Data desa geojson berhasil disimpan!');

        // Reset form
        this.reset();
    });
});
</script>
@endsection
