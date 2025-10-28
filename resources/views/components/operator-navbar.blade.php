<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">

<!-- Garis putih tebal di atas navbar -->
<div class="top-banner">
    <div class="banner-content">
        <div class="banner-left">
            <span class="banner-text">Sistem Informasi Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen Dasar</span>
        </div>
    </div>
</div>

<div class="superadmin-navbar">
    <!-- Kiri: Logo Sijagad -->
    <div class="logo-sijagad">
        <img src="{{ asset('storage/img/sijagad.png') }}" alt="Logo Sijagad" class="sijagad-logo">
    </div>

    <!-- Hamburger Menu Button (Mobile Only) -->
    <button class="mobile-menu-toggle" id="operatorMobileMenuToggle" onclick="toggleOperatorMobileMenu()"
        style="z-index: 9999; position: relative; pointer-events: auto; cursor: pointer;">
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
            Peta <span class="dropdown-arrow"><i class="fas fa-chevron-right"></i></span>
            <ul class="dropdown-menu">
                <li><a href="{{ route('peta-penyalahgunaan.domisili') }}">Peta Kerawanan<br>Berdasarkan NIK</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.tkp') }}">Peta Kerawanan<br>Berdasarkan TKP</a></li>
                <li><a href="">Peta Kawasan<br>Rawan Geospasial</a></li>
            </ul>
        </div>

        <!-- Mobile Profile and Logout Section -->
        <div class="mobile-profile-section">
            <div class="profile-divider">
                <div class="divider-line"></div>
                <span class="divider-text">Akun</span>
                <div class="divider-line"></div>
            </div>
            <a href="{{ route('profile.edit') }}" class="mobile-profile-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="mobile-profile-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: block; width: 100%;">
                @csrf
                <button type="submit" class="mobile-logout-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mobile-profile-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Kanan: Logo BNN dan Tulisannya -->
    <div class="logo-bnn" id="logoBNN" onclick="toggleProfileMenu()">
        <div class="logo-text">
            <span class="bnn">BNN</span>
            <span class="prov">PROVINSI JAWA TIMUR</span>
        </div>
        <div class="logo-circle">
            <img src="{{ asset('img/logo.png') }}" alt="Logo BNN">
        </div>
    </div>
</div>

<!-- Profile Menu (No Overlay, Desktop Only) -->
<div class="profile-menu" id="profileMenu">
    <div class="profile-menu-header">
        <span class="profile-menu-title">Menu Akun Operator</span>
        <button class="profile-menu-close" onclick="closeProfileMenu()">✕</button>
    </div>
    <div class="profile-menu-content">
        <a href="{{ route('profile.edit') }}" class="profile-menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="profile-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Profil</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display: block;">
            @csrf
            <button type="submit" class="profile-menu-item profile-menu-logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="profile-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="operatorMobileMenuOverlay"></div>

