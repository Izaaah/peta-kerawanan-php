@extends('layouts.guest')

@section('content')
<div class="login-content">
    <!-- Mobile Layout (up to 767px) -->
    <div class="flex flex-col items-center justify-center px-4 sm:px-6 md:hidden">
        <!-- Welcome Section -->
        <div class="w-full max-w-sm mb-6 text-center">
            <h1 class="text-lg sm:text-xl font-bold text-white mb-3 drop-shadow-lg">
                Selamat Datang di
            </h1>
            <img src="{{ asset('img/sijagad.png') }}" alt="Logo BNN"
                 class="w-28 sm:w-36 h-auto mx-auto mb-3 drop-shadow-lg">
            <p class="text-xs sm:text-sm text-white drop-shadow-md leading-relaxed">
                <span class="block">Sistem Informasi Jaringan Pemetaan Kawasan</span>
                <span class="block">Rawan Geospasial Berbasis Intelijen Dasar</span>
            </p>
        </div>

        <!-- Login Form -->
        <div class="w-full max-w-sm">
            <div class="bg-white/95 backdrop-blur-sm rounded-xl p-4 sm:p-6 shadow-2xl border border-white/20">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 text-center">Login</h3>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Username -->
                    <div class="mb-3">
                        <input id="username"
                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg
                                   focus:border-red-600 focus:ring-2 focus:ring-red-100 transition-all duration-300
                                   bg-white/90 placeholder-gray-500 text-sm"
                            type="text" name="username" :value="old('username')" required autofocus
                            autocomplete="username" placeholder="Username atau email" />
                        <x-input-error :messages="$errors->get('username')" class="mt-1" />
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <div class="relative">
                            <input id="password"
                                class="w-full px-3 py-2 pr-10 border-2 border-gray-200 rounded-lg
                                       focus:border-red-600 focus:ring-2 focus:ring-red-100 transition-all duration-300
                                       bg-white/90 placeholder-gray-500 text-sm"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Password" />
                            <button type="button" id="togglePassword"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-600 transition-colors">
                                <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="eyeSlashIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                    <!-- Remember Me -->
                    <div class="flex items-center mb-3">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-3 h-3 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <label for="remember_me" class="ml-2 text-xs text-gray-700">{{ __('Remember me') }}</label>
                    </div>
                    <!-- Login Button -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800
                                   text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300
                                   transform hover:-translate-y-0.5 hover:shadow-lg uppercase tracking-wide text-sm">
                        LOGIN
                    </button>
                    <div class="flex justify-center mt-3">
                        @if (Route::has('password.request'))
                            <a class="text-red-600 hover:text-red-700 text-xs transition-colors"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tablet Layout (768px - 1023px) -->
    <div class="hidden md:flex lg:hidden tablet-layout">
        <div class="w-full max-w-2xl mx-auto flex items-center justify-center">
            <div class="w-full flex items-center justify-between">
                <!-- Left: Welcome Section -->
                <div class="w-1/2 pr-8">
                    <div class="text-center">
                        <h1 class="text-2xl font-bold text-white mb-4 drop-shadow-lg">
                            Selamat Datang di
                        </h1>
                        <img src="{{ asset('img/sijagad.png') }}" alt="Logo BNN"
                             class="w-40 h-auto mx-auto mb-4 drop-shadow-lg">
                        <p class="text-sm text-white drop-shadow-md leading-relaxed">
                            <span class="block">Sistem Informasi Jaringan Pemetaan Kawasan</span>
                            <span class="block">Rawan Geospasial Berbasis Intelijen Dasar</span>
                        </p>
                    </div>
                </div>

                <!-- Right: Login Form -->
                <div class="w-1/2 pl-8">
                    <div class="bg-white/95 backdrop-blur-sm rounded-xl p-6 shadow-2xl border border-white/20">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Login</h3>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Username -->
                            <div class="mb-4">
                                <input id="username-tablet"
                                    class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg
                                           focus:border-red-600 focus:ring-2 focus:ring-red-100 transition-all duration-300
                                           bg-white/90 placeholder-gray-500 text-sm"
                                    type="text" name="username" :value="old('username')" required autofocus
                                    autocomplete="username" placeholder="Username atau email" />
                                <x-input-error :messages="$errors->get('username')" class="mt-1" />
                            </div>
                            <!-- Password -->
                            <div class="mb-4">
                                <div class="relative">
                                    <input id="password-tablet"
                                        class="w-full px-3 py-2 pr-10 border-2 border-gray-200 rounded-lg
                                               focus:border-red-600 focus:ring-2 focus:ring-red-100 transition-all duration-300
                                               bg-white/90 placeholder-gray-500 text-sm"
                                        type="password" name="password" required autocomplete="current-password"
                                        placeholder="Password" />
                                    <button type="button" id="togglePasswordTablet"
                                            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-600 transition-colors">
                                        <svg id="eyeIconTablet" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eyeSlashIconTablet" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>
                            <!-- Remember Me -->
                            <div class="flex items-center mb-4">
                                <input id="remember_me_tablet" type="checkbox" name="remember"
                                       class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <label for="remember_me_tablet" class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</label>
                            </div>
                            <!-- Login Button -->
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800
                                           text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300
                                           transform hover:-translate-y-0.5 hover:shadow-lg uppercase tracking-wide text-sm">
                                LOGIN
                            </button>
                            <div class="flex justify-center mt-4">
                                @if (Route::has('password.request'))
                                    <a class="text-red-600 hover:text-red-700 text-sm transition-colors"
                                       href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Layout (1024px+) -->
    <div class="hidden lg:block desktop-layout">
        <div class="w-full flex items-center justify-between">
            <!-- Left: Welcome Section -->
            <div class="w-2/5">
                <div class="text-center">
                    <h1 class="text-3xl xl:text-4xl 2xl:text-5xl font-bold text-white mb-6 drop-shadow-lg">
                        Selamat Datang di
                    </h1>
                    <img src="{{ asset('img/sijagad.png') }}" alt="Logo BNN"
                         class="w-56 xl:w-64 2xl:w-72 h-auto mx-auto mb-6 drop-shadow-lg">
                    <p class="text-lg xl:text-xl 2xl:text-2xl text-white drop-shadow-md leading-relaxed">
                        <span class="block">Sistem Informasi Jaringan Pemetaan Kawasan</span>
                        <span class="block">Rawan Geospasial Berbasis Intelijen Dasar</span>
                    </p>
                </div>
            </div>

            <!-- Right: Login Form -->
            <div class="w-2/5">
                <div class="bg-white/95 backdrop-blur-sm rounded-xl p-8 xl:p-10 2xl:p-12 shadow-2xl border border-white/20">
                    <h3 class="text-2xl xl:text-3xl font-bold text-gray-800 mb-8 text-center">Login</h3>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Username -->
                        <div class="mb-6">
                            <input id="username-desktop"
                                class="w-full px-4 py-3 xl:px-5 xl:py-4 border-2 border-gray-200 rounded-lg
                                       focus:border-red-600 focus:ring-2 focus:ring-red-100 transition-all duration-300
                                       bg-white/90 placeholder-gray-500 text-base xl:text-lg"
                                type="text" name="username" :value="old('username')" required autofocus
                                autocomplete="username" placeholder="Username atau email" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div class="mb-6">
                            <div class="relative">
                                <input id="password-desktop"
                                    class="w-full px-4 py-3 xl:px-5 xl:py-4 pr-12 border-2 border-gray-200 rounded-lg
                                           focus:border-red-600 focus:ring-2 focus:ring-red-100 transition-all duration-300
                                           bg-white/90 placeholder-gray-500 text-base xl:text-lg"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="Password" />
                                <button type="button" id="togglePasswordDesktop"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-600 transition-colors">
                                    <svg id="eyeIconDesktop" class="w-6 h-6 xl:w-7 xl:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="eyeSlashIconDesktop" class="w-6 h-6 xl:w-7 xl:h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Remember Me -->
                        <div class="flex items-center mb-6">
                            <input id="remember_me_desktop" type="checkbox" name="remember"
                                   class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <label for="remember_me_desktop" class="ml-3 text-base text-gray-700">{{ __('Remember me') }}</label>
                        </div>
                        <!-- Login Button -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800
                                       text-white font-semibold py-3 xl:py-4 px-6 rounded-lg transition-all duration-300
                                       transform hover:-translate-y-0.5 hover:shadow-lg uppercase tracking-wide text-base xl:text-lg">
                            LOGIN
                        </button>
                        <div class="flex justify-center mt-6">
                            @if (Route::has('password.request'))
                                <a class="text-red-600 hover:text-red-700 text-base transition-colors"
                                   href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
