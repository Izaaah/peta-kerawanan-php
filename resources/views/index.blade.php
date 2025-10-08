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

        /* Modern color variables */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 12px 40px rgba(0, 0, 0, 0.15);
            --shadow-strong: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Modern glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-soft);
        }

        /* Modern gradient backgrounds */
        .gradient-primary {
            background: var(--primary-gradient);
        }

        .gradient-secondary {
            background: var(--secondary-gradient);
        }

        .gradient-accent {
            background: var(--accent-gradient);
        }

        .gradient-dark {
            background: var(--dark-gradient);
        }

        /* Modern card styles */
        .modern-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .modern-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-strong);
        }

        /* Floating elements */
        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Modern button styles */
        .btn-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        /* Modern section backgrounds */
        .section-bg {
            position: relative;
            overflow: hidden;
        }

        .section-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            z-index: -1;
        }

        /* Modern grid layout */
        .modern-grid {
            display: grid;
            gap: 2rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        /* Modern typography */
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-shadow {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        /* Fade in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Slide in from left */
        .slide-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s ease-out;
        }

        .slide-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Slide in from right */
        .slide-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s ease-out;
        }

        .slide-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Scale animation */
        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s ease-out;
        }

        .scale-in.visible {
            opacity: 1;
            transform: scale(1);
        }

        /* Stagger animation for cards */
        .stagger-item {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .stagger-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Counter animation */
        .counter {
            transition: all 0.5s ease-out;
        }

        /* Navbar scroll effect */
        .navbar-scrolled {
            background-color: rgba(153, 27, 27, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        /* Button hover effects */
        .btn-hover {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-hover:hover::before {
            left: 100%;
        }

        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Typing effect */
        .typing {
            border-right: 2px solid #fff;
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            50% {
                border-color: #fff;
            }

            51%,
            100% {
                border-color: transparent;
            }
        }

        /* Pulse animation */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 text-gray-800">

    <!-- NAVBAR -->
    <header id="navbar" class="glass fixed w-full top-0 z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-6 px-8">
            <a href="#" class="flex items-center gap-4">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl blur opacity-75">
                    </div>
                    <div class="relative bg-white p-3 rounded-2xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gradient" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h1 class="font-bold text-2xl text-gradient leading-tight">SIJAGAD</h1>
                    <p class="text-sm text-gray-600 font-medium">Sistem Informasi Monitoring Kasus</p>
                </div>
            </a>
            <nav class="hidden md:flex items-center gap-8">
                <a href="#"
                    class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 relative group">
                    Beranda
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#statistik"
                    class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 relative group">
                    Statistik
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#tentang"
                    class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 relative group">
                    Laporan
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#footer"
                    class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 relative group">
                    Kontak
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>
            <button class="md:hidden p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
    </header>

    <!-- HERO -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background dengan gradient dan floating elements -->
        <div class="absolute inset-0 gradient-primary"></div>
        <div class="absolute inset-0 bg-black opacity-20"></div>

        <!-- Floating decorative elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white opacity-10 rounded-full floating"
            style="animation-delay: 0s;"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-white opacity-10 rounded-full floating"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-20 w-12 h-12 bg-white opacity-10 rounded-full floating"
            style="animation-delay: 4s;"></div>
        <div class="absolute bottom-40 right-10 w-24 h-24 bg-white opacity-10 rounded-full floating"
            style="animation-delay: 1s;"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-6 text-center text-white">
            <div class="mb-8">
                <div class="inline-block p-4 rounded-full bg-white bg-opacity-20 backdrop-blur-lg mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
            </div>

            <h1 id="hero-title" class="text-6xl md:text-8xl font-black mb-8 tracking-tight text-shadow fade-in">
                SIJAGAD
            </h1>

            <p id="hero-subtitle" class="text-xl md:text-2xl mb-6 font-light max-w-4xl mx-auto leading-relaxed fade-in">
                Sistem Informasi Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen Dasar
            </p>

            <p id="hero-description"
                class="text-lg md:text-xl mb-12 text-white text-opacity-90 max-w-2xl mx-auto fade-in">
                Platform canggih untuk memantau dan menganalisis tingkat kerawanan Narkoba di Jawa Timur secara
                real-time dengan teknologi geospasial terdepan.
            </p>

            <div id="hero-buttons" class="flex flex-col sm:flex-row gap-6 justify-center items-center fade-in">
                <a href="peta.php" class="btn-modern inline-flex items-center justify-center gap-3 group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                    Lihat Peta Sekarang
                </a>

                <a href="eksplorasi.php"
                    class="glass px-8 py-4 rounded-full text-white font-semibold hover:bg-opacity-30 transition-all duration-300 inline-flex items-center justify-center gap-3 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:rotate-12"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Mulai Eksplorasi
                </a>
            </div>

            <!-- Scroll indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white opacity-60" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    </section>

    <!-- RINGKASAN STATISTIK -->
    <section id="statistik" class="section-bg py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gradient mb-6 fade-in">
                    Ringkasan Statistik
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto fade-in">
                    Data real-time untuk monitoring dan analisis tingkat kerawanan narkoba
                </p>
            </div>

            <div class="modern-grid">
                <!-- Card 1 -->
                <div class="modern-card p-8 text-center stagger-item group relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full blur-lg opacity-30">
                                </div>
                                <div class="relative bg-gradient-to-r from-blue-500 to-purple-600 p-4 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-5xl font-black text-gradient mb-2 counter" data-target="4524">0</h3>
                        <p class="text-lg font-semibold text-gray-700 mb-3">Total Kasus</p>
                        <div class="flex items-center justify-center gap-2 text-sm">
                            <span class="text-green-600 font-semibold">↓ 8%</span>
                            <span class="text-gray-500">dari bulan lalu</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="modern-card p-8 text-center stagger-item group relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-500 to-pink-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-red-500 to-pink-600 rounded-full blur-lg opacity-30">
                                </div>
                                <div class="relative bg-gradient-to-r from-red-500 to-pink-600 p-4 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-gradient mb-2">Jawa Timur</h3>
                        <p class="text-lg font-semibold text-gray-700 mb-3">Daerah Rawan Tertinggi</p>
                        <div class="flex items-center justify-center gap-2 text-sm">
                            <span class="text-red-600 font-semibold">↑ 512</span>
                            <span class="text-gray-500">kasus aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="modern-card p-8 text-center stagger-item group relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-500 to-teal-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-green-500 to-teal-600 rounded-full blur-lg opacity-30">
                                </div>
                                <div class="relative bg-gradient-to-r from-green-500 to-teal-600 p-4 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-5xl font-black text-gradient mb-2 counter" data-target="189">0</h3>
                        <p class="text-lg font-semibold text-gray-700 mb-3">Tren Bulanan</p>
                        <div class="flex items-center justify-center gap-2 text-sm">
                            <span class="text-green-600 font-semibold">↓ 12%</span>
                            <span class="text-gray-500">menurun bulan ini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TENTANG PLATFORM INI -->
    <section id="tentang" class="relative py-24 px-6 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-blue-50"></div>
        <div class="relative max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gradient mb-6 slide-left">
                    Tentang Platform Ini
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto slide-left">
                    Platform Peta Kerawanan Narkoba adalah sistem informasi terintegrasi yang menyajikan visualisasi
                    data dan analisis mengenai persebaran kasus narkoba di Indonesia dengan teknologi geospasial
                    terdepan.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Feature Cards -->
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="modern-card p-8 stagger-item group relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center mb-4">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-xl mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Data Terintegrasi</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed">
                                Menggabungkan data dari berbagai instansi untuk informasi yang akurat dan terpercaya
                                dengan validasi multi-layer.
                            </p>
                        </div>
                    </div>

                    <div class="modern-card p-8 stagger-item group relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-500 to-teal-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center mb-4">
                                <div class="bg-gradient-to-r from-green-500 to-teal-600 p-3 rounded-xl mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Update Real-time</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed">
                                Data diperbarui secara real-time memastikan informasi terkini di lapangan dengan
                                sinkronisasi otomatis.
                            </p>
                        </div>
                    </div>

                    <div class="modern-card p-8 stagger-item group relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-500 to-pink-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center mb-4">
                                <div class="bg-gradient-to-r from-red-500 to-pink-600 p-3 rounded-xl mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Keamanan Data</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed">
                                Keamanan berlapis dengan enkripsi end-to-end untuk melindungi integritas dan kerahasiaan
                                data sensitif.
                            </p>
                        </div>
                    </div>

                    <div class="modern-card p-8 stagger-item group relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-500 to-indigo-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center mb-4">
                                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 p-3 rounded-xl mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Kolaborasi Multi-Instansi</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed">
                                Kolaborasi lintas instansi untuk pencegahan dan penanganan narkoba dengan platform
                                terintegrasi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Vision Card -->
                <div class="lg:col-span-1">
                    <div
                        class="modern-card p-8 h-full flex flex-col justify-center text-center scale-in group relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="relative mb-6">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full blur-lg opacity-30">
                                </div>
                                <div
                                    class="relative bg-gradient-to-r from-indigo-500 to-purple-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gradient mb-4">Visi Kami</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Mewujudkan Indonesia bebas narkoba melalui sistem informasi yang transparan, akurat, dan
                                terintegrasi untuk mendukung pengambilan keputusan yang efektif.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Peta Interaktif Jawa Timur</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            body {
                margin: 0;
                padding: 0;
                background: #f5f6f7;
                font-family: Arial, sans-serif;
            }

            /* Supaya kontainer peta berada di tengah */
            .map-wrapper {
                display: flex;
                justify-content: center;
                /* taruh horizontal tengah */
                align-items: center;
                /* taruh vertical tengah */
                min-height: 100vh;
                /* biar ketengah halaman penuh */
            }

            .map-container {
                background: #fff;
                padding: 1px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                text-align: center;
                /* max-width: 700px; */
                /* atur ukuran maksimal */
                width: 1350px;
                max-height: 800px;

            }

            h2 {
                margin-top: 0;
                font-size: 20px;
            }

            #map {
                height: 400px;
                border-radius: 10px;
            }
        </style>
    </head>

    {{-- <body>
        <div class="map-wrapper">
            <div class="map-container">
                <h2><b>Peta Interaktif Jawa Timur</b></h2>
                <div id="map"></div>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            var map = L.map('map').setView([-7.25, 112.75], 8);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
            }).addTo(map);
        </script>
    </body> --}}

</html> --}}

