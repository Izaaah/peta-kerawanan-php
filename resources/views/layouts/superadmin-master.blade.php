<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
