@extends('layouts.admin-master')

@section('title', 'Data Titik Masuk')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Daftar Tempat Titik Masuk</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai Titik Masuk</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.data.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.data.titik-masuk.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari jenis, nama pihak, posisi..."
                class="border rounded px-3 py-2 w-full" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>

        <div class="bg-white rounded shadow p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Route Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Start Location</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Transport Type</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Distance</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($titikMasukList as $i => $titikMasuk)
                        <tr>
                            <td class="px-4 py-2">{{ $titikMasukList->firstItem() + $i }}</td>
                            <td class="px-4 py-2">
                                <div class="font-medium text-gray-900">{{ $titikMasuk->route_name ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-2">
                                @if ($titikMasuk->is_multi_segment && $titikMasuk->waypoints)
                                    @php
                                        $waypoints = is_string($titikMasuk->waypoints)
                                            ? json_decode($titikMasuk->waypoints, true)
                                            : $titikMasuk->waypoints;
                                        $startWp = $waypoints[0] ?? null;
                                        $endWp = end($waypoints);
                                    @endphp
                                    @if ($startWp)
                                        <div class="font-medium text-gray-900">{{ $startWp['location'] ?? 'Waypoint 1' }}
                                        </div>
                                        @if ($endWp && count($waypoints) > 1)
                                            <div class="text-xs text-gray-500">→
                                                {{ $endWp['location'] ?? 'Waypoint ' . count($waypoints) }}</div>
                                        @endif
                                        <div class="text-xs text-blue-600 mt-1">{{ count($waypoints) }} waypoints</div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                @else
                                    <div class="font-medium text-gray-900">{{ $titikMasuk->start_location ?? '-' }}</div>
                                    @if ($titikMasuk->end_location)
                                        <div class="text-xs text-gray-500">→ {{ $titikMasuk->end_location }}</div>
                                    @endif
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if ($titikMasuk->is_multi_segment && $titikMasuk->waypoints)
                                    @php
                                        $waypoints = is_string($titikMasuk->waypoints)
                                            ? json_decode($titikMasuk->waypoints, true)
                                            : $titikMasuk->waypoints;
                                        $transportTypes = array_filter(array_column($waypoints, 'transport_to_next'));
                                        $uniqueTransports = array_unique($transportTypes);
                                    @endphp
                                    @if (count($uniqueTransports) > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($uniqueTransports as $transport)
                                                <span class="inline-flex items-center text-xs">
                                                    {{ \App\Models\TransportationRoute::getTransportIcon($transport) }}
                                                    <span class="ml-1">{{ ucfirst($transport) }}</span>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                @else
                                    @if ($titikMasuk->transport_type)
                                        <span class="inline-flex items-center">
                                            {{ \App\Models\TransportationRoute::getTransportIcon($titikMasuk->transport_type) }}
                                            <span class="ml-1 text-xs">{{ ucfirst($titikMasuk->transport_type) }}</span>
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if ($titikMasuk->distance_km)
                                    <span class="text-sm text-gray-600">{{ number_format($titikMasuk->distance_km, 2) }}
                                        km</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if ($titikMasuk->is_active ?? true)
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-1 py-2 flex gap-2 justify-center">
                                <a href="{{ route('admin.data.titik-masuk.show', $titikMasuk->id) }}"
                                    class="text-blue-600 hover:text-blue-900 flex items-center border border-blue-600 rounded-md px-1 py-1 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center text-gray-500">Belum ada data titik masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $titikMasukList->links() }}
            </div>
        </div>
    </div>
@endsection
