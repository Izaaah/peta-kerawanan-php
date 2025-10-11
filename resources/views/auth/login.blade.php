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
                        <input id="password"
                            class="login-input block w-full"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="Password" />
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
