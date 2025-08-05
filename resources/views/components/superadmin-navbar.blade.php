<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">

<!-- Garis putih tebal di atas navbar -->
<div class="top-banner">
    <div class="banner-content">
        <div class="banner-left">
            <span class="banner-text">Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen Dasar</span>
        </div>
        <div class="banner-right">
            <span class="profile-label"><a href="{{ route('profile.edit') }}">Profil</a></span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="superadmin-navbar">
    <!-- Kiri: Logo Sijagad -->
    <div class="logo-sijagad">
        <img src="{{ asset('storage/img/sijagad.png') }}" alt="Logo Sijagad" class="sijagad-logo">
    </div>

    <!-- Tengah: Menu Navigasi -->
    <div class="menu-area">
        <div class="menu-btn"><a href="{{ route('super-admin.dashboard') }}">Home</a>
        </div>
        <div class="menu-btn"><a href="{{ route('super-admin.data.index') }}">Data</a></div>
        <div class="menu-btn"><a href="{{ route('super-admin.verification.index') }}">Verification</a></div>
        <div class="menu-btn"><a href="{{ route('super-admin.chart-jaringan') }}">Chart</a></div>
        <div class="menu-btn"><a href="{{ route('super-admin.user-management.index') }}">User Management</a></div>
        <div class="menu-btn dropdown-parent">
            Peta <span class="dropdown-arrow">&#9662;</span>
            <ul class="dropdown-menu">
                <li><a href="{{ route('peta-penyalahgunaan.domisili') }}">Peta Kerawanan<br>Berdasarkan NIK</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.tkp') }}">Peta Kerawanan<br>Berdasarkan TKP</a></li>
                <li><a href="">Peta Kawasan<br>Rawan Geospasial</a></li>
            </ul>
        </div>
    </div>

    <!-- Kanan: Logo BNN dan Tulisannya -->
    <div class="logo-bnn">
        <div class="logo-circle">
            <img src="{{ asset('storage/img/logo.png') }}" alt="Logo BNN">
        </div>
        <div class="logo-text">
            <span class="bnn">BNN</span>
            <span class="prov">Provinsi Jawa Timur</span>
        </div>
    </div>
</div>
