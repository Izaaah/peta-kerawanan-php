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

    <!-- Hamburger Menu Button (Mobile Only) -->
    <button class="mobile-menu-toggle" id="operatorMobileMenuToggle" type="button" aria-label="Toggle mobile menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <!-- Tengah: Menu Navigasi -->
    <div class="menu-area" id="operatorMenuArea">
        <div class="menu-btn"><a href="{{ route('operator.dashboard') }}">Beranda</a>
        </div>
        <div class="menu-btn"><a href="{{ route('operator.data.index') }}">Data Intelijen</a></div>
        <div class="menu-btn"><a href="{{ route('operator.chart-jaringan') }}">Chart</a></div>
        <div class="menu-btn-peta dropdown-parent">
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
        <div class="logo-text">
            <span class="bnn">BNN</span>
            <span class="prov">PROVINSI JAWA TIMUR</span>
        </div>
        <div class="logo-circle">
            <img src="{{ asset('img/logo.png') }}" alt="Logo BNN">
        </div>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="operatorMobileMenuOverlay"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Operator navbar script loaded');

        const mobileMenuToggle = document.getElementById('operatorMobileMenuToggle');
        const menuArea = document.getElementById('operatorMenuArea');
        const mobileMenuOverlay = document.getElementById('operatorMobileMenuOverlay');

        // Debug: Check if elements exist
        console.log('Operator mobile menu toggle:', mobileMenuToggle);
        console.log('Operator menu area:', menuArea);
        console.log('Operator mobile menu overlay:', mobileMenuOverlay);

        if (!mobileMenuToggle || !menuArea || !mobileMenuOverlay) {
            console.error('Required operator elements not found');
            return;
        }

        // Mobile menu toggle functionality
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Operator hamburger menu clicked');

            const isOpen = menuArea.classList.contains('mobile-menu-open');
            console.log('Operator menu is currently:', isOpen ? 'open' : 'closed');

            menuArea.classList.toggle('mobile-menu-open');
            mobileMenuOverlay.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');

            console.log('Operator menu toggled to:', menuArea.classList.contains('mobile-menu-open') ?
                'open' : 'closed');
        });

        // Close mobile menu when clicking overlay
        mobileMenuOverlay.addEventListener('click', function() {
            console.log('Operator overlay clicked - closing menu');
            menuArea.classList.remove('mobile-menu-open');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
        });

        // Close mobile menu when clicking on menu items
        const menuItems = menuArea.querySelectorAll('.menu-btn a');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                console.log('Operator menu item clicked - closing menu');
                menuArea.classList.remove('mobile-menu-open');
                mobileMenuOverlay.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            });
        });

        // Scroll behavior for navbar
        let lastScrollTop = 0;
        const navbar = document.querySelector('.superadmin-navbar');
        const topBanner = document.querySelector('.top-banner');

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Add scrolled class when scrolling down
            if (scrollTop > 50) {
                document.body.classList.add('scrolled');
            } else {
                document.body.classList.remove('scrolled');
            }

            // Close mobile menu when scrolling
            if (menuArea.classList.contains('mobile-menu-open')) {
                menuArea.classList.remove('mobile-menu-open');
                mobileMenuOverlay.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            }

            lastScrollTop = scrollTop;
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            // Close mobile menu on resize to desktop
            if (window.innerWidth > 768) {
                menuArea.classList.remove('mobile-menu-open');
                mobileMenuOverlay.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            }
        });

        // Debug: Log current screen width
        console.log('Operator current screen width:', window.innerWidth);
        console.log('Operator mobile menu toggle display:', window.getComputedStyle(mobileMenuToggle).display);
    });
</script>
