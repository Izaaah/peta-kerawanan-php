@extends('layouts.superadmin-master')

@section('title', 'Detail Titik Masuk')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Detail Titik Masuk</h2>

            <!-- Basic Information -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <strong>Route Name:</strong>
                        <div class="text-gray-700">{{ $titikMasuk->route_name ?? '-' }}</div>
                    </div>
                    <div class="mb-4">
                        <strong>Jenis Rute:</strong>
                        <div class="text-gray-700">
                            @if ($titikMasuk->is_multi_segment)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-route mr-1"></i>Multi-Waypoint
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-arrow-right mr-1"></i>Direct Route
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-4">
                        <strong>Start Location:</strong>
                        <div class="text-gray-700">{{ $titikMasuk->start_location ?? '-' }}</div>
                    </div>
                    <div class="mb-4">
                        <strong>End Location:</strong>
                        <div class="text-gray-700">{{ $titikMasuk->end_location ?? '-' }}</div>
                    </div>
                    <div class="mb-4">
                        <strong>Transport Type:</strong>
                        <div class="text-gray-700">
                            @if ($titikMasuk->transport_type)
                                <span class="inline-flex items-center">
                                    {{ \App\Models\TransportationRoute::getTransportIcon($titikMasuk->transport_type) }}
                                    <span class="ml-2">{{ ucfirst($titikMasuk->transport_type) }}</span>
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-4">
                        <strong>Status:</strong>
                        <div class="text-gray-700">
                            @if ($titikMasuk->is_active ?? true)
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Non-Aktif
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-4">
                        <strong>Jarak:</strong>
                        <div class="text-gray-700">
                            {{ $titikMasuk->distance_km ? number_format($titikMasuk->distance_km, 2) . ' km' : '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Coordinate Information -->
            @if ($titikMasuk->start_lat && $titikMasuk->start_lng)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Koordinat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <strong>Start Latitude:</strong>
                            <div class="text-gray-700 font-mono">{{ number_format($titikMasuk->start_lat, 8) }}</div>
                        </div>
                        <div class="mb-4">
                            <strong>Start Longitude:</strong>
                            <div class="text-gray-700 font-mono">{{ number_format($titikMasuk->start_lng, 8) }}</div>
                        </div>
                        @if ($titikMasuk->end_lat && $titikMasuk->end_lng)
                            <div class="mb-4">
                                <strong>End Latitude:</strong>
                                <div class="text-gray-700 font-mono">{{ number_format($titikMasuk->end_lat, 8) }}</div>
                            </div>
                            <div class="mb-4">
                                <strong>End Longitude:</strong>
                                <div class="text-gray-700 font-mono">{{ number_format($titikMasuk->end_lng, 8) }}</div>
                            </div>
                        @endif
                    </div>
                    @if ($titikMasuk->color)
                        <div class="mb-4">
                            <strong>Warna Rute:</strong>
                            <div class="flex items-center mt-1">
                                <div class="w-8 h-4 rounded border" style="background-color: {{ $titikMasuk->color }}">
                                </div>
                                <span class="ml-2 text-gray-700 font-mono">{{ $titikMasuk->color }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Description -->
            @if ($titikMasuk->description)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Deskripsi</h3>
                    <div class="text-gray-700 bg-gray-50 p-4 rounded-lg">
                        {{ $titikMasuk->description }}
                    </div>
                </div>
            @endif

            <!-- Waypoints -->
            @if ($titikMasuk->is_multi_segment && $titikMasuk->waypoints)
                @php
                    $waypoints = is_string($titikMasuk->waypoints)
                        ? json_decode($titikMasuk->waypoints, true)
                        : $titikMasuk->waypoints;
                @endphp
                @if (is_array($waypoints) && count($waypoints) > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Waypoints
                            ({{ count($waypoints) }} titik)</h3>
                        <div class="space-y-3">
                            @foreach ($waypoints as $index => $waypoint)
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center">
                                                <span
                                                    class="inline-flex items-center justify-center w-6 h-6 bg-blue-500 text-white text-xs font-bold rounded-full mr-3">
                                                    {{ $index + 1 }}
                                                </span>
                                                <strong
                                                    class="text-gray-900 text-lg">{{ $waypoint['location'] ?? 'Waypoint ' . ($index + 1) }}</strong>
                                            </div>
                                            @if (isset($waypoint['transport_to_next']))
                                                <div class="mt-2 ml-9">
                                                    <span class="inline-flex items-center text-sm text-blue-600">
                                                        {{ \App\Models\TransportationRoute::getTransportIcon($waypoint['transport_to_next']) }}
                                                        <span
                                                            class="ml-1">{{ ucfirst($waypoint['transport_to_next']) }}</span>
                                                        @if ($index < count($waypoints) - 1)
                                                            <span class="ml-2 text-gray-400">→</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        @if (isset($waypoint['lat']) && isset($waypoint['lng']))
                                            <div class="text-xs text-gray-500 font-mono bg-white px-2 py-1 rounded">
                                                {{ number_format($waypoint['lat'], 6) }},
                                                {{ number_format($waypoint['lng'], 6) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            <div class="flex gap-2 mt-6">
                <a href="{{ route('super-admin.data.titik-masuk.edit', $titikMasuk->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    <i class="fas fa-edit mr-1"></i>Edit Route Name
                </a>
                <a href="{{ route('super-admin.data.titik-masuk.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
