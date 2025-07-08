<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight lg:ml-[250px] lg:mt-[65px]">
            {{ __('User Management') }}
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
                        <a href="{{ route('super-admin.user-management.index') }}" class="flex items-center px-2 py-2 text-sm font-medium rounded-md bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <svg class="mr-3 h-6 w-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            User Management
                        </a>

                        <!-- 8. Profile -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100">
                            <svg class="mr-3 h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
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
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">User Management</h3>
                                    <a href="{{ route('super-admin.user-management.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add New User
                                    </a>
                                </div>

                                <!-- Search Form -->
                                <div class="mb-6">
                                    <form method="GET" action="{{ route('super-admin.user-management.index') }}" class="flex gap-4">
                                        <div class="flex-1">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                    </svg>
                                                </div>
                                                <input type="text"
                                                       name="search"
                                                       value="{{ $search }}"
                                                       placeholder="Search users..."
                                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        </div>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Search
                                        </button>
                                        @if($search)
                                            <a href="{{ route('super-admin.user-management.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                Clear
                                            </a>
                                        @endif
                                    </form>
                                </div>

                                <!-- Search Results Info -->
                                @if($search)
                                    <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-md">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <span class="text-blue-700 dark:text-blue-300">
                                                Search results for: <strong>"{{ $search }}"</strong>
                                                ({{ $users->total() }} {{ Str::plural('user', $users->total()) }} found)
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Users Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Username</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($users as $user)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                                    @if($search && stripos($user->name, $search) !== false)
                                                                        {!! str_ireplace($search, '<mark class="bg-yellow-200 dark:bg-yellow-800">' . $search . '</mark>', $user->name) !!}
                                                                    @else
                                                                        {{ $user->name }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                                            @if($search && stripos($user->username, $search) !== false)
                                                                {!! str_ireplace($search, '<mark class="bg-yellow-200 dark:bg-yellow-800">' . $search . '</mark>', $user->username) !!}
                                                            @else
                                                                {{ $user->username }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                                            @if($search && stripos($user->email, $search) !== false)
                                                                {!! str_ireplace($search, '<mark class="bg-yellow-200 dark:bg-yellow-800">' . $search . '</mark>', $user->email) !!}
                                                            @else
                                                                {{ $user->email }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($user->role === 'super-admin')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                                @if($search && stripos('super-admin', $search) !== false)
                                                                    {!! str_ireplace($search, '<mark class="bg-yellow-200 dark:bg-yellow-800">' . $search . '</mark>', 'Super Admin') !!}
                                                                @else
                                                                    Super Admin
                                                                @endif
                                                            </span>
                                                        @elseif($user->role === 'administrator')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                                @if($search && stripos('administrator', $search) !== false)
                                                                    {!! str_ireplace($search, '<mark class="bg-yellow-200 dark:bg-yellow-800">' . $search . '</mark>', 'Administrator') !!}
                                                                @else
                                                                    Administrator
                                                                @endif
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                                @if($search && stripos('operator', $search) !== false)
                                                                    {!! str_ireplace($search, '<mark class="bg-yellow-200 dark:bg-yellow-800">' . $search . '</mark>', 'Operator') !!}
                                                                @else
                                                                    Operator
                                                                @endif
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $user->created_at->format('M d, Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('super-admin.user-management.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ route('super-admin.user-management.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                </svg>
                                                            </a>
                                                            @if($user->id !== auth()->id())
                                                                <form action="{{ route('super-admin.user-management.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if($users->count() === 0)
                                    <div class="text-center py-8">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No users found</h3>
                                        @if($search)
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                No users match your search criteria "{{ $search }}".
                                            </p>
                                        @else
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                Get started by creating a new user.
                                            </p>
                                        @endif
                                    </div>
                                @endif

                                <!-- Pagination -->
                                <div class="mt-6">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit search form after user stops typing
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchForm = searchInput.closest('form');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    searchForm.submit();
                }, 500); // Wait 500ms after user stops typing
            });

            // Submit on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchForm.submit();
                }
            });
        });
    </script>
</x-app-layout>
