        <!-- Konten Profil Organisasi -->
        <div id="profilContent" class="dashboard-content hidden">
            <div class="bg-white rounded-lg shadow-lg p-4 lg:p-6">
                <div class="mb-6 text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo BNN" class="h-16 mb-2 mx-auto">
                    <div>
                        <h2 class="text-base lg:text-lg font-bold text-gray-900">BADAN NARKOTIKA NASIONAL</h2>
                        <h3 class="text-base lg:text-lg font-bold text-gray-900">PROVINSI JAWA TIMUR</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8">
                </div>

                <!-- Tugas Pokok dan Fungsi -->
                <div class="mt-5 space-y-8 lg:space-y-12 mx-auto px-2 lg:px-4">
                    <div class="relative pb-6">
                        <h4
                            class="text-xl lg:text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-red-600 pb-3">
                            Tugas Pokok dan Fungsi (Tupoksi) Bidang Pemberantasan dan Intelijen</h4>
                        <div
                            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                        </div>
                    </div>

                    <!-- Tugas Pokok -->
                    <div
                        class="bg-gradient-to-br from-white to-blue-50 rounded-base shadow-lg p-4 lg:p-8 border-t border-l border-blue-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-1 gap-2">
                            <h5 class="text-lg lg:text-2xl font-bold text-black tracking-tight">Tugas Pokok Bidang Pemberantasan
                                dan
                                Intelijen</h5>
                            <button type="button" onclick="openTugasModal()"
                                class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Edit Tugas Pokok
                            </button>
                        </div>
                        <div class="pl-2 lg:pl-5 pr-2 lg:pr-4">
                            <div class="text-gray-700 leading-relaxed text-base lg:text-lg bg-white bg-opacity-50 p-2 lg:p-4 ml-2 lg:ml-5 font-sans"
                                id="tugasContent">
                                @if (isset($tugas) && $tugas->count() > 0)
                                    @foreach ($tugas as $t)
                                        <p>
                                            <span class="font-bold">{{ $t->pasal }}</span>:<br>
                                            <span class="italic"><span
                                                    class="font-bold">"</span>{{ $t->isi }}<span
                                                    class="font-bold">"</span></span>
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 italic">Belum ada data tugas pokok. Klik tombol "Edit Tugas
                                        Pokok" untuk menambahkan data.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Fungsi -->
                    <div
                        class="bg-gradient-to-br from-white to-green-50 rounded-base shadow-lg p-4 lg:p-8 border-t border-l border-green-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden mb-8">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4 gap-4">
                            <div class="items-center">
                                <h5 class="text-lg lg:text-2xl font-bold text-black tracking-tight">Fungsi Bidang
                                    Pemberantasan</h5>
                                <p class="font-bold">Sesuai Pasal 10, Peraturan Kepala BNN Nomor 6 Tahun 2020:</p>
                                <p class="italic">Dalam melaksanakan tugas sebagaimana dimaksud dalam Pasal 9, Bidang
                                    Pemberantasan dan Intelijen menyelenggarakan fungsi: </p>
                            </div>
                            <button type="button" onclick="openFungsiModal()"
                                class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-green-600 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Edit Fungsi
                            </button>
                        </div>
                        <div class="pl-1 lg:pr-4">
                            <div class="bg-white bg-opacity-50 p-2 lg:p-4 rounded-xl shadow-sm">
                                <ul class="space-y-4 list-none" id="fungsiContent">
                                    @if (isset($fungsi) && $fungsi->count() > 0)
                                        @foreach ($fungsi as $index => $f)
                                            <li
                                                class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                                <div class="flex-shrink-0 mt-1">
                                                    <span
                                                        class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                        <span
                                                            class="text-white text-xs font-bold">{{ $index + 1 }}</span>
                                                    </span>
                                                </div>
                                                <p
                                                    class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                                    {{ $f->isi }}</p>
                                            </li>
                                        @endforeach
                                    @else
                                        <li
                                            class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                            <div class="flex-shrink-0 mt-1">
                                                <span
                                                    class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-gray-400 to-gray-500 group-hover:from-gray-500 group-hover:to-gray-600 transition-all duration-200 shadow-sm">
                                                    <span class="text-white text-xs font-bold">?</span>
                                                </span>
                                            </div>
                                            <p class="ml-4 text-gray-500 italic">Belum ada data fungsi. Klik tombol
                                                "Edit
                                                Fungsi" untuk menambahkan data.</p>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Struktur Organisasi -->
                    <div class="mt-8 lg:mt-12 max-w-6xl mx-auto px-2 lg:px-4">
                        <div class="relative pb-6 mb-8">
                            <h4
                                class="text-xl lg:text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-red-600 pb-3">
                                Struktur Organisasi</h4>
                            <div
                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                            </div>
                            <div class="absolute right-0 top-0">
                                <button type="button" onclick="openPegawaiModal()"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Kelola Susunan
                                </button>
                                {{-- <a href="{{ route('admin.data.index') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Edit Struktur
                                </a> --}}
                            </div>
                        </div>

                        <!-- Struktur Organisasi -->
                        <div
                            class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-xl border border-blue-100 overflow-hidden relative mb-8 lg:mb-12 mt-4 lg:mt-8 p-4 lg:p-8">
                            <div id="orgChart" class="org-chart-container">
                                <!-- Background decorative elements -->
                                <div
                                    class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full opacity-30 -mr-32 -mt-32 z-0">
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-red-100 to-red-50 rounded-full opacity-30 -ml-32 -mb-32 z-0">
                                </div>

                                <div class="org-chart relative space-y-4 lg:space-y-8">

                                    <!-- Level 1: Kepala BNNP Jatim -->
                                    <div class="relative flex flex-col items-center">
                                        <div
                                            class="flex items-center bg-gradient-to-r from-red-600 to-red-700 text-white shadow-xl p-3 lg:p-6 rounded-xl border-2 border-red-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[280px] lg:min-w-[400px]">
                                            <div
                                                class="w-12 h-12 lg:w-20 lg:h-20 bg-white mr-2 lg:mr-5 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                <svg class="w-6 h-6 lg:w-12 lg:h-12 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                @php $ketua = $pegawai->where('jabatan','Ketua')->first(); @endphp
                                                <div class="text-white font-bold text-sm lg:text-xl">Kepala BNNP Jatim</div>
                                                <div class="text-white text-xs lg:text-lg">{{ $ketua->nama ?? '-' }}</div>
                                            </div>
                                        </div>

                                        <!-- Vertical connector -->
                                        <div class="h-6 lg:h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>

                                        <!-- Horizontal connector -->
                                        <div
                                            class="w-full h-1 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300">
                                        </div>

                                        <!-- Vertical connectors for subordinates -->
                                        <div class="flex w-full justify-between px-4 lg:px-8">
                                            <div class="h-6 lg:h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                            <div class="h-6 lg:h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                        </div>
                                    </div>

                                    <!-- Level 2: Kabid Pemberantasan dan Kabag Umum -->
                                    <div
                                        class="relative flex flex-col lg:flex-row justify-between items-start lg:space-x-16 space-y-4 lg:space-y-0">

                                        <!-- Kabid Pemberantasan dan Intelijen -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-xl p-3 lg:p-5 rounded-xl border-2 border-blue-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[250px] lg:min-w-[350px]">
                                                <div
                                                    class="w-10 h-10 lg:w-16 lg:h-16 bg-white mr-2 lg:mr-4 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-5 h-5 lg:w-10 lg:h-10 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kabidPemberantasan = $pegawai->where('jabatan','Kabid Pemberantasan')->first(); @endphp
                                                    <div class="text-white font-bold text-sm lg:text-lg">Kabid Pemberantasan dan
                                                        Intelijen</div>
                                                    <div class="text-white text-xs lg:text-base">
                                                        {{ $kabidPemberantasan->nama ?? '-' }}</div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to Kasi -->
                                            <div class="h-8 lg:h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-2 lg:mt-4">
                                            </div>

                                            <!-- Horizontal connector to Kasi -->
                                            <div
                                                class="w-full h-1 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300">
                                            </div>

                                            <!-- Vertical connectors for Kasi -->
                                            <div class="flex w-full justify-between px-6 lg:px-12">
                                                <div class="h-8 lg:h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                                <div class="h-8 lg:h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                            </div>
                                        </div>

                                        <!-- Kabag Umum -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-green-600 to-green-700 text-white shadow-xl p-3 lg:p-5 rounded-xl border-2 border-green-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[250px] lg:min-w-[350px]">
                                                <div
                                                    class="w-10 h-10 lg:w-16 lg:h-16 bg-white mr-2 lg:mr-4 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-5 h-5 lg:w-10 lg:h-10 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kabagUmum = $pegawai->where('jabatan','Kabag Umum')->first(); @endphp
                                                    <div class="text-white font-bold text-sm lg:text-lg">Kabag Umum</div>
                                                    <div class="text-white text-xs lg:text-base">{{ $kabagUmum->nama ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to Koordinator -->
                                            <div class="h-8 lg:h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-2 lg:mt-4">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Level 3: Kasi Intelijen, Kasi Wastahti, dan Koordinator -->
                                    <div
                                        class="relative flex flex-col lg:flex-row justify-between items-start lg:space-x-8 space-y-4 lg:space-y-0">

                                        <!-- Kasi Intelijen -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-xl p-2 lg:p-4 rounded-xl border-2 border-purple-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[200px] lg:min-w-[280px]">
                                                <div
                                                    class="w-8 h-8 lg:w-14 lg:h-14 bg-white mr-2 lg:mr-3 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-4 h-4 lg:w-8 lg:h-8 text-purple-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kasiIntelijen = $pegawai->where('jabatan','Kasi Intelijen')->first(); @endphp
                                                    <div class="text-white font-bold text-xs lg:text-base">Kasi Intelijen</div>
                                                    <div class="text-white text-xs lg:text-sm">{{ $kasiIntelijen->nama ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to staff -->
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-3">
                                            </div>
                                        </div>

                                        <!-- Kasi Wastahti -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-orange-600 to-orange-700 text-white shadow-xl p-4 rounded-xl border-2 border-orange-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[280px]">
                                                <div
                                                    class="w-14 h-14 bg-white mr-3 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-8 h-8 text-orange-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kasiWastahti = $pegawai->where('jabatan','Kasi Wastahti')->first(); @endphp
                                                    <div class="text-white font-bold text-base">Kasi Wastahti</div>
                                                    <div class="text-white text-sm">{{ $kasiWastahti->nama ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to staff -->
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-3">
                                            </div>
                                        </div>

                                        <!-- Koordinator dan Kelompok Jabatan Fungsional -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-gray-600 to-gray-700 text-white shadow-xl p-4 rounded-xl border-2 border-gray-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[280px]">
                                                <div
                                                    class="w-14 h-14 bg-white mr-3 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-8 h-8 text-gray-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    <div class="text-white font-bold text-base">Koordinator dan
                                                        Kelompok
                                                        Jabatan Fungsional</div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to staff -->
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Staff Level -->
                            <div class="mt-4 lg:mt-8 grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">

                                <!-- Staff di bawah Kasi Intelijen -->
                                <div class="space-y-4">
                                    <h5 class="text-sm lg:text-lg font-bold text-gray-800 text-center mb-2 lg:mb-4">Staff Sie Intelijen
                                    </h5>

                                    <!-- Analisis Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 lg:p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-sm lg:text-base mb-2">Analisis Intelijen
                                            </div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan', 'Analisis Intelijen') as $analisisIntelijen)
                                                        <li>{{ $analisisIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Penyidik Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Penyidik Sie
                                                Intelijen
                                            </div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Penyidik Sie Intelijen') as $penyidikSieIntelijen)
                                                        <li>{{ $penyidikSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Petugas Pengejaran Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Petugas Pengejaran
                                                Sie
                                                Intelijen</div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Petugas Pengejaran') as $petugasPengejaranSieIntelijen)
                                                        <li>{{ $petugasPengejaranSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Petugas Penindakan Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Petugas Penindakan
                                                Sie
                                                Intelijen</div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Petugas Penindakan Sie Intelijen') as $petugasPenindakanSieIntelijen)
                                                        <li>{{ $petugasPenindakanSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pengolah Data Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Pengolah Data Sie
                                                Intelijen
                                            </div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Pengolah Data Sie Intelijen') as $pengolahDataSieIntelijen)
                                                        <li>{{ $pengolahDataSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff di bawah Kasi Wastahti -->
                                <div class="space-y-4">
                                    <h5 class="text-lg font-bold text-gray-800 text-center mb-4">Staff Sie Wastahti
                                    </h5>

                                    <!-- Penjaga Tahanan -->
                                    <div
                                        class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-4 border border-orange-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-orange-800 font-bold text-base mb-2">Penjaga Tahanan</div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Penjaga Tahanan') as $penjagaTahanan)
                                                        <li>{{ $penjagaTahanan->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pengadministrasian Umum -->
                                    <div
                                        class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-4 border border-orange-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-orange-800 font-bold text-base mb-2">Pengadministrasian
                                                Umum
                                            </div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Pengadministrasian Umum') as $pengadministrasianUmum)
                                                        <li>{{ $pengadministrasianUmum->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-xl p-4 lg:p-8 border border-blue-100 overflow-hidden relative mb-8 lg:mb-12">
                        <div class="space-y-6">
                            <!-- Tabel Komposisi -->
                            <div class="relative pb-6 mb-8">
                                <h4
                                    class="text-xl lg:text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-red-600 pb-3">
                                    Komposisi Personil Pemberantasan</h4>
                                <div
                                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow">
                            <div class="relative px-4 lg:px-6 py-4 border-b border-gray-200">
                                <h3 class="text-base lg:text-lg font-semibold text-gray-900">Rincian Komposisi</h3>
                                <div class="absolute right-0 top-0 mt-3 mr-2 lg:mr-4">
                                    <a href="#" onclick="openKomposisiModal()"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                        Tambah Komposisi
                                    </a>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th rowspan="2"
                                                class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider border-r">
                                                BIDANG/SEKSI
                                            </th>
                                            <th rowspan="2"
                                                class="px-2 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider border-r">
                                                JUMLAH <br>PERSONIL
                                            </th>
                                            <th colspan="3"
                                                class="px-4 py-3 text-center text-base font-medium text-gray-500 uppercase tracking-wider border-b border-r">
                                                DSP
                                            </th>
                                            <th rowspan="2"
                                                class="px-6 py-3 text-center text-base font-medium text-gray-500 uppercase tracking-wider border-r">
                                                KETERANGAN
                                            </th>
                                            <th rowspan="2"
                                                class="px-2 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                                AKSI
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                                JUMLAH</th>
                                            <th
                                                class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                                TERISI</th>
                                            <th
                                                class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                                KOSONG</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($komposisiList as $komposisi)
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-3 whitespace-nowrap text-left text-sm font-medium text-gray-900 border-r uppercase">
                                                    {{ $komposisi->bidang }}</td>
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-green-100 text-center border-r">
                                                    {{ $komposisi->jumlah_personil }}</td>
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-blue-100 text-center border-r">
                                                    {{ $komposisi->dsp_jumlah }}</td>
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-red-100 text-center border-r">
                                                    {{ $komposisi->dsp_kosong }}</td>
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-yellow-100 text-center border-r">
                                                    {{ $komposisi->dsp_terisi }}</td>
                                                <td
                                                    class="px-6 py-3 text-sm text-gray-900 bg-white text-left border-r">
                                                    {{ $komposisi->keterangan }}</td>
                                                <td class="flex items-center justify-center space-x-2">
                                                    {{-- Tombol Edit --}}
                                                    <a href="#" onclick="openKomposisiModal(this.dataset)"
                                                        data-id="{{ $komposisi->id }}"
                                                        data-bidang="{{ $komposisi->bidang }}"
                                                        data-jumlah_personil="{{ $komposisi->jumlah_personil }}"
                                                        data-dsp_jumlah="{{ $komposisi->dsp_jumlah }}"
                                                        data-dsp_terisi="{{ $komposisi->dsp_terisi }}"
                                                        data-dsp_kosong="{{ $komposisi->dsp_kosong }}"
                                                        data-keterangan="{{ $komposisi->keterangan }}"
                                                        class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>

                                                    {{-- Tombol Delete --}}
                                                    <form
                                                        action="{{ route('super-admin.komposisi.destroy', $komposisi->id) }}"
                                                        method="POST" onsubmit="return confirmDeleteKomposisi(event)"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-red-600 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"
                                                    class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                                    Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="1"
                                                class="px-6 py-4 text-center text-sm font-bold border-r text-gray-900">
                                                TOTAL</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-green-100 border-r">
                                                {{ $totalPersonil }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-blue-100 border-r">
                                                {{ $totalDspJumlah }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-red-100 border-r">
                                                {{ $totalDspTerisi }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-yellow-100 border-r">
                                                {{ $totalDspKosong }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- Removed all extra table elements that were outside the table structure -->
                            </div>
                        </div>


                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-white to-blue-50 w-full shadow-xl p-4 lg:p-8 border border-blue-100 overflow-hidden relative mb-8 lg:mb-12">
                    <!-- New Gallery Section Below Komposisi Personil -->
                    <div id="gallery-section" class="gallery-section">
                        <div class="relative mb-8">
                            <h4
                                class="text-xl lg:text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-red-600 pb-3">
                                Galeri Foto
                            </h4>
                            <div
                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                            </div>
                        </div>

                        <!-- Add Photo Button -->
                        <div class="text-center mb-4">
                            <button id="addPhotoBtn"
                                class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                Tambah Foto
                            </button>
                        </div>

                        <!-- Gallery Container -->
                        <div class="flex justify-center items-center px-2">
                            @if (isset($galeri) && count($galeri) > 0)
                                <div class="relative w-full max-w-6xl">
                                    <!-- Carousel Container -->
                                    <div class="relative overflow-hidden rounded-2xl">
                                        <!-- Main Gallery Display -->
                                        <div class="flex items-center justify-center space-x-2 lg:space-x-4 py-4 lg:py-8">

                                            <!-- Previous Image (Left) -->
                                            <div class="flex-shrink-0 transform scale-75 opacity-50 blur-sm transition-all duration-500 hidden sm:block"
                                                id="prevImageContainer">
                                                <div
                                                    class="w-32 h-32 lg:w-64 lg:h-64 bg-gray-200 rounded-xl overflow-hidden shadow-lg">
                                                    <img id="prevImage" src="" alt="Previous"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            </div>

                                            <!-- Current Image (Center) -->
                                            <div class="flex-shrink-0 transform scale-100 opacity-100 transition-all duration-500"
                                                id="currentImageContainer">
                                                <div
                                                    class="relative w-64 h-64 lg:w-96 lg:h-96 bg-gray-200 rounded-xl overflow-hidden shadow-2xl">
                                                    <img id="galleryImage"
                                                        src="{{ asset('storage/' . $galeri[0]->image_path) }}"
                                                        alt="Current"
                                                        class="w-full h-full object-cover transition-all duration-700 ease-in-out">
                                                    <div id="imageDescription"
                                                        class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black via-black/70 to-transparent text-white p-4 text-sm">
                                                        <div class="font-semibold">
                                                            {{ $galeri[0]->description ?? 'No Description' }}</div>
                                                    </div>

                                                    <!-- Delete Button -->
                                                    <button id="deleteCurrentBtn"
                                                        class="absolute top-4 right-4 bg-red-500/80 backdrop-blur-sm text-white p-2 rounded-full hover:bg-red-600/90 transition-all duration-300 shadow-lg hover:scale-110"
                                                        onclick="deleteCurrentImage()" title="Hapus Foto">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>

                                                    <!-- Navigation Buttons -->
                                                    <button id="prevBtn"
                                                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-all duration-300 shadow-lg">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                        </svg>
                                                    </button>
                                                    <button id="nextBtn"
                                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-all duration-300 shadow-lg">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Next Image (Right) -->
                                            <div class="flex-shrink-0 transform scale-75 opacity-50 blur-sm transition-all duration-500 hidden sm:block"
                                                id="nextImageContainer">
                                                <div
                                                    class="w-32 h-32 lg:w-64 lg:h-64 bg-gray-200 rounded-xl overflow-hidden shadow-lg">
                                                    <img id="nextImage" src="" alt="Next"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Dots Indicator -->
                                        <div class="flex justify-center space-x-2 mt-4" id="dotsContainer">
                                            @foreach ($galeri as $index => $image)
                                                <button
                                                    class="dot w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-blue-600 scale-125' : 'bg-gray-300 hover:bg-gray-400' }}"
                                                    data-index="{{ $index }}"></button>
                                            @endforeach
                                        </div>

                                        <!-- Timer Display -->
                                        <div class="text-center mt-4">
                                            <div
                                                class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg">
                                                <svg class="w-5 h-5 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span id="timer" class="text-lg font-bold text-blue-600">10</span>
                                                <span class="text-sm text-gray-600">detik</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 text-lg">Belum ada foto galeri</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Berita Eksternal Section -->
                <div class="mt-8 lg:mt-12" id="beritaSection">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-6 gap-4">
                        <div>
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 mb-2">Berita Terkini</h2>
                            <p class="text-sm lg:text-base text-gray-600">Kumpulan berita dari berbagai sumber eksternal</p>
                        </div>
                        <button id="addNewsBtn"
                            class="bg-gradient-to-r from-green-500 to-green-700 text-white px-4 py-2 rounded-lg hover:from-green-600 hover:to-green-800 transition-all duration-200 transform hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Berita
                        </button>
                    </div>

                    @if (isset($berita) && count($berita) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($berita->take(4) as $index => $news)
                                <div
                                    class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <!-- News Image -->
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}"
                                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                            onerror="this.src='{{ asset('img/logo.png') }}'">

                                        <!-- Delete Button -->
                                        <div class="absolute top-3 right-3">
                                            <button onclick="deleteNews({{ $news->id }})"
                                                class="bg-red-500/80 backdrop-blur-sm text-white p-2 rounded-full hover:bg-red-600/90 transition-all duration-300 shadow-lg hover:scale-110"
                                                title="Hapus Berita">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- News Content -->
                                    <div class="p-3 lg:p-4">
                                        <h3 class="font-bold text-gray-900 text-sm lg:text-lg mb-2 line-clamp-2">
                                            {{ $news->title }}</h3>
                                        <p class="text-gray-600 text-xs lg:text-sm mb-3 line-clamp-3">
                                            {{ $news->description }}</p>

                                        <!-- News Meta -->
                                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                            <span>{{ \Carbon\Carbon::parse($news->published_at)->format('d M Y') }}</span>
                                            <a href="{{ $news->url }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                                Baca Selengkapnya
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada berita</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan berita pertama Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Informasi Kontak -->
            {{-- <div class="mt-8 bg-gradient-to-r from-red-600 to-red-700 rounded-lg p-6 text-white">
            <h4 class="text-lg font-semibold mb-4">Informasi Kontak</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Jl. Ahmad Yani No. 116, Surabaya</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>(031) 502-1234</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>bnnp.jatim@bnn.go.id</span>
                </div>
            </div>
        </div> --}}

        </div>
        </div>
        </div>
