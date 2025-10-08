// Multi-Waypoint Routes Functionality
// Usage: Include after transportation-routes.js

let currentMode = 'simple'; // 'simple' or 'multi'
let waypoints = []; // Array of {location, lat, lng, transport_to_next, marker}
let waypointMarkers = [];
let waypointLines = [];

// Mode switcher
document.getElementById('modeSimple').addEventListener('click', function() {
    currentMode = 'simple';
    document.getElementById('simpleModePanel').classList.remove('hidden');
    document.getElementById('multiModePanel').classList.add('hidden');
    document.getElementById('modeSimple').classList.remove('bg-gray-300', 'text-gray-700');
    document.getElementById('modeSimple').classList.add('bg-blue-600', 'text-white', 'font-semibold');
    document.getElementById('modeMulti').classList.remove('bg-blue-600', 'text-white', 'font-semibold');
    document.getElementById('modeMulti').classList.add('bg-gray-300', 'text-gray-700');
    clearWaypoints();
});

document.getElementById('modeMulti').addEventListener('click', function() {
    currentMode = 'multi';
    document.getElementById('simpleModePanel').classList.add('hidden');
    document.getElementById('multiModePanel').classList.remove('hidden');
    document.getElementById('modeMulti').classList.remove('bg-gray-300', 'text-gray-700');
    document.getElementById('modeMulti').classList.add('bg-blue-600', 'text-white', 'font-semibold');
    document.getElementById('modeSimple').classList.remove('bg-blue-600', 'text-white', 'font-semibold');
    document.getElementById('modeSimple').classList.add('bg-gray-300', 'text-gray-700');
    // Clear simple mode markers
    if (startMarker) map.removeLayer(startMarker);
    if (endMarker) map.removeLayer(endMarker);
    if (routeLine) map.removeLayer(routeLine);
    startMarker = null;
    endMarker = null;
    routeLine = null;
});

// Add waypoint on map click (multi mode)
function handleMapClickMultiMode(e) {
    if (currentMode !== 'multi') return;

    const waypointNum = waypoints.length + 1;
    const location = prompt(`📍 Nama Waypoint ${waypointNum}:`, `Titik ${waypointNum}`);
    if (!location) return;

    // Choose transport to next point (if not the last point)
    let transportToNext = null;
    if (waypoints.length > 0) {
        const transportOptions = ['pesawat', 'kapal', 'kereta', 'mobil', 'motor', 'truk'];
        const transportLabels = {
            'pesawat': '✈️ Pesawat',
            'kapal': '🚢 Kapal',
            'kereta': '🚂 Kereta',
            'mobil': '🚗 Mobil',
            'motor': '🏍️ Motor',
            'truk': '🚚 Truk'
        };

        let transportChoice = prompt(
            `🚗 Transportasi dari "${waypoints[waypoints.length - 1].location}" ke "${location}":\n\n` +
            `1 = Pesawat\n2 = Kapal\n3 = Kereta\n4 = Mobil\n5 = Motor\n6 = Truk\n\n` +
            `Pilih (1-6):`,
            '1'
        );

        const transportIndex = parseInt(transportChoice) - 1;
        if (transportIndex >= 0 && transportIndex < transportOptions.length) {
            transportToNext = transportOptions[transportIndex];
        }
    }

    // Create marker with number
    const waypointIcon = L.divIcon({
        html: `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 35px; height: 35px; border-radius: 50%; border: 3px solid white; box-shadow: 0 3px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">${waypointNum}</div>`,
        className: 'custom-marker',
        iconSize: [35, 35],
        iconAnchor: [17.5, 17.5]
    });

    const marker = L.marker(e.latlng, {
        icon: waypointIcon,
        draggable: true
    }).addTo(map);

    marker.bindPopup(`<b>${waypointNum}. ${location}</b>`).openPopup();

    // Add to waypoints array
    const waypoint = {
        location: location,
        lat: e.latlng.lat,
        lng: e.latlng.lng,
        transport_to_next: transportToNext,
        marker: marker
    };
    waypoints.push(waypoint);
    waypointMarkers.push(marker);

    // Draw lines between waypoints
    if (waypoints.length > 1) {
        drawWaypointLines();
    }

    // Update waypoints list UI
    renderWaypointsList();

    // Update marker drag event
    marker.on('dragend', function() {
        waypoint.lat = marker.getLatLng().lat;
        waypoint.lng = marker.getLatLng().lng;
        drawWaypointLines();
        renderWaypointsList();
    });
}

