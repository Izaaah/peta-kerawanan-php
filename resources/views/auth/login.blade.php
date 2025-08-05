@extends('layouts.guest')

@section('content')
    <div class="login-container">
        <!-- Kiri: Pesan Selamat Datang -->
        <div class="welcome-section">
            <div class="welcome-content">
                <img src="{{ asset('storage/img/logo.png') }}" alt="Logo BNN" class="welcome-logo">
                <h1 class="welcome-title">Selamat Datang di</h1>
                <h2 class="welcome-subtitle">Sistem Peta Kerawanan</h2>
                <p class="welcome-description">
                    Jaringan Pemetaan Kawasan Rawan Geospasial<br>
                    Berbasis Intelijen Dasar
                </p>
                <div class="welcome-features">
                    <div class="feature-item">
                        <span class="feature-icon">🗺️</span>
                        <span>Peta Kerawanan Interaktif</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📊</span>
                        <span>Analisis Data Real-time</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🔒</span>
                        <span>Sistem Keamanan Terjamin</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Form Login -->
        <div class="login-form-section">
            <div class="login-form-card">
                <h3 class="login-form-title">Login</h3>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Username -->
                    <div class="mb-4">
                        <input id="username" class="login-input block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Username atau email .." />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mb-4">
                        <input id="password" class="login-input block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400" type="password" name="password" required autocomplete="current-password" placeholder="Password .." />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Remember Me -->
                    <div class="flex items-center mb-4">
                        <input id="remember_me" type="checkbox" class="mr-2" name="remember">
                        <label for="remember_me" class="text-sm text-gray-600">{{ __('Remember me') }}</label>
                    </div>
                    <!-- Tombol LOGIN hijau -->
                    <button type="submit" class="login-btn w-full">LOGIN</button>
                    <div class="flex justify-between mt-2">
                        @if (Route::has('password.request'))
                            <a class="text-xs text-blue-900 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
