<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIJAGAD</title>
    <link rel="icon" href="{{ asset('storage/img/logo-bnn.png') }}" type="image/png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Override responsive-layout.css for login page */
        body.login-page {
            background-image: url('{{ asset('img/bg-candi.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 0;
            margin: 0;
            height: 100vh;
            display: block !important;
            flex-direction: unset !important;
            overflow-x: hidden;
        }

        /* Ensure login content takes full height */
        .login-page .login-content {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Desktop layout positioning */
        @media (min-width: 1024px) {
            .login-page .desktop-layout {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 1400px;
            }
        }

        /* iPad specific adjustments */
        @media (min-width: 768px) and (max-width: 1023px) {
            .login-page .tablet-layout {
                padding: 2rem;
                max-width: 600px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body class="login-page">
    @yield('content')
    <div class="login-footer text-center text-white">
        &copy; {{ date('Y') }} SIJAGAD. All rights reserved.<br>
        <a href="https://bnn.go.id/" target="_blank">BNN RI</a> |
        <a href="https://jatim.bnn.go.id/" target="_blank">BNNP Jatim</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile password toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (togglePassword && passwordInput && eyeIcon && eyeSlashIcon) {
                togglePassword.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeIcon.classList.add('hidden');
                        eyeSlashIcon.classList.remove('hidden');
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.classList.remove('hidden');
                        eyeSlashIcon.classList.add('hidden');
                    }
                });
            }

            // Tablet password toggle
            const togglePasswordTablet = document.getElementById('togglePasswordTablet');
            const passwordInputTablet = document.getElementById('password-tablet');
            const eyeIconTablet = document.getElementById('eyeIconTablet');
            const eyeSlashIconTablet = document.getElementById('eyeSlashIconTablet');

            if (togglePasswordTablet && passwordInputTablet && eyeIconTablet && eyeSlashIconTablet) {
                togglePasswordTablet.addEventListener('click', function() {
                    if (passwordInputTablet.type === 'password') {
                        passwordInputTablet.type = 'text';
                        eyeIconTablet.classList.add('hidden');
                        eyeSlashIconTablet.classList.remove('hidden');
                    } else {
                        passwordInputTablet.type = 'password';
                        eyeIconTablet.classList.remove('hidden');
                        eyeSlashIconTablet.classList.add('hidden');
                    }
                });
            }

            // Desktop password toggle
            const togglePasswordDesktop = document.getElementById('togglePasswordDesktop');
            const passwordInputDesktop = document.getElementById('password-desktop');
            const eyeIconDesktop = document.getElementById('eyeIconDesktop');
            const eyeSlashIconDesktop = document.getElementById('eyeSlashIconDesktop');

            if (togglePasswordDesktop && passwordInputDesktop && eyeIconDesktop && eyeSlashIconDesktop) {
                togglePasswordDesktop.addEventListener('click', function() {
                    if (passwordInputDesktop.type === 'password') {
                        passwordInputDesktop.type = 'text';
                        eyeIconDesktop.classList.add('hidden');
                        eyeSlashIconDesktop.classList.remove('hidden');
                    } else {
                        passwordInputDesktop.type = 'password';
                        eyeIconDesktop.classList.remove('hidden');
                        eyeSlashIconDesktop.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>

</html>
