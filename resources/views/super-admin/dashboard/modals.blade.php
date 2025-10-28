    <!-- Modal Semua Kabupaten -->
    <div id="allKabupatenModal" class="dashboard-content hidden">
        <div class="space-y-6">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Kabupaten/Kota Berdasarkan Jumlah Kasus
                </h3>
                <button id="closeKabupatenModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-auto flex-grow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kabupaten/Kota</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Kasus</th>
                            </tr>
                        </thead>
                        <tbody id="allKabupatenTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Semua Kecamatan -->
    <div id="allKecamatanModal"
        class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Kecamatan Berdasarkan Jumlah Kasus</h3>
                <button id="closeKecamatanModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-auto flex-grow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kecamatan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kabupaten/Kota</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Kasus</th>
                            </tr>
                        </thead>
                        <tbody id="allKecamatanTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <!-- Previous and Next buttons will appear automatically with pagination -->
                        {{ $allKecamatanTkpList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Anggaran -->
    <div id="tambahAnggaranModal"
        class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">

        <div
            class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto mt-10 transform transition-all duration-300 ease-in-out">

            <div class="relative px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Anggaran Baru</h3>
                <button id="closeModalBtn"
                    class="absolute top-[20px] right-4 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            {{-- <form action="#" method="POST" class="p-6 space-y-4"> --}}
            <form action="{{ route('super-admin.anggaran.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                @if (isset($errors) && $errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tipe Anggaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">TIPE ANGGARAN</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="tipe_anggaran" value="main" id="tipe_main" checked
                                class="mr-3 text-blue-600 focus:ring-blue-500" onchange="toggleParentSelection()">
                            <span class="text-sm font-medium text-gray-700">Kegiatan Utama (Main Activity)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="tipe_anggaran" value="sub" id="tipe_sub"
                                class="mr-3 text-blue-600 focus:ring-blue-500" onchange="toggleParentSelection()">
                            <span class="text-sm font-medium text-gray-700">Sub Kegiatan (Sub Activity)</span>
                        </label>
                    </div>
                </div>

                <!-- Parent Activity Selection (Hidden by default) -->
                <div id="parent_selection" class="hidden">
                    <label for="parent_id" class="block text-sm font-medium text-gray-700">KEGIATAN UTAMA</label>
                    <select id="parent_id" name="parent_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Kegiatan Utama</option>
                        @foreach ($anggaranList as $mainActivity)
                            <option value="{{ $mainActivity->id }}">{{ $mainActivity->akun }} -
                                {{ $mainActivity->kegiatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="akun" class="block text-sm font-medium text-gray-700">AKUN</label>
                    <input type="text" id="akun" name="akun"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm uppercase"
                        placeholder="Contoh: 3251 atau 3251.BKA.002.051.A">
                </div>

                <div>
                    <label for="kegiatan" class="block text-sm font-medium text-gray-700">KEGIATAN</label>
                    <textarea id="kegiatan" name="kegiatan" rows="3"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan deskripsi kegiatan"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="anggaran_sebelum" class="block text-sm font-medium text-gray-700">ANGGARAN SEBELUM
                            BLOKIR</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                Rp
                            </span>
                            <input type="number" id="anggaran_sebelum" name="anggaran_sebelum" step="0.01"
                                min="0"
                                class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="blokir" class="block text-sm font-medium text-gray-700">BLOKIR</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                Rp
                            </span>
                            <input type="number" id="blokir" name="blokir" step="0.01" min="0"
                                class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <button type="button" id="cancelModalBtn"
                        class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Anggaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Pegawai -->
    <div id="pegawaiModal" class="fixed inset-0 hidden items-center justify-center p-4 bg-black/50 z-[9999]">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Kelola Susunan Organisasi</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closePegawaiModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6 overflow-auto">

                {{-- FORM TAMBAH BANYAK --}}
                <div>
                    <h4 class="font-semibold mb-3">Tambah Banyak</h4>
                    <form id="pegawaiCreateForm" method="POST" action="{{ route('super-admin.pegawai.store') }}"
                        class="space-y-3">
                        @csrf

                        {{-- Dropdown Jabatan (dinamis dari controller) --}}
                        <label class="block text-sm font-medium">Jabatan</label>
                        <select name="jabatan" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatanList as $j)
                                <option value="{{ $j }}">{{ $j }}</option>
                            @endforeach
                        </select>

                        {{-- Nama[] dinamis --}}
                        <div class="space-y-2" id="namaWrapper">
                            <div class="flex gap-2">
                                <input type="text" name="nama[]" class="w-full border rounded px-3 py-2"
                                    placeholder="Nama Pegawai" required>
                                <button type="button" onclick="addNamaField()"
                                    class="px-3 py-2 bg-green-500 text-white rounded">+</button>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>

                {{-- FORM EDIT SATU ORANG --}}
                <div>
                    <h4 class="font-semibold mb-3">Edit Data</h4>
                    <form id="pegawaiEditForm" method="POST" action="#" class="space-y-3">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <input type="hidden" id="edit_id">
                        <div>
                            <label class="block text-sm font-medium">Nama</label>
                            <input type="text" id="edit_nama" name="nama"
                                class="w-full border rounded px-3 py-2" placeholder="Nama Pegawai">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jabatan</label>
                            <select id="edit_jabatan" name="jabatan" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach ($jabatanList as $j)
                                    <option value="{{ $j }}">{{ $j }}</option>
                                @endforeach
                                {{-- extra option kalau value edit tidak ada di list --}}
                                <option value="" id="edit_jabatan_extra" class="hidden"></option>
                            </select>
                        </div>

                        <div class="flex gap-2 pt-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                            <button type="button" onclick="clearEditForm()"
                                class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Bersihkan</button>
                        </div>
                    </form>

                </div>

                {{-- TABEL DATA --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-semibold">Daftar Pegawai</h4>
                        {{-- (Opsional) Filter cepat berdasarkan jabatan --}}
                        <form method="GET" action="" class="flex items-center gap-2">
                            <select name="filter_jabatan" class="border rounded px-2 py-1"
                                onchange="this.form.submit()">
                                <option value="">Semua Jabatan</option>
                                @foreach ($jabatanList as $j)
                                    <option value="{{ $j }}" @selected(request('filter_jabatan') === $j)>
                                        {{ $j }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="overflow-x-auto border rounded">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left">#</th>
                                    <th class="px-3 py-2 text-left">Nama</th>
                                    <th class="px-3 py-2 text-left">Jabatan</th>
                                    <th class="px-3 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawai as $i => $p)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-3 py-2">{{ $i + 1 }}</td>
                                        <td class="px-3 py-2">{{ $p->nama }}</td>
                                        <td class="px-3 py-2">{{ $p->jabatan }}</td>
                                        <td class="px-3 py-2">
                                            <div class="flex items-center justify-center gap-2">
                                                {{-- EDIT: isi form edit di panel kanan modal --}}
                                                <button type="button"
                                                    class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                                                    onclick="fillEditForm(this.dataset)"
                                                    data-id="{{ $p->id }}" data-nama="{{ $p->nama }}"
                                                    data-jabatan="{{ $p->jabatan }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                {{-- DELETE --}}
                                                <form method="POST"
                                                    action="{{ route('super-admin.pegawai.destroy', $p->id) }}"
                                                    onsubmit="return confirm('Yakin hapus {{ $p->nama }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-3 py-6 text-center text-gray-500">Belum ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Edit Komposisi -->
    <div id="komposisiModal" class="fixed inset-0 hidden items-center justify-center p-4 bg-black bg-opacity-50"
        style="z-index: 9999;">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="komposisiModalTitle">Edit Komposisi</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeKomposisiModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="komposisiForm" method="POST" action="{{ route('super-admin.komposisi.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="komposisiFormMethod" value="POST" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Bidang/Seksi</label>
                        <input name="bidang" id="komposisi_bidang" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Jumlah Personil</label>
                        <input name="jumlah_personil" id="komposisi_jumlah_personil" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">DSP Jumlah</label>
                        <input name="dsp_jumlah" id="komposisi_dsp_jumlah" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">DSP Terisi</label>
                        <input name="dsp_terisi" id="komposisi_dsp_terisi" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">DSP Kosong</label>
                        <input name="dsp_kosong" id="komposisi_dsp_kosong" type="number" min="0" readonly
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 uppercase">Keterangan</label>
                    <textarea name="keterangan" id="komposisi_keterangan" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeKomposisiModal()"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Anggaran -->
    <div id="anggaranModal" class="fixed inset-0 hidden items-center justify-center p-4 bg-black bg-opacity-50"
        style="z-index: 9999;">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="anggaranModalTitle">Edit Anggaran</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeAnggaranModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="anggaranForm" method="POST" action="{{ route('super-admin.anggaran.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="anggaranFormMethod" value="POST" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Akun</label>
                        <input name="akun" id="anggaran_akun" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Kegiatan</label>
                        <input name="kegiatan" id="anggaran_kegiatan" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Anggaran Sebelum
                            Blokir</label>
                        <input name="anggaran_sebelum" id="anggaran_sebelum" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Blokir</label>
                        <input name="blokir" id="anggaran_blokir" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Anggaran Setelah
                            Blokir</label>
                        <input name="anggaran_setelah" id="anggaran_setelah" type="number" min="0" readonly
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeAnggaranModal()"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Adding New Photo -->
    <div id="addPhotoModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Foto Baru</h3>

                <!-- Image Upload Form -->
                <form action="{{ route('super-admin.gallery.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Pilih Foto
                        </label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-200 hover:border-gray-400"
                            required>
                        <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 5MB</p>
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Deskripsi Foto
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-200 hover:border-gray-400 resize-none"
                            placeholder="Masukkan deskripsi foto (opsional)..."></textarea>
                        <p class="mt-1 text-xs text-gray-500">Deskripsi akan ditampilkan di bawah foto dalam galeri</p>
                    </div>

                    <!-- Preview Section -->
                    <div class="mt-4" id="imagePreview" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto</label>
                        <div class="relative">
                            <img id="previewImage" src="" alt="Preview"
                                class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            <div class="absolute top-2 right-2">
                                <button type="button" onclick="removePreview()"
                                    class="bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button"
                            class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors duration-200"
                            onclick="closeAddPhotoModal()">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md hover:from-blue-600 hover:to-blue-800 transition-all duration-200 transform hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Berita -->
    <div id="addNewsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Berita Eksternal</h3>

                <!-- News URL Form -->
                <form id="newsForm">
                    @csrf
                    <div class="mb-4">
                        <label for="newsUrl" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                            URL Berita
                        </label>
                        <input type="url" id="newsUrl" name="url"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-200 hover:border-gray-400"
                            placeholder="https://example.com/berita" required>
                        <p class="mt-1 text-xs text-gray-500">Masukkan URL lengkap berita yang ingin ditambahkan</p>
                    </div>

                    <!-- Preview Section -->
                    <div id="newsPreview" class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview Berita</label>
                        <div class="border border-gray-300 rounded-lg p-3 bg-gray-50">
                            <div class="flex space-x-3">
                                <img id="previewImage" src="" alt="Preview"
                                    class="w-16 h-16 object-cover rounded">
                                <div class="flex-1">
                                    <h4 id="previewTitle" class="font-semibold text-sm text-gray-900 line-clamp-2">
                                    </h4>
                                    <p id="previewDescription" class="text-xs text-gray-600 line-clamp-2 mt-1"></p>
                                    <p id="previewSource" class="text-xs text-gray-500 mt-1"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors duration-200"
                            onclick="closeAddNewsModal()">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </button>
                        <button type="submit" id="submitNewsBtn"
                            class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white text-sm font-medium rounded-md hover:from-green-600 hover:to-green-800 transition-all duration-200 transform hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tugas Pokok -->
    <div id="tugasModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center p-4"
        style="z-index: 1002;">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="tugasModalTitle">Edit Tugas Pokok</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeTugasModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="tugasForm" method="POST" action="{{ route('super-admin.tupoksi.tugas.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="tugasFormMethod" value="POST" />

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pasal</label>
                    <input name="pasal" id="tugas_pasal" type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: Pasal 9 Peraturan Kepala BNN Nomor 6 Tahun 2020" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Isi Tugas Pokok</label>
                    <textarea name="isi" id="tugas_isi" rows="6"
                        class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan isi tugas pokok..." required></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeTugasModal()"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>

            <!-- Daftar Tugas Pokok -->
            <div class="px-6 pb-6">
                <h4 class="text-md font-semibold text-gray-900 mb-3">Daftar Tugas Pokok</h4>
                <div class="space-y-3" id="tugasList">
                    <!-- Data akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Fungsi -->
    <div id="fungsiModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center p-4"
        style="z-index: 1002;">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="fungsiModalTitle">Edit Fungsi</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeFungsiModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="fungsiForm" method="POST" action="{{ route('super-admin.tupoksi.fungsi.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="fungsiFormMethod" value="POST" />

                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-md font-semibold text-gray-900">Daftar Fungsi</h4>
                    <button type="button" onclick="addFungsiField()"
                        class="px-3 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                        <i class="fas fa-plus mr-1"></i>Tambah Fungsi
                    </button>
                </div>

                <div id="fungsiFieldsContainer" class="space-y-3">
                    <!-- Dynamic fields will be added here -->
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeFungsiModal()"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700">Simpan Semua</button>
                </div>
            </form>

            <!-- Daftar Fungsi -->
            <div class="px-6 pb-6">
                <h4 class="text-md font-semibold text-gray-900 mb-3">Daftar Fungsi</h4>
                <div class="space-y-3" id="fungsiList">
                    <!-- Data akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>
