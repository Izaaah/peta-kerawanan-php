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
        body.login-bg {
            min-height: 100vh;
            background: url('{{ asset('img/bg-candi.png') }}') no-repeat center center fixed;
            background-size: cover;
        }

        /* Layout Container */
        .login-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 1rem 2rem;
            gap: 3rem;
        }

        /* Welcome Section (Kiri) */
        .welcome-section {
            flex: 1;
            max-width: 450px;
            color: white;
            text-align: center;
            animation: slideInLeft 1s ease-out;
            margin-top: -150px;
        }

        .welcome-logo {
            height: 100px;
            object-fit: cover;
            margin: 0 auto 1.5rem;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #ffffff;
            text-align: center;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
        }

        .welcome-subtitle {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #39e639;
            text-align: center;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.4);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .welcome-description {
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
            color: #f0f0f0;
            opacity: 0.95;
            margin-bottom: 2.5rem;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }


        .welcome-features {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            padding: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-icon {
            font-size: 1.2rem;
        }

        /* Login Form Section (Kanan) */
        .login-form-section {
            flex: 0 0 350px;
            animation: slideInRight 1s ease-out;
            margin-left: 410px;
        }

        .login-form-card {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-form-card::before {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            border-radius: 20px 20px 0 0;
            background: linear-gradient(90deg, #B22222 0%, #8B0000 100%);
            z-index: 2;
        }

        .login-form-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffff;
            margin-bottom: 2rem;
            position: relative;
            z-index: 3;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .login-input {
            transition: box-shadow 0.2s, border-color 0.2s;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            border-radius: 8px;
        }

        .login-input:focus {
            border-color: #DC143C;
            box-shadow: 0 0 0 2px #8B0000 background: #fff;
        }

        .login-btn {
            background: linear-gradient(90deg, #B22222 0%, #8B0000 100%);
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
            background: linear-gradient(90deg, #8B0000 0%, #B22222 100%);
            box-shadow: 0 4px 16px #39e63933;
            transform: translateY(-2px) scale(1.03);
        }

        .login-footer {
            margin-top: 2rem;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            opacity: 0.8;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .login-footer a {
            color: #DC143C;
            text-decoration: underline;
            margin: 0 0.25rem;
        }

        .login-footer a:hover {
            color: #8B0000;
        }

        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .login-container {
                display: flex;
                min-height: 100vh;
                align-items: stretch;
                justify-content: space-between;
                padding: 0;
                /* hilangkan padding agar dempet */
                gap: 0;
                /* hilangkan gap antar kolom */
            }


            .welcome-section {
                max-width: 100%;
                order: 2;
            }

            .login-form-section {
                flex: 1;
                max-width: 450px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2.5rem 1.5rem;
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(10px);
                border-radius: 0px;
                /* agar sama seperti welcome-content */
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: white;
            }

            .welcome-title {
                font-size: 1.8rem;
            }

            .welcome-subtitle {
                font-size: 1.3rem;
            }

            .welcome-logo {
                width: 90px;
                height: 90px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 0.5rem;
                gap: 1rem;
            }

            .welcome-content {
                padding: 0.5rem 1rem;
            }

            .login-form-card {
                width: 100%;
                max-width: 100%;
                background: transparent;
                box-shadow: none;
                border: none;
                padding: 0;
            }

            .welcome-title {
                font-size: 1.4rem;
            }

            .welcome-subtitle {
                font-size: 1.1rem;
            }

            .welcome-description {
                font-size: 0.9rem;
            }

            .feature-item {
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .welcome-logo {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased login-bg">
    <div class="login-container">
        @yield('content')
    </div>
    <div class="login-footer">
        &copy; {{ date('Y') }} SIJAGAD. All rights reserved.<br>
        <a href="https://bnn.go.id/" target="_blank">BNN RI</a> |
        <a href="https://jatim.bnn.go.id/" target="_blank">BNNP Jatim</a>
    </div>
</body>

</html>
