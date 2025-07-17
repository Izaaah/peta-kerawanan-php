@extends('layouts.superadmin-master')

@section('title', 'Tambah Akun Media Sosial')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Akun Media Sosial</h1>
            <p class="text-sm text-gray-500">Form untuk input data akun media sosial</p>
        </div>
        <a href="{{ route('super-admin.data.medsos.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            <form action="{{ route('super-admin.data.medsos.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-hashtag mr-2"></i>Data Akun Media Sosial</h6>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Media Sosial <span class="text-red-500">*</span></label>
                        <select id="nama_media_sosial" name="nama_media_sosial" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="" disabled selected>Pilih Media Sosial</option>
                            <option value="instagram">Instagram</option>
                            <option value="facebook">Facebook</option>
                            <option value="tiktok">Tiktok</option>
                            <option value="telegram">Telegram</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <input
                            type="text"
                            id="nama_media_sosial_lainnya"
                            name="nama_media_sosial_lainnya"
                            class="w-full border-gray-300 rounded-md px-3 py-2 mt-2"
                            placeholder="Nama Media Sosial"
                            style="display: none;">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Akun <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_akun" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Link Akun</label>
                        <input type="url" name="link_akun" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <button type="reset" class="px-6 py-2 text-gray-800 bg-gray-200 rounded hover:bg-gray-300">
                        <i class="fas fa-undo mr-2"></i>Reset
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-6 order-1 lg:order-2">
            <div class="bg-white shadow rounded p-4 space-y-4">
                <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-400">
                    <h6 class="font-semibold text-blue-700 mb-2"><i class="fas fa-info-circle mr-2"></i>Informasi</h6>
                    <ul class="list-disc list-inside text-sm text-blue-800 space-y-1">
                        <li>Pastikan nama media sosial dan nama akun sudah benar</li>
                        <li>Jika memilih "Lainnya", isi nama media sosial secara manual</li>
                        <li>Link akun opsional, namun disarankan diisi untuk verifikasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const select = document.getElementById('nama_media_sosial');
    const inputLainnya = document.getElementById('nama_media_sosial_lainnya');
    select.addEventListener('change', function() {
        if (this.value === 'lainnya') {
            inputLainnya.style.display = 'block';
            inputLainnya.required = true;
        } else {
            inputLainnya.style.display = 'none';
            inputLainnya.required = false;
            inputLainnya.value = '';
        }
    });
    window.addEventListener('DOMContentLoaded', function() {
        if (select.value === 'lainnya') {
            inputLainnya.style.display = 'block';
            inputLainnya.required = true;
        }
    });
</script>
@endsection