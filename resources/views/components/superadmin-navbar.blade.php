<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">

<!-- Garis putih tebal di atas navbar -->
<div class="top-banner">
    <div class="banner-content">
        <div class="banner-left">
            <span class="banner-text">Sistem Informasi Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis
                Intelijen
                Dasar</span>
        </div>
        <div class="banner-right">
            <span class="profile-label"><a href="{{ route('profile.edit') }}">Profil</a></span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </div>
    </div>
</div>

<div class="superadmin-navbar">
    <!-- Kiri: Logo Sijagad -->
    <div class="logo-sijagad">
        <img src="{{ asset('storage/img/sijagad.png') }}" alt="Logo Sijagad" class="sijagad-logo">
    </div>

    <!-- Mobile Menu Toggle Button -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle" onclick="toggleMobileMenu()"
        style="z-index: 9999; position: relative; pointer-events: auto; cursor: pointer;">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <!-- Tengah: Menu Navigasi -->
    <div class="menu-area" id="menuArea">
        <div class="menu-btn"><a href="{{ route('super-admin.dashboard') }}">Beranda</a></div>
        <div class="menu-btn"><a href="{{ route('super-admin.data.index') }}">Data Intelijen</a></div>
        <div class="menu-btn"><a href="{{ route('super-admin.chart-jaringan') }}">Diagram</a></div>
        <div class="menu-btn"><a href="{{ route('super-admin.verification.index') }}">Verifikasi</a></div>
        <div class="menu-btn"><a href="{{ route('super-admin.user-management.index') }}">Pengguna</a></div>
        <div class="menu-btn-peta dropdown-parent">
            Peta <span class="dropdown-arrow">&#9662;</span>
            <ul class="dropdown-menu">
                <li><a href="{{ route('peta-penyalahgunaan.domisili') }}">Peta Kerawanan<br>Berdasarkan NIK</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.tkp') }}">Peta Kerawanan<br>Berdasarkan TKP</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.titik-masuk') }}">Peta Kawasan<br>Titik Masuk</a></li>
            </ul>
        </div>

        <!-- Mobile Profile and Logout Section -->
        {{-- <div class="mobile-profile-section">
            <div class="profile-divider">
                <div class="divider-line"></div>
                <span class="divider-text">Akun</span>
                <div class="divider-line"></div>
            </div>
            <a href="{{ route('profile.edit') }}" class="mobile-profile-btn">
                <i class="profile-icon">👤</i>
                <span>Profil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: block;">
                @csrf
                <button type="submit" class="mobile-logout-btn">
                    <i class="logout-icon">🚪</i>
                    <span>Keluar</span>
                </button>
            </form>
        </div> --}}
    </div>

    <!-- Kanan: Logo BNN dan Tulisannya -->
    <div class="logo-bnn">
        <div class="logo-text">
            <span class="bnn">BNN</span>
            <span class="prov">PROVINSI JAWA TIMUR</span>
        </div>
        <div class="logo-circle">
            <img src="{{ asset('img/logo-bnn.png') }}" alt="Logo BNN">
        </div>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<script>
    // Global function untuk toggle mobile menu
    function toggleMobileMenu() {
        console.log('Toggle clicked via onclick!');

        const menuArea = document.getElementById('menuArea');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            // Toggle classes
            menuArea.classList.toggle('mobile-menu-open');
            mobileMenuOverlay.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');

            console.log('Menu toggled:', menuArea.classList.contains('mobile-menu-open'));
        } else {
            console.log('Elements not found:', {
                menu: menuArea,
                overlay: mobileMenuOverlay,
                toggle: mobileMenuToggle
            });
        }
    }

    function closeMobileMenu() {
        console.log('Closing menu');
        const menuArea = document.getElementById('menuArea');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            menuArea.classList.remove('mobile-menu-open');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const menuArea = document.getElementById('menuArea');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

        console.log('Elements found:', {
            toggle: mobileMenuToggle,
            menu: menuArea,
            overlay: mobileMenuOverlay
        });

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);
            console.log('Event listener added to overlay');
        }

        // Close menu when clicking on menu items
        if (menuArea) {
            const menuItems = menuArea.querySelectorAll('.menu-btn a, .dropdown-menu a');
            menuItems.forEach(item => {
                item.addEventListener('click', closeMobileMenu);
            });
            console.log('Event listeners added to', menuItems.length, 'menu items');
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeMobileMenu();
            }
        });
    });
</script>
