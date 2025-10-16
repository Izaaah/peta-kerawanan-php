@extends('layouts.admin-master')
@section('title', 'Tambah Perusahaan Farmasi/Prekursor')
@section('content')
<div class="container mx-auto px-4 py-3">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Perusahaan Farmasi/Prekursor</h1>
            <p class="text-sm text-gray-500">Form untuk input data perusahaan atau farmasi prekursor</p>
        </div>
        <a href="{{ route('admin.data.farmasi.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            <form action="{{ route('admin.data.farmasi.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-industry mr-2"></i>Data Perusahaan / Farmasi Prekursor</h6>

                    <!-- Dropdown Sub-Option dengan Tombol Tambah -->
                    <div class="mb-4">
                        <label for="farmasi_sub_option" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-list mr-2"></i>Pilih Jenis Farmasi/Prekursor
                        </label>
                        <div class="flex gap-2">
                            <select id="farmasi_sub_option" class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="perusahaan">Perusahaan</option>
                                <option value="farmasi">Farmasi</option>
                            </select>
                            <button type="button" onclick="addNewFarmasiType()"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 whitespace-nowrap">
                                <i class="fas fa-plus mr-1"></i>Tambah Jenis
                            </button>
                        </div>
                    </div>

                    <!-- Dynamic Fields Container for Perusahaan -->
                    <div id="farmasi-perusahaan-fields" class="farmasi-sub-fields hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                                <input type="text" name="farmasi[perusahaan_nama]" value="{{ old('farmasi.perusahaan_nama') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Manager</label>
                                <input type="text" name="farmasi[perusahaan_manager]" value="{{ old('farmasi.perusahaan_manager') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. HP</label>
                                <input type="text" name="farmasi[perusahaan_no_hp]" value="{{ old('farmasi.perusahaan_no_hp') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <textarea name="farmasi[perusahaan_lokasi]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.perusahaan_lokasi') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Prekusor</label>
                                <textarea name="farmasi[perusahaan_prekusor]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.perusahaan_prekusor') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ijin Penerbit</label>
                                <textarea name="farmasi[perusahaan_ijin_penerbit]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.perusahaan_ijin_penerbit') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="text" name="farmasi[perusahaan_jumlah]" value="{{ old('farmasi.perusahaan_jumlah') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tujuan</label>
                                <textarea name="farmasi[perusahaan_tujuan]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.perusahaan_tujuan') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Fields Container for Farmasi -->
                    <div id="farmasi-farmasi-fields" class="farmasi-sub-fields hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Farmasi</label>
                                <input type="text" name="farmasi[farmasi_nama]" value="{{ old('farmasi.farmasi_nama') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Manager</label>
                                <input type="text" name="farmasi[farmasi_manager]" value="{{ old('farmasi.farmasi_manager') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. HP</label>
                                <input type="text" name="farmasi[farmasi_no_hp]" value="{{ old('farmasi.farmasi_no_hp') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <textarea name="farmasi[farmasi_lokasi]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.farmasi_lokasi') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Prekusor</label>
                                <textarea name="farmasi[farmasi_prekusor]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.farmasi_prekusor') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ijin Penerbit</label>
                                <textarea name="farmasi[farmasi_ijin_penerbit]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.farmasi_ijin_penerbit') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="text" name="farmasi[farmasi_jumlah]" value="{{ old('farmasi.farmasi_jumlah') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tujuan</label>
                                <textarea name="farmasi[farmasi_tujuan]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('farmasi.farmasi_tujuan') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Container for Dynamically Added Types -->
                    <div id="farmasi-dynamic-container"></div>
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
                        <li>Pastikan semua data perusahaan / farmasi prekursor yang diinput sudah benar</li>
                        <li>No. HP harus dapat dihubungi</li>
                        <li>Data digunakan untuk keperluan verifikasi dan pelaporan</li>
                        <li>Isi data prekusor dan ijin penerbit dengan lengkap</li>
                    </ul>
                </div>
            </div>
            <div class="mt-4">
                <div class="bg-white shadow rounded p-6">
                    <h6 class="text-lg font-semibold text-green-700 mb-4 flex items-center">
                        <i class="fas fa-file-excel mr-2"></i>Import Data
                    </h6>

                    <!-- Download Template CSV -->
                    <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-download text-blue-600 mr-2"></i>
                                <span class="text-sm text-blue-800">Download template untuk format yang benar</span>
                            </div>
                            <a href="{{ route('admin.data.farmasi.template') }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                <i class="fas fa-file-csv mr-1"></i>
                                Download
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('admin.data.farmasi.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center sm:space-x-4 space-y-4 sm:space-y-0">
                        @csrf
                        <input type="file" name="file" accept=".csv,.txt" required class="block w-full text-sm text-gray-500">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center">
                            <i class="fas fa-file-csv mr-2"></i>Input
                        </button>
                    </form>

                    @error('file')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                    @if(session('success'))
                        <div class="mt-2 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mt-2 p-2 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========== Farmasi Sub-Option Handler ==========
    const farmasiSubOption = document.getElementById('farmasi_sub_option');
    let farmasiSubFields = document.querySelectorAll('.farmasi-sub-fields');
    const farmasiDynamicContainer = document.getElementById('farmasi-dynamic-container');
    let dynamicTypeCounter = 0;

    function updateFarmasiSubFields() {
        farmasiSubFields = document.querySelectorAll('.farmasi-sub-fields');
    }

    if (farmasiSubOption) {
        farmasiSubOption.addEventListener('change', function() {
            const selectedSubOption = this.value;

            // Hide all sub-fields
            farmasiSubFields.forEach(field => {
                field.classList.add('hidden');
            });

            // Show selected sub-fields
            if (selectedSubOption) {
                const selectedFields = document.getElementById(`farmasi-${selectedSubOption}-fields`);
                if (selectedFields) {
                    selectedFields.classList.remove('hidden');
                }
            }
        });
    }

    // ========== Add New Farmasi Type Function ==========
    window.addNewFarmasiType = function() {
        const typeName = prompt('Masukkan nama jenis farmasi/prekursor baru:\n(Contoh: Apotek, Distributor, Pabrik Obat, dll)');

        if (!typeName || typeName.trim() === '') {
            return;
        }

        const cleanTypeName = typeName.trim();
        const typeId = 'custom_' + (++dynamicTypeCounter);
        const typeSlug = cleanTypeName.toLowerCase().replace(/\s+/g, '_').replace(/[^a-z0-9_]/g, '');

        // Add option to dropdown
        const option = document.createElement('option');
        option.value = typeId;
        option.textContent = cleanTypeName;
        farmasiSubOption.appendChild(option);

        // Create dynamic fields container
        const fieldsContainer = document.createElement('div');
        fieldsContainer.id = `farmasi-${typeId}-fields`;
        fieldsContainer.className = 'farmasi-sub-fields hidden';
        fieldsContainer.innerHTML = `
            <div class="bg-gray-50 p-3 rounded mb-2 flex justify-between items-center">
                <h6 class="text-sm font-semibold text-gray-700">
                    <i class="fas fa-capsules mr-2"></i>${cleanTypeName}
                </h6>
                <button type="button" onclick="removeFarmasiType('${typeId}')"
                    class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                    <i class="fas fa-trash mr-1"></i>Hapus
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama ${cleanTypeName}</label>
                    <input type="text" name="farmasi[${typeSlug}_nama]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Manager</label>
                    <input type="text" name="farmasi[${typeSlug}_manager]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. HP</label>
                    <input type="text" name="farmasi[${typeSlug}_no_hp]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <textarea name="farmasi[${typeSlug}_lokasi]" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prekusor</label>
                    <textarea name="farmasi[${typeSlug}_prekusor]" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ijin Penerbit</label>
                    <textarea name="farmasi[${typeSlug}_ijin_penerbit]" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="text" name="farmasi[${typeSlug}_jumlah]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tujuan</label>
                    <textarea name="farmasi[${typeSlug}_tujuan]" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>
        `;

        farmasiDynamicContainer.appendChild(fieldsContainer);
        updateFarmasiSubFields();

        // Auto-select the new type
        farmasiSubOption.value = typeId;
        farmasiSubOption.dispatchEvent(new Event('change'));

        // Show success message
        alert(`✅ Jenis farmasi "${cleanTypeName}" berhasil ditambahkan!`);
    };

    // ========== Remove Farmasi Type Function ==========
    window.removeFarmasiType = function(typeId) {
        if (confirm('Yakin ingin menghapus jenis farmasi ini?')) {
            // Remove fields container
            const fieldsContainer = document.getElementById(`farmasi-${typeId}-fields`);
            if (fieldsContainer) {
                fieldsContainer.remove();
            }

            // Remove option from dropdown
            const option = farmasiSubOption.querySelector(`option[value="${typeId}"]`);
            if (option) {
                option.remove();
            }

            // Reset dropdown to empty
            farmasiSubOption.value = '';
            farmasiSubOption.dispatchEvent(new Event('change'));

            updateFarmasiSubFields();
        }
    };
});
</script>
@endpush
