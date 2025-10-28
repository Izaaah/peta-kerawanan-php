<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">

<style>
    .notification-section-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .notification-section-title {
        font-size: 12px;
        font-weight: 600;
        color: #6c757d;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .notification-item.pending {
        opacity: 0.8;
        background-color: #fff3cd;
        border-left: 3px solid #ffc107;
    }

    .notification-item.pending .notification-item-title {
        color: #856404;
    }

    .notification-item.pending .notification-item-message {
        color: #856404;
    }
</style>

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
            Peta <span class="dropdown-arrow"><i class="fas fa-chevron-right"></i></span>
            <ul class="dropdown-menu">
                <li><a href="{{ route('peta-penyalahgunaan.domisili') }}">Peta Kerawanan<br>Berdasarkan NIK</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.tkp') }}">Peta Kerawanan<br>Berdasarkan TKP</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.titik-masuk') }}">Peta Kawasan<br>Titik Masuk</a></li>
            </ul>
        </div>
        {{-- <div class="menu-btn"><a href="{{ route('admin.input.index') }}">Input</a></div> --}}

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
                @if (isset($totalNotificationCount) && $totalNotificationCount > 0) style="display: flex;" @else style="display: none;" @endif>
                <span class="notification-count">{{ $totalNotificationCount ?? 0 }}</span>
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
            @if (isset($approvedVerifications) && $approvedVerifications->count() > 0)
                <!-- Approved Verifications Section -->
                <div class="notification-section-header py-4 px-6 md:py-5 md:px-8 -mx-6 md:-mx-8 mb-2">
                    <h3 class="notification-section-title">✅ Verifikasi Disetujui</h3>
                </div>
                @foreach ($approvedVerifications->take(4) as $verification)
                    <div class="notification-item unread"
                        onclick="handleVerificationClick({{ $verification->id }}, '{{ $verification->table_name }}', {{ $verification->data_id }})"
                        style="cursor: pointer;">
                        <div class="notification-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="notification-item-content">
                            <div class="notification-item-title">Verifikasi Disetujui -
                                {{ $verification->table_display_name }}</div>
                            <div class="notification-item-message">
                                @if ($verification->data_id == 0)
                                    Data baru Anda telah disetujui oleh
                                    {{ $verification->superAdmin->name ?? 'Super Admin' }}. Klik untuk melanjutkan
                                    input data.
                                @else
                                    Perubahan data Anda telah disetujui oleh
                                    {{ $verification->superAdmin->name ?? 'Super Admin' }}. Klik untuk melanjutkan edit
                                    data.
                                @endif
                            </div>
                            <div class="notification-item-time">{{ $verification->updated_at->diffForHumans() }}</div>
                        </div>
                        <div class="notification-item-status"></div>
                    </div>
                @endforeach
            @endif

            @if (isset($pendingVerifications) && $pendingVerifications->count() > 0)
                <!-- Pending Verifications Section -->
                <div class="notification-section-header py-4 px-6 md:py-5 md:px-8 -mx-6 md:-mx-8 mb-2">
                    <h3 class="notification-section-title">⏳ Menunggu Verifikasi</h3>
                </div>
                @foreach ($pendingVerifications->take(4) as $verification)
                    <div class="notification-item pending">
                        <div class="notification-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="notification-item-content">
                            <div class="notification-item-title">Menunggu Verifikasi -
                                {{ $verification->table_display_name }}</div>
                            <div class="notification-item-message">
                                @if ($verification->data_id == 0)
                                    Data baru Anda sedang menunggu verifikasi dari Super Admin
                                @else
                                    Perubahan data Anda sedang menunggu verifikasi dari Super Admin
                                @endif
                            </div>
                            <div class="notification-item-time">{{ $verification->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="notification-item-status"></div>
                    </div>
                @endforeach
            @endif

            @if (
                (!isset($approvedVerifications) || $approvedVerifications->count() == 0) &&
                    (!isset($pendingVerifications) || $pendingVerifications->count() == 0))
                <div class="notification-item">
                    <div class="notification-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="notification-item-content">
                        <div class="notification-item-title">Tidak Ada Notifikasi</div>
                        <div class="notification-item-message">Tidak ada verifikasi yang perlu ditindaklanjuti saat ini
                        </div>
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
        <span class="profile-menu-title">Menu Akun Admin</span>
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
                @if (isset($totalNotificationCount) && $totalNotificationCount > 0) style="display: flex;" @else style="display: none;" @endif>
                <span class="notification-menu-count">{{ $totalNotificationCount ?? 0 }}</span>
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
<div class="mobile-menu-overlay" id="adminMobileMenuOverlay"></div>

<script>
    let isTogglingAdminProfileMenu = false;

    function toggleProfileMenu(event) {
        isTogglingAdminProfileMenu = true;

        if (window.innerWidth <= 768) {
            isTogglingAdminProfileMenu = false;
            return;
        }

        closeAdminMobileMenu();

        const profileMenu = document.getElementById('profileMenu');

        if (profileMenu) {
            const isActive = profileMenu.classList.contains('active');

            if (isActive) {
                profileMenu.classList.remove('active');
                isTogglingAdminProfileMenu = false;
            } else {
                profileMenu.classList.add('active');
                // Reset flag after a short delay to ensure click event is fully processed
                setTimeout(function() {
                    isTogglingAdminProfileMenu = false;
                }, 100);
            }
        } else {
            isTogglingAdminProfileMenu = false;
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

    function fetchVerificationCount() {
        fetch('{{ route('admin.notifications.count') }}', {
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
        .catch(error => console.error('Error fetching verification count:', error));
    }

    function startNotificationRefresh() {
        setInterval(fetchVerificationCount, 30000);
    }

    function handleVerificationClick(verificationId, tableName, dataId) {
        closeNotificationPopup();

        const routeMap = {
            'data_individu_tsk': 'data-individu',
            'thm': 'thm',
            'lsm_narkotika': 'lsm',
            'media_sosial': 'medsos',
            'penjual_vape': 'vape',
            'perusahaan_farmasi_prekursor': 'farmasi',
            'objek_vital': 'objek',
            'penggiat_narkotika': 'penggiat',
            'penginapan': 'penginapan',
            'rutan_lapas': 'rutan',
            'transportasi': 'transportasi',
            'ekspedisi': 'ekspedisi',
            'lembaga_rehabilitasi': 'rehabilitasi',
        };

        const routePath = routeMap[tableName];

        if (routePath) {
            if (dataId && dataId > 0) {
                window.location.href = `/admin/${routePath}/${dataId}/edit`;
            } else {
                window.location.href = `/admin/${routePath}/create`;
            }
        } else {
            alert('Tidak dapat menentukan halaman tujuan untuk tabel: ' + tableName);
        }
    }

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
    }

    function hideNotificationBadge() {
        const badge = document.getElementById('notificationBadge');
        const menuBadge = document.getElementById('notificationMenuBadge');

        if (badge) badge.style.display = 'none';
        if (menuBadge) menuBadge.style.display = 'none';
    }

    function updateNotificationCount(count) {
        const badge = document.getElementById('notificationBadge');
        const menuBadge = document.getElementById('notificationMenuBadge');

        if (badge) {
            const countElement = badge.querySelector('.notification-count');
            if (countElement) {
                countElement.textContent = count;
            }
            badge.style.display = count > 0 ? 'flex' : 'none';
        }

        if (menuBadge) {
            const menuCountElement = menuBadge.querySelector('.notification-menu-count');
            if (menuCountElement) {
                menuCountElement.textContent = count;
            }
            menuBadge.style.display = count > 0 ? 'flex' : 'none';
        }
    }

    function showNotificationPanel(event) {
        event.preventDefault();
        event.stopPropagation();
        closeProfileMenu();
        showNotificationPopup();
    }

    function showNotificationPopup() {
        const overlay = document.getElementById('notificationPopupOverlay');
        if (overlay) {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeNotificationPopup() {
        const overlay = document.getElementById('notificationPopupOverlay');
        if (overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    function markAllAsRead() {
        const unreadItems = document.querySelectorAll('.notification-item.unread');
        unreadItems.forEach(item => item.classList.remove('unread'));

        updateNotificationCount(0);

        const markAllBtn = document.getElementById('markAllBtn');
        if (markAllBtn) {
            markAllBtn.textContent = 'Semua Sudah Dibaca';
            markAllBtn.style.background = '#28a745';
            markAllBtn.style.cursor = 'default';
            markAllBtn.onclick = null;
        }
    }

    function toggleAdminMobileMenu() {
        const menuArea = document.getElementById('adminMenuArea');
        const mobileMenuOverlay = document.getElementById('adminMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('adminMobileMenuToggle');

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

    function closeAdminMobileMenu() {
        const menuArea = document.getElementById('adminMenuArea');
        const mobileMenuOverlay = document.getElementById('adminMobileMenuOverlay');
        const mobileMenuToggle = document.getElementById('adminMobileMenuToggle');

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
        const mobileMenuToggle = document.getElementById('adminMobileMenuToggle');
        const menuArea = document.getElementById('adminMenuArea');
        const mobileMenuOverlay = document.getElementById('adminMobileMenuOverlay');

        // Debug viewport info (comment out in production)
        if (console && console.log) {
            console.log('🖥️ Admin Viewport:', window.innerWidth + 'x' + window.innerHeight,
                       '| Screen:', window.screen.width + 'x' + window.screen.height,
                       '| Zoom:', Math.round(window.devicePixelRatio * 100) + '%');
        }

        const verificationCount = {{ $totalNotificationCount ?? 0 }};
        if (verificationCount > 0) {
            showNotificationBadge(verificationCount);
        } else {
            hideNotificationBadge();
        }

        const notificationBadge = document.getElementById('notificationBadge');
        if (notificationBadge) {
            notificationBadge.addEventListener('click', function(e) {
                e.stopPropagation();
                showNotificationPopup();
            });
        }

        const notificationPopupOverlay = document.getElementById('notificationPopupOverlay');
        if (notificationPopupOverlay) {
            notificationPopupOverlay.addEventListener('click', function(e) {
                if (e.target === notificationPopupOverlay) {
                    closeNotificationPopup();
                }
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeNotificationPopup();
            }
        });

        document.addEventListener('click', function(event) {
            if (isTogglingAdminProfileMenu) {
                isTogglingAdminProfileMenu = false;
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

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeAdminMobileMenu);
        }

        function bindAdminMobileDropdownToggle() {
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

        bindAdminMobileDropdownToggle();

        if (menuArea) {
            const menuItems = menuArea.querySelectorAll('.menu-btn a, .dropdown-menu a');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        if (!item.closest('.dropdown-menu')) {
                            setTimeout(() => closeAdminMobileMenu(), 100);
                        }
                    }
                });
            });
        }

        window.addEventListener('resize', function() {
            closeAdminMobileMenu();
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

            bindAdminMobileDropdownToggle();
        });

        startNotificationRefresh();
    });
</script>
