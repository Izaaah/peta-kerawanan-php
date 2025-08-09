<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'SIJAGAD') }}</title> --}}
    <title>SIJAGAD</title>
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image/png"/>

    <!-- Tambahkan di layouts/superadmin-master.blade.php, sebelum </head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Additional Styles -->
    <link rel="stylesheet" href="{{ asset('css/superadmin-components.css') }}">
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col" style="padding-top: 110px;">
        <!-- Include Superadmin Navbar -->
        @include('components.superadmin-navbar')

        <!-- Main Content Area -->
        <div class="flex flex-1">
            <!-- Sidebar (optional - bisa diaktifkan jika diperlukan) -->
            {{-- @include('components.superadmin-sidebar') --}}

            <!-- Main Content -->
            <main class="flex-1 py-4 px-6">
                @yield('content')
            </main>
        </div>

        <!-- Footer -->
        @include('components.superadmin-footer')
    </div>

    <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
