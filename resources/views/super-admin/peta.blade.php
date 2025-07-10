@extends('layouts.superadmin-master')

@section('content')
<div class="container mx-auto">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-4">Peta Kerawanan Narkoba</h1>

            <!-- Peta akan ditampilkan di sini -->
            <div id="map" style="height: 600px; width: 100%;"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script>
    const map = L.map('map').setView([-7.5, 112.5], 9);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    fetch('/peta-kerawanan')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, {
                style: feature => {
                    const jumlah = feature.properties.jumlah_kasus;
                    return {
                        fillColor: getColor(jumlah),
                        weight: 1,
                        color: 'white',
                        fillOpacity: 0.7
                    };
                },
                onEachFeature: (feature, layer) => {
                    layer.bindPopup(`<strong>${feature.properties.nama_desa}</strong><br>Kasus: ${feature.properties.jumlah_kasus}`);
                }
            }).addTo(map);
        });

    function getColor(jumlah) {
        return jumlah > 100 ? '#800026' :
               jumlah > 50  ? '#BD0026' :
               jumlah > 20  ? '#E31A1C' :
               jumlah > 10  ? '#FC4E2A' :
               jumlah > 5   ? '#FD8D3C' :
               jumlah > 0   ? '#FEB24C' :
                              '#D9F0A3';
    }
</script>
@endpush
@endsection
