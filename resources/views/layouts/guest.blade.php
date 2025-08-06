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
            }

            .welcome-content {
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 2.5rem 1.5rem;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .welcome-logo {
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 50%;
                margin: 0 auto 1.5rem;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                border: 3px solid rgba(255, 255, 255, 0.3);
            }

            .welcome-title {
                font-size: 2rem;
                font-weight: bold;
                margin-bottom: 0.5rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }

            .welcome-subtitle {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
                color: #39e639;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }

            .welcome-description {
                font-size: 1rem;
                line-height: 1.5;
                margin-bottom: 2rem;
                opacity: 0.9;
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
            }

            .login-form-card {
                background: rgba(255,255,255,0.95);
                border-radius: 20px;
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                padding: 2rem 1.5rem;
                border: 1.5px solid rgba(57,230,57,0.2);
                position: relative;
                overflow: hidden;
            }

            .login-form-card::before {
                content: '';
                display: block;
                position: absolute;
                top: 0; left: 0; right: 0;
                height: 6px;
                border-radius: 20px 20px 0 0;
                background: linear-gradient(90deg, #39e639 0%, #2ecc40 100%);
                z-index: 2;
            }

            .login-form-title {
                text-align: center;
                font-size: 1.8rem;
                font-weight: bold;
                color: #1a202c;
                margin-bottom: 2rem;
                position: relative;
                z-index: 3;
            }

            .login-input {
                transition: box-shadow 0.2s, border-color 0.2s;
                background: rgba(255,255,255,0.9);
                font-size: 1rem;
                border-radius: 8px;
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
                margin-top: 2rem;
                text-align: center;
                color: white;
                font-size: 0.9rem;
                opacity: 0.8;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            }

            .login-footer a {
                color: #39e639;
                text-decoration: underline;
                margin: 0 0.25rem;
            }

            .login-footer a:hover {
                color: #2ecc40;
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
                    flex-direction: column;
                    gap: 1.5rem;
                    padding: 1rem;
                    justify-content: center;
                }

                                .welcome-section {
                    max-width: 100%;
                    order: 2;
                }

                .login-form-section {
                    flex: 0 0 auto;
                    width: 100%;
                    max-width: 350px;
                    order: 1;
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
                    padding: 1.5rem 1rem;
                }

                .login-form-card {
                    padding: 1.5rem 1rem;
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
            &copy; {{ date('Y') }} Peta Kerawanan BNNP JATIM. All rights reserved.<br>
            <a href="https://bnn.go.id/" target="_blank">BNN RI</a> |
            <a href="https://jatim.bnn.go.id/" target="_blank">BNNP Jatim</a>
        </div>
    </body>
</html>
