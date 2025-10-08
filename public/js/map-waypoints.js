// Map Waypoints - Optimized Version
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing map...');

    // User role check - get from global variable set in blade template
    const userRole = window.userRole || 'guest';
    const isSuperAdmin = window.isSuperAdmin || false;
    console.log('JavaScript - User role:', userRole, 'Is Super Admin:', isSuperAdmin);

    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    console.log('CSRF Token found:', csrfToken ? 'Yes' : 'No');

    // Initialize map
    const map = L.map('map').setView([-2.5, 118], 5);
    console.log('Map initialized:', map);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Variables
    let movingMarker = null;
    let animationInProgress = false;
    let animationCompleted = false;
    let currentAnimationSegment = 0;
    let waypoints = [];
    let waypointMarkers = [];
    let waypointLines = [];

    // Saved routes variables
    let savedRoutes = [];
    let savedRoutesLayers = {}; // Store route layers for show/hide functionality

    // Auto-play animation variables
    let autoPlayEnabled = true;
    let autoPlayInterval = null;
    let allAnimationsCompleted = false;

    // Transport icons
    const transportIcons = {
        pesawat: '✈️',
        kapal: '🚢',
        kereta: '🚂',
        mobil: '🚗',
        motor: '🏍️',
        truk: '🚚',
        bus: '🚌'
    };

    // Function to display routes on map only (for read-only mode)
    function displayRoutesOnMapOnly(routes) {
        console.log('Displaying routes on map only for read-only mode:', routes.length);

        // For read-only mode, make all routes active for animation
        routes.forEach(route => {
            route.is_active = true;
        });

        routes.forEach(route => {
            // Handle both simple and multi-waypoint routes
            if (route.is_multi_segment && route.waypoints) {
                const waypoints = typeof route.waypoints === 'string' ? JSON.parse(route.waypoints) : route.waypoints;

                // Create route layers for map display
                const layerGroup = L.layerGroup();

                // Add waypoint markers - small dots
                waypoints.forEach((wp, index) => {
                    const marker = L.marker([wp.lat, wp.lng], {
                        icon: L.divIcon({
                            html: `<div style="background: #3b82f6; border-radius: 50%; width: 6px; height: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.3);"></div>`,
                            className: 'custom-saved-waypoint-marker',
                            iconSize: [6, 6],
                            iconAnchor: [3, 3]
                        })
                    }).bindPopup(`<b>${wp.location}</b><br/>Waypoint ${index + 1}<br/>Route: ${route.route_name || 'Unnamed Route'}`);
                    layerGroup.addLayer(marker);
                });

                // Add route lines
                for (let i = 0; i < waypoints.length - 1; i++) {
                    const start = waypoints[i];
                    const end = waypoints[i + 1];
                    const transportType = start.transport_to_next || 'mobil';
                    const line = L.polyline([
                        [start.lat, start.lng],
                        [end.lat, end.lng]
                    ], {
                        color: getTransportColor(transportType),
                        weight: 3,
                        opacity: 0.7,
                        dashArray: '5, 5' // Garis putus-putus kecil
                    }).bindPopup(`<b>${route.route_name || 'Unnamed Route'}</b><br/>Transport: ${transportType}<br/>Distance: ${route.distance_km || '0'} km`);
                    layerGroup.addLayer(line);
                }

                // Store layer group and always add to map for read-only mode
                savedRoutesLayers[route.id] = layerGroup;
                layerGroup.addTo(map);

            } else {
                // Handle simple routes
                if (route.start_lat && route.start_lng && route.end_lat && route.end_lng) {
                    const layerGroup = L.layerGroup();

                    const startMarker = L.marker([route.start_lat, route.start_lng], {
                        icon: L.divIcon({
                            html: `<div style="background: #10b981; border-radius: 50%; width: 6px; height: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.3);"></div>`,
                            className: 'custom-start-marker',
                            iconSize: [6, 6],
                            iconAnchor: [3, 3]
                        })
                    }).bindPopup(`<b>${route.start_location || 'Start'}</b><br/>Route: ${route.route_name || 'Unnamed Route'}`);

                    const endMarker = L.marker([route.end_lat, route.end_lng], {
                        icon: L.divIcon({
                            html: `<div style="background: #ef4444; border-radius: 50%; width: 6px; height: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.3);"></div>`,
                            className: 'custom-end-marker',
                            iconSize: [6, 6],
                            iconAnchor: [3, 3]
                        })
                    }).bindPopup(`<b>${route.end_location || 'End'}</b><br/>Route: ${route.route_name || 'Unnamed Route'}`);

                    const line = L.polyline([
                        [route.start_lat, route.start_lng],
                        [route.end_lat, route.end_lng]
                    ], {
                        color: getTransportColor(route.transport_type || 'mobil'),
                        weight: 3,
                        opacity: 0.7,
                        dashArray: '5, 5' // Garis putus-putus kecil
                    }).bindPopup(`<b>${route.route_name || 'Unnamed Route'}</b><br/>Transport: ${route.transport_type || 'mobil'}<br/>Distance: ${route.distance_km || '0'} km`);

                    layerGroup.addLayer(startMarker);
                    layerGroup.addLayer(endMarker);
                    layerGroup.addLayer(line);

                    // Store layer group and always add to map for read-only mode
                    savedRoutesLayers[route.id] = layerGroup;
                    layerGroup.addTo(map);
                }
            }
        });

        console.log('All routes displayed on map for read-only mode');
    }

    // Function to get transport color based on category
    function getTransportColor(transport) {
        const colors = {
            // Jalur Udara - Merah
            pesawat: '#FF0000',

            // Jalur Laut - Biru
            kapal: '#0000FF',

            // Jalur Darat - Hitam
            kereta: '#000000',
            mobil: '#000000',
            motor: '#000000',
            truk: '#000000',
            bus: '#000000'
        };
        return colors[transport] || '#000000';
    }

    // Status update function
    function updateStatus(message) {
        const statusElement = document.getElementById('statusInfo');
        if (statusElement) {
            statusElement.textContent = message;
        }
    }

    // Add waypoint function
    window.addWaypointHere = function(lat, lng, locationName = null) {
        const waypointNum = waypoints.length + 1;
        const location = locationName || `Waypoint ${waypointNum}`;

        // Choose transport to next point
        let transportToNext = 'mobil'; // default
        if (waypoints.length > 0) {
            const options = ['pesawat', 'kapal', 'kereta', 'mobil', 'motor', 'truk'];
            const choice = prompt(`🚗 Pilih transportasi dari ${waypoints[waypoints.length - 1].location} ke ${location}:\n1. ✈️ Pesawat\n2. 🚢 Kapal\n3. 🚂 Kereta\n4. 🚗 Mobil\n5. 🏍️ Motor\n6. 🚚 Truk\n\nMasukkan nomor (1-6):`, '4');
            const index = parseInt(choice) - 1;
            if (index >= 0 && index < options.length) {
                transportToNext = options[index];
            }
        }

        // Create marker - small dot
        const marker = L.marker([lat, lng], {
            draggable: true,
            icon: L.divIcon({
                html: `<div style="background: #3b82f6; border-radius: 50%; width: 8px; height: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.3);"></div>`,
                className: 'custom-waypoint-marker',
                iconSize: [8, 8],
                iconAnchor: [4, 4]
            })
        }).addTo(map);

        marker.bindPopup(`<b>📍 ${location}</b><br>Waypoint ${waypointNum}`).openPopup();

        // Create waypoint object
        const waypoint = {
            location: location,
            lat: lat,
            lng: lng,
            transport_to_next: transportToNext,
            marker: marker
        };

        waypoints.push(waypoint);
        waypointMarkers.push(marker);

        // Draw lines between waypoints
        if (waypoints.length > 1) {
            const prevWaypoint = waypoints[waypoints.length - 2];
            const transportType = prevWaypoint.transport_to_next || 'mobil';
            const line = L.polyline([
                [prevWaypoint.lat, prevWaypoint.lng],
                [lat, lng]
            ], {
                color: getTransportColor(transportType),
                weight: 4,
                opacity: 0.8,
                dashArray: '5, 5' // Garis putus-putus kecil
            }).addTo(map);

            waypointLines.push(line);
        }

        updateWaypointsList();
        updateStatus(`Waypoint ${waypointNum} ditambahkan: ${location}`);

        // Reset animation state when waypoints change
        resetAnimationState();
    };

    // Update waypoints list
    function updateWaypointsList() {
        const listElement = document.getElementById('waypointsList');
        if (!listElement) return;

        listElement.innerHTML = '';
        waypoints.forEach((wp, index) => {
            const item = document.createElement('div');
            item.className = 'flex justify-between items-center p-2 bg-gray-50 rounded mb-2';

            const transportInfo = index < waypoints.length - 1 ?
                `<br><small class="text-gray-600">→ ${transportIcons[wp.transport_to_next]} ${wp.transport_to_next}</small>` : '';

            item.innerHTML = `
                <div>
                    <span class="font-semibold">${index + 1}. ${wp.location}</span>
                    ${transportInfo}
                </div>
                <div class="flex gap-1">
                    <button onclick="editWaypointName(${index})" class="text-blue-500 hover:text-blue-700 text-sm" title="Edit Nama">✏️</button>
                    ${index < waypoints.length - 1 ? `<button onclick="changeTransport(${index})" class="text-green-500 hover:text-green-700 text-sm" title="Ubah Transportasi">🚗</button>` : ''}
                    <button onclick="removeWaypoint(${index})" class="text-red-500 hover:text-red-700 text-sm" title="Hapus Waypoint">🗑️</button>
                </div>
            `;
            listElement.appendChild(item);
        });
    }

    // Remove waypoint
    window.removeWaypoint = function(index) {
        if (waypoints[index] && waypoints[index].marker) {
            map.removeLayer(waypoints[index].marker);
        }
        waypoints.splice(index, 1);
        waypointMarkers.splice(index, 1);

        // Redraw lines
        waypointLines.forEach(line => map.removeLayer(line));
        waypointLines = [];

        for (let i = 0; i < waypoints.length - 1; i++) {
            const line = L.polyline([
                [waypoints[i].lat, waypoints[i].lng],
                [waypoints[i + 1].lat, waypoints[i + 1].lng]
            ], {
                color: '#667eea',
                weight: 4,
                opacity: 0.8
            }).addTo(map);
            waypointLines.push(line);
        }

        updateWaypointsList();
        updateStatus(`Waypoint dihapus. Total: ${waypoints.length} waypoint`);
        resetAnimationState();
    };

    // Edit waypoint name
    window.editWaypointName = function(index) {
        const waypoint = waypoints[index];
        const newName = prompt(`✏️ Edit nama waypoint:`, waypoint.location);
        if (newName && newName !== waypoint.location) {
            waypoint.location = newName;
            waypoint.marker.bindPopup(`<b>📍 ${newName}</b><br>Waypoint ${index + 1}`);
            updateWaypointsList();
            updateStatus(`Waypoint ${index + 1} diubah menjadi: ${newName}`);
        }
    };

    // Change transport
    window.changeTransport = function(index) {
        const waypoint = waypoints[index];
        if (index >= waypoints.length - 1) return; // Last waypoint has no transport

        const nextWaypoint = waypoints[index + 1];
        const options = ['pesawat', 'kapal', 'kereta', 'mobil', 'motor', 'truk'];
        const icons = ['✈️', '🚢', '🚂', '🚗', '🏍️', '🚚'];

        let optionsText = `🚗 Pilih transportasi dari "${waypoint.location}" ke "${nextWaypoint.location}":\n\n`;
        options.forEach((option, index) => {
            optionsText += `${index + 1}. ${icons[index]} ${option.charAt(0).toUpperCase() + option.slice(1)}\n`;
        });
        optionsText += `\nMasukkan nomor (1-6):`;

        const choice = prompt(optionsText, '4');
        if (!choice) return;

        const optionIndex = parseInt(choice) - 1;
        if (optionIndex >= 0 && optionIndex < options.length) {
            const newTransport = options[optionIndex];
            waypoint.transport_to_next = newTransport;

            // Redraw lines to update transport icons
            waypointLines.forEach(line => map.removeLayer(line));
            waypointLines = [];

            for (let i = 0; i < waypoints.length - 1; i++) {
                const start = waypoints[i];
                const end = waypoints[i + 1];

                const line = L.polyline([
                    [start.lat, start.lng],
                    [end.lat, end.lng]
                ], {
                    color: getTransportColor(start.transport_to_next),
                    weight: 4,
                    opacity: 0.8,
                    dashArray: '5, 5' // Garis putus-putus kecil
                }).addTo(map);

                waypointLines.push(line);

                // Add transport icon in the middle
                const midLat = (start.lat + end.lat) / 2;
                const midLng = (start.lng + end.lng) / 2;

                const transportIcon = transportIcons[start.transport_to_next] || '🚗';
                const transportMarker = L.marker([midLat, midLng], {
                    icon: L.divIcon({
                        html: `<div style="font-size: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${transportIcon}</div>`,
                        className: 'transport-icon',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12]
                    })
                }).addTo(map);

                waypointLines.push(transportMarker);
            }

            updateWaypointsList();
            updateStatus(`Transportasi diubah menjadi: ${transportIcons[newTransport]} ${newTransport}`);
            resetAnimationState();
        }
    };

    // Reset animation state
    function resetAnimationState() {
        animationInProgress = false;
        animationCompleted = false;
        currentAnimationSegment = 0;
        if (movingMarker) {
            map.removeLayer(movingMarker);
            movingMarker = null;
        }
    }

    // Clear waypoints
    function clearWaypoints() {
        waypointMarkers.forEach(marker => map.removeLayer(marker));
        waypointLines.forEach(line => map.removeLayer(line));
        waypoints = [];
        waypointMarkers = [];
        waypointLines = [];
        updateWaypointsList();
        resetAnimationState();
    }

    // Animation function
    function startMultiWaypointAnimation(continueFromCurrent = false) {
        // If animation completed, ask user what to do
        if (animationCompleted && !continueFromCurrent) {
            const choice = confirm('Animasi sudah selesai. Klik OK untuk mengulang dari awal, atau Cancel untuk melanjutkan dari posisi terakhir.');
            if (choice) {
                // Restart from beginning
                currentAnimationSegment = 0;
                animationCompleted = false;
                if (movingMarker) {
                    map.removeLayer(movingMarker);
                    movingMarker = null;
                }
            } else {
                // Continue from current position (do nothing, just return)
                return;
            }
        }

        // If already in progress, ask to restart
        if (animationInProgress) {
            const restart = confirm('Animasi sedang berjalan. Klik OK untuk mengulang dari awal, atau Cancel untuk membatalkan.');
            if (restart) {
                currentAnimationSegment = 0;
                animationCompleted = false;
                if (movingMarker) {
                    map.removeLayer(movingMarker);
                    movingMarker = null;
                }
            } else {
                return;
            }
        }

        animationInProgress = true;

        function animateSegment() {
            if (currentAnimationSegment >= waypoints.length - 1) {
                animationInProgress = false;
                animationCompleted = true;
                updateStatus('✅ Animasi selesai! Klik "Mulai Animasi" untuk mengulang atau melanjutkan.');
                if (movingMarker) {
                    movingMarker.bindPopup(`🎯 Tiba di ${waypoints[waypoints.length - 1].location}!`).openPopup();
                    // Hide transport icon after arrival
                    setTimeout(() => {
                        if (movingMarker) {
                            map.removeLayer(movingMarker);
                            movingMarker = null;
                        }
                    }, 2000); // Wait 2 seconds before hiding
                }
                return;
            }

            const start = waypoints[currentAnimationSegment];
            const end = waypoints[currentAnimationSegment + 1];
            const transport = start.transport_to_next || 'mobil';

            updateStatus(`🚀 Segmen ${currentAnimationSegment + 1}/${waypoints.length - 1}: ${start.location} → ${end.location} (${transportIcons[transport]})`);

            // Create moving marker
            const emoji = transportIcons[transport] || '🚗';
            const transportIconHtml = L.divIcon({
                html: `<div style="font-size: 32px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${emoji}</div>`,
                className: 'custom-marker',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            });

            if (!movingMarker) {
                movingMarker = L.marker([start.lat, start.lng], {
                    icon: transportIconHtml
                }).addTo(map);
            } else {
                movingMarker.setIcon(transportIconHtml);
                movingMarker.setLatLng([start.lat, start.lng]);
            }

            // Animate
            const duration = 3000; // 3 seconds per segment
            const startTime = Date.now();

            function animate() {
                if (!animationInProgress) return; // Stop if animation was cancelled

                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);

                const lat = start.lat + (end.lat - start.lat) * progress;
                const lng = start.lng + (end.lng - start.lng) * progress;

                movingMarker.setLatLng([lat, lng]);

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    currentAnimationSegment++;
                    setTimeout(() => animateSegment(), 500);
                }
            }

            animate();
        }

        animateSegment();
    }

    // Event listeners
    // Map click handler - add waypoint on click (Super Admin only)
    if (isSuperAdmin) {
        map.on('click', function(e) {
            console.log('Map clicked at:', e.latlng);
            const waypointNum = waypoints.length + 1;
            const locationName = `Waypoint ${waypointNum}`;
            addWaypointHere(e.latlng.lat, e.latlng.lng, locationName);
        });
    }

    // Animation button (Super Admin only)
    if (isSuperAdmin && document.getElementById('startAnimationBtn')) {
        document.getElementById('startAnimationBtn').addEventListener('click', function() {
            if (waypoints.length < 2) {
                alert('⚠️ Tambahkan minimal 2 waypoint terlebih dahulu!');
                return;
            }
            if (animationInProgress) {
                alert('⚠️ Animasi sedang berjalan!');
                return;
            }
            startMultiWaypointAnimation();
        });
    }

    // Clear button (Super Admin only)
    if (isSuperAdmin && document.getElementById('clearWaypoints')) {
        document.getElementById('clearWaypoints').addEventListener('click', clearWaypoints);
    }

    // Clear map button (Super Admin only)
    if (isSuperAdmin && document.getElementById('clearMapBtn')) {
        document.getElementById('clearMapBtn').addEventListener('click', function() {
            if (confirm('🗑️ Hapus semua marker dan rute dari peta?')) {
                clearWaypoints();
                if (movingMarker) {
                    map.removeLayer(movingMarker);
                    movingMarker = null;
                }
                animationInProgress = false;
                updateStatus('🗑️ Peta dibersihkan. Klik peta untuk menambah waypoint.');
            }
        });
    }

    // Save route button (Super Admin only)
    if (isSuperAdmin && document.getElementById('saveRouteBtn')) {
        document.getElementById('saveRouteBtn').addEventListener('click', function() {
        if (waypoints.length < 2) {
            alert('⚠️ Tambahkan minimal 2 waypoint untuk menyimpan rute!');
            return;
        }

        const routeName = prompt('📝 Nama rute:', `Rute ${waypoints.length} Titik`);
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
            color: '#667eea',
            description: `Multi-waypoint route dengan ${waypoints.length} titik`
        };

        // Show loading status
        updateStatus('💾 Menyimpan rute...');

        fetch('/api/transportation-routes', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(routeData)
            })
            .then(response => {
                console.log('Save response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Save response data:', data);
                if (data.success) {
                    alert('💾 Rute berhasil disimpan!');
                    updateStatus('💾 Rute tersimpan! Klik peta untuk membuat rute baru.');

                    // Clear waypoints after saving so user can create new route
                    clearWaypoints();

                    // Reload saved routes to show the new one
                    loadSavedRoutes();
                } else {
                    alert('❌ Gagal menyimpan rute: ' + (data.message || 'Unknown error'));
                    updateStatus('❌ Gagal menyimpan rute.');
                }
            })
            .catch(error => {
                console.error('Error saving route:', error);
                alert('❌ Terjadi kesalahan saat menyimpan rute!');
                updateStatus('❌ Error saat menyimpan rute.');
            });
        });
    }

    // Load saved routes function
    function loadSavedRoutes() {
        console.log('Loading saved routes...');

        fetch('/api/transportation-routes', {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Loaded routes:', data);
                savedRoutes = data || []; // Store routes globally
                displaySavedRoutes(data);

                // Auto-start animation after routes are loaded and displayed
                if (autoPlayEnabled && savedRoutes.length > 0) {
                    autoStartAnimation();
                }
            })
            .catch(error => {
                console.error('Error loading routes:', error);
                savedRoutes = []; // Clear global routes
                updateStatus('❌ Error loading saved routes.');
            });
    }

    // Display saved routes in the panel
    function displaySavedRoutes(routes) {
        const routesList = document.getElementById('savedRoutesList');

        // Clear existing route layers
        Object.values(savedRoutesLayers).forEach(layerGroup => {
            map.removeLayer(layerGroup);
        });
        savedRoutesLayers = {};

        // For read-only mode, just display routes on map without panel
        if (!isSuperAdmin) {
            if (routes && routes.length > 0) {
                displayRoutesOnMapOnly(routes);
            }
            return;
        }

        // Super admin mode - show panel
        if (!routesList) return;
        routesList.innerHTML = '';

        if (!routes || routes.length === 0) {
            routesList.innerHTML = '<p class="text-gray-500 text-sm">Belum ada rute tersimpan.</p>';
            return;
        }

        routes.forEach(route => {
            const routeItem = document.createElement('div');
            routeItem.className = 'bg-gray-50 p-3 rounded-lg mb-2 border border-gray-200';

            // Handle both simple and multi-waypoint routes
            let routeInfo = '';
            if (route.is_multi_segment && route.waypoints) {
                const waypoints = typeof route.waypoints === 'string' ? JSON.parse(route.waypoints) : route.waypoints;
                routeInfo = `📍 ${waypoints.length} waypoints: ${waypoints[0].location} → ${waypoints[waypoints.length - 1].location}`;

                // Create route layers for map display
                const layerGroup = L.layerGroup();

                // Add waypoint markers - small dots
                waypoints.forEach((wp, index) => {
                    const marker = L.marker([wp.lat, wp.lng], {
                        icon: L.divIcon({
                            html: `<div style="background: #3b82f6; border-radius: 50%; width: 6px; height: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.3);"></div>`,
                            className: 'custom-saved-waypoint-marker',
                            iconSize: [6, 6],
                            iconAnchor: [3, 3]
                        })
                    }).bindPopup(`<b>${wp.location}</b><br/>Waypoint ${index + 1}`);
                    layerGroup.addLayer(marker);
                });

                // Add route lines
                for (let i = 0; i < waypoints.length - 1; i++) {
                    const start = waypoints[i];
                    const end = waypoints[i + 1];
                    const transportType = start.transport_to_next || 'mobil';
                    const line = L.polyline([
                        [start.lat, start.lng],
                        [end.lat, end.lng]
                    ], {
                        color: getTransportColor(transportType),
                        weight: 3,
                        opacity: 0.7,
                        dashArray: '5, 5' // Garis putus-putus kecil
                    });
                    layerGroup.addLayer(line);
                }

                // Store layer group
                savedRoutesLayers[route.id] = layerGroup;

                // Show route if active
                if (route.is_active) {
                    layerGroup.addTo(map);
                }

            } else {
                routeInfo = `📍 ${route.start_location || 'Start'} → ${route.end_location || 'End'}`;

                // Handle simple routes if needed
                if (route.start_lat && route.start_lng && route.end_lat && route.end_lng) {
                    const layerGroup = L.layerGroup();

                    const startMarker = L.marker([route.start_lat, route.start_lng], {
                        icon: L.divIcon({
                            html: `<div style="background: #10b981; border-radius: 50%; width: 6px; height: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.3);"></div>`,
                            className: 'custom-start-marker',
                            iconSize: [6, 6],
                            iconAnchor: [3, 3]
                        })
                    }).bindPopup(`<b>${route.start_location || 'Start'}</b>`);
                    const endMarker = L.marker([route.end_lat, route.end_lng], {
                        icon: L.divIcon({
                            html: `<div style="background: #ef4444; border-radius: 50%; width: 6px; height: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.3);"></div>`,
                            className: 'custom-end-marker',
                            iconSize: [6, 6],
                            iconAnchor: [3, 3]
                        })
                    }).bindPopup(`<b>${route.end_location || 'End'}</b>`);

                    const line = L.polyline([
                        [route.start_lat, route.start_lng],
                        [route.end_lat, route.end_lng]
                    ], {
                        color: getTransportColor(route.transport_type || 'mobil'),
                        weight: 3,
                        opacity: 0.7,
                        dashArray: '5, 5' // Garis putus-putus kecil
                    });

                    layerGroup.addLayer(startMarker);
                    layerGroup.addLayer(endMarker);
                    layerGroup.addLayer(line);

                    savedRoutesLayers[route.id] = layerGroup;

                    if (route.is_active) {
                        layerGroup.addTo(map);
                    }
                }
            }

            routeItem.innerHTML = `
                <div class="flex justify-between items-start mb-2">
                    <h4 class="font-semibold text-gray-800 text-sm">${route.route_name || 'Unnamed Route'}</h4>
                    <div class="flex gap-1">
                        <button onclick="toggleRouteVisibility(${route.id})"
                            class="text-xs px-2 py-1 rounded ${route.is_active ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700'}"
                            title="${route.is_active ? 'Hide route' : 'Show route'}">
                            ${route.is_active ? '👁️' : '👁️‍🗨️'}
                        </button>
                        ${isSuperAdmin ? `
                            <button onclick="editRoute(${route.id})"
                                class="text-xs px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                                title="Edit route">
                                ✏️
                            </button>
                            <button onclick="deleteRoute(${route.id})"
                                class="text-xs px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                title="Delete route">
                                🗑️
                            </button>
                        ` : ''}
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-1">${routeInfo}</p>
                <p class="text-sm text-gray-600">
                    📏 ${route.distance_km || '0'} km
                    ${route.transport_type ? `• 🚗 ${route.transport_type}` : ''}
                </p>
                ${route.description ? `<p class="text-xs text-gray-500 mt-1">${route.description}</p>` : ''}
            `;

            routesList.appendChild(routeItem);
        });
    }

    // Update route button appearance
    function updateRouteButton(routeId, isActive) {
        const button = document.querySelector(`button[onclick="toggleRouteVisibility(${routeId})"]`);
        if (button) {
            button.className = `text-xs px-2 py-1 rounded ${isActive ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700'}`;
            button.title = isActive ? 'Hide route' : 'Show route';
            button.textContent = isActive ? '👁️' : '👁️‍🗨️';
        }
    }

    // Toggle route visibility
    window.toggleRouteVisibility = function(routeId) {
        fetch(`/api/transportation-routes/${routeId}/toggle`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Toggle the route layer on the map immediately
                    const layerGroup = savedRoutesLayers[routeId];
                    if (layerGroup) {
                        if (data.route.is_active) {
                            // Show the route
                            layerGroup.addTo(map);
                            updateStatus(`✅ Rute "${data.route.route_name}" ditampilkan.`);
                        } else {
                            // Hide the route
                            map.removeLayer(layerGroup);
                            updateStatus(`👁️‍🗨️ Rute "${data.route.route_name}" disembunyikan.`);
                        }
                    }

                    // Update the specific route in savedRoutes array
                    const routeIndex = savedRoutes.findIndex(route => route.id == routeId);
                    if (routeIndex !== -1) {
                        savedRoutes[routeIndex].is_active = data.route.is_active;
                    }

                    // Update only the button appearance without reloading entire list
                    updateRouteButton(routeId, data.route.is_active);
                } else {
                    alert('❌ Failed to toggle route visibility.');
                }
            })
            .catch(error => {
                console.error('Error toggling route:', error);
                alert('❌ Error toggling route visibility.');
            });
    };

    // Edit route function
    window.editRoute = function(routeId) {
        const route = savedRoutes.find(r => r.id == routeId);
        if (!route) {
            alert('❌ Rute tidak ditemukan.');
            return;
        }

        if (!route.is_multi_segment || !route.waypoints) {
            alert('⚠️ Hanya rute multi-waypoint yang dapat diedit.');
            return;
        }

        const waypoints = typeof route.waypoints === 'string' ? JSON.parse(route.waypoints) : route.waypoints;

        // Create edit modal
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center';
        modal.style.zIndex = '9999';
        modal.innerHTML = `
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 max-h-96 overflow-y-auto" style="z-index: 10000;">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">✏️ Edit Rute: ${route.route_name}</h3>
                    <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                </div>
                <div id="editWaypointsList">
                    ${waypoints.map((wp, index) => {
                        if (index === waypoints.length - 1) return ''; // Skip last waypoint (no transport_to_next)
                        return `
                            <div class="mb-3 p-3 border rounded-lg bg-gray-50">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium text-sm">${wp.location}</span>
                                    <span class="text-xs text-gray-500">→ ${waypoints[index + 1].location}</span>
                                </div>
                                <select class="w-full p-2 border rounded transport-select" data-index="${index}">
                                    <option value="pesawat" ${wp.transport_to_next === 'pesawat' ? 'selected' : ''}>✈️ Pesawat</option>
                                    <option value="kapal" ${wp.transport_to_next === 'kapal' ? 'selected' : ''}>🚢 Kapal</option>
                                    <option value="kereta" ${wp.transport_to_next === 'kereta' ? 'selected' : ''}>🚂 Kereta</option>
                                    <option value="mobil" ${wp.transport_to_next === 'mobil' ? 'selected' : ''}>🚗 Mobil</option>
                                    <option value="motor" ${wp.transport_to_next === 'motor' ? 'selected' : ''}>🏍️ Motor</option>
                                    <option value="truk" ${wp.transport_to_next === 'truk' ? 'selected' : ''}>🚚 Truk</option>
                                </select>
                            </div>
                        `;
                    }).join('')}
                </div>
                <div class="flex gap-2 mt-4">
                    <button onclick="saveRouteEdit(${routeId})" class="flex-1 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        💾 Simpan
                    </button>
                    <button onclick="closeEditModal()" class="flex-1 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                        ❌ Batal
                    </button>
                </div>
            </div>
        `;

        // Add click outside to close modal
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeEditModal();
            }
        });

        document.body.appendChild(modal);
        window.currentEditModal = modal;

        // Add escape key listener
        document.addEventListener('keydown', escapeKeyListener);
    };

    // Close edit modal
    window.closeEditModal = function() {
        if (window.currentEditModal) {
            document.body.removeChild(window.currentEditModal);
            window.currentEditModal = null;
            // Remove escape key listener
            document.removeEventListener('keydown', escapeKeyListener);
        }
    };

    // Escape key listener for modal
    function escapeKeyListener(e) {
        if (e.key === 'Escape' && window.currentEditModal) {
            closeEditModal();
        }
    }

    // Save route edit
    window.saveRouteEdit = function(routeId) {
        const route = savedRoutes.find(r => r.id == routeId);
        if (!route) {
            alert('❌ Rute tidak ditemukan.');
            return;
        }

        const waypoints = typeof route.waypoints === 'string' ? JSON.parse(route.waypoints) : route.waypoints;
        const transportSelects = document.querySelectorAll('.transport-select');

        // Update waypoints with new transport selections
        transportSelects.forEach(select => {
            const index = parseInt(select.dataset.index);
            waypoints[index].transport_to_next = select.value;
        });

        // Prepare update data
        const updateData = {
            route_name: route.route_name,
            waypoints: waypoints,
            is_multi_segment: true,
            distance_km: route.distance_km,
            description: route.description,
            color: route.color
        };

        // Show loading
        updateStatus('💾 Menyimpan perubahan rute...');

        // Send update request
        fetch(`/api/transportation-routes/${routeId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(updateData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateStatus('✅ Rute berhasil diperbarui!');
                    closeEditModal();
                    loadSavedRoutes(); // Reload routes to show updated data
                } else {
                    alert('❌ Gagal memperbarui rute: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error updating route:', error);
                alert('❌ Error memperbarui rute.');
                updateStatus('❌ Error memperbarui rute.');
            });
    };

    // Delete route
    window.deleteRoute = function(routeId) {
        if (!confirm('🗑️ Hapus rute ini? Tindakan tidak dapat dibatalkan.')) {
            return;
        }

        fetch(`/api/transportation-routes/${routeId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('🗑️ Rute berhasil dihapus!');
                    loadSavedRoutes(); // Reload to update display
                    updateStatus('Rute dihapus.');
                } else {
                    alert('❌ Gagal menghapus rute: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error deleting route:', error);
                alert('❌ Error menghapus rute.');
            });
    };

    // Refresh routes button (Super Admin only)
    if (isSuperAdmin && document.getElementById('refreshRoutesBtn')) {
        document.getElementById('refreshRoutesBtn').addEventListener('click', function() {
            updateStatus('🔄 Memuat rute tersimpan...');
            loadSavedRoutes();
        });
    }

    // Add new route button (Super Admin only)
    if (isSuperAdmin && document.getElementById('addNewRouteBtn')) {
        document.getElementById('addNewRouteBtn').addEventListener('click', function() {
            startNewRoute();
        });
    }

    // Animate all routes button (Super Admin only)
    if (isSuperAdmin && document.getElementById('animateAllRoutesBtn')) {
        document.getElementById('animateAllRoutesBtn').addEventListener('click', function() {
            animateAllRoutes();
        });
    }

    // Stop animation button (Super Admin only)
    if (isSuperAdmin && document.getElementById('stopAnimationBtn')) {
        document.getElementById('stopAnimationBtn').addEventListener('click', function() {
            clearAllAnimations();
            updateStatus('⏹️ Semua animasi dihentikan.');
        });
    }

    // Animation buttons for Read-Only Mode
    if (!isSuperAdmin) {
        // Animate all routes button (Read-Only Mode)
        if (document.getElementById('animateAllRoutesReadOnlyBtn')) {
            document.getElementById('animateAllRoutesReadOnlyBtn').addEventListener('click', function() {
                console.log('Starting animation for all routes in read-only mode');
                autoPlayEnabled = true; // Re-enable auto-play when manually started
                animateAllRoutes();
            });
        }

        // Stop animation button (Read-Only Mode)
        if (document.getElementById('stopAnimationReadOnlyBtn')) {
            document.getElementById('stopAnimationReadOnlyBtn').addEventListener('click', function() {
                console.log('Stopping all animations in read-only mode');
                clearAllAnimations(); // This will set autoPlayEnabled = false
            });
        }
    }

    // Start new route function
    function startNewRoute() {
        if (waypoints.length > 0) {
            if (confirm('🗑️ Hapus waypoint saat ini dan mulai rute baru?')) {
                clearWaypoints();
                updateStatus('✨ Siap membuat rute baru. Klik peta untuk menambah waypoint.');
            }
        } else {
            updateStatus('✨ Siap membuat rute baru. Klik peta untuk menambah waypoint.');
        }
    }

    // Global array to store all active moving markers
    let activeMovingMarkers = [];

    // Animate all routes function - PARALLEL VERSION
    function animateAllRoutes(isAutoPlay = false) {
        console.log('animateAllRoutes called, isAutoPlay:', isAutoPlay);
        console.log('savedRoutes:', savedRoutes);

        const activeRoutes = savedRoutes.filter(route => route.is_active);
        console.log('activeRoutes:', activeRoutes);

        if (activeRoutes.length === 0) {
            if (!isAutoPlay) {
                alert('⚠️ Tidak ada rute aktif untuk dianimasikan. Aktifkan rute terlebih dahulu.');
            }
            return;
        }

        // Skip confirmation for auto-play
        const shouldProceed = isAutoPlay || confirm(`🎬 Mulai animasi untuk ${activeRoutes.length} rute secara bersamaan?`);

        if (shouldProceed) {
            updateStatus(`🎬 Memulai animasi ${activeRoutes.length} rute bersamaan...`);

            // Clear any existing animations
            clearAllAnimations();
            allAnimationsCompleted = false;

            // Start all route animations in parallel
            let completedRoutes = 0;

            activeRoutes.forEach((route, index) => {
                console.log(`Starting parallel animation for route ${index + 1}:`, route);

                if (route.is_multi_segment && route.waypoints) {
                    const waypoints = typeof route.waypoints === 'string' ? JSON.parse(route.waypoints) : route.waypoints;
                    console.log(`Route ${index + 1} waypoints:`, waypoints);

                    // Start animation for this route
                    animateRouteWaypointsSmooth(waypoints, route.route_name, index, () => {
                        completedRoutes++;
                        console.log(`Route "${route.route_name}" completed. ${completedRoutes}/${activeRoutes.length} done.`);

                        if (completedRoutes === activeRoutes.length) {
                            updateStatus('✅ Semua animasi rute selesai!');
                            allAnimationsCompleted = true;

                            // Auto-restart animation if auto-play is enabled
                            if (autoPlayEnabled) {
                                console.log('All animations completed, restarting in 0.5 seconds...');
                                setTimeout(() => {
                                    if (autoPlayEnabled) {
                                        animateAllRoutes(true);
                                    }
                                }, 500); // Wait 0.5 seconds before restarting
                            }
                        }
                    });
                } else {
                    console.log(`Skipping non-multi-segment route: ${route.route_name}`);
                    completedRoutes++;
                    if (completedRoutes === activeRoutes.length) {
                        updateStatus('✅ Semua animasi rute selesai!');
                        allAnimationsCompleted = true;

                        // Auto-restart animation if auto-play is enabled
                        if (autoPlayEnabled) {
                            console.log('All animations completed, restarting in 0.5 seconds...');
                            setTimeout(() => {
                                if (autoPlayEnabled) {
                                    animateAllRoutes(true);
                                }
                            }, 500); // Wait 0.5 seconds before restarting
                        }
                    }
                }
            });
        }
    }

    // Clear all active animations
    function clearAllAnimations() {
        activeMovingMarkers.forEach(marker => {
            if (marker && map.hasLayer(marker)) {
                map.removeLayer(marker);
            }
        });
        activeMovingMarkers = [];

        // Clear single moving marker too
        if (movingMarker) {
            map.removeLayer(movingMarker);
            movingMarker = null;
        }

        // Stop auto-play when manually clearing animations
        autoPlayEnabled = false;
        allAnimationsCompleted = false;
    }

    // Animate route waypoints function
    function animateRouteWaypoints(routeWaypoints, onComplete) {
        console.log('animateRouteWaypoints called with:', routeWaypoints);

        if (routeWaypoints.length < 2) {
            console.log('Not enough waypoints for animation');
            if (onComplete) onComplete();
            return;
        }

        let segmentIndex = 0;

        function animateSegment() {
            if (segmentIndex >= routeWaypoints.length - 1) {
                console.log('Animation completed');
                if (onComplete) onComplete();
                return;
            }

            const start = routeWaypoints[segmentIndex];
            const end = routeWaypoints[segmentIndex + 1];
            const transport = start.transport_to_next || 'mobil';
            const icon = transportIcons[transport] || '🚗';

            console.log(`Animating segment ${segmentIndex}: ${start.location} -> ${end.location} (${transport})`);

            // Remove previous marker
            if (movingMarker) {
                map.removeLayer(movingMarker);
            }

            // Check if MovingMarker is available
            if (typeof L.Marker.movingMarker === 'function') {
                console.log('Using MovingMarker plugin');
                // Create moving marker
                movingMarker = L.Marker.movingMarker(
                    [[start.lat, start.lng], [end.lat, end.lng]],
                    [2000], // 2 seconds per segment
                    {
                        icon: L.divIcon({
                            html: `<div style="font-size: 24px; color: black; text-shadow: 1px 1px 2px rgba(255,255,255,0.8); filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${icon}</div>`,
                            className: 'custom-marker',
                            iconSize: [30, 30],
                            iconAnchor: [15, 15]
                        })
                    }
                ).addTo(map);

                movingMarker.start();

                movingMarker.on('end', function() {
                    segmentIndex++;
                    setTimeout(animateSegment, 500); // 0.5 second delay between segments
                });
            } else {
                console.log('MovingMarker not available, using fallback animation');
                // Fallback: simple marker movement
                movingMarker = L.marker([start.lat, start.lng], {
                    icon: L.divIcon({
                        html: `<div style="font-size: 24px; color: black; text-shadow: 1px 1px 2px rgba(255,255,255,0.8); filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${icon}</div>`,
                        className: 'custom-marker',
                        iconSize: [30, 30],
                        iconAnchor: [15, 15]
                    })
                }).addTo(map);

                // Simple animation: move marker to end position after delay
                setTimeout(() => {
                    movingMarker.setLatLng([end.lat, end.lng]);
                    segmentIndex++;
                    setTimeout(animateSegment, 1000); // 1 second delay between segments
                }, 1000);
            }
        }

        animateSegment();
    }

    // Custom smooth animation function for parallel routes
    function animateRouteWaypointsSmooth(routeWaypoints, routeName, routeIndex, onComplete) {
        console.log(`animateRouteWaypointsSmooth called for route "${routeName}":`, routeWaypoints);

        if (routeWaypoints.length < 2) {
            console.log(`Not enough waypoints for route "${routeName}"`);
            if (onComplete) onComplete();
            return;
        }

        // Get the primary transport type
        const transports = routeWaypoints.map(wp => wp.transport_to_next).filter(t => t);
        const primaryTransport = transports.length > 0 ? transports[0] : 'mobil';
        const icon = transportIcons[primaryTransport] || '🚗';

        // Create unique colors for each route
        const routeColors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8'];
        const routeColor = routeColors[routeIndex % routeColors.length];

        console.log(`Creating custom smooth animation for route "${routeName}"`);

        // Create marker
        const routeMarker = L.marker([routeWaypoints[0].lat, routeWaypoints[0].lng], {
            icon: L.divIcon({
                html: `<div style="font-size: 24px; color: black; text-shadow: 1px 1px 2px rgba(255,255,255,0.8); filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${icon}</div>`,
                className: 'custom-marker',
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            })
        }).addTo(map);

        activeMovingMarkers.push(routeMarker);

        // Custom smooth animation implementation
        let currentSegment = 0;

        function animateToNextWaypoint() {
            if (currentSegment >= routeWaypoints.length - 1) {
                console.log(`Custom animation completed for route "${routeName}"`);
                // Hide transport icon when animation is completed
                setTimeout(() => {
                    if (routeMarker) {
                        map.removeLayer(routeMarker);
                        // Remove from active markers array
                        const index = activeMovingMarkers.indexOf(routeMarker);
                        if (index > -1) {
                            activeMovingMarkers.splice(index, 1);
                        }
                    }
                }, 1000); // Wait 1 second before hiding
                if (onComplete) onComplete();
                return;
            }

            const startPoint = routeWaypoints[currentSegment];
            const endPoint = routeWaypoints[currentSegment + 1];

            console.log(`Animating segment ${currentSegment}: ${startPoint.location} -> ${endPoint.location}`);

            // Smooth interpolation animation
            const startLat = startPoint.lat;
            const startLng = startPoint.lng;
            const endLat = endPoint.lat;
            const endLng = endPoint.lng;

            const duration = 3000; // 3 seconds per segment
            const steps = 60; // 60 steps for smooth animation (50fps)
            const stepDuration = duration / steps;
            let currentStep = 0;

            function animateStep() {
                if (currentStep >= steps) {
                    // Segment completed, move to next
                    currentSegment++;
                    setTimeout(animateToNextWaypoint, 500); // 0.5 second pause between segments
                    return;
                }

                // Calculate interpolated position
                const progress = currentStep / steps;
                const currentLat = startLat + (endLat - startLat) * progress;
                const currentLng = startLng + (endLng - startLng) * progress;

                // Update marker position
                routeMarker.setLatLng([currentLat, currentLng]);

                currentStep++;
                setTimeout(animateStep, stepDuration);
            }

            // Start segment animation
            animateStep();
        }

        // Start the animation
        animateToNextWaypoint();
    }

    // Auto-start animation function
    function autoStartAnimation() {
        console.log('Auto-starting animation...');
        if (savedRoutes && savedRoutes.length > 0) {
            const activeRoutes = savedRoutes.filter(route => route.is_active);
            if (activeRoutes.length > 0) {
                console.log(`Auto-starting animation for ${activeRoutes.length} routes`);
                setTimeout(() => {
                    animateAllRoutes(true); // Start with auto-play enabled
                }, 1000); // Wait 1 second after routes are loaded
            } else {
                console.log('No active routes found for auto-start');
            }
        } else {
            console.log('No routes found for auto-start');
        }
    }

    // Initialize
    updateStatus('Mode Multi-Waypoint aktif. Klik peta untuk menambah waypoint.');
    console.log('Multi-waypoint mode initialized');

    // Load saved routes on startup
    loadSavedRoutes();
});
