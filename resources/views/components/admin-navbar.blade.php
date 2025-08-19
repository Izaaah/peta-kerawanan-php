<!-- Include CSS khusus navbar superadmin -->
<link rel="stylesheet" href="{{ asset('css/superadmin-navbar.css') }}">

<!-- Garis putih tebal di atas navbar -->
<div class="top-banner">
    <div class="banner-content">
        <div class="banner-left">
            <span class="banner-text">Sistem Informasi Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen Dasar</span>
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

    <!-- Tengah: Menu Navigasi -->
    <div class="menu-area">
        <div class="menu-btn"><a href="{{ route('admin.dashboard') }}">Beranda</a>
        </div>
        <div class="menu-btn"><a href="{{ route('admin.data.index') }}">Data</a></div>
        <div class="menu-btn"><a href="{{ route('admin.chart-jaringan') }}">Diagram</a></div>
        <div class="menu-btn dropdown-parent">
            Peta <span class="dropdown-arrow">&#9662;</span>
            <ul class="dropdown-menu">
                <li><a href="{{ route('peta-penyalahgunaan.domisili') }}">Peta Kerawanan<br>Berdasarkan NIK</a></li>
                <li><a href="{{ route('peta-penyalahgunaan.tkp') }}">Peta Kerawanan<br>Berdasarkan TKP</a></li>
                <li><a href="">Peta Kawasan<br>Rawan Geospasial</a></li>
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
            <img src="{{ asset('storage/img/logo.png') }}" alt="Logo BNN">
        </div>
    </div>
</div>
{{-- <script>
    (function() {
      const onScroll = () => {
        if (window.scrollY > 10) {
          document.body.classList.add('scrolled');
        } else {
          document.body.classList.remove('scrolled');
        }
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    })();
    </script> --}}
