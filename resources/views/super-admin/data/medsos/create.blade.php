@extends('layouts.superadmin-master')

@section('title', 'Tambah Akun Media Sosial')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Tambah Akun Media Sosial</h2>
        <form action="{{ route('super-admin.data.medsos.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Media Sosial</label>
                <select id="nama_media_sosial" name="nama_media_sosial" class="w-full border-gray-300 rounded px-3 py-2" required>
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
                    class="w-full border-gray-300 rounded px-3 py-2 mt-2"
                    placeholder="Nama Media Sosial"
                    style="display: none;">
                <!-- <div id="lainnya" class="hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama Akun</label>
                    <input type="text" name="nama_akun" class="w-full border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Link Akun</label>
                    <input type="url" name="link_akun" class="w-full border-gray-300 rounded px-3 py-2">
                </div>
                <div class="flex gap-2 mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('super-admin.data.medsos.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                </div>
        </form>
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
    // Jika ingin tetap muncul saat reload (misal validasi gagal)
    window.addEventListener('DOMContentLoaded', function() {
        if (select.value === 'lainnya') {
            inputLainnya.style.display = 'block';
            inputLainnya.required = true;
        }
    });
</script>
@endsection