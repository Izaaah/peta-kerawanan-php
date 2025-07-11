@extends('layouts.superadmin-master')

@section('title', 'Tambah Data Individu TSK')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Individu TSK</h1>
            <p class="text-muted mb-0">Input data individu TSK dengan korelasi kasus</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('super-admin.data.individu') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Individu TSK</h6>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('super-admin.data.individu.store') }}" method="POST" id="individuForm">
                        @csrf

                        <!-- Data Pribadi -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user me-2"></i>Data Pribadi
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                       id="nik" name="nik" value="{{ old('nik') }}" maxlength="16" required>
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nkk" class="form-label">Nomor KK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nkk') is-invalid @enderror"
                                       id="nkk" name="nkk" value="{{ old('nkk') }}" maxlength="16" required>
                                @error('nkk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Napi" {{ old('status') == 'Napi' ? 'selected' : '' }}>Napi</option>
                                    <option value="Non napi" {{ old('status') == 'Non napi' ? 'selected' : '' }}>Non napi</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Alamat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Data Alamat
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                       id="provinsi" name="provinsi" value="{{ old('provinsi', 'Jawa Timur') }}" required>
                                @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten <span class="text-danger">*</span></label>
                                <select class="form-select @error('kabupaten') is-invalid @enderror"
                                        id="kabupaten" name="kabupaten" required>
                                    <option value="">Pilih Kabupaten</option>
                                    @foreach($kabupatenList as $kabupaten)
                                        <option value="{{ $kabupaten }}" {{ old('kabupaten') == $kabupaten ? 'selected' : '' }}>
                                            {{ $kabupaten }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select @error('kecamatan') is-invalid @enderror"
                                        id="kecamatan" name="kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                                <select class="form-select @error('kelurahan') is-invalid @enderror"
                                        id="kelurahan" name="kelurahan" required>
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                                @error('kelurahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-users me-2"></i>Data Orang Tua
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                       id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nik_ayah" class="form-label">NIK Ayah</label>
                                <input type="text" class="form-control @error('nik_ayah') is-invalid @enderror"
                                       id="nik_ayah" name="nik_ayah" value="{{ old('nik_ayah') }}" maxlength="16">
                                @error('nik_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                       id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nik_ibu" class="form-label">NIK Ibu</label>
                                <input type="text" class="form-control @error('nik_ibu') is-invalid @enderror"
                                       id="nik_ibu" name="nik_ibu" value="{{ old('nik_ibu') }}" maxlength="16">
                                @error('nik_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Kasus -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Data Kasus
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="peran_jaringan" class="form-label">Peran dalam Jaringan <span class="text-danger">*</span></label>
                                <select class="form-select @error('peran_jaringan') is-invalid @enderror"
                                        id="peran_jaringan" name="peran_jaringan" required>
                                    <option value="">Pilih Peran</option>
                                    <option value="koordinator informan" {{ old('peran_jaringan') == 'koordinator informan' ? 'selected' : '' }}>Koordinator Informan</option>
                                    <option value="informan" {{ old('peran_jaringan') == 'informan' ? 'selected' : '' }}>Informan</option>
                                    <option value="kurir" {{ old('peran_jaringan') == 'kurir' ? 'selected' : '' }}>Kurir</option>
                                    <option value="gudang" {{ old('peran_jaringan') == 'gudang' ? 'selected' : '' }}>Gudang</option>
                                    <option value="broker" {{ old('peran_jaringan') == 'broker' ? 'selected' : '' }}>Broker</option>
                                    <option value="bandar" {{ old('peran_jaringan') == 'bandar' ? 'selected' : '' }}>Bandar</option>
                                    <option value="beking" {{ old('peran_jaringan') == 'beking' ? 'selected' : '' }}>Beking</option>
                                    <option value="tidak tahu" {{ old('peran_jaringan') == 'tidak tahu' ? 'selected' : '' }}>Tidak Tahu</option>
                                </select>
                                @error('peran_jaringan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jenis_narkotika" class="form-label">Jenis Narkotika</label>
                                <input type="text" class="form-control @error('jenis_narkotika') is-invalid @enderror"
                                       id="jenis_narkotika" name="jenis_narkotika" value="{{ old('jenis_narkotika') }}">
                                @error('jenis_narkotika')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="skala_kelas" class="form-label">Skala Kelas <span class="text-danger">*</span></label>
                                <select class="form-select @error('skala_kelas') is-invalid @enderror"
                                        id="skala_kelas" name="skala_kelas" required>
                                    <option value="">Pilih Skala</option>
                                    <option value="dibawah 10gr" {{ old('skala_kelas') == 'dibawah 10gr' ? 'selected' : '' }}>Dibawah 10gr</option>
                                    <option value="dibawah1ons" {{ old('skala_kelas') == 'dibawah1ons' ? 'selected' : '' }}>Dibawah 1 ons</option>
                                    <option value="dibawah1kg" {{ old('skala_kelas') == 'dibawah1kg' ? 'selected' : '' }}>Dibawah 1kg</option>
                                    <option value="diatas1kg" {{ old('skala_kelas') == 'diatas1kg' ? 'selected' : '' }}>Diatas 1kg</option>
                                    <option value="tidak tahu" {{ old('skala_kelas') == 'tidak tahu' ? 'selected' : '' }}>Tidak Tahu</option>
                                </select>
                                @error('skala_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sumber_informasi" class="form-label">Sumber Informasi</label>
                                <select class="form-select @error('sumber_informasi') is-invalid @enderror"
                                        id="sumber_informasi" name="sumber_informasi">
                                    <option value="">Pilih Sumber</option>
                                    <option value="informan" {{ old('sumber_informasi') == 'informan' ? 'selected' : '' }}>Informan</option>
                                    <option value="analisa sosmed" {{ old('sumber_informasi') == 'analisa sosmed' ? 'selected' : '' }}>Analisa Sosmed</option>
                                    <option value="analisa aliran dana" {{ old('sumber_informasi') == 'analisa aliran dana' ? 'selected' : '' }}>Analisa Aliran Dana</option>
                                </select>
                                @error('sumber_informasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="modus_operasi" class="form-label">Modus Operasi</label>
                                <textarea class="form-control @error('modus_operasi') is-invalid @enderror"
                                          id="modus_operasi" name="modus_operasi" rows="3">{{ old('modus_operasi') }}</textarea>
                                @error('modus_operasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="residivis" name="residivis"
                                           value="1" {{ old('residivis') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="residivis">
                                        Residivis
                                    </label>
                                </div>
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
                            <li>Data yang diinput akan otomatis berkorelasi dengan data kasus narkoba</li>
                            <li>Jika status "Napi" dipilih, data akan masuk ke tabel kasus narkoba</li>
                            <li>Data desa akan otomatis terhubung berdasarkan kelurahan/kecamatan</li>
                            <li>Pastikan data yang diinput sudah benar dan lengkap</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian</h6>
                        <p class="mb-0">NIK harus unik dan tidak boleh duplikat dalam sistem</p>
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
        const kelurahanSelect = document.getElementById('kelurahan');

        // Reset kecamatan and kelurahan
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

        if (kabupaten) {
            fetch(`/super-admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(kecamatan => {
                        const option = document.createElement('option');
                        option.value = kecamatan;
                        option.textContent = kecamatan;
                        kecamatanSelect.appendChild(option);
                    });
                });
        }
    });

    // Load kelurahan when kecamatan changes
    document.getElementById('kecamatan').addEventListener('change', function() {
        const kecamatan = this.value;
        const kelurahanSelect = document.getElementById('kelurahan');

        // Reset kelurahan
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

        if (kecamatan) {
            fetch(`/super-admin/api/desa-data?kecamatan=${encodeURIComponent(kecamatan)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.data) {
                        data.data.forEach(desa => {
                            const option = document.createElement('option');
                            option.value = desa.nama_desa;
                            option.textContent = desa.nama_desa;
                            kelurahanSelect.appendChild(option);
                        });
                    }
                });
        }
    });

    // NIK validation
    document.getElementById('nik').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });

    // NKK validation
    document.getElementById('nkk').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });
});
</script>
@endsection