<!-- FOOTER -->
<footer id="footer" class="gradient-dark text-white pt-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-6 pb-8">
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Informasi Kontak -->
            <div class="fade-in">
                <h5 class="font-bold text-xl mb-6 text-gradient">Informasi Kontak</h5>
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

<!-- JavaScript untuk Efek Animasi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Intersection Observer untuk animasi scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');

                    // Trigger counter animation jika element memiliki class counter
                    if (entry.target.classList.contains('counter')) {
                        animateCounter(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan class animasi
        const animatedElements = document.querySelectorAll(
            '.fade-in, .slide-left, .slide-right, .scale-in, .stagger-item');
        animatedElements.forEach(el => {
            observer.observe(el);
        });

        // Stagger animation untuk cards
        const staggerItems = document.querySelectorAll('.stagger-item');
        staggerItems.forEach((item, index) => {
            item.style.transitionDelay = `${index * 0.1}s`;
        });

        // Counter animation function
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Typing effect untuk hero title
        const heroTitle = document.getElementById('hero-title');
        const titleText = heroTitle.textContent;
        heroTitle.textContent = '';
        heroTitle.classList.add('typing');

        let i = 0;
        const typeWriter = () => {
            if (i < titleText.length) {
                heroTitle.textContent += titleText.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            } else {
                heroTitle.classList.remove('typing');
            }
        };

        // Start typing effect after a short delay
        setTimeout(typeWriter, 500);

        // Smooth scrolling untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Parallax effect untuk hero section
        const heroSection = document.querySelector('section');
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = heroSection.querySelector('.fade-in');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });

        // Add loading animation
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });

        // Mouse cursor effect untuk cards
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add ripple effect untuk buttons
        const buttons = document.querySelectorAll('.btn-hover');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
                .btn-hover {
                    position: relative;
                    overflow: hidden;
                }

                .ripple {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    pointer-events: none;
                }

                @keyframes ripple-animation {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
        document.head.appendChild(style);

        // Intersection Observer untuk fade in animations dengan delay
        const fadeObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, 200);
                }
            });
        }, observerOptions);

        // Observe fade-in elements
        const fadeElements = document.querySelectorAll('.fade-in');
        fadeElements.forEach(el => {
            fadeObserver.observe(el);
        });

    });
</script>

</body>

</html>
