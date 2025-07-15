@extends('layouts.superadmin-master')

@section('title', 'Input Management')

@section('content')
@include('components.superadmin-navbar')

<div class="container mx-auto py-8 px-2">
    <!-- Search Input -->
    <div class="flex justify-center mb-6">
        <div class="relative w-full max-w-md">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text" id="inputSearch" placeholder="Cari jenis input..." class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-emerald-400 focus:border-emerald-400 focus:outline-none shadow-sm" />
        </div>
    </div>
    <!-- Card Grid -->
    <div id="inputCardGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
        <!-- Card: Data Individu TSK -->
        <a href="{{ route('super-admin.input.individu') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-emerald-500 to-emerald-400 mb-3 shadow">
                    <i class="fas fa-user-tie text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-emerald-700 mb-1">Input Data Individu TSK</div>
                <div class="text-xs text-gray-500">Input data tersangka individu</div>
            </div>
        </a>
        <!-- Card: Data Pendukung Kasus -->
        <a href="{{ route('super-admin.input.pendukung') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-green-400 to-green-500 mb-3 shadow">
                    <i class="fas fa-user-friends text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-green-700 mb-1">Input Data Pendukung</div>
                <div class="text-xs text-gray-500">Input data pendukung kasus</div>
            </div>
        </a>
        <!-- Card: Data Lanjutan Penanganan -->
        <a href="{{ route('super-admin.input.lanjutan') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-yellow-400 to-yellow-500 mb-3 shadow">
                    <i class="fas fa-forward text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-yellow-700 mb-1">Input Data Lanjutan</div>
                <div class="text-xs text-gray-500">Input data lanjutan penanganan</div>
            </div>
        </a>
        <!-- Card: Data Kasus Narkoba -->
        <a href="{{ route('super-admin.input.kasus') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-red-400 to-pink-500 mb-3 shadow">
                    <i class="fas fa-biohazard text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-red-700 mb-1">Input Data Kasus Narkoba</div>
                <div class="text-xs text-gray-500">Input data kasus narkoba</div>
            </div>
        </a>
        <!-- Card: Data Desa Geojson -->
        <a href="{{ route('super-admin.input.desa') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-400 to-blue-500 mb-3 shadow">
                    <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-blue-700 mb-1">Input Data Desa Geojson</div>
                <div class="text-xs text-gray-500">Input data desa/kelurahan</div>
            </div>
        </a>
        <!-- Card: Data LSM Narkotika -->
        <a href="{{ route('super-admin.data.lsm.create') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-purple-400 to-purple-500 mb-3 shadow">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-purple-700 mb-1">Input Data LSM Narkotika</div>
                <div class="text-xs text-gray-500">Input data LSM narkotika</div>
            </div>
        </a>
        <!-- Card: Data Akun Sosmed -->
        <a href="{{ route('super-admin.data.medsos.create') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-pink-400 to-pink-500 mb-3 shadow">
                    <i class="fab fa-instagram text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-pink-700 mb-1">Input Data Akun Sosmed</div>
                <div class="text-xs text-gray-500">Input data akun media sosial</div>
            </div>
        </a>
        <!-- Card: Data Penjual Vape -->
        <a href="{{ route('super-admin.data.vape.create') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-gray-400 to-gray-500 mb-3 shadow">
                    <i class="fas fa-smoking text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-gray-700 mb-1">Input Data Penjual Vape</div>
                <div class="text-xs text-gray-500">Input data penjual vape</div>
            </div>
        </a>
        <!-- Card: Data Perusahaan/Farmasi Prekursor -->
        <a href="{{ route('super-admin.data.farmasi.create') }}" class="block group">
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition flex flex-col items-center text-center border border-transparent hover:border-emerald-400">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-indigo-400 to-indigo-500 mb-3 shadow">
                    <i class="fas fa-flask text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-indigo-700 mb-1">Input Data Farmasi Prekursor</div>
                <div class="text-xs text-gray-500">Input data perusahaan/farmasi prekursor</div>
            </div>
        </a>
        <!-- Card: Data Jaringan di Rutan dan Lapas -->
        <a href="{{ route('super-admin.data.rutanlapas.create') }}" class="block group opacity-50" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-cyan-400 to-cyan-500 mb-3 shadow">
                    <i class="fas fa-network-wired text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-cyan-700 mb-1">Input Data Jaringan Rutan/Lapas</div>
                <div class="text-xs text-gray-500">Input data jaringan rutan/lapas</div>
            </div>
        </a>
        <!-- Card: Data Objek Vital -->
        <a href="{{ route('super-admin.data.objekvital.create') }}" class="block group opacity-50" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-gray-700 to-gray-900 mb-3 shadow">
                    <i class="fas fa-landmark text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-gray-800 mb-1">Input Data Objek Vital</div>
                <div class="text-xs text-gray-500">Input data objek vital</div>
            </div>
        </a>
        <!-- Card: Data Jaringan Penggiat -->
        <a href="{{ route('super-admin.data.penggiat.create') }}" class="block group opacity-50" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-lime-400 to-lime-500 mb-3 shadow">
                    <i class="fas fa-people-carry text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-lime-700 mb-1">Input Data Jaringan Penggiat</div>
                <div class="text-xs text-gray-500">Input data jaringan penggiat</div>
            </div>
        </a>
        <!-- Card: Data Lembaga Rehabilitasi -->
        <a href="{{ route('super-admin.data.lrehab.create') }}" class="block group opacity-50" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-green-700 to-green-900 mb-3 shadow">
                    <i class="fas fa-hospital-alt text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-green-800 mb-1">Input Data Lembaga Rehabilitasi</div>
                <div class="text-xs text-gray-500">Input data lembaga rehabilitasi</div>
            </div>
        </a>
        <!-- Card: Data Ekspedisi -->
        <a href="{{ route('super-admin.data.ekspedisi.create') }}" class="block group opacity-50" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-yellow-700 to-yellow-900 mb-3 shadow">
                    <i class="fas fa-shipping-fast text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-yellow-800 mb-1">Input Data Ekspedisi</div>
                <div class="text-xs text-gray-500">Input data ekspedisi</div>
            </div>
        </a>
        <!-- Card: Data Jasa Transportasi -->
        <a href="{{ route('super-admin.data.transportasi.create') }}" class="block group opacity-50" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-700 to-blue-900 mb-3 shadow">
                    <i class="fas fa-bus-alt text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-blue-800 mb-1">Input Data Jasa Transportasi</div>
                <div class="text-xs text-gray-500">Input data jasa transportasi</div>
            </div>
        </a>
        <!-- Card: Data Penginapan (Hotel & Kost) -->
        <a href="{{ route('super-admin.data.penginapan.create') }}" class="block group opacity-50" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-pink-700 to-pink-900 mb-3 shadow">
                    <i class="fas fa-hotel text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-pink-800 mb-1">Input Data Penginapan</div>
                <div class="text-xs text-gray-500">Input data penginapan</div>
            </div>
        </a>
        <!-- Card: Data Daerah Penyalahguna -->
        <a href="#" class="block group opacity-50 cursor-not-allowed" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-orange-400 to-orange-500 mb-3 shadow">
                    <i class="fas fa-user-injured text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-orange-700 mb-1">Input Data Daerah Penyalahguna</div>
                <div class="text-xs text-gray-500">Input data daerah penyalahguna</div>
            </div>
        </a>
        <!-- Card: Data Daerah Penyelundupan -->
        <a href="#" class="block group opacity-50 cursor-not-allowed" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-amber-400 to-amber-500 mb-3 shadow">
                    <i class="fas fa-truck-loading text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-amber-700 mb-1">Input Data Daerah Penyelundupan</div>
                <div class="text-xs text-gray-500">(Belum tersedia)</div>
            </div>
        </a>
        <!-- Card: Data THM dan Manager -->
        <a href="#" class="block group opacity-50 cursor-not-allowed" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-fuchsia-400 to-fuchsia-500 mb-3 shadow">
                    <i class="fas fa-glass-martini-alt text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-fuchsia-700 mb-1">Input Data THM & Manager</div>
                <div class="text-xs text-gray-500">(Belum tersedia)</div>
            </div>
        </a>
        <!-- Card: Data Jaringan Informasi (Orang) -->
        <a href="#" class="block group opacity-50 cursor-not-allowed" tabindex="-1">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center border border-transparent">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tr from-sky-400 to-sky-500 mb-3 shadow">
                    <i class="fas fa-user-secret text-white text-2xl"></i>
                </div>
                <div class="font-semibold text-sky-700 mb-1">Input Data Jaringan Informasi</div>
                <div class="text-xs text-gray-500">(Belum tersedia)</div>
            </div>
        </a>
    </div>
    <div id="noResultMsg" class="hidden text-center text-gray-400 text-sm py-8">Tidak ada jenis input yang ditemukan.</div>
    <div class="alert alert-success text-center mt-6 rounded-xl">
        <i class="fas fa-info-circle me-2"></i>
        Anda dapat menambahkan data baru sesuai kebutuhan dengan memilih jenis input di atas.
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('inputSearch');
    const cardGrid = document.getElementById('inputCardGrid');
    const cards = Array.from(cardGrid.children);
    const noResultMsg = document.getElementById('noResultMsg');

    searchInput.addEventListener('input', function() {
        const q = this.value.trim().toLowerCase();
        let visibleCount = 0;
        cards.forEach(card => {
            const label = card.querySelector('div.font-semibold')?.textContent.toLowerCase() || '';
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
