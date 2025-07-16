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
                background: url('{{ asset('storage/img/bg-candi.png') }}') no-repeat center center fixed;
                background-size: cover;
            }
            .login-card {
                background: rgba(255,255,255,0.80);
                border-radius: 28px;
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                padding: 3rem 2.2rem 2.2rem 2.2rem;
                max-width: 400px;
                width: 100%;
                transition: box-shadow 0.3s, border 0.3s;
                position: relative;
                border: 1.5px solid rgba(57,230,57,0.13);
                overflow: hidden;
                opacity: 0;
                transform: translateY(-60px);
            }
            .login-card.animated-in {
                opacity: 1;
                transform: translateY(0);
                transition: opacity 1.2s cubic-bezier(.4,2,.3,1), transform 1.2s cubic-bezier(.4,2,.3,1);
            }
            .login-card::before {
                content: '';
                display: block;
                position: absolute;
                top: 0; left: 0; right: 0;
                height: 6px;
                border-radius: 28px 28px 0 0;
                background: linear-gradient(90deg, #39e639 0%, #2ecc40 100%);
                z-index: 2;
            }
            .login-logo {
                width: 96px;
                height: 96px;
                object-fit: cover;
                margin-bottom: 0.5rem;
                margin-top: 0.5rem;
                border-radius: 50%;
                box-shadow: 0 2px 8px rgba(0,0,0,0.12);
                display: block;
                margin-left: auto;
                margin-right: auto;
                z-index: 3;
                position: relative;
            }
            .login-title {
                text-align: center;
                font-weight: bold;
                font-size: 1.35rem;
                margin-bottom: 1.2rem;
                color: #1a202c;
                letter-spacing: 1px;
                z-index: 3;
                position: relative;
            }
            .login-input {
                transition: box-shadow 0.2s, border-color 0.2s;
                background: rgba(255,255,255,0.85);
            }
            .login-input:focus {
                border-color: #39e639;
                box-shadow: 0 0 0 2px #39e63933;
                background: #fff;
            }
            .login-btn {
                background: linear-gradient(90deg, #39e639 0%, #2ecc40 100%);
                color: white;
                font-weight: bold;
                padding: 0.85rem 0;
                border-radius: 10px;
                font-size: 1.08rem;
                letter-spacing: 1px;
                transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
                box-shadow: 0 2px 8px #39e63922;
            }
            .login-btn:hover {
                background: linear-gradient(90deg, #2ecc40 0%, #39e639 100%);
                box-shadow: 0 4px 16px #39e63933;
                transform: translateY(-2px) scale(1.03);
            }
            .login-footer {
                margin-top: 2.5rem;
                text-align: center;
                color: #555;
                font-size: 0.95rem;
                opacity: 0.85;
            }
            .login-footer a {
                color: #39e639;
                text-decoration: underline;
                margin: 0 0.25rem;
            }
            .login-footer a:hover {
                color: #2ecc40;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased login-bg">
        <div class="min-h-screen flex flex-col justify-center items-center">
            <div class="login-card relative" id="loginCard">
                @yield('login_logo')
                @yield('login_title')
                @yield('content')
            </div>
            <div class="login-footer">
                &copy; {{ date('Y') }} Peta Kerawanan BNNP JATIM. All rights reserved.<br>
                <a href="https://bnn.go.id/" target="_blank">BNN RI</a> |
                <a href="https://jatim.bnn.go.id/" target="_blank">BNNP Jatim</a>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('loginCard').classList.add('animated-in');
            }, 250);
        });
        </script>
    </body>
</html>
