@extends('layouts.superadmin-master')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight lg:ml-[250px] lg:mt-[65px]">
            {{ __('Chart Jaringan Narkoba') }}
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
                                <h3 class="text-lg font-semibold mb-6">Input Data Jaringan Narkoba</h3>

                                <form x-data="chartJaringan" x-init="init" class="space-y-6">

                                    <!-- Node Input Section -->
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="text-md font-medium mb-4">Tambah Node Jaringan</h4>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Nama/ID Pelaku
                                                </label>
                                                <input type="text" x-model="newNodeName"
                                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
                                                       placeholder="Contoh: Bandar A, Kurir B">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Tipe Pelaku
                                                </label>
                                                <select x-model="newNodeType"
                                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                                                    <option value="supplier">Supplier/Produsen</option>
                                                    <option value="distributor">Distributor</option>
                                                    <option value="kurir">Kurir</option>
                                                    <option value="dealer">Dealer</option>
                                                    <option value="user">User/Pengguna</option>
                                                </select>
                                            </div>

                                            <div class="flex items-end">
                                                <button type="button" @click="addNode"
                                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                                    Tambah Node
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nodes List -->
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="text-md font-medium mb-4">Daftar Node Jaringan</h4>

                                        <div class="space-y-3">
                                            <template x-for="(node, index) in nodes" :key="node.id">
                                                <div class="flex items-center space-x-4 p-3 bg-white dark:bg-gray-800 rounded-lg border">
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2">
                                                            <span class="text-sm font-medium" x-text="node.name || 'Node ' + (index + 1)"></span>
                                                            <span class="px-2 py-1 text-xs rounded-full"
                                                                  :class="{
                                                                      'bg-red-100 text-red-800': node.type === 'supplier',
                                                                      'bg-orange-100 text-orange-800': node.type === 'distributor',
                                                                      'bg-yellow-100 text-yellow-800': node.type === 'kurir',
                                                                      'bg-green-100 text-green-800': node.type === 'dealer',
                                                                      'bg-blue-100 text-blue-800': node.type === 'user'
                                                                  }"
                                                                  x-text="node.type"></span>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center space-x-2">
                                                        <input type="text" x-model="node.name"
                                                               class="px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                                                               placeholder="Nama node">
                                                        <select x-model="node.type"
                                                                class="px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                                            <option value="supplier">Supplier</option>
                                                            <option value="distributor">Distributor</option>
                                                            <option value="kurir">Kurir</option>
                                                            <option value="dealer">Dealer</option>
                                                            <option value="user">User</option>
                                                        </select>
                                                        <button type="button" @click="removeNode(index)"
                                                                class="text-red-600 hover:text-red-800">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>

                                            <div x-show="nodes.length === 0" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="mt-2">Belum ada node jaringan. Tambahkan node di atas.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Connection Section -->
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="text-md font-medium mb-4">Hubungan Antar Node</h4>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Dari Node
                                                </label>
                                                <select x-model="connectionFrom"
                                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                                                    <option value="">Pilih node</option>
                                                    <template x-for="(node, index) in nodes" :key="node.id">
                                                        <option :value="index" x-text="node.name || 'Node ' + (index + 1)"></option>
                                                    </template>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Ke Node
                                                </label>
                                                <select x-model="connectionTo"
                                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                                                    <option value="">Pilih node</option>
                                                    <template x-for="(node, index) in nodes" :key="node.id">
                                                        <option :value="index" x-text="node.name || 'Node ' + (index + 1)"></option>
                                                    </template>
                                                </select>
                                            </div>

                                            <div class="flex items-end">
                                                <button type="button" @click="addConnection(connectionFrom, connectionTo)"
                                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                                    Tambah Hubungan
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Visualization Preview -->
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="text-md font-medium mb-4">Preview Visualisasi Jaringan</h4>
                                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border min-h-[300px]">
                                            <template x-if="nodes.length > 0">
                                                <pre x-ref="mermaidEl" class="mermaid" x-text="mermaidCode"></pre>
                                            </template>
                                            <div x-show="nodes.length === 0" class="text-center py-12 text-gray-500 dark:text-gray-400">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <p class="mt-2">Visualisasi akan muncul setelah menambahkan node</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex justify-end space-x-4">
                                        <button type="button" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                            Reset
                                        </button>
                                        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200">
                                            Simpan & Visualisasi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/mermaid@10.9.0/dist/mermaid.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chartJaringan', () => ({
            nodes: [],
            connectionFrom: '',
            connectionTo: '',
            newNodeName: '',
            newNodeType: 'supplier',
            mermaidCode: 'graph TD\n',
            addNode() {
                if (!this.newNodeName) return;
                this.nodes.push({
                    id: Date.now() + Math.random(),
                    name: this.newNodeName,
                    type: this.newNodeType,
                    connections: []
                });
                this.newNodeName = '';
                this.newNodeType = 'supplier';
                this.updateMermaid();
            },
            removeNode(index) {
                this.nodes.splice(index, 1);
                this.updateMermaid();
            },
            addConnection(fromIndex, toIndex) {
                if (fromIndex !== toIndex && fromIndex !== '' && toIndex !== '' && fromIndex >= 0 && toIndex >= 0) {
                    if (!this.nodes[fromIndex].connections.includes(toIndex)) {
                        this.nodes[fromIndex].connections.push(toIndex);
                        this.updateMermaid();
                    }
                }
            },
            updateMermaid() {
                let code = 'graph TD\n';
                this.nodes.forEach((node, idx) => {
                    let label = node.name ? node.name + ' [' + node.type + ']' : 'Node' + (idx+1) + ' [' + node.type + ']';
                    code += `N${idx}[\"${label}\"]\n`;
                });
                this.nodes.forEach((node, idx) => {
                    node.connections.forEach(connIdx => {
                        code += `N${idx} --> N${connIdx}\n`;
                    });
                });
                this.mermaidCode = code;
                this.$nextTick(() => {
                    if (window.mermaid) {
                        window.mermaid.init(undefined, this.$refs.mermaidEl);
                    }
                });
            },
            init() {
                this.updateMermaid();
            }
        }));
    });
</script>
@endpush
