<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIJAGAD - Peta Kerawanan Narkoba</title>
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial
        }

        /* Hamburger Menu Styles */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 4px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #7c2d12;
            flex-direction: column;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }

        .mobile-menu.active {
            display: flex;
        }

        .mobile-menu a {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .mobile-menu a:hover {
            color: #fecaca;
        }

        .mobile-menu a:last-child {
            border-bottom: none;
        }

        /* Responsive Navigation */
        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .desktop-nav {
                display: none !important;
            }

            .navbar-container {
                position: relative;
            }
        }

        /* Desktop Navigation - Hide hamburger on larger screens */
        @media (min-width: 769px) {
            .hamburger {
                display: none !important;
            }

            .desktop-nav {
                display: flex !important;
            }

            .mobile-menu {
                display: none !important;
            }
        }

        /* Mobile Card Sizing */
        @media (max-width: 768px) {
            .vision-card {
                min-height: 200px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .feature-card {
                min-height: 200px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-red-800 text-white">
        <div class="navbar-container max-w-7xl mx-auto flex items-center justify-between py-4 px-6">
            <a href="#" class="flex items-center gap-3">
                <span class="bg-white text-blue-700 p-2 rounded-xl shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7l9-4 9 4-9 4-9-4zM3 7v10l9 4 9-4V7" />
                    </svg>
                </span>
                <div>
                    <p class="font-extrabold text-xl leading-tight">Peta Kerawanan Narkoba</p>
                    <p class="text-xs opacity-90 -mt-1">Sistem Informasi Monitoring Kasus</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav flex items-center gap-6 text-sm">
                <a href="#" class="hover:text-gray-200">Beranda</a>
                <a href="#statistik" class="hover:text-gray-200">Statistik</a>
                <a href="#tentang" class="hover:text-gray-200">Laporan</a>
                <a href="#footer" class="hover:text-gray-200">Kontak</a>
            </nav>

            <!-- Hamburger Menu Button -->
            <div class="hamburger" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Mobile Navigation Menu -->
            <nav class="mobile-menu" id="mobileMenu">
                <a href="#" onclick="closeMobileMenu()">Beranda</a>
                <a href="#statistik" onclick="closeMobileMenu()">Statistik</a>
                <a href="#tentang" onclick="closeMobileMenu()">Laporan</a>
                <a href="#footer" onclick="closeMobileMenu()">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="bg-gradient-to-b from-red-700 to-red-900 text-white text-center py-20">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-5xl md:text-6xl font-extrabold mb-5 tracking-tight">SIJAGAD</h2>
            <p class="text-lg md:text-xl mb-4 opacity-95">
                Sistem Informasi Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen Dasar
            </p>
            <p class="text-sm md:text-base text-white-100 mb-10">
                Sistem visualisasi untuk memantau tingkat kerawanan Narkoba di Jawa Timur secara real-time.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="peta.php"
                    class="bg-red-800 hover:bg-red-900 px-6 py-3 rounded-lg shadow-lg inline-flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    Lihat Peta Sekarang
                </a>
                <a href="eksplorasi.php"
                    class="border border-red px-6 py-3 rounded-lg hover:bg-red-900 inline-flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Mulai Eksplorasi
                </a>
            </div>
        </div>
    </section>

    <!-- RINGKASAN STATISTIK -->
    <section id="statistik" class="max-w-7xl mx-auto py-16 px-6">
        <h3 class="text-2xl md:text-3xl font-semibold text-center mb-10">Ringkasan Statistik</h3>
        <div class="grid md:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-blue-500">
                <div class="flex justify-center mb-4">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">📊</div>
                </div>
                <p class="text-4xl font-extrabold tracking-tight">4,524</p>
                <p class="text-gray-600">Total Kasus</p>
                <p class="text-green-600 text-sm mt-2">↓ 8% dari bulan lalu</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-red-500">
                <div class="flex justify-center mb-4">
                    <div class="bg-red-100 text-red-600 p-3 rounded-full">⚠️</div>
                </div>
                <p class="text-xl font-extrabold">Jawa Timur</p>
                <p class="text-gray-600">Daerah Rawan Tertinggi</p>
                <p class="text-red-600 text-sm mt-2">↑ 512 kasus aktif</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-green-500">
                <div class="flex justify-center mb-4">
                    <div class="bg-green-100 text-green-600 p-3 rounded-full">📈</div>
                </div>
                <p class="text-4xl font-extrabold tracking-tight">189</p>
                <p class="text-gray-600">Tren Bulanan</p>
                <p class="text-green-600 text-sm mt-2">↓ Menurun 12% bulan ini</p>
            </div>

        </div>
    </section>

    <!-- TENTANG PLATFORM INI -->
    <section id="tentang" class="bg-white-800 text-black py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-extrabold mb-3">Tentang Platform Ini</h3>
            <p class="mb-10 text-white-100 max-w-3xl">
                Platform Peta Kerawanan Narkoba adalah sistem informasi terintegrasi yang menyajikan visualisasi data
                dan analisis
                mengenai persebaran kasus narkoba di Indonesia.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- 4 small cards -->
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="feature-card bg-gradient-to-b from-red-700 to-red-900 rounded-2xl p-6 shadow">
                        <h4 class="font-semibold text-lg mb-2 text-white">📡 Data Terintegrasi</h4>
                        <p class="text-sm text-white">Menggabungkan data dari berbagai instansi untuk informasi yang
                            akurat dan terpercaya.</p>
                    </div>
                    <div class="feature-card bg-gradient-to-b from-red-700 to-red-900 rounded-2xl p-6 shadow">
                        <h4 class="font-semibold text-lg mb-2 text-white">⏱️ Update Real-time</h4>
                        <p class="text-sm text-white">Data diperbarui berkala memastikan informasi terkini di lapangan.
                        </p>
                    </div>
                    <div class="feature-card bg-gradient-to-b from-red-700 to-red-900 rounded-2xl p-6 shadow">
                        <h4 class="font-semibold text-lg mb-2 text-white">🛡️ Keamanan Data</h4>
                        <p class="text-sm text-white">Keamanan berlapis untuk melindungi integritas dan kerahasiaan
                            data.</p>
                    </div>
                    <div class="feature-card bg-gradient-to-b from-red-700 to-red-900 rounded-2xl p-6 shadow">
                        <h4 class="font-semibold text-lg mb-2 text-white">🤝 Kolaborasi Multi-Instansi</h4>
                        <p class="text-sm text-white">Kolaborasi lintas instansi untuk pencegahan dan penanganan
                            narkoba.</p>
                    </div>
                </div>

                <!-- big vision card -->
                <div
                    class="vision-card bg-gradient-to-b from-red-700 to-red-900 rounded-2xl p-8 flex flex-col items-center justify-center text-center shadow relative">
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-4">
                        <span class="text-3xl">📊</span>
                    </div>
                    <h4 class="text-xl font-extrabold mb-2 text-white">Visi Kami</h4>
                    <p class="text-sm text-white">
                        Mewujudkan Indonesia bebas narkoba melalui sistem informasi yang transparan, akurat, dan
                        terintegrasi untuk
                        mendukung pengambilan keputusan yang efektif.
                    </p>
                </div>

            </div>
        </div>
    </section>

</html>

<!-- FOOTER -->
<footer id="footer" class="bg-red-900 text-white pt-12">
    <div class="max-w-7xl mx-auto px-6 pb-8">
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Informasi Kontak -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Informasi Kontak</h5>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V21a1 1 0 01-1 1C10.19 22 2 13.81 2 3a1 1 0 011-1h3.49a1 1 0 011 1c0 1.24.2 2.45.57 3.57a1 1 0 01-.24 1.02l-2.2 2.2z" />
                        </svg>
                        <span>+62 21 1234 5678</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M2 4a2 2 0 012-2h16a2 2 0 012 2v1l-10 6L2 5V4zm0 4.236V20a2 2 0 002 2h16a2 2 0 002-2V8.236l-9.445 5.666a2 2 0 01-2.11 0L2 8.236z" />
                        </svg>
                        <span>info@petanarkoba.go.id</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z" />
                        </svg>
                        <span>Jakarta, Indonesia</span>
                    </li>
                </ul>
            </div>

            <!-- Tautan Penting -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Tautan Penting</h5>
                <ul class="space-y-3 text-sm">
                    <li><a class="hover:underline" href="#">Panduan Penggunaan</a></li>
                    <li><a class="hover:underline" href="#">Kebijakan Privasi</a></li>
                    <li><a class="hover:underline" href="#">Syarat dan Ketentuan</a></li>
                    <li><a class="hover:underline" href="#">FAQ</a></li>
                </ul>
            </div>

            <!-- Instansi Terkait -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Instansi Terkait</h5>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2">🛡️ <span>Polri</span></li>
                    <li class="flex items-center gap-2">⚖️ <span>BNN</span></li>
                    <li class="flex items-center gap-2">🏛️ <span>Kemendagri</span></li>
                </ul>
            </div>

            <!-- Media Sosial -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Media Sosial</h5>
                <div class="flex items-center gap-3">
                    <a href="#"
                        class="bg-blue-700 hover:bg-blue-600 w-10 h-10 rounded-lg grid place-items-center"
                        aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M22 12a10 10 0 10-11.5 9.9v-7H7.9V12h2.6V9.8c0-2.6 1.5-4 3.8-4 1.1 0 2.3.2 2.3.2v2.5h-1.3c-1.3 0-1.7.8-1.7 1.6V12h2.9l-.5 2.9h-2.4v7A10 10 0 0022 12z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="bg-blue-700 hover:bg-blue-600 w-10 h-10 rounded-lg grid place-items-center"
                        aria-label="Twitter/X">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M17.6 3H21l-7.6 8.7L22 21h-6l-4.7-5.5L6 21H3l8.4-9.7L2 3h6l4.3 5L17.6 3z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="bg-blue-700 hover:bg-blue-600 w-10 h-10 rounded-lg grid place-items-center"
                        aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm5 5a5 5 0 100 10 5 5 0 000-10zm6-1a1 1 0 100 2 1 1 0 000-2z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="bg-blue-700 hover:bg-blue-600 w-10 h-10 rounded-lg grid place-items-center"
                        aria-label="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M23.5 6.2a3 3 0 00-2.1-2.1C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.4.6A3 3 0 00.5 6.2 31 31 0 000 12a31 31 0 00.5 5.8 3 3 0 002.1 2.1c1.8.6 9.4.6 9.4.6s7.6 0 9.4-.6a3 3 0 002.1-2.1A31 31 0 0024 12a31 31 0 00-.5-5.8zM9.7 15.6V8.4L15.8 12l-6.1 3.6z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-black-700 my-8">

        <div class="text-center text-sm">
            <p class="mb-3">© 2024 Peta Kerawanan Narkoba. Seluruh hak cipta dilindungi.</p>
            <p class="text-white-200">
                <span class="font-semibold">Disclaimer:</span>
                Data yang ditampilkan bersifat informatif dan dapat berubah sewaktu-waktu.
                Untuk informasi resmi, silakan hubungi instansi terkait.
            </p>
        </div>
    </div>
</footer>

    <!-- JavaScript for Hamburger Menu -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.querySelector('.hamburger');

            mobileMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.querySelector('.hamburger');

            mobileMenu.classList.remove('active');
            hamburger.classList.remove('active');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.querySelector('.hamburger');
            const navbarContainer = document.querySelector('.navbar-container');

            if (!navbarContainer.contains(event.target)) {
                mobileMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });

        // Close mobile menu on window resize if screen becomes larger
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburger = document.querySelector('.hamburger');

                mobileMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });

        // Ensure proper initial state on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth > 768) {
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburger = document.querySelector('.hamburger');

                mobileMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });
    </script>

</body>

</html>
