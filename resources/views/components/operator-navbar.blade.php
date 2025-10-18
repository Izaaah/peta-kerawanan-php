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
    // Prevent immediate close when opening
    let isTogglingProfileMenu = false;

    // Global function untuk toggle profile menu
    function toggleProfileMenu(event) {
        console.log('=== Toggle Profile Menu ===');
        console.log('Window width:', window.innerWidth);
        console.log('Event:', event);

        // Set flag to prevent immediate close
        isTogglingProfileMenu = true;

        // Disable on mobile
        if (window.innerWidth <= 768) {
            console.log('❌ Mobile detected (width ≤ 768px), toggle disabled');
            isTogglingProfileMenu = false;
            return;
        }

        // Close mobile menu if open
        closeOperatorMobileMenu();

        const profileMenu = document.getElementById('profileMenu');
        console.log('Profile menu element:', profileMenu);

        if (profileMenu) {
            const isActive = profileMenu.classList.contains('active');
            const computedStyle = window.getComputedStyle(profileMenu);

            console.log('Current active status:', isActive);
            console.log('Current display:', computedStyle.display);
            console.log('Current right:', computedStyle.right);

            if (isActive) {
                profileMenu.classList.remove('active');
                console.log('✅ Menu CLOSED');
                isTogglingProfileMenu = false;
            } else {
                profileMenu.classList.add('active');
                console.log('✅ Menu OPENED');

                // Check again after adding class
                setTimeout(() => {
                    const newStyle = window.getComputedStyle(profileMenu);
                    console.log('After opening - display:', newStyle.display, 'right:', newStyle.right);
                }, 100);
            }
        } else {
            console.error('❌ Profile menu element not found!');
            isTogglingProfileMenu = false;
        }

        // Stop event propagation to prevent immediate close
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

    // Global function untuk toggle operator mobile menu
    function toggleOperatorMobileMenu() {
        console.log('Operator mobile menu toggle clicked!');

        const menuArea = document.getElementById('operatorMenuArea');
        const mobileMenuOverlay = document.getElementById('operatorMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('operatorMobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            // Close profile menu if open
            closeProfileMenu();

            // Toggle classes
            menuArea.classList.toggle('mobile-menu-open');
            mobileMenuOverlay.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');

            // Lock/unlock background scroll when menu is open
            if (menuArea.classList.contains('mobile-menu-open')) {
                document.body.style.overflow = 'hidden';
                document.documentElement.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
                document.documentElement.style.overflow = '';
            }

            console.log('Operator menu toggled:', menuArea.classList.contains('mobile-menu-open'));
        } else {
            console.log('Operator elements not found:', {
                menu: menuArea,
                overlay: mobileMenuOverlay,
                toggle: mobileMenuToggle
            });
        }
    }

    function closeOperatorMobileMenu() {
        console.log('Closing operator menu');
        const menuArea = document.getElementById('operatorMenuArea');
        const mobileMenuOverlay = document.getElementById('operatorMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('operatorMobileMenuToggle');

        if (menuArea && mobileMenuOverlay && mobileMenuToggle) {
            menuArea.classList.remove('mobile-menu-open');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';

            // Close any open dropdown menus
            const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
            if (dropdownParent && dropdownParent.classList.contains('active')) {
                dropdownParent.classList.remove('active');
                const arrow = dropdownParent.querySelector('.dropdown-arrow');
                if (arrow) {
                    arrow.innerHTML = '<i class="fas fa-chevron-right"></i>'; // Reset to right arrow
                }
                const dropdownMenu = dropdownParent.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.style.maxHeight = '0px';
                    dropdownMenu.style.padding = '0';
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log('Operator navbar script loaded');

        const mobileMenuToggle = document.getElementById('operatorMobileMenuToggle');
        const menuArea = document.getElementById('operatorMenuArea');
        const mobileMenuOverlay = document.getElementById('operatorMobileMenuOverlay');

        console.log('Elements found:', {
            toggle: mobileMenuToggle,
            menu: menuArea,
            overlay: mobileMenuOverlay
        });

        // Close profile menu when clicking outside
        document.addEventListener('click', function(event) {
            // Skip if currently toggling
            if (isTogglingProfileMenu) {
                console.log('Skipping outside click check - currently toggling');
                isTogglingProfileMenu = false;
                return;
            }

            const profileMenu = document.getElementById('profileMenu');
            const logoBNN = document.getElementById('logoBNN');

            if (profileMenu && logoBNN) {
                // Check if click is outside both menu and logo
                if (!profileMenu.contains(event.target) && !logoBNN.contains(event.target)) {
                    if (profileMenu.classList.contains('active')) {
                        console.log('Closing menu from outside click');
                        closeProfileMenu();
                    }
                }
            }
        });

        // Handle dropdown menu toggle on mobile/iPad/tablet/1200px range
        function bindOperatorMobileDropdownToggle() {
            const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
            if (dropdownParent) {
                // Remove existing event listener if bound
                if (dropdownParent.dataset.bound === 'true') {
                    dropdownParent.removeEventListener('click', dropdownParent._mobileClickHandler);
                }

                if (window.innerWidth <= 1366) {
                    // Create new click handler for mobile/iPad/tablet/1200px range
                    dropdownParent._mobileClickHandler = function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Toggle active class
                        dropdownParent.classList.toggle('active');

                        // Update arrow direction
                        const arrow = dropdownParent.querySelector('.dropdown-arrow');
                        if (arrow) {
                            if (dropdownParent.classList.contains('active')) {
                                arrow.innerHTML = '<i class="fas fa-chevron-down"></i>'; // Down arrow when open
                            } else {
                                arrow.innerHTML = '<i class="fas fa-chevron-right"></i>'; // Right arrow when closed
                            }
                        }

                        // Force reflow to ensure CSS transition works
                        const dropdownMenu = dropdownParent.querySelector('.dropdown-menu');
                        if (dropdownMenu) {
                            dropdownMenu.style.maxHeight = dropdownParent.classList.contains('active') ? '200px' : '0px';
                            dropdownMenu.style.padding = dropdownParent.classList.contains('active') ? '0.5rem 0' : '0';
                        }

                        console.log('Operator Mobile/Tablet/1200px dropdown toggled:', dropdownParent.classList.contains('active'));
                    };

                    // Add event listener
                    dropdownParent.addEventListener('click', dropdownParent._mobileClickHandler);
                    dropdownParent.dataset.bound = 'true';
                    console.log('Operator Mobile/Tablet/1200px dropdown toggle bound for width:', window.innerWidth);
                } else {
                    // Remove mobile functionality for desktop
                    dropdownParent.dataset.bound = 'false';
                    console.log('Operator Mobile dropdown toggle unbound for desktop');
                }
            }
        }

        bindOperatorMobileDropdownToggle();

        // Debug: Check if elements exist
        console.log('Operator mobile menu toggle:', mobileMenuToggle);
        console.log('Operator menu area:', menuArea);
        console.log('Operator mobile menu overlay:', mobileMenuOverlay);

        if (!mobileMenuToggle || !menuArea || !mobileMenuOverlay) {
            console.error('Required operator elements not found');
            return;
        }

        // Close mobile menu when clicking overlay
        mobileMenuOverlay.addEventListener('click', closeOperatorMobileMenu);

        // Close mobile menu when clicking on menu items (only on mobile)
        if (menuArea) {
            const menuItems = menuArea.querySelectorAll('.menu-btn a, .dropdown-menu a');
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    // Only close menu on mobile, don't prevent navigation
                    if (window.innerWidth <= 768) {
                        setTimeout(() => closeOperatorMobileMenu(), 100);
                    }
                    // Don't prevent default - allow navigation to happen
                });
            });
            console.log('Event listeners added to', menuItems.length, 'menu items');
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            // Close mobile menu on resize to desktop
            if (window.innerWidth > 1366) {
                menuArea.classList.remove('mobile-menu-open');
                mobileMenuOverlay.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                closeProfileMenu();

                // Reset dropdown state for desktop
                const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
                if (dropdownParent) {
                    dropdownParent.classList.remove('active');
                    // Reset arrow to right direction
                    const arrow = dropdownParent.querySelector('.dropdown-arrow');
                    if (arrow) {
                        arrow.innerHTML = '<i class="fas fa-chevron-right"></i>';
                    }
                    // Reset dropdown menu styles
                    const dropdownMenu = dropdownParent.querySelector('.dropdown-menu');
                    if (dropdownMenu) {
                        dropdownMenu.style.maxHeight = '';
                        dropdownMenu.style.padding = '';
                    }
                }
            }

            // Rebind mobile dropdown toggle as viewport changes (mobile/iPad/tablet/1200px range)
            bindOperatorMobileDropdownToggle();
        });

        // Debug: Log current screen width
        console.log('Operator current screen width:', window.innerWidth);
        console.log('Operator mobile menu toggle display:', window.getComputedStyle(mobileMenuToggle).display);
    });
</script>
