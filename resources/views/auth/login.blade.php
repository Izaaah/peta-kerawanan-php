@extends('layouts.guest')

@section('content')
    <div class="flex flex-col items-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Logo_BNN.png" alt="Logo BNN" class="login-logo mb-2 mt-[-60px]">
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Username -->
        <div class="mb-4">
            <input id="username" class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Username atau email .." />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mb-4">
            <input id="password" class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400" type="password" name="password" required autocomplete="current-password" placeholder="Password .." />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Remember Me -->
        <div class="flex items-center mb-4">
            <input id="remember_me" type="checkbox" class="mr-2" name="remember">
            <label for="remember_me" class="text-sm text-gray-600">{{ __('Remember me') }}</label>
        </div>
        <!-- Tombol LOGIN hijau -->
        <button type="submit" class="w-full" style="background:#39e639; color:white; font-weight:bold; padding:0.75rem 0; border-radius:6px; font-size:1rem; letter-spacing:1px;">LOGIN</button>
        <div class="flex justify-between mt-2">
            @if (Route::has('register'))
                <a class="text-xs text-blue-900 hover:underline" href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            @endif
            @if (Route::has('password.request'))
                <a class="text-xs text-blue-900 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
@endsection
