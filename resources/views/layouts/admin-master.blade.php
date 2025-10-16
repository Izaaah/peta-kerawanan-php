<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIJAGAD</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" />
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Tambahkan di layouts/superadmin-master.blade.php, sebelum </head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Additional Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin-components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive-layout.css') }}">
    @stack('styles')
</head>

<body class="font-sans antialiased" style="display: flex; flex-direction: column; min-height: 100vh; margin: 0; padding: 0; overflow-x: hidden;">
    <!-- Include Admin Navbar -->
    @include('components.admin-navbar')

    <!-- Main Content Area with responsive class -->
    <main class="main-content bg-gray-100" style="flex: 1 0 auto;">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.superadmin-footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
