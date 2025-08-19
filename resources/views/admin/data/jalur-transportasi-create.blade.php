@extends('layouts.admin-master')

@section('title', 'Tambah Jalur Transportasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Jalur Transportasi</h1>
        <p class="text-gray-600">Menambahkan jalur transportasi antar titik masuk</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form id="jalurTransportasiForm" action="{{ route('admin.data.jalur-transportasi.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Titik Awal -->
                <div>
                    <label for="titik_awal_id" class="block text-sm font-medium text-gray-700">Titik Awal <span class="text-red-500">*</span></label>
                    <select name="titik_awal_id" id="titik_awal_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Titik Awal</option>
                        @foreach($titikMasukList as $titik)
                            <option value="{{ $titik->id }}" {{ old('titik_awal_id') == $titik->id ? 'selected' : '' }}>
                                {{ $titik->nama_tempat }} ({{ $titik->jenis_transportasi }}) - {{ $titik->kabupaten }}
                            </option>
                        @endforeach
                    </select>
                    @error('titik_awal_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Titik Tujuan -->
                <div>
                    <label for="titik_tujuan_id" class="block text-sm font-medium text-gray-700">Titik Tujuan <span class="text-red-500">*</span></label>
                    <select name="titik_tujuan_id" id="titik_tujuan_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Titik Tujuan</option>
                        @foreach($titikMasukList as $titik)
                            <option value="{{ $titik->id }}" {{ old('titik_tujuan_id') == $titik->id ? 'selected' : '' }}>
                                {{ $titik->nama_tempat }} ({{ $titik->jenis_transportasi }}) - {{ $titik->kabupaten }}
                            </option>
                        @endforeach
                    </select>
                    @error('titik_tujuan_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Jalur -->
                <div>
                    <label for="nama_jalur" class="block text-sm font-medium text-gray-700">Nama Jalur <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_jalur" id="nama_jalur" value="{{ old('nama_jalur') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Contoh: Jalur Malang-Surabaya" required>
                    @error('nama_jalur')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Transportasi -->
                <div>
                    <label for="jenis_transportasi" class="block text-sm font-medium text-gray-700">Jenis Transportasi <span class="text-red-500">*</span></label>
                    <select name="jenis_transportasi" id="jenis_transportasi" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Jenis Transportasi</option>
                        @foreach($jenisTransportasiOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('jenis_transportasi') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_transportasi')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estimasi Waktu -->
                <div>
                    <label for="estimasi_waktu" class="block text-sm font-medium text-gray-700">Estimasi Waktu (menit) <span class="text-red-500">*</span></label>
                    <input type="number" name="estimasi_waktu" id="estimasi_waktu" value="{{ old('estimasi_waktu') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="120" min="1" required>
                    @error('estimasi_waktu')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jarak -->
                <div>
                    <label for="jarak_km" class="block text-sm font-medium text-gray-700">Jarak (km) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="jarak_km" id="jarak_km" value="{{ old('jarak_km') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="50.5" min="0.01" required>
                    @error('jarak_km')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('status', 'aktif') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Keterangan -->
            <div class="mt-6">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Informasi tambahan tentang jalur transportasi">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Route Preview -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Preview Jalur</h3>
                <div id="routePreview" class="text-sm text-gray-600">
                    Pilih titik awal dan tujuan untuk melihat preview jalur
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.data.jalur-transportasi.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Simpan Jalur
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titikAwalSelect = document.getElementById('titik_awal_id');
    const titikTujuanSelect = document.getElementById('titik_tujuan_id');
    const routePreview = document.getElementById('routePreview');
    
    function updateRoutePreview() {
        const titikAwal = titikAwalSelect.options[titikAwalSelect.selectedIndex];
        const titikTujuan = titikTujuanSelect.options[titikTujuanSelect.selectedIndex];
        
        if (titikAwal.value && titikTujuan.value) {
            if (titikAwal.value === titikTujuan.value) {
                routePreview.innerHTML = '<span class="text-red-600">Error: Titik awal dan tujuan tidak boleh sama!</span>';
            } else {
                routePreview.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <span class="font-medium">${titikAwal.text}</span>
                        <span class="text-gray-400">→</span>
                        <span class="font-medium">${titikTujuan.text}</span>
                    </div>
                `;
            }
        } else {
            routePreview.innerHTML = 'Pilih titik awal dan tujuan untuk melihat preview jalur';
        }
    }
    
    titikAwalSelect.addEventListener('change', updateRoutePreview);
    titikTujuanSelect.addEventListener('change', updateRoutePreview);
    
    // Form validation
    document.getElementById('jalurTransportasiForm').addEventListener('submit', function(e) {
        const titikAwal = document.getElementById('titik_awal_id').value;
        const titikTujuan = document.getElementById('titik_tujuan_id').value;
        
        if (titikAwal === titikTujuan) {
            e.preventDefault();
            alert('Titik awal dan tujuan tidak boleh sama!');
            return false;
        }
    });
});
</script>
@endsection