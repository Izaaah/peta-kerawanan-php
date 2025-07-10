<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/dashboard-admin.css">
</head>
<body>
    <div class="header">
        <div class="logo-col">
            <div class="logo-stack">
                <div class="logo-circle">
                    <img src="/img/logo-bnn.png" alt="Logo BNN" class="logo-img">
                </div>
                <div class="logo-text">
                    <div class="bnn-title">BNN</div>
                    <div class="bnn-subtitle">Provinsi Jawa Timur</div>
                </div>
            </div>
            <span class="sijagat">SIJAGAD</span>
        </div>
        <nav class="menu">
            <a href="#">Home</a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Data</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Data Daerah Penyalahguna</a></li>
                    <li><a href="#">Data Daerah Penyelundupan</a></li>
                    <li><a href="#">Data THM dan Manager</a></li>
                    <li><a href="#">Data Jaringan di Rutan dan Lapas</a></li>
                    <li><a href="#">Data Objek Vital</a></li>
                    <li><a href="#">Data Jaringan Penggiat</a></li>
                    <li><a href="#">Data Jaringan Informasi (Orang)</a></li>
                    <li><a href="#">Data LSM Narkotika</a></li>
                    <li><a href="#">Data Lembaga Rehabilitasi</a></li>
                    <li><a href="#">Data Ekspedisi</a></li>
                    <li><a href="#">Data Jasa Transportasi</a></li>
                    <li><a href="#">Data Penginapan (Hotel & Kost)</a></li>
                    <li><a href="#">Data Akun Sosmed</a></li>
                    <li><a href="#">Data Umum Tempat Transportasi</a></li>
                    <li><a href="#">Data Perusahan/Farmasi Prekursor</a></li>
                    <li><a href="#">Data Penjual Vape</a></li>
                </ul>
            </div>
            <a href="#">Peta</a>
            <a href="#">Input</a>
            <a href="#">Profil</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </nav>
    </div>
    <main style="min-height:80vh; background:#fff;"></main>
</body>
</html>

