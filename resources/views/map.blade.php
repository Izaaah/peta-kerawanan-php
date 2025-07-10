<div id="map" style="height: 600px;"></div>

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
                              '#D9F0A3'; // hijau muda untuk nol kasus
    }
</script>
