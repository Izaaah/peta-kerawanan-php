<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">
<div class="superadmin-navbar">
    <!-- Kiri: Logo dan Judul -->
    <div class="logo-area">
        <div class="logo-circle">
            <img src="{{ asset('storage/img/logo.png') }}" alt="Logo">

        </div>
        <div class="logo-text">
            <span class="bnn">BNN</span>
            <span class="prov">Provinsi Jawa Timur</span>
        </div>
    </div>
    <span class="sijagat-title">SIJAGAD</span>
    <!-- Tengah: Menu Navigasi -->
    <div class="menu-area">
        <div class="menu-select">
            <select>
                <option>Home</option>
            </select>
        </div>
        <div class="menu-btn dropdown-parent">
            Data <span class="dropdown-arrow">&#9662;</span>
            <ul class="dropdown-menu">
                <li>Data Daerah Penyalahguna</li>
                <li>Data Daerah Penyelundupan</li>
                <li>Data THM dan Manager</li>
                <li>Data Jaringan di Rutan dan Lapas</li>
                <li>Data Objek Vital</li>
                <li>Data Jaringan Penggiat</li>
                <li>Data Jaringan Informasi (Orang)</li>
                <li>Data LSM Narkotika</li>
                <li>Data Lembaga Rehabilitasi</li>
                <li>Data Ekspedisi</li>
                <li>Data Jasa Transportasi</li>
                <li>Data Penginapan (Hotel & Kost)</li>
                <li>Data Akun Sosmed</li>
                <li>Data Umum Tempat Transportasi</li>
                <li>Data Perusahan/Farmasi Prekursor</li>
                <li>Data Penjual Vape</li>
            </ul>
        </div>
        <div class="menu-btn">Peta</div>
        <div class="menu-btn">Input</div>
        <div class="menu-btn">User Managemen</div>
    </div>
    <!-- Kanan: Logout dan Profil -->
    <div class="right-area">
        <span class="profile-label">Profil</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</div>
<!-- Konten utama di bawahnya -->