// Fungsi untuk memuat komponen dari file HTML
async function loadComponent(id, file, callback) {
  try {
    const res = await fetch(file);
    const html = await res.text();
    document.getElementById(id).innerHTML = html;
    if (callback) callback(); // callback untuk peta
  } catch (err) {
    console.error("Gagal memuat:", file, err);
  }
}

// Load komponen
loadComponent("header", "header.html");
loadComponent("hero", "hero.html");
loadComponent("statistik", "statistik.html");
loadComponent("tentang", "tentang.html");
loadComponent("footer", "footer.html");

// Peta - pakai callback agar dijalankan setelah div dimuat
loadComponent("peta", "peta.html", initMap);

// Fungsi inisialisasi peta setelah elemen ada
function initMap() {
  // Load Leaflet JS dulu
  const leafletScript = document.createElement("script");
  leafletScript.src = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.js";
  leafletScript.integrity = "sha256-p8FhJbL3Tff++h67ucn5C8IvS+gYvgrvSCtqfMIk0iE=";
  leafletScript.crossOrigin = "";
  leafletScript.onload = () => {
    const map = L.map("map").setView([-7.250445, 112.768845], 8);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a>',
    }).addTo(map);

    L.marker([-7.257472, 112.752090])
      .addTo(map)
      .bindPopup("Surabaya<br>Zona Rawan")
      .openPopup();
  };
  document.body.appendChild(leafletScript);
}
