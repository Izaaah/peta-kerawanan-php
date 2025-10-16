<!-- Tab Anggaran Content -->
<div id="anggaranContent" class="dashboard-content hidden">
    <div class="space-y-6">

        <!-- Statistik Cards Anggaran -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
            <!-- Total Anggaran Sebelum -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Total Anggaran Sebelum</div>
                            <div class="text-xl font-bold text-gray-900">Rp
                                {{ number_format($anggaranStats['Total Anggaran Sebelum'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Blokir -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Total Blokir</div>
                            <div class="text-xl font-bold text-gray-900">Rp
                                {{ number_format($anggaranStats['Total Blokir'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Anggaran Setelah -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Total Anggaran Setelah</div>
                            <div class="text-xl font-bold text-gray-900">Rp
                                {{ number_format($anggaranStats['Total Anggaran Setelah'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Kegiatan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Jumlah Kegiatan</div>
                            <div class="text-2xl font-bold text-gray-900">
                                {{ number_format($anggaranStats['Jumlah Kegiatan']) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Anggaran -->
        <div class="bg-white rounded-lg shadow">
            <div class="relative px-4 lg:px-6 py-4 border-b border-gray-200">
                <h3 class="text-base lg:text-lg font-semibold text-gray-900">Rincian Anggaran</h3>
                <div class="absolute right-0 top-0 mt-3 mr-2 lg:mr-4">
                    <a href="#" id="openModalBtn"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Tambah Anggaran
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                AKUN</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KEGIATAN</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ANGGARAN SEBELUM BLOKIR</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                BLOKIR</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ANGGARAN SETELAH BLOKIR</th>
                            <th
                                class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($anggaranList as $anggaran)
                            @if ($anggaran->is_main_activity)
                                {{-- Main Activity Row --}}
                                <tr class="hover:bg-gray-50 bg-blue-50">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900 border-l-4 border-yellow-400">
                                        {{ $anggaran->akun }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <strong>{{ $anggaran->kegiatan }}</strong>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-blue-100">
                                        Rp {{ number_format($anggaran->total_anggaran_sebelum, 0, ',', '.') }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-red-100">
                                        Rp
                                        {{ $anggaran->total_blokir ? number_format($anggaran->total_blokir, 0, ',', '.') : '-' }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-yellow-100">
                                        Rp {{ number_format($anggaran->total_anggaran_setelah, 0, ',', '.') }}
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                        <div class="flex items-center justify-center space-x-2">
                                            {{-- Tombol Edit --}}
                                            <a href="#" onclick="tambahAnggaranModal(this.dataset)"
                                                data-id="{{ $anggaran->id }}"
                                                class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('super-admin.anggaran.destroy', $anggaran->id) }}"
                                                method="POST" onsubmit="return confirmDeleteAnggaran(event)"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-red-600 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4v4m-6 4h8" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Sub Activities --}}
                                @foreach ($anggaran->children as $subAnggaran)
                                    <tr class="hover:bg-gray-50 bg-red-50">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 pl-12">
                                            {{ $subAnggaran->akun }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 pl-12">
                                            {{ $subAnggaran->kegiatan }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 bg-blue-100">
                                            Rp {{ number_format($subAnggaran->anggaran_sebelum, 0, ',', '.') }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 bg-red-100">
                                            Rp
                                            {{ $subAnggaran->blokir ? number_format($subAnggaran->blokir, 0, ',', '.') : '-' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 bg-yellow-100">
                                            Rp
                                            {{ number_format($subAnggaran->anggaran_sebelum - ($subAnggaran->blokir ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                                            <div class="flex items-center justify-center space-x-2">
                                                {{-- Tombol Edit --}}
                                                <a href="#" onclick="tambahAnggaranModal(this.dataset)"
                                                    data-id="{{ $subAnggaran->id }}"
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
                                                    action="{{ route('super-admin.anggaran.destroy', $subAnggaran->id) }}"
                                                    method="POST" onsubmit="return confirmDeleteAnggaran(event)"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-red-600 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4v4m-6 4h8" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada
                                    data anggaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-sm font-bold text-gray-900">TOTAL
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-blue-100">
                                Rp {{ number_format($totalAnggaranSebelum, 0, ',', '.') }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-red-100">
                                Rp {{ number_format($totalBlokir, 0, ',', '.') }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-yellow-100">
                                Rp {{ number_format($totalSetelah, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Pie Chart Anggaran -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Distribusi Anggaran per Kegiatan Utama</h3>
                <p class="text-sm text-gray-600 mb-4">Perbandingan anggaran sebelum dan setelah blokir untuk setiap
                    kegiatan utama</p>
                <div class="flex justify-center">
                    <div style="max-width: 350px; width: 100%;">
                        <canvas id="chartAnggaranPie" width="300" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
