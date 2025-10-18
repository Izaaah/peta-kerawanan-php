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
        body {
            background-image: url('{{ asset('img/bg-candi.png') }}');
            background-size: cover;
            background-position: center;
            padding: 0;
            margin: 0;
        }

        /* Mobile body adjustments */
        @media (max-width: 1023px) {
            body {
                padding: 0.5rem;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.25rem;
            }
        }

        @media (max-width: 375px) {
            body {
                padding: 0.125rem;
            }
        }

        /* Welcome Section Styling */
        .welcome-title {
            font-weight: bold;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin-bottom: 0.5rem;
        }

        .welcome-logo {
            height: auto;
            margin: 0.5rem auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
            max-width: 100%;
            display: block;
        }

        /* Mobile welcome logo adjustments */
        @media (max-width: 1023px) {
            .welcome-logo {
                max-width: 200px;
                height: auto;
                margin: 0.5rem auto;
                display: block;
            }
        }

        @media (max-width: 480px) {
            .welcome-logo {
                max-width: 150px;
                margin: 0.5rem auto;
                display: block;
            }
        }

        @media (max-width: 375px) {
            .welcome-logo {
                max-width: 120px;
                margin: 0.5rem auto;
                display: block;
            }
        }

        .welcome-description {
            color: #ffffff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            line-height: 1.6;
        }

        /* Responsive font sizes for welcome title */
        @media (max-width: 640px) {
            .welcome-title {
                font-size: 1.125rem;
                margin-bottom: 0.5rem;
            }
        }

        @media (min-width: 640px) and (max-width: 768px) {
            .welcome-title {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .welcome-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }
        }

        @media (min-width: 1024px) and (max-width: 1280px) {
            .welcome-title {
                font-size: 1.875rem;
                margin-bottom: 1rem;
            }
        }

        @media (min-width: 1280px) and (max-width: 1536px) {
            .welcome-title {
                font-size: 2.25rem;
                margin-bottom: 1rem;
            }
        }

        @media (min-width: 1536px) {
            .welcome-title {
                font-size: 3rem;
                margin-bottom: 1rem;
            }
        }

        /* Form Styling */
        .login-form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 100%;
        }

        /* Mobile form container adjustments */
        @media (max-width: 1023px) {
            .login-form-container {
                margin: 0.5rem;
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .login-form-container {
                margin: 0.25rem;
                padding: 1rem;
                border-radius: 12px;
            }
        }

        @media (max-width: 375px) {
            .login-form-container {
                margin: 0.125rem;
                padding: 0.875rem;
                border-radius: 10px;
            }
        }

        @media (min-width: 640px) {
            .login-form-container {
                padding: 1.5rem;

            }
        }

        @media (min-width: 768px) {
            .login-form-container {
                padding: 1.75rem;
            }
        }

        @media (min-width: 1024px) {
            .login-form-container {
                padding: 2rem;
            }
        }

        @media (min-width: 1280px) {
            .login-form-container {
                padding: 2.25rem;
            }
        }

        @media (min-width: 1536px) {
            .login-form-container {
                padding: 2.5rem;
            }
        }

        .login-input {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 640px) {
            .login-input {
                padding: 10px 14px;
            }
        }

        @media (min-width: 768px) {
            .login-input {
                padding: 12px 16px;
            }
        }

        @media (min-width: 1024px) {
            .login-input {
                padding: 14px 18px;
            }
        }

        @media (min-width: 1280px) {
            .login-input {
                padding: 16px 20px;
            }
        }

        @media (min-width: 1536px) {
            .login-input {
                padding: 18px 22px;
            }
        }

        .login-input:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .login-input::placeholder {
            color: #6b7280;
        }

        .login-btn {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (min-width: 640px) {
            .login-btn {
                padding: 10px 20px;
            }
        }

        @media (min-width: 768px) {
            .login-btn {
                padding: 12px 24px;
            }
        }

        @media (min-width: 1024px) {
            .login-btn {
                padding: 14px 28px;
            }
        }

        @media (min-width: 1280px) {
            .login-btn {
                padding: 16px 32px;
            }
        }

        @media (min-width: 1536px) {
            .login-btn {
                padding: 18px 36px;
            }
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .remember-me-container {
            display: flex;
            align-items: center;
            margin: 1rem 0;
        }

        .remember-me-container input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            accent-color: #dc2626;
        }

        .remember-me-container label {
            color: #374151;
            font-size: 0.9rem;
        }

        .forgot-password-link {
            color: #dc2626;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password-link:hover {
            color: #b91c1c;
            text-decoration: underline;
        }

        /* Password Toggle Styles */
        .password-input-container {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: #6b7280;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle-btn:hover {
            color: #dc2626;
        }

        .eye-icon,
        .eye-slash-icon {
            width: 20px;
            height: 20px;
            stroke-width: 2;
        }

        @media (min-width: 640px) {
            .eye-icon,
            .eye-slash-icon {
                width: 22px;
                height: 22px;
            }
        }

        @media (min-width: 768px) {
            .eye-icon,
            .eye-slash-icon {
                width: 24px;
                height: 24px;
            }
        }

        @media (min-width: 1024px) {
            .eye-icon,
            .eye-slash-icon {
                width: 26px;
                height: 26px;
            }
        }

        @media (min-width: 1280px) {
            .eye-icon,
            .eye-slash-icon {
                width: 28px;
                height: 28px;
            }
        }

        @media (min-width: 1536px) {
            .eye-icon,
            .eye-slash-icon {
                width: 30px;
                height: 30px;
            }
        }

        /* Positioning for content between temple elements */
        @media (min-width: 1024px) {
            .container {
                position: relative;
                min-height: 100vh;
            }

            /* Ensure content doesn't overlap with temple center */
            .welcome-section {
                position: absolute;
                left: 5%;
                top: 50%;
                transform: translateY(-50%);
                z-index: 10;
                max-width: 25%;
                padding-left: 4px;
                padding-right: 4px;
            }

            .login-section {
                position: absolute;
                right: 5%;
                top: 50%;
                transform: translateY(-50%);
                z-index: 10;
                max-width: 30%;
                padding-left: 4px;
                padding-right: 4px;
            }
        }

        /* Mobile and tablet - keep centered layout with proper padding */
        @media (max-width: 1023px) {
            .container {
                padding: 1rem;
                width: 100%;
                max-width: 100%;
            }

            .welcome-section,
            .login-section {
                position: static;
                transform: none;
                max-width: none;
                padding: 0.5rem;
            }

            .welcome-content {
                padding: 1rem 0.5rem;
                margin-bottom: 1rem;
            }

            .login-section {
                padding: 0.5rem;
            }
        }

        /* Extra mobile padding for very small screens */
        @media (max-width: 480px) {
            .container {
                padding: 0.75rem;
            }

            .welcome-section,
            .login-section {
                padding: 0.25rem;
            }

            .welcome-content {
                padding: 0.75rem 0.25rem;
                margin-bottom: 0.75rem;
            }

            .login-section {
                padding: 0.25rem;
            }
        }

        /* iPhone SE and smaller screens */
        @media (max-width: 375px) {
            .container {
                padding: 0.5rem;
            }

            .welcome-section,
            .login-section {
                padding: 0.125rem;
            }

            .welcome-content {
                padding: 0.5rem 0.125rem;
                margin-bottom: 0.5rem;
            }

            .login-section {
                padding: 0.125rem;
            }
        }

        /* 3xl breakpoint for screens larger than 1920px */
        @media (min-width: 1920px) {
            .welcome-section {
                padding-left: 8px;
                padding-right: 8px;
            }

            .login-section {
                padding-left: 8px;
                padding-right: 8px;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center h-screen">
    @yield('content')
    <div class="login-footer text-center text-white">
        &copy; {{ date('Y') }} SIJAGAD. All rights reserved.<br>
        <a href="https://bnn.go.id/" target="_blank">BNN RI</a> |
        <a href="https://jatim.bnn.go.id/" target="_blank">BNNP Jatim</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
</body>

</html>
