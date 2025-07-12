@extends('layouts.superadmin-master')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight lg:ml-[250px] lg:mt-[65px]">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="flex h-screen">

        <!-- Main content with offset for fixed sidebar -->
        <div class="flex flex-col flex-1">
            <div class="flex-1">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">User Details</h3>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('super-admin.user-management.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit User
                                        </a>
                                        <a href="{{ route('super-admin.user-management.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                            Back to Users
                                        </a>
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- User Avatar -->
                                        <div class="flex items-center space-x-4">
                                            <div class="h-20 w-20 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                <span class="text-2xl font-bold text-gray-700 dark:text-gray-300">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h4>
                                                <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                                            </div>
                                        </div>

                                        <!-- Role Badge -->
                                        <div class="flex items-center justify-end">
                                            @if($user->role === 'super-admin')
                                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    Super Admin
                                                </span>
                                            @elseif($user->role === 'administrator')
                                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    Administrator
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    Operator
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- User Details -->
                                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <h5 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">User Information</h5>
                                            <dl class="space-y-3">
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</dt>
                                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Username</dt>
                                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->username }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</dt>
                                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email ?: 'Not provided' }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Role</dt>
                                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                        @if($user->role === 'super-admin')
                                                            Super Admin
                                                        @elseif($user->role === 'administrator')
                                                            Administrator
                                                        @else
                                                            Operator
                                                        @endif
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>

                                        <div>
                                            <h5 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Account Information</h5>
                                            <dl class="space-y-3">
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Account Created</dt>
                                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->created_at->format('F d, Y \a\t g:i A') }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->updated_at->format('F d, Y \a\t g:i A') }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User ID</dt>
                                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->id }}</dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </x-app-layout> --}}
@endsection
