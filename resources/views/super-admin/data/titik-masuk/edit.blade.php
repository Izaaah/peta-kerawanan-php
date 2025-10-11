@extends('layouts.superadmin-master')

@section('title', 'Edit Route Name')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Edit Route Name</h2>
            <p class="text-gray-600 mb-6">Anda hanya dapat mengedit nama rute. Data waypoint dan transport lainnya tidak
                dapat diubah dari sini.</p>

            <form action="{{ route('super-admin.data.titik-masuk.update', $titikMasuk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-4">
                        <label for="route_name" class="block font-semibold mb-1">Route Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="route_name" id="route_name"
                            value="{{ old('route_name', $titikMasuk->route_name) }}"
                            class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('route_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Display current route information (read-only) -->
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Informasi Rute Saat Ini</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-600">Start Location:</span>
                            <span class="text-gray-800">{{ $titikMasuk->start_location ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">End Location:</span>
                            <span class="text-gray-800">{{ $titikMasuk->end_location ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Transport Type:</span>
                            <span class="text-gray-800">
                                @if ($titikMasuk->transport_type)
                                    {{ \App\Models\TransportationRoute::getTransportIcon($titikMasuk->transport_type) }}
                                    {{ ucfirst($titikMasuk->transport_type) }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Distance:</span>
                            <span
                                class="text-gray-800">{{ $titikMasuk->distance_km ? number_format($titikMasuk->distance_km, 2) . ' km' : '-' }}</span>
                        </div>
                        @if ($titikMasuk->is_multi_segment && $titikMasuk->waypoints)
                            @php
                                $waypoints = is_string($titikMasuk->waypoints)
                                    ? json_decode($titikMasuk->waypoints, true)
                                    : $titikMasuk->waypoints;
                            @endphp
                            <div class="md:col-span-2">
                                <span class="font-medium text-gray-600">Waypoints:</span>
                                <span class="text-gray-800">{{ count($waypoints) }} titik</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fas fa-save mr-1"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('super-admin.data.titik-masuk.index') }}"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        <i class="fas fa-times mr-1"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
