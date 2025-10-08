@extends('layouts.operator')

@section('title', 'Data Management')

@section('content')
    @include('components.operator-navbar')

    <div class="mx-auto py-4 px-2">
        <!-- Search Input -->
        <div class="flex justify-center mb-6">
            <div class="relative w-full max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                </span>
                <input type="text" id="dataSearch" placeholder="Cari jenis data..."
                    class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-blue-400 focus:border-blue-400 focus:outline-none shadow-sm" />
            </div>
        </div>
        <!-- Card Grid -->
        <div id="dataCardGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            <!-- Card: Data Individu TSK -->
            <a href="{{ route('operator.data.individu') }}" class="block group">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-blue-400">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-600 to-sky-400 mb-3 shadow mx-auto">
                        <i class="fas fa-user-tie text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-blue-700 mb-1">Data Individu TSK</div>
                    <div class="text-xs text-gray-500">Kelola data tersangka individu</div>
                </div>
            </a>
            <!-- Card: Data LSM Narkotika -->
            <a href="{{ route('operator.data.lsm.index') }}" class="block group">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-blue-400">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-purple-400 to-purple-500 mb-3 shadow mx-auto">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-purple-700 mb-1">Data LSM Narkotika</div>
                    <div class="text-xs text-gray-500">Kelola data LSM narkotika</div>
                </div>
            </a>
            <!-- Card: Data Akun Sosmed -->
            <a href="{{ route('operator.data.medsos.index') }}" class="block group">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-blue-400">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-pink-400 to-pink-500 mb-3 shadow mx-auto">
                        <i class="fab fa-instagram text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-pink-700 mb-1">Data Akun Sosmed</div>
                    <div class="text-xs text-gray-500">Kelola data akun media sosial</div>
                </div>
            </a>
            <!-- Card: Data Penjual Vape -->
            <a href="{{ route('operator.data.vape.index') }}" class="block group">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-blue-400">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-gray-400 to-gray-500 mb-3 shadow mx-auto">
                        <i class="fas fa-smoking text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-gray-700 mb-1">Data Penjual Vape</div>
                    <div class="text-xs text-gray-500">Kelola data penjual vape</div>
                </div>
            </a>
            <!-- Card: Data Farmasi Prekursor -->
            <a href="{{ route('operator.data.farmasi.index') }}" class="block group">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-blue-400">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-indigo-400 to-indigo-500 mb-3 shadow mx-auto">
                        <i class="fas fa-flask text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-indigo-700 mb-1">Data Farmasi Prekursor</div>
                    <div class="text-xs text-gray-500">Kelola data perusahaan/farmasi prekursor</div>
                </div>
            </a>
            <!-- Card: Data Jaringan di Rutan dan Lapas -->
            <a href="{{ route('operator.data.rutanlapas.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-cyan-400 to-cyan-500 mb-3 shadow">
                        <i class="fas fa-network-wired text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-cyan-700 mb-1">Input Data Jaringan Rutan/Lapas</div>
                    <div class="text-xs text-gray-500">Input data jaringan rutan/lapas</div>
                </div>
            </a>
            <!-- Card: Data Objek Vital -->
            <a href="{{ route('operator.data.objekvital.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-gray-700 to-gray-900 mb-3 shadow mx-auto">
                        <i class="fas fa-landmark text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-gray-800 mb-1">Data Objek Vital</div>
                    <div class="text-xs text-gray-500">Kelola data objek vital</div>
                </div>
            </a>
            <!-- Card: Data Jaringan Penggiat -->
            <a href="{{ route('operator.data.penggiat.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-lime-400 to-lime-500 mb-3 shadow mx-auto">
                        <i class="fas fa-people-carry text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-lime-700 mb-1">Data Jaringan Penggiat</div>
                    <div class="text-xs text-gray-500">Kelola data jaringan penggiat</div>
                </div>
            </a>
            <!-- Card: Data Lembaga Rehabilitasi -->
            <a href="{{ route('operator.data.lrehab.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-green-700 to-green-900 mb-3 shadow mx-auto">
                        <i class="fas fa-hospital-alt text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-green-800 mb-1">Data Lembaga Rehabilitasi</div>
                    <div class="text-xs text-gray-500">Kelola data lembaga rehabilitasi</div>
                </div>
            </a>
            <!-- Card: Data Ekspedisi -->
            <a href="{{ route('operator.data.ekspedisi.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-yellow-700 to-yellow-900 mb-3 shadow mx-auto">
                        <i class="fas fa-shipping-fast text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-yellow-800 mb-1">Data Ekspedisi</div>
                    <div class="text-xs text-gray-500">Kelola data ekspedisi</div>
                </div>
            </a>
            <!-- Card: Data Jasa Transportasi -->
            <a href="{{ route('operator.data.transportasi.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-700 to-blue-900 mb-3 shadow mx-auto">
                        <i class="fas fa-bus-alt text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-blue-800 mb-1">Data Jasa Transportasi</div>
                    <div class="text-xs text-gray-500">Kelola data jasa transportasi</div>
                </div>
            </a>
            <!-- Card: Data Penginapan (Hotel & Kost) -->
            <a href="{{ route('operator.data.penginapan.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-pink-700 to-pink-900 mb-3 shadow mx-auto">
                        <i class="fas fa-hotel text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-pink-800 mb-1">Data Penginapan</div>
                    <div class="text-xs text-gray-500">Kelola data penginapan</div>
                </div>
            </a>
            <!-- Card: Data THM dan Manager -->
            <a href="{{ route('operator.data.thm.index') }}" class="block group" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-fuchsia-400 to-fuchsia-500 mb-3 shadow mx-auto">
                        <i class="fas fa-glass-martini-alt text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-fuchsia-700 mb-1">Data THM & Manager</div>
                    <div class="text-xs text-gray-500">Kelola data THM dan manager</div>
                </div>
            </a>
            <!-- Card: Data Daerah Penyalahguna -->
            <a href="#" class="block group opacity-50 cursor-not-allowed" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-orange-400 to-orange-500 mb-3 shadow mx-auto">
                        <i class="fas fa-user-injured text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-orange-700 mb-1">Data Daerah Penyalahguna</div>
                    <div class="text-xs text-gray-500">(Belum tersedia)</div>
                </div>
            </a>
            <!-- Card: Data Daerah Penyelundupan -->
            <a href="#" class="block group opacity-50 cursor-not-allowed" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-amber-400 to-amber-500 mb-3 shadow mx-auto">
                        <i class="fas fa-truck-loading text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-amber-700 mb-1">Data Daerah Penyelundupan</div>
                    <div class="text-xs text-gray-500">(Belum tersedia)</div>
                </div>
            </a>
            <!-- Card: Data Jaringan Informasi (Orang) -->
            <a href="#" class="block group opacity-50 cursor-not-allowed" tabindex="-1">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-sky-400 to-sky-500 mb-3 shadow mx-auto">
                        <i class="fas fa-user-secret text-white text-2xl"></i>
                    </div>
                    <div class="font-semibold text-sky-700 mb-1">Data Jaringan Informasi</div>
                    <div class="text-xs text-gray-500">(Belum tersedia)</div>
                </div>
            </a>
        </div>
        <div id="noResultMsg" class="hidden text-center text-gray-400 text-sm py-8">Tidak ada jenis data yang ditemukan.
        </div>
        <div class="alert alert-info text-center mt-6 rounded-xl">
            <i class="fas fa-info-circle me-2"></i>
            Anda dapat mengelola data sesuai kebutuhan dengan memilih jenis data di atas.
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('dataSearch');
            const cardGrid = document.getElementById('dataCardGrid');
            const cards = Array.from(cardGrid.children);
            const noResultMsg = document.getElementById('noResultMsg');

            searchInput.addEventListener('input', function() {
                const q = this.value.trim().toLowerCase();
                let visibleCount = 0;
                cards.forEach(card => {
                    const label = card.querySelector('div.font-semibold')?.textContent
                        .toLowerCase() || '';
                    if (label.includes(q)) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });
                if (visibleCount === 0) {
                    noResultMsg.classList.remove('hidden');
                } else {
                    noResultMsg.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