<script>
    let isTogglingOperatorProfileMenu = false;

    function toggleProfileMenu(event) {
        isTogglingOperatorProfileMenu = true;

        if (window.innerWidth <= 768) {
            isTogglingOperatorProfileMenu = false;
            return;
        }

        closeOperatorMobileMenu();

        const profileMenu = document.getElementById('profileMenu');

        if (profileMenu) {
            const isActive = profileMenu.classList.contains('active');

            if (isActive) {
                profileMenu.classList.remove('active');
                isTogglingOperatorProfileMenu = false;
            } else {
                profileMenu.classList.add('active');
                // Reset flag after a short delay to ensure click event is fully processed
                setTimeout(function() {
                    isTogglingOperatorProfileMenu = false;
                }, 100);
            }
        } else {
            isTogglingOperatorProfileMenu = false;
        }

        if (event) {
            event.stopPropagation();
        }
    }

    function closeProfileMenu() {
        const profileMenu = document.getElementById('profileMenu');
        if (profileMenu) {
            profileMenu.classList.remove('active');
        }
    }

    function toggleOperatorMobileMenu() {
        const menuArea = document.getElementById('operatorMenuArea');
        const mobileMenuOverlay = document.getElementById('operatorMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('operatorMobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            closeProfileMenu();

            menuArea.classList.toggle('mobile-menu-open');
            mobileMenuOverlay.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');

            if (menuArea.classList.contains('mobile-menu-open')) {
                document.body.style.overflow = 'hidden';
                document.documentElement.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
                document.documentElement.style.overflow = '';
            }
        }
    }

    function closeOperatorMobileMenu() {
        const menuArea = document.getElementById('operatorMenuArea');
        const mobileMenuOverlay = document.getElementById('operatorMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('operatorMobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            menuArea.classList.remove('mobile-menu-open');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.classList.remove('active');

            const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
            if (dropdownParent && dropdownParent.classList.contains('active')) {
                dropdownParent.classList.remove('active');
                const arrow = dropdownParent.querySelector('.dropdown-arrow');
                if (arrow) {
                    arrow.innerHTML = '<i class="fas fa-chevron-right"></i>';
                }
                const dropdownMenu = dropdownParent.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.style.maxHeight = '0px';
                    dropdownMenu.style.padding = '0';
                }
            }
        }

        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('operatorMobileMenuToggle');
        const menuArea = document.getElementById('operatorMenuArea');
        const mobileMenuOverlay = document.getElementById('operatorMobileMenuOverlay');

        // Debug viewport info (comment out in production)
        if (console && console.log) {
            console.log('🖥️ Operator Viewport:', window.innerWidth + 'x' + window.innerHeight,
                       '| Screen:', window.screen.width + 'x' + window.screen.height,
                       '| Zoom:', Math.round(window.devicePixelRatio * 100) + '%');
        }

        document.addEventListener('click', function(event) {
            if (isTogglingOperatorProfileMenu) {
                isTogglingOperatorProfileMenu = false;
                return;
            }

            const profileMenu = document.getElementById('profileMenu');
            const logoBNN = document.getElementById('logoBNN');

            if (profileMenu && logoBNN) {
                if (!profileMenu.contains(event.target) && !logoBNN.contains(event.target)) {
                    if (profileMenu.classList.contains('active')) {
                        closeProfileMenu();
                    }
                }
            }
        });

        function bindOperatorMobileDropdownToggle() {
            const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
            if (!dropdownParent) return;

            if (dropdownParent.dataset.bound === 'true') {
                dropdownParent.removeEventListener('click', dropdownParent._mobileClickHandler);
            }

            if (window.innerWidth <= 1366) {
                dropdownParent._mobileClickHandler = function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    dropdownParent.classList.toggle('active');

                    const arrow = dropdownParent.querySelector('.dropdown-arrow');
                    if (arrow) {
                        arrow.innerHTML = dropdownParent.classList.contains('active') ?
                            '<i class="fas fa-chevron-down"></i>' :
                            '<i class="fas fa-chevron-right"></i>';
                    }

                    const dropdownMenu = dropdownParent.querySelector('.dropdown-menu');
                    if (dropdownMenu) {
                        const isActive = dropdownParent.classList.contains('active');
                        dropdownMenu.style.maxHeight = isActive ? '200px' : '0px';
                        dropdownMenu.style.padding = isActive ? '0.5rem 0' : '0';
                    }
                };

                dropdownParent.addEventListener('click', dropdownParent._mobileClickHandler);
                dropdownParent.dataset.bound = 'true';
            } else {
                dropdownParent.dataset.bound = 'false';
            }
        }

        bindOperatorMobileDropdownToggle();

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeOperatorMobileMenu);
        }

        if (menuArea) {
            const menuItems = menuArea.querySelectorAll('.menu-btn a, .dropdown-menu a');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        setTimeout(() => closeOperatorMobileMenu(), 100);
                    }
                });
            });
        }

        window.addEventListener('resize', function() {
            closeOperatorMobileMenu();
            closeProfileMenu();

            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';

            const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
            if (dropdownParent) {
                dropdownParent.classList.remove('active');

                const arrow = dropdownParent.querySelector('.dropdown-arrow');
                if (arrow) {
                    arrow.innerHTML = '<i class="fas fa-chevron-right"></i>';
                }

                const dropdownMenu = dropdownParent.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.style.maxHeight = '';
                    dropdownMenu.style.padding = '';
                }
            }

            bindOperatorMobileDropdownToggle();
        });
    });
</script>
