<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">

<!-- Garis putih tebal di atas navbar -->
<div class="top-banner">
    <div class="banner-content">
        <div class="banner-left">
            <span class="banner-text">Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen Dasar</span>
        </div>
        <div class="banner-right">
            <span class="profile-label"><a href="">Profil</a></span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</div>

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
        <div class="menu-btn"><a href="">Home</a>
        </div>
        <div class="menu-btn dropdown-parent">
            Peta <span class="dropdown-arrow">&#9662;</span>
            <ul class="dropdown-menu">
                <li><a href="">Peta Kerawanan<br>Berdasarkan NIK</a></li>
                <li><a href="">Peta Kerawanan<br>Berdasarkan TKP</a></li>
                <li><a href="">Peta Kawasan<br>Rawan Geospasial</a></li>
            </ul>
        </div>
        <div class="menu-btn"><a href="">Data</a></div>
        <div class="menu-btn"><a href="">Input</a></div>
        <div class="menu-btn"><a href="">User Management</a></div>
    </div>
</div>
