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
        <img src="{{ asset('img/sijagad.png') }}" alt="Logo Sijagad" class="sijagad-logo">
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
        <div class="mobile-profile-section">
            <div class="profile-divider">
                <div class="divider-line"></div>
                <span class="divider-text">Akun</span>
                <div class="divider-line"></div>
            </div>
            <a href="{{ route('profile.edit') }}" class="mobile-profile-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="mobile-profile-icon" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: block; width: 100%;">
                @csrf
                <button type="submit" class="mobile-logout-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mobile-profile-icon" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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
            <img src="{{ asset('img/logo-bnn.png') }}" alt="Logo BNN">
            <!-- Notification Badge -->
            <div class="notification-badge" id="notificationBadge"
                @if (isset($pendingVerificationCount) && $pendingVerificationCount > 0) style="display: flex;" @else style="display: none;" @endif>
                <span class="notification-count">{{ $pendingVerificationCount ?? 0 }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Notification Popup Modal -->
<div class="notification-popup-overlay" id="notificationPopupOverlay">
    <div class="notification-popup" id="notificationPopup">
        <div class="notification-popup-header">
            <div class="notification-popup-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="notification-popup-icon" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 0 0-15 0v5h5l-5 5-5-5h5v-5a7.5 7.5 0 0 1 15 0v5z" />
                </svg>
                <span>Notifikasi Terbaru</span>
            </div>
            <button class="notification-popup-close" onclick="closeNotificationPopup()">✕</button>
        </div>
        <div class="notification-popup-content">
            @if (isset($pendingVerifications) && $pendingVerifications->count() > 0)
                @foreach ($pendingVerifications->take(8) as $verification)
                    <div class="notification-item unread">
                        <div class="notification-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="notification-item-content">
                            <div class="notification-item-title">Verifikasi Data
                                {{ $verification->table_display_name }}</div>
                            <div class="notification-item-message">
                                @if ($verification->data_id == 0)
                                    Data baru dari BNNK {{ $verification->admin->name ?? 'Admin' }} memerlukan
                                    verifikasi
                                @else
                                    Perubahan data dari BNNK {{ $verification->admin->name ?? 'Admin' }} memerlukan
                                    verifikasi
                                @endif
                            </div>
                            <div class="notification-item-time">{{ $verification->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="notification-item-status"></div>
                    </div>
                @endforeach
            @else
                <div class="notification-item">
                    <div class="notification-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="notification-item-content">
                        <div class="notification-item-title">Tidak Ada Verifikasi</div>
                        <div class="notification-item-message">Tidak ada data yang memerlukan verifikasi saat ini</div>
                        <div class="notification-item-time">Sekarang</div>
                    </div>
                    <div class="notification-item-status"></div>
                </div>
            @endif
        </div>
        <div class="notification-popup-footer">
            <button class="notification-mark-all-btn" id="markAllBtn" onclick="markAllAsRead()">
                Tandai Semua Dibaca
            </button>
        </div>
    </div>
</div>

<!-- Profile Menu (No Overlay, Desktop Only) -->
<div class="profile-menu" id="profileMenu">
    <div class="profile-menu-header">
        <span class="profile-menu-title">Menu Akun</span>
        <button class="profile-menu-close" onclick="closeProfileMenu()">✕</button>
    </div>
    <div class="profile-menu-content">
        <a href="{{ route('profile.edit') }}" class="profile-menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="profile-menu-icon" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Profil</span>
        </a>
        <a href="#" class="profile-menu-item notification-menu-item" onclick="showNotificationPanel(event)">
            <svg xmlns="http://www.w3.org/2000/svg" class="profile-menu-icon" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 0 0-15 0v5h5l-5 5-5-5h5v-5a7.5 7.5 0 0 1 15 0v5z" />
            </svg>
            <span>Notifikasi</span>
            <div class="notification-menu-badge" id="notificationMenuBadge"
                @if (isset($pendingVerificationCount) && $pendingVerificationCount > 0) style="display: flex;" @else style="display: none;" @endif>
                <span class="notification-menu-count">{{ $pendingVerificationCount ?? 0 }}</span>
            </div>
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display: block;">
            @csrf
            <button type="submit" class="profile-menu-item profile-menu-logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="profile-menu-icon" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

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
        closeMobileMenu();

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

    // Close profile menu when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
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
    });

    // Global function untuk toggle mobile menu
    function toggleMobileMenu() {
        console.log('Toggle clicked via onclick!');

        const menuArea = document.getElementById('menuArea');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');

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
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        }
    }

    // Function to fetch verification count via AJAX
    function fetchVerificationCount() {
        fetch('{{ route('super-admin.notifications.count') }}', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateNotificationCount(data.count);
                }
            })
            .catch(error => {
                console.error('Error fetching verification count:', error);
            });
    }

    // Function to refresh notifications periodically
    function startNotificationRefresh() {
        // Refresh every 30 seconds
        setInterval(fetchVerificationCount, 30000);
    }

    // Notification Badge Functions
    function showNotificationBadge(count = 3) {
        const badge = document.getElementById('notificationBadge');
        const menuBadge = document.getElementById('notificationMenuBadge');

        if (badge) {
            const countElement = badge.querySelector('.notification-count');
            if (countElement) {
                countElement.textContent = count;
            }
            badge.style.display = 'flex';
        }

        if (menuBadge) {
            const menuCountElement = menuBadge.querySelector('.notification-menu-count');
            if (menuCountElement) {
                menuCountElement.textContent = count;
            }
            menuBadge.style.display = 'flex';
        }

        console.log('✅ Notification badges shown with count:', count);
    }

    function hideNotificationBadge() {
        const badge = document.getElementById('notificationBadge');
        const menuBadge = document.getElementById('notificationMenuBadge');

        if (badge) {
            badge.style.display = 'none';
        }

        if (menuBadge) {
            menuBadge.style.display = 'none';
        }

        console.log('❌ Notification badges hidden');
    }

    function updateNotificationCount(count) {
        const badge = document.getElementById('notificationBadge');
        const menuBadge = document.getElementById('notificationMenuBadge');

        if (badge) {
            const countElement = badge.querySelector('.notification-count');
            if (countElement) {
                countElement.textContent = count;
            }
            if (count > 0) {
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        }

        if (menuBadge) {
            const menuCountElement = menuBadge.querySelector('.notification-menu-count');
            if (menuCountElement) {
                menuCountElement.textContent = count;
            }
            if (count > 0) {
                menuBadge.style.display = 'flex';
            } else {
                menuBadge.style.display = 'none';
            }
        }

        console.log('📊 Notification count updated to:', count);
    }

    // Notification Panel Functions
    function showNotificationPanel(event) {
        event.preventDefault();
        event.stopPropagation();
        console.log('🔔 Notification panel clicked');

        // Close profile menu
        closeProfileMenu();

        // Show notification popup
        showNotificationPopup();
    }

    function showNotificationPopup() {
        const overlay = document.getElementById('notificationPopupOverlay');
        if (overlay) {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
            console.log('✅ Notification popup opened');
        }
    }

    function closeNotificationPopup() {
        const overlay = document.getElementById('notificationPopupOverlay');
        if (overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = ''; // Restore background scroll
            console.log('❌ Notification popup closed');
        }
    }

    function markAllAsRead() {
        console.log('📖 Marking all notifications as read');

        // Remove unread class from all notification items
        const unreadItems = document.querySelectorAll('.notification-item.unread');
        unreadItems.forEach(item => {
            item.classList.remove('unread');
        });

        // Update notification count to 0
        updateNotificationCount(0);

        // Update button text and style
        const markAllBtn = document.getElementById('markAllBtn');
        if (markAllBtn) {
            markAllBtn.textContent = 'Semua Sudah Dibaca';
            markAllBtn.style.background = '#28a745'; // Green color
            markAllBtn.style.cursor = 'default';
            markAllBtn.onclick = null; // Remove click functionality
        }

        // Don't close popup - let user see the changes
        // closeNotificationPopup();
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

        // Initialize notification badge with real verification count
        const verificationCount = {{ $pendingVerificationCount ?? 0 }};
        if (verificationCount > 0) {
            showNotificationBadge(verificationCount);
        } else {
            hideNotificationBadge();
        }

        // Add click event to notification badge
        const notificationBadge = document.getElementById('notificationBadge');
        if (notificationBadge) {
            notificationBadge.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering profile menu
                console.log('🔔 Notification badge clicked');
                showNotificationPopup();
            });
        }

        // Close notification popup when clicking outside
        const notificationPopupOverlay = document.getElementById('notificationPopupOverlay');
        if (notificationPopupOverlay) {
            notificationPopupOverlay.addEventListener('click', function(e) {
                if (e.target === notificationPopupOverlay) {
                    closeNotificationPopup();
                }
            });
        }

        // Close notification popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeNotificationPopup();
            }
        });

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);
            console.log('Event listener added to overlay');
        }

        // Close menu when clicking on menu items (only on mobile)
        if (menuArea) {
            const menuItems = menuArea.querySelectorAll('.menu-btn a, .dropdown-menu a');
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    // Only close menu on mobile, don't prevent navigation
                    if (window.innerWidth <= 768) {
                        setTimeout(() => closeMobileMenu(), 100);
                    }
                    // Don't prevent default - allow navigation to happen
                });
            });
            console.log('Event listeners added to', menuItems.length, 'menu items');
        }

        // Mobile dropdown toggle for "Peta"
        function bindMobileDropdownToggle() {
            if (window.innerWidth <= 768) {
                const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
                if (dropdownParent && !dropdownParent.dataset.bound) {
                    dropdownParent.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        dropdownParent.classList.toggle('active');
                    });
                    dropdownParent.dataset.bound = 'true';
                    console.log('Mobile dropdown toggle bound');
                }
            }
        }

        bindMobileDropdownToggle();

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeMobileMenu();
                closeProfileMenu();
            }
            // Rebind mobile dropdown toggle as viewport changes
            bindMobileDropdownToggle();
            if (window.innerWidth > 768) {
                const dropdownParent = document.querySelector('.menu-btn-peta.dropdown-parent');
                if (dropdownParent) dropdownParent.classList.remove('active');
            }
        });

        // Start periodic notification refresh
        startNotificationRefresh();

        // Example: Hide notification badge after 10 seconds (for demo)
        // setTimeout(() => {
        //     hideNotificationBadge();
        // }, 10000);
    });
</script>
