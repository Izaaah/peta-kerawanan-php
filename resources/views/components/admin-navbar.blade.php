<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">

<!-- Garis putih tebal di atas navbar -->
<div class="top-banner">
    <div class="banner-content">
        <div class="banner-left">
            <span class="banner-text">Sistem Informasi Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen
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
        <img src="{{ asset('img/sijagad.png') }}" alt="Logo Sijagad" class="sijagad-logo">
    </div>

    <!-- Mobile Menu Toggle Button -->
    <button class="mobile-menu-toggle" id="adminMobileMenuToggle" onclick="toggleAdminMobileMenu()">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <!-- Tengah: Menu Navigasi -->
    <div class="menu-area" id="adminMenuArea">
        <div class="menu-btn"><a href="{{ route('admin.dashboard') }}">Beranda</a>
        </div>
        <div class="menu-btn"><a href="{{ route('admin.data.index') }}">Data Intelijen</a></div>
        <div class="menu-btn"><a href="{{ route('admin.chart-jaringan') }}">Diagram</a></div>
        <div class="menu-btn-peta dropdown-parent">
            Peta <span class="dropdown-arrow">&#9662;</span>
            <ul class="dropdown-menu">
                <li><a href="{{ route('peta-penyalahgunaan.domisili') }}">Peta Kerawanan<br>Berdasarkan NIK</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.tkp') }}">Peta Kerawanan<br>Berdasarkan TKP</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.titik-masuk') }}">Peta Kawasan<br>Titik Masuk</a></li>
            </ul>
        </div>
        {{-- <div class="menu-btn"><a href="{{ route('admin.input.index') }}">Input</a></div> --}}
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
<div class="mobile-menu-overlay" id="adminMobileMenuOverlay"></div>

<script>
    // Global function untuk toggle admin mobile menu
    function toggleAdminMobileMenu() {
        console.log('Admin mobile menu toggle clicked!');

        const menuArea = document.getElementById('adminMenuArea');
        const mobileMenuOverlay = document.getElementById('adminMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('adminMobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            // Toggle classes
            menuArea.classList.toggle('mobile-menu-open');
            mobileMenuOverlay.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');

            console.log('Admin menu toggled:', menuArea.classList.contains('mobile-menu-open'));
        } else {
            console.log('Admin elements not found:', {
                menu: menuArea,
                overlay: mobileMenuOverlay,
                toggle: mobileMenuToggle
            });
        }
    }

    function closeAdminMobileMenu() {
        console.log('Closing admin menu');
        const menuArea = document.getElementById('adminMenuArea');
        const mobileMenuOverlay = document.getElementById('adminMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('adminMobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            menuArea.classList.remove('mobile-menu-open');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('adminMobileMenuToggle');
        const menuArea = document.getElementById('adminMenuArea');
        const mobileMenuOverlay = document.getElementById('adminMobileMenuOverlay');

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeAdminMobileMenu);
        }

        // Handle dropdown menu toggle on mobile
        const dropdownParent = menuArea?.querySelector('.dropdown-parent');
        if (dropdownParent) {
            dropdownParent.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    dropdownParent.classList.toggle('active');
                }
            });
        }

        // Close menu when clicking on menu items (only on mobile)
        if (menuArea) {
            const menuItems = menuArea.querySelectorAll('.menu-btn a, .dropdown-menu a');
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        // Don't close immediately for dropdown items
                        if (!item.closest('.dropdown-menu')) {
                            setTimeout(() => closeAdminMobileMenu(), 100);
                        }
                    }
                });
            });
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeAdminMobileMenu();
            }
        });
    });
</script>