// Draw lines between waypoints with transport icons
function drawWaypointLines() {
    // Clear existing lines
    waypointLines.forEach(line => map.removeLayer(line));
    waypointLines = [];

    // Draw lines between consecutive waypoints
    for (let i = 0; i < waypoints.length - 1; i++) {
        const start = waypoints[i];
        const end = waypoints[i + 1];

        // Get transport type for this segment
        const transport = start.transport_to_next || 'mobil';
        const colors = {
            'pesawat': '#3B82F6',
            'kapal': '#10B981',
            'kereta': '#F59E0B',
            'mobil': '#EF4444',
            'motor': '#8B5CF6',
            'truk': '#6B7280'
        };

        const line = L.polyline([
            [start.lat, start.lng],
            [end.lat, end.lng]
        ], {
            color: colors[transport] || '#10B981',
            weight: 4,
            opacity: 0.7,
            dashArray: '10, 5'
        }).addTo(map);

        // Add transport icon at midpoint
        const midLat = (start.lat + end.lat) / 2;
        const midLng = (start.lng + end.lng) / 2;
        const icon = transportIcons[transport] || '🚗';

        const transportMarker = L.marker([midLat, midLng], {
            icon: L.divIcon({
                html: `<div style="font-size: 24px; background: white; padding: 4px; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">${icon}</div>`,
                className: 'custom-marker',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            })
        }).addTo(map);

        waypointLines.push(line);
        waypointLines.push(transportMarker);
    }
}

// Render waypoints list UI
function renderWaypointsList() {
    const list = document.getElementById('waypointsList');

    if (waypoints.length === 0) {
        list.innerHTML = '<p class="text-gray-500 text-sm text-center py-4">Klik peta untuk menambahkan waypoint...</p>';
        return;
    }

    list.innerHTML = waypoints.map((wp, index) => {
        const nextTransport = wp.transport_to_next ? transportIcons[wp.transport_to_next] : '';
        const arrow = index < waypoints.length - 1 ? `→ ${nextTransport}` : '';

        return `
            <div class="flex items-center justify-between bg-gray-50 p-2 rounded border">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-purple-600">${index + 1}.</span>
                    <div>
                        <p class="text-sm font-semibold">${wp.location}</p>
                        <p class="text-xs text-gray-500">${wp.lat.toFixed(6)}, ${wp.lng.toFixed(6)}</p>
                    </div>
                    ${arrow ? `<span class="text-lg">${arrow}</span>` : ''}
                </div>
                <button onclick="removeWaypoint(${index})" class="text-red-600 hover:text-red-800 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
    }).join('');
}

// Remove waypoint
function removeWaypoint(index) {
    if (!confirm(`Hapus waypoint "${waypoints[index].location}"?`)) return;

    // Remove marker from map
    map.removeLayer(waypoints[index].marker);

    // Remove from array
    waypoints.splice(index, 1);
    waypointMarkers.splice(index, 1);

    // Redraw everything
    drawWaypointLines();
    renderWaypointsList();

    // Renumber markers
    waypoints.forEach((wp, i) => {
        const newIcon = L.divIcon({
            html: `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 35px; height: 35px; border-radius: 50%; border: 3px solid white; box-shadow: 0 3px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">${i + 1}</div>`,
            className: 'custom-marker',
            iconSize: [35, 35],
            iconAnchor: [17.5, 17.5]
        });
        wp.marker.setIcon(newIcon);
        wp.marker.setPopupContent(`<b>${i + 1}. ${wp.location}</b>`);
    });
}

// Clear all waypoints
function clearWaypoints() {
    waypointMarkers.forEach(marker => map.removeLayer(marker));
    waypointLines.forEach(line => map.removeLayer(line));
    waypoints = [];
    waypointMarkers = [];
    waypointLines = [];
    renderWaypointsList();
}

document.getElementById('clearWaypoints').addEventListener('click', clearWaypoints);

// Modify map click handler to support multi mode
const originalMapClickHandler = map._events.click[0].fn;
map.off('click');
map.on('click', function(e) {
    if (currentMode === 'multi') {
        handleMapClickMultiMode(e);
    } else {
        originalMapClickHandler(e);
    }
});

// Save multi-waypoint route
function saveMultiWaypointRoute() {
    if (waypoints.length < 2) {
        alert('⚠️ Tambahkan minimal 2 waypoint!');
        return;
    }

    const routeName = prompt('Nama rute:', `Rute ${waypoints.length} titik`);
    if (!routeName) return;

    // Calculate total distance
    let totalDistance = 0;
    for (let i = 0; i < waypoints.length - 1; i++) {
        const start = L.latLng(waypoints[i].lat, waypoints[i].lng);
        const end = L.latLng(waypoints[i + 1].lat, waypoints[i + 1].lng);
        totalDistance += start.distanceTo(end);
    }

    const routeData = {
        route_name: routeName,
        is_multi_segment: true,
        waypoints: waypoints.map(wp => ({
            location: wp.location,
            lat: wp.lat,
            lng: wp.lng,
            transport_to_next: wp.transport_to_next
        })),
        distance_km: (totalDistance / 1000).toFixed(2),
        color: '#667eea'
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
            alert('💾 Rute multi-waypoint berhasil disimpan!');
            loadSavedRoutes();
            clearWaypoints();
        } else {
            alert('❌ Gagal menyimpan rute!');
        }
    })
    .catch(error => {
        console.error('Error saving route:', error);
        alert('❌ Terjadi kesalahan saat menyimpan rute!');
    });
}

// Update save button to handle both modes
const originalSaveBtn = document.getElementById('saveRouteBtn');
originalSaveBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    if (currentMode === 'multi') {
        saveMultiWaypointRoute();
    } else {
        saveRouteToDatabase();
    }
});

