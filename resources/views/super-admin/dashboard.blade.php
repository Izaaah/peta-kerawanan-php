<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight lg:ml-[250px] lg:mt-[65px]">
            {{ __('Super Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex h-screen">
        <!-- Fixed Sidebar -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 md:top-[65px]">
            <div class="flex flex-col flex-grow bg-white dark:bg-gray-800 overflow-y-auto border-r border-gray-200 dark:border-gray-700">
                <div class="flex items-center flex-shrink-0 px-4 py-4">
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Super Admin Menu</h1>
                </div>
                <div class="flex-grow flex flex-col">
                    <nav class="flex-1 px-2 pb-4 space-y-1">
                        <!-- 1. Peta Daerah Rawan -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none">
                                <svg class="mr-3 h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7a4 4 0 018 0v4" />
                                </svg>
                                Peta Penyalahgunaan
                                <svg :class="{'rotate-90': open}" class="ml-auto h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div x-show="open" class="ml-8 space-y-1" x-cloak>
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-blue-600">
                                    <svg class="mr-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Berdasarkan domisili
                                </a>
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-blue-600">
                                    <svg class="mr-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
                                    </svg>
                                    Berdasarkan TKP
                                </a>
                            </div>
                        </div>

                        <!-- 2. Peta Daerah Rawan Penyelundupan -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none">
                                <svg class="mr-3 h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18" />
                                </svg>
                                Peta Penyelundupan
                                <svg :class="{'rotate-90': open}" class="ml-auto h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div x-show="open" class="ml-8 space-y-1" x-cloak>
                                <!-- Jalur Udara (Pesawat) -->
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-green-600">
                                    <!-- Plane Icon -->
                                    <svg class="mr-2 h-4 w-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19l7-7m0 0l-7-7m7 7H3" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Jalur Udara
                                </a>
                                <!-- Jalur Darat (Mobil) -->
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-green-600">
                                    <!-- Car Icon -->
                                    <svg class="mr-2 h-4 w-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="11" width="18" height="6" rx="2" />
                                        <circle cx="7.5" cy="17.5" r="1.5" />
                                        <circle cx="16.5" cy="17.5" r="1.5" />
                                    </svg>
                                    Jalur Darat
                                </a>
                                <!-- Jalur Laut (Kapal) -->
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-green-600">
                                    <!-- Ship Icon -->
                                    <svg class="mr-2 h-4 w-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20s1-1 9-1 9 1 9 1M5 17l7-7 7 7M12 10V3" />
                                    </svg>
                                    Jalur Laut
                                </a>
                            </div>
                        </div>

                        <!-- 3. Data Pendukung -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none">
                                <svg class="mr-3 h-6 w-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H5a1 1 0 00-1 1v16a1 1 0 001 1h3" />
                                </svg>
                                Data Pendukung
                                <svg :class="{'rotate-90': open}" class="ml-auto h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div x-show="open" class="ml-8 space-y-1" x-cloak>
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-yellow-600">
                                    <svg class="mr-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    PO, Ekspedisi, dan Data Lainnya
                                </a>
                            </div>
                        </div>

                        <!-- 4. Data Informan -->
                        <a href="#" class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100">
                            <svg class="mr-3 h-6 w-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Data Informan
                        </a>

                        <!-- 5. Data Chart -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none">
                                <svg class="mr-3 h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a2 2 0 104 0 2 2 0 00-4 0zm-7 4a2 2 0 104 0 2 2 0 00-4 0zm14-4a2 2 0 104 0 2 2 0 00-4 0zm-7-4a2 2 0 104 0 2 2 0 00-4 0z" />
                                </svg>
                                Data Chart
                                <svg :class="{'rotate-90': open}" class="ml-auto h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div x-show="open" class="ml-8 space-y-1" x-cloak>
                                <a href="{{ route('super-admin.chart-jaringan') }}" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-pink-600">
                                    <svg class="mr-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="12" width="4" height="8" />
                                        <rect x="9" y="8" width="4" height="12" />
                                        <rect x="15" y="4" width="4" height="16" />
                                    </svg>
                                    Chart Jaringan
                                </a>
                            </div>
                        </div>

                        <!-- 6. Input Data -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none">
                                <svg class="mr-3 h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Input Data
                                <svg :class="{'rotate-90': open}" class="ml-auto h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div x-show="open" class="ml-8 space-y-1" x-cloak>
                                <!-- Group 1: Data Penyalahgunaan -->
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-indigo-600">
                                    <svg class="mr-2 h-4 w-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2" />
                                    </svg>
                                    Data Penyalahgunaan
                                </a>
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-indigo-600">
                                    <svg class="mr-2 h-4 w-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
                                    </svg>
                                    Data TKP
                                </a>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>

                                <!-- Group 2: Data Penyelundupan -->
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-indigo-600">
                                    <svg class="mr-2 h-4 w-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19l7-7m0 0l-7-7m7 7H3" />
                                    </svg>
                                    Data Jalur Udara
                                </a>
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-indigo-600">
                                    <svg class="mr-2 h-4 w-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="11" width="18" height="6" rx="2" />
                                        <circle cx="7.5" cy="17.5" r="1.5" />
                                        <circle cx="16.5" cy="17.5" r="1.5" />
                                    </svg>
                                    Data Jalur Darat
                                </a>
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-indigo-600">
                                    <svg class="mr-2 h-4 w-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20s1-1 9-1 9 1 9 1M5 17l7-7 7 7M12 10V3" />
                                    </svg>
                                    Data Jalur Laut
                                </a>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>

                                <!-- Group 3: Data Pendukung -->
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-indigo-600">
                                    <svg class="mr-2 h-4 w-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Data PO & Ekspedisi
                                </a>
                                <a href="#" class="flex items-center px-2 py-2 text-sm text-gray-500 hover:text-indigo-600">
                                    <svg class="mr-2 h-4 w-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Data Informan
                                </a>
                            </div>
                        </div>

                        <!-- 7. User Management -->
                        <a href="{{ route('super-admin.user-management.index') }}" class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100">
                            <svg class="mr-3 h-6 w-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            User Management
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main content with offset for fixed sidebar -->
        <div class="md:pl-64 flex flex-col flex-1">
            <div class="flex-1">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-lg font-semibold mb-4">Selamat datang, {{ Auth::user()->name }}! (Super Admin)</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <!-- Card 1 -->
                                    <div class="bg-red-50 dark:bg-red-900/20 p-6 rounded-lg border border-red-200 dark:border-red-800">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="text-lg font-medium text-red-900 dark:text-red-100">Total Users</h4>
                                                <p class="text-2xl font-bold text-red-600 dark:text-red-400">5,234</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 2 -->
                                    <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg border border-blue-200 dark:border-blue-800">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100">Administrators</h4>
                                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">12</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 3 -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg border border-green-200 dark:border-green-800">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="text-lg font-medium text-green-900 dark:text-green-100">Operators</h4>
                                                <p class="text-2xl font-bold text-green-600 dark:text-green-400">156</p>
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
    </div>
</x-app-layout>
