<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BNNP JATIM</title>
    {{-- <link rel="stylesheet" href="{{ url_for('static', filename='css/dashboard.css') }}"> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="user-info">
                {{-- <img src="{{ url_for('static', filename='img/user.png') }}" alt="User" class="user-avatar"> --}}
                <div class="user-name">{{ username or 'Super Admin' }}</div>
            </div>
            <nav class="sidebar-menu">
                <a href="#" class="menu-item active">Peta</a>
                <a href="#" class="menu-item">Notification</a>
                <a href="#" class="menu-item">Data Umum</a>
                <a href="#" class="menu-item">Data Daerah</a>
                <a href="#" class="menu-item">Data Jaringan</a>
                <a href="#" class="menu-item">Data Lembaga Rehab</a>
                <a href="#" class="menu-item">Data Penginapan</a>
                <a href="#" class="menu-item">Data Realisasi Anggaran</a>
                <a href="#" class="menu-item">Data BBPOM</a>
                <a href="#" class="menu-item">Data Penjual Vape</a>
                <a href="#" class="menu-item">Data Asesmen Terpadu</a>
                <a href="#" class="menu-item">Chart Jaringan</a>
                <a href="#" class="menu-item">Data penangan kasus</a>
            </nav>
            <a href="/logout" class="logout-link">Log out</a>
        </aside>
        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <button class="menu-toggle">&#9776;</button>
                <input type="text" class="search-bar" placeholder="Search">
                <div class="profile-icon">
                    {{-- <img src="{{ url_for('static', filename='img/user.png') }}" alt="Profile"> --}}
                </div>
            </header>
            <section class="card-row">
                <div class="card card-blue">
                    <div class="card-icon">
                        <canvas id="pie1" width="80" height="80"></canvas>
                    </div>
                    <h3>Data Total Kasus yang Sudah Tuntas</h3>
                </div>
                <div class="card card-green">
                    <div class="card-icon">
                        <canvas id="pie2" width="80" height="80"></canvas>
                    </div>
                    <h3>Data Total Pasien Rehabilitasi</h3>
                </div>
                <div class="card card-orange">
                    <div class="card-icon">
                        <canvas id="pie3" width="80" height="80"></canvas>
                    </div>
                    <h3>Data Total Kasus yang Belum Tuntas</h3>
                </div>
            </section>
            <section class="data-row">
                <div class="data-card">
                    <canvas id="chart" width="300" height="180"></canvas>
                </div>
                <div class="data-card">
                    <div id="map" style="height: 180px; border-radius: 12px;"></div>
                </div>
            </section>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    {{-- <script src="{{ url_for('static', filename='js/dashboard.js') }}"></script> --}}
</body>
</html>
