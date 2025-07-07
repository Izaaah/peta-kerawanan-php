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
        <style>
            body.login-bg {
                min-height: 100vh;
                background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') no-repeat center center fixed;
                background-size: cover;
            }
            .login-card {
                background: rgba(255,255,255,0.95);
                border-radius: 16px;
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                padding: 2.5rem 2rem 2rem 2rem;
                max-width: 370px;
                width: 100%;
            }
            .login-logo {
                width: 100px;
                height: 100px;
                object-fit: contain;
                margin-bottom: 1rem;
                margin-top: -70px;
                background: #fff;
                border-radius: 50%;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            .login-title {
                text-align: center;
                font-weight: bold;
                font-size: 1.2rem;
                margin-bottom: 1.5rem;
                color: #1a202c;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased login-bg">
        <div class="min-h-screen flex flex-col justify-center items-center">
            <div class="login-card relative">
                @yield('login_logo')
                @yield('login_title')
                @yield('content')
            </div>
        </div>
    </body>
</html>
