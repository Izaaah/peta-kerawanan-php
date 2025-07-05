<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="hidden md:flex md:w-64 md:flex-col">
            <div class="flex flex-col flex-grow pt-5 bg-white dark:bg-gray-800 overflow-y-auto border-r border-gray-200 dark:border-gray-700">
                <div class="flex items-center flex-shrink-0 px-4">
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Menu</h1>
                </div>
                <div class="mt-5 flex-grow flex flex-col">
                    <nav class="flex-1 px-2 pb-4 space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" class="group flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                            <div class="flex items-center">
                                <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-gray-500 dark:text-gray-300' : 'text-gray-400 dark:text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                                </svg>
                                Dashboard
                            </div>
                        </a>

                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}" class="group flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('profile.edit') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                            <div class="flex items-center">
                                <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('profile.edit') ? 'text-gray-500 dark:text-gray-300' : 'text-gray-400 dark:text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </div>
                        </a>

                        <!-- Users -->
                        <a href="#" class="group flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100">
                            <div class="flex items-center">
                                <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 dark:text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                                Users
                            </div>
                        </a>

                        <!-- Settings -->
                        <a href="#" class="group flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100">
                            <div class="flex items-center">
                                <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 dark:text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Card 1 -->
                                <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg border border-blue-200 dark:border-blue-800">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100">Total Users</h4>
                                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">1,234</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2 -->
                                <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg border border-green-200 dark:border-green-800">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-green-900 dark:text-green-100">Active Sessions</h4>
                                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">567</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3 -->
                                <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg border border-purple-200 dark:border-purple-800">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-8 w-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-purple-900 dark:text-purple-100">Growth Rate</h4>
                                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">+12.5%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="space-y-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600 dark:text-gray-300">User John Doe logged in</span>
                                            <span class="text-xs text-gray-400">2 minutes ago</span>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600 dark:text-gray-300">New user registered</span>
                                            <span class="text-xs text-gray-400">5 minutes ago</span>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600 dark:text-gray-300">System maintenance completed</span>
                                            <span class="text-xs text-gray-400">1 hour ago</span>
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
</x-app-layout>
