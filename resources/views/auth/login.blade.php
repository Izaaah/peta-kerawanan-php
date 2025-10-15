@extends('layouts.guest')

@section('content')
    <div class="container ">
        <!-- Kiri: Pesan Selamat Datang -->
        <div class="welcome-section">
            <div class="welcome-content text-center">
                <h1 class="welcome-title whitespace-nowrap">Selamat Datang di</h1>
                <img src="{{ asset('img/sijagad.png') }}" alt="Logo BNN" class="welcome-logo mx-auto">
                <p class="welcome-description">
                    <span class="whitespace-nowrap">Sistem Informasi Jaringan Pemetaan Kawasan</span>
                    <br>Rawan Geospasial Berbasis Intelijen Dasar
                </p>
            </div>
        </div>

        <!-- Kanan: Form Login -->
        <div class="login-section w-full">
            <div class="login-form-container">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h3>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Username -->
                    <div class="mb-4">
                        <input id="username"
                            class="login-input block w-full"
                            type="text" name="username" :value="old('username')" required autofocus
                            autocomplete="username" placeholder="Username atau email" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mb-4">
                        <div class="password-input-container relative">
                            <input id="password"
                                class="login-input block w-full pr-12"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Password" />
                            <button type="button" id="togglePassword" class="password-toggle-btn">
                                <svg id="eyeIcon" class="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="eyeSlashIcon" class="eye-slash-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Remember Me -->
                    <div class="remember-me-container">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">{{ __('Remember me') }}</label>
                    </div>
                    <!-- Tombol LOGIN -->
                    <button type="submit" class="login-btn w-full">LOGIN</button>
                    <div class="flex justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="forgot-password-link" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
