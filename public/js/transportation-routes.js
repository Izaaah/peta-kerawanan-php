// Transportation Routes - Save & Load Multiple Routes
// Add this functionality to map_titikMasuk.blade.php

// Load saved routes from API
function loadSavedRoutes() {
    fetch('/api/transportation-routes', {
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(routes => {
        savedRoutes = routes;
        renderSavedRoutesList();
        displayRoutesOnMap();
    })
    .catch(error => {
        console.error('Error loading routes:', error);
    });
}

// Render saved routes list in sidebar
function renderSavedRoutesList() {
    const listContainer = document.getElementById('savedRoutesList');

    if (savedRoutes.length === 0) {
        listContainer.innerHTML = `
            <div class="text-center text-gray-500 py-8">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                </svg>
                <p>Belum ada rute tersimpan</p>
            </div>
        `;
        return;
    }

    listContainer.innerHTML = savedRoutes.map(route => `
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow route-item" data-route-id="${route.id}">
            <div class="flex justify-between items-start mb-2">
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800 text-sm">${transportIcons[route.transport_type] || '🚗'} ${route.route_name || 'Rute ' + route.id}</h4>
                    <p class="text-xs text-gray-600 mt-1">
                        📍 ${route.start_location} → ${route.end_location}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        📏 ${parseFloat(route.distance_km).toFixed(2)} km
                    </p>
                </div>
                <div class="flex gap-1">
                    <button onclick="toggleRouteVisibility(${route.id})" class="text-blue-600 hover:text-blue-800 p-1" title="Show/Hide">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="animateRoute(${route.id})" class="text-green-600 hover:text-green-800 p-1" title="Animate">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                    <button onclick="deleteRoute(${route.id})" class="text-red-600 hover:text-red-800 p-1" title="Delete">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="text-xs text-gray-400">
                ${new Date(route.created_at).toLocaleDateString('id-ID')}
            </div>
        </div>
    `).join('');
}

// Display all saved routes on map
function displayRoutesOnMap() {
    // Clear existing saved route layers
    Object.values(savedRouteLayers).forEach(layer => {
        if (layer) map.removeLayer(layer);
    });
    savedRouteLayers = {};

    // Add each route to map
    savedRoutes.forEach(route => {
        if (route.is_active) {
            const routeLayer = L.polyline([
                [route.start_lat, route.start_lng],
                [route.end_lat, route.end_lng]
            ], {
                color: route.color || '#10B981',
                weight: 3,
                opacity: 0.6,
                dashArray: '5, 10'
            }).addTo(map);

            routeLayer.bindPopup(`
                <b>${transportIcons[route.transport_type]} ${route.route_name || 'Rute ' + route.id}</b><br>
                ${route.start_location} → ${route.end_location}<br>
                <small>${parseFloat(route.distance_km).toFixed(2)} km</small>
            `);

            savedRouteLayers[route.id] = routeLayer;
        }
    });
}

// Toggle route visibility
function toggleRouteVisibility(routeId) {
    if (savedRouteLayers[routeId]) {
        map.removeLayer(savedRouteLayers[routeId]);
        delete savedRouteLayers[routeId];
    } else {
        const route = savedRoutes.find(r => r.id === routeId);
        if (route) {
            const routeLayer = L.polyline([
                [route.start_lat, route.start_lng],
                [route.end_lat, route.end_lng]
            ], {
                color: route.color || '#10B981',
                weight: 3,
                opacity: 0.6,
                dashArray: '5, 10'
            }).addTo(map);

            routeLayer.bindPopup(`
                <b>${transportIcons[route.transport_type]} ${route.route_name || 'Rute ' + route.id}</b><br>
                ${route.start_location} → ${route.end_location}<br>
                <small>${parseFloat(route.distance_km).toFixed(2)} km</small>
            `);

            savedRouteLayers[routeId] = routeLayer;
            map.fitBounds(routeLayer.getBounds());
        }
    }
}

// Animate specific route
function animateRoute(routeId) {
    const route = savedRoutes.find(r => r.id === routeId);
    if (!route) return;

    if (movingMarker) map.removeLayer(movingMarker);

    const emoji = transportIcons[route.transport_type] || '🚗';
    const transportIconHtml = L.divIcon({
        html: `<div style="font-size: 32px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${emoji}</div>`,
        className: 'custom-marker',
        iconSize: [32, 32],
        iconAnchor: [16, 16]
    });

    movingMarker = L.marker([route.start_lat, route.start_lng], {
        icon: transportIconHtml
    }).addTo(map);

    const distance = L.latLng(route.start_lat, route.start_lng).distanceTo(L.latLng(route.end_lat, route.end_lng));
    const duration = Math.max(3000, Math.min(10000, distance / 100));

    animateMarker(movingMarker,
        L.latLng(route.start_lat, route.start_lng),
        L.latLng(route.end_lat, route.end_lng),
        duration
    );

    // Zoom to route
    map.fitBounds([
        [route.start_lat, route.start_lng],
        [route.end_lat, route.end_lng]
    ], { padding: [50, 50] });
}

// Delete route
function deleteRoute(routeId) {
    if (!confirm('🗑️ Hapus rute ini?')) return;

    fetch(`/api/transportation-routes/${routeId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove from map
            if (savedRouteLayers[routeId]) {
                map.removeLayer(savedRouteLayers[routeId]);
                delete savedRouteLayers[routeId];
            }

            // Reload routes
            loadSavedRoutes();

            alert('✅ Rute berhasil dihapus!');
        }
    })
    .catch(error => {
        console.error('Error deleting route:', error);
        alert('❌ Gagal menghapus rute!');
    });
}

// Save route to database
function saveRouteToDatabase() {
    if (!startMarker || !endMarker) {
        alert('⚠️ Tempatkan kedua titik terlebih dahulu!');
        return;
    }

    const transportType = document.getElementById('transportType').value;
    if (!transportType) {
        alert('⚠️ Pilih jenis transportasi terlebih dahulu!');
        return;
    }

    const startLoc = document.getElementById('startLocationName').value || 'Lokasi Awal';
    const endLoc = document.getElementById('endLocationName').value || 'Lokasi Tujuan';
    const routeName = prompt('Nama rute (opsional):', `${startLoc} - ${endLoc}`);

    const routeData = {
        route_name: routeName,
        start_location: startLoc,
        end_location: endLoc,
        start_lat: startMarker.getLatLng().lat,
        start_lng: startMarker.getLatLng().lng,
        end_lat: endMarker.getLatLng().lat,
        end_lng: endMarker.getLatLng().lng,
        transport_type: transportType,
        distance_km: (startMarker.getLatLng().distanceTo(endMarker.getLatLng()) / 1000).toFixed(2),
        color: '#10B981'
    };

    fetch('/api/transportation-routes', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(routeData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('💾 Rute berhasil disimpan!');
            loadSavedRoutes();
            updateStatus('💾 Rute tersimpan!');
        } else {
            alert('❌ Gagal menyimpan rute!');
        }
    })
    .catch(error => {
        console.error('Error saving route:', error);
        alert('❌ Terjadi kesalahan saat menyimpan rute!');
    });
}

// Initialize on page load
loadSavedRoutes();

// Refresh button
document.getElementById('refreshRoutesBtn').addEventListener('click', loadSavedRoutes);

// Update save button to use database
document.getElementById('saveRouteBtn').addEventListener('click', saveRouteToDatabase);

