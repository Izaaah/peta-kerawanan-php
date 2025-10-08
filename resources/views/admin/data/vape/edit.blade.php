@extends('layouts.admin-master')

@section('title', 'Edit Penjual Vape')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Edit Penjual Vape</h2>
            <form action="{{ route('admin.data.vape.update', $vape->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Nama Toko</label>
                            <input type="text" name="nama_toko" value="{{ old('nama_toko', $vape->nama_toko) }}"
                                class="w-full border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Pemilik</label>
                            <input type="text" name="pemilik" value="{{ old('pemilik', $vape->pemilik) }}"
                                class="w-full border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Lokasi</label>
                            <textarea name="lokasi" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('lokasi', $vape->lokasi) }}</textarea>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $vape->no_hp) }}"
                                class="w-full border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Liquid Dicurigai</label>
                            @php
                                $liquidsOld = old('liquid_dicurigai');
                                $liquids = is_array($liquidsOld)
                                    ? $liquidsOld
                                    : (is_array($vape->liquid_dicurigai)
                                        ? $vape->liquid_dicurigai
                                        : (empty($vape->liquid_dicurigai)
                                            ? ['']
                                            : [$vape->liquid_dicurigai]));
                            @endphp
                            <div id="liquid-container-edit">
                                @foreach ($liquids as $idx => $liquid)
                                    <div class="liquid-item flex items-center space-x-2 mb-2">
                                        <input type="text" name="liquid_dicurigai[]" value="{{ $liquid }}"
                                            class="flex-1 border-gray-300 rounded px-3 py-2">
                                        <button type="button" onclick="removeLiquidItemEdit(this)"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addLiquidItemEdit()"
                                class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah
                                Liquid</button>
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Distributor</label>
                            <textarea name="distributor" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('distributor', $vape->distributor) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('admin.data.vape.index') }}"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function addLiquidItemEdit() {
            const container = document.getElementById('liquid-container-edit');
            const div = document.createElement('div');
            div.className = 'liquid-item flex items-center space-x-2 mb-2';
            div.innerHTML = `
            <input type="text" name="liquid_dicurigai[]" class="flex-1 border-gray-300 rounded px-3 py-2">
            <button type="button" onclick="removeLiquidItemEdit(this)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
        `;
            container.appendChild(div);
        }

        function removeLiquidItemEdit(btn) {
            const container = document.getElementById('liquid-container-edit');
            if (container.children.length > 1) {
                btn.parentElement.remove();
            }
        }
    </script>
@endsection
