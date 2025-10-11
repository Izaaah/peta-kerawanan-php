        <script>
            // Data dari controller
            const kasusPerKabupaten = @json($kasusPerKabupaten);
            const kasusPerKecamatan = @json($kasusPerKecamatan);
            const trendBulanan = @json($trendBulanan);
            const statusPie = @json($statusPie);
            const residivisPie = @json($residivisPie);
            const jenisKelaminStats = @json($jenisKelaminStats);
            const umurStats = @json($umurStats);
            const anggaranStats = @json($anggaranStats);
            const anggaranPie = @json($anggaranPie);
            const kegiatanPie = @json($kegiatanPie);
            const kasusPerKabupatenNik = @json($kasusPerKabupatenNik);
            const kasusPerKecamatanNik = @json($kasusPerKecamatanNik);

            // Gallery data
            const gallery = @json($galeri ?? []);

            // Initialize everything when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM Content Loaded - Initializing dashboard...');

                // Use setTimeout to ensure all included content is fully rendered
                setTimeout(function() {
                    initializeCharts();
                    initializeModalListeners();
                    initializeTabs();
                    if (gallery.length > 0) {
                        initializeGallery();
                        startAutoRotation();
                    }
                    initializeAnggaranModal();
                    initializePhotoModal();
                    initializeNewsModal();
                    initializePegawaiModal();
                    initializeTupoksiModals();
                    console.log('Dashboard initialization complete!');
                }, 100);
            });

            function initializeCharts() {
                console.log('Initializing charts...');
                // Grafik Kasus per Kabupaten
                const ctxKabupaten = document.getElementById('chartKabupaten');
                if (!ctxKabupaten) {
                    console.error('Canvas chartKabupaten tidak ditemukan!');
                    return;
                }
                new Chart(ctxKabupaten, {
                    type: 'bar',
                    data: {
                        labels: kasusPerKabupaten.map(item => item.kabupaten),
                        datasets: [{
                            label: 'Jumlah Kasus',
                            data: kasusPerKabupaten.map(item => item.total),
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Grafik Kasus per Kecamatan
                const ctxKecamatan = document.getElementById('chartKecamatan');
                if (!ctxKecamatan) return;
                new Chart(ctxKecamatan, {
                    type: 'bar',
                    data: {
                        labels: kasusPerKecamatan.map(item => item.kecamatan),
                        datasets: [{
                            label: 'Jumlah Kasus',
                            data: kasusPerKecamatan.map(item => item.total),
                            backgroundColor: 'rgba(16, 185, 129, 0.8)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Grafik Trend Bulanan
                const bulanNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
                const trendData = new Array(12).fill(0);
                trendBulanan.forEach(item => {
                    trendData[item.bulan - 1] = item.total;
                });

                const ctxTrend = document.getElementById('chartTrend');
                if (!ctxTrend) return;
                new Chart(ctxTrend, {
                    type: 'line',
                    data: {
                        labels: bulanNames,
                        datasets: [{
                            label: 'Kasus per Bulan',
                            data: trendData,
                            borderColor: 'rgba(245, 158, 11, 1)',
                            backgroundColor: 'rgba(245, 158, 11, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Pie Chart Status Individu
                const ctxStatusPie = document.getElementById('chartStatusPie');
                if (!ctxStatusPie) return;
                new Chart(ctxStatusPie, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(statusPie),
                        datasets: [{
                            data: Object.values(statusPie),
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.8)', // Napi
                                'rgba(16, 185, 129, 0.8)' // Non napi
                            ],
                            borderColor: [
                                'rgba(59, 130, 246, 1)',
                                'rgba(16, 185, 129, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Pie Chart Residivis Individu
                const ctxResidivisPie = document.getElementById('chartResidivisPie');
                if (!ctxResidivisPie) return;
                new Chart(ctxResidivisPie, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(residivisPie),
                        datasets: [{
                            data: Object.values(residivisPie),
                            backgroundColor: [
                                'rgba(239, 68, 68, 0.8)', // Residivis
                                'rgba(245, 158, 11, 0.8)' // Non Residivis
                            ],
                            borderColor: [
                                'rgba(239, 68, 68, 1)',
                                'rgba(245, 158, 11, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Pie Chart Jenis Kelamin
                const ctxJenisKelaminPie = document.getElementById('chartJenisKelaminPie');
                if (!ctxJenisKelaminPie) return;
                new Chart(ctxJenisKelaminPie, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(jenisKelaminStats),
                        datasets: [{
                            data: Object.values(jenisKelaminStats),
                            backgroundColor: [
                                'rgba(147, 51, 234, 0.8)', // Laki-laki - Purple
                                'rgba(236, 72, 153, 0.8)' // Perempuan - Pink
                            ],
                            borderColor: [
                                'rgba(147, 51, 234, 1)',
                                'rgba(236, 72, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Pie Chart Kategori Umur
                const ctxUmurPie = document.getElementById('chartUmurPie');
                if (!ctxUmurPie) return;
                new Chart(ctxUmurPie, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(umurStats),
                        datasets: [{
                            data: Object.values(umurStats),
                            backgroundColor: [
                                'rgba(249, 115, 22, 0.8)', // Anak-anak - Orange
                                'rgba(99, 102, 241, 0.8)' // Dewasa - Indigo
                            ],
                            borderColor: [
                                'rgba(249, 115, 22, 1)',
                                'rgba(99, 102, 241, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Grafik Kasus per Kecamatan NIK
                const ctxKecamatanNik = document.getElementById('chartKecamatanNik');
                if (!ctxKecamatanNik) return;
                new Chart(ctxKecamatanNik, {
                    type: 'bar',
                    data: {
                        labels: kasusPerKecamatanNik.map(item => item.kecamatan),
                        datasets: [{
                            label: 'Jumlah Kasus',
                            data: kasusPerKecamatanNik.map(item => item.total),
                            backgroundColor: 'rgba(16, 185, 129, 0.8)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Grafik Kasus per Kabupaten NIK
                const ctxKabupatenNik = document.getElementById('chartKabupatenNik');
                if (!ctxKabupatenNik) return;
                new Chart(ctxKabupatenNik, {
                    type: 'bar',
                    data: {
                        labels: kasusPerKabupatenNik.map(item => item.kabupaten),
                        datasets: [{
                            label: 'Jumlah Kasus',
                            data: kasusPerKabupatenNik.map(item => item.total),
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            } // End of initializeCharts()

            function initializeModalListeners() {
                // Modal dan Tabel Desa/Kecamatan
                const showAllKabupatenBtn = document.getElementById('showAllKabupatenBtn');
                const showAllKecamatanBtn = document.getElementById('showAllKecamatanBtn');
                const allKabupatenModal = document.getElementById('allKabupatenModal');
                const allKecamatanModal = document.getElementById('allKecamatanModal');
                const closeKabupatenModal = document.getElementById('closeKabupatenModal');
                const closeKecamatanModal = document.getElementById('closeKecamatanModal');
                const allKabupatenTableBody = document.getElementById('allKabupatenTableBody');
                const allKecamatanTableBody = document.getElementById('allKecamatanTableBody');

                // Modal dan Tabel Desa/Kecamatan NIK
                const showAllKabupatenBtnNik = document.getElementById('showAllKabupatenBtnNik');
                const showAllKecamatanBtnNik = document.getElementById('showAllKecamatanBtnNik');
                const allKabupatenModalNik = document.getElementById('allKabupatenModalNik');
                const allKecamatanModalNik = document.getElementById('allKecamatanModalNik');
                const closeKabupatenModalNik = document.getElementById('closeKabupatenModalNik');
                const closeKecamatanModalNik = document.getElementById('closeKecamatanModalNik');
                const allKabupatenTableBodyNik = document.getElementById('allKabupatenTableBodyNik');
                const allKecamatanTableBodyNik = document.getElementById('allKecamatanTableBodyNik');

                // Fungsi untuk menampilkan modal desa
                if (showAllKabupatenBtn) {
                    showAllKabupatenBtn.addEventListener('click', function() {
                        // Urutkan data Kabupaten berdasarkan jumlah kasus (dari tertinggi ke terendah)
                        const sortedKabupaten = [...kasusPerKabupaten].sort((a, b) => b.total - a.total);

                        // Bersihkan tabel
                        allKabupatenTableBody.innerHTML = '';

                        // Isi tabel dengan semua data Kabupaten
                        sortedKabupaten.forEach((item, index) => {
                            const row = document.createElement('tr');
                            row.className = index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                            row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.kabupaten}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-semibold">${item.total}</td>
        `;
                            allKabupatenTableBody.appendChild(row);
                        });

                        // Tampilkan modal
                        allKabupatenModal.classList.add('hidden');
                        //document.body.classList.add('overflow-hidden');
                    });
                }

                // Fungsi untuk menampilkan modal kecamatan
                if (showAllKecamatanBtn) {
                    showAllKecamatanBtn.addEventListener('click', function() {
                        // Urutkan data kecamatan berdasarkan jumlah kasus (dari tertinggi ke terendah)
                        const sortedKecamatan = [...kasusPerKecamatan].sort((a, b) => b.total - a.total);

                        // Bersihkan tabel
                        allKecamatanTableBody.innerHTML = '';

                        // Isi tabel dengan semua data kecamatan
                        sortedKecamatan.forEach((item, index) => {
                            const row = document.createElement('tr');
                            row.className = index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                            row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.kecamatan}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.kabupaten}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">${item.total}</td>
        `;
                            allKecamatanTableBody.appendChild(row);
                        });

                        // Tampilkan modal
                        allKecamatanModal.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    });
                }

                // Tutup modal desa
                if (closeKabupatenModal) {
                    closeKabupatenModal.addEventListener('click', function() {
                        allKabupatenModal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    });
                }

                // Tutup modal kecamatan
                if (closeKecamatanModal) {
                    closeKecamatanModal.addEventListener('click', function() {
                        allKecamatanModal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    });
                }

                // Tutup modal saat klik di luar modal
                if (allKabupatenModal) {
                    allKabupatenModal.addEventListener('click', function(e) {
                        if (e.target === allKabupatenModal) {
                            allKabupatenModal.classList.add('hidden');
                            document.body.classList.remove('overflow-hidden');
                        }
                    });
                }

                if (allKecamatanModal) {
                    allKecamatanModal.addEventListener('click', function(e) {
                        if (e.target === allKecamatanModal) {
                            allKecamatanModal.classList.add('hidden');
                            document.body.classList.remove('overflow-hidden');
                        }
                    });
                }
            } // End of initializeModalListeners()

            // Gallery Auto-Rotation JavaScript
            let activeIndex = 0;
            let autoRotateInterval;
            let countdownInterval;
            let currentCountdown = 10;

            function initializeGallery() {
                updateGallery();
                setupGalleryControls();
            }

            function updateGallery() {
                if (gallery.length === 0) return;

                const currentImage = gallery[activeIndex];
                const prevIndex = activeIndex === 0 ? gallery.length - 1 : activeIndex - 1;
                const nextIndex = activeIndex === gallery.length - 1 ? 0 : activeIndex + 1;

                // Update main image
                const galleryImage = document.getElementById('galleryImage');
                const imageDescription = document.getElementById('imageDescription');
                if (galleryImage) {
                    galleryImage.src = `{{ asset('storage/') }}/${currentImage.image_path}`;
                }
                if (imageDescription) {
                    imageDescription.innerHTML =
                        `<div class="font-semibold">${currentImage.description || 'No Description'}</div>`;
                }

                // Update previous image
                const prevImage = document.getElementById('prevImage');
                if (prevImage) {
                    prevImage.src = `{{ asset('storage/') }}/${gallery[prevIndex].image_path}`;
                }

                // Update next image
                const nextImage = document.getElementById('nextImage');
                if (nextImage) {
                    nextImage.src = `{{ asset('storage/') }}/${gallery[nextIndex].image_path}`;
                }

                // Update dots
                updateDots();
            }

            function updateDots() {
                const dots = document.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    if (index === activeIndex) {
                        dot.classList.add('bg-blue-600', 'scale-125');
                        dot.classList.remove('bg-gray-300');
                    } else {
                        dot.classList.remove('bg-blue-600', 'scale-125');
                        dot.classList.add('bg-gray-300');
                    }
                });
            }

            function setupGalleryControls() {
                // Previous button
                const prevBtn = document.getElementById('prevBtn');
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        activeIndex = activeIndex === 0 ? gallery.length - 1 : activeIndex - 1;
                        updateGallery();
                        resetTimer();
                    });
                }

                // Next button
                const nextBtn = document.getElementById('nextBtn');
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        activeIndex = activeIndex === gallery.length - 1 ? 0 : activeIndex + 1;
                        updateGallery();
                        resetTimer();
                    });
                }

                // Dot navigation
                const dots = document.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        activeIndex = index;
                        updateGallery();
                        resetTimer();
                    });
                });
            }

            function startAutoRotation() {
                if (gallery.length <= 1) return;

                resetTimer();
                autoRotateInterval = setInterval(() => {
                    activeIndex = activeIndex === gallery.length - 1 ? 0 : activeIndex + 1;
                    updateGallery();
                    resetTimer();
                }, 10000); // 10 seconds
            }

            function resetTimer() {
                clearInterval(countdownInterval);
                currentCountdown = 10;
                updateTimerDisplay();

                countdownInterval = setInterval(() => {
                    currentCountdown--;
                    updateTimerDisplay();
                    if (currentCountdown <= 0) {
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }

            function updateTimerDisplay() {
                const timerElement = document.getElementById('timer');
                if (timerElement) {
                    timerElement.textContent = currentCountdown;
                }
            }

            function stopAutoRotation() {
                clearInterval(autoRotateInterval);
                clearInterval(countdownInterval);
            }

            // Pause auto-rotation on hover
            const gallerySection = document.getElementById('gallery-section');
            if (gallerySection) {
                gallerySection.addEventListener('mouseenter', stopAutoRotation);
                gallerySection.addEventListener('mouseleave', startAutoRotation);
            }

            // JavaScript untuk toggle konten dashboard
            function initializeTabs() {
                const statistikTab = document.getElementById('statistikTab');
                const anggaranTab = document.getElementById('anggaranTab');
                const profilTab = document.getElementById('profilTab');
                const statistikContent = document.getElementById('statistikContent');
                const anggaranContent = document.getElementById('anggaranContent');
                const profilContent = document.getElementById('profilContent');

                // Check if all required elements exist
                if (!statistikTab || !anggaranTab || !profilTab || !statistikContent || !anggaranContent || !profilContent) {
                    console.error('Tab elements tidak ditemukan!');
                    return;
                }

                // Default tampilkan statistik
                statistikContent.classList.remove('hidden');
                anggaranContent.classList.add('hidden');
                profilContent.classList.add('hidden');

                // Function to reset all tabs
                function resetTabs() {
                    // Remove active classes
                    statistikTab.classList.remove('active');
                    anggaranTab.classList.remove('active');
                    profilTab.classList.remove('active');

                    // Add inactive classes
                    statistikTab.classList.add('inactive');
                    anggaranTab.classList.add('inactive');
                    profilTab.classList.add('inactive');

                    // Hide all content
                    statistikContent.classList.add('hidden');
                    anggaranContent.classList.add('hidden');
                    profilContent.classList.add('hidden');

                    // Reset colors to gray
                    document.querySelectorAll('.tab-button svg').forEach(svg => {
                        svg.classList.remove('text-blue-600');
                        svg.classList.add('text-gray-500');
                    });
                    document.querySelectorAll('.tab-button span').forEach(span => {
                        span.classList.remove('text-blue-600');
                        span.classList.add('text-gray-700');
                    });
                }

                // Animasi untuk struktur organisasi
                function animateOrgChart() {
                    if (profilContent.classList.contains('hidden')) return;

                    const orgBoxes = document.querySelectorAll('.org-box');
                    orgBoxes.forEach((box, index) => {
                        setTimeout(() => {
                            box.style.opacity = '1';
                            box.style.transform = 'translateY(0)';
                        }, 100 * index);
                    });
                }

                // Set initial state for org chart boxes
                const orgBoxes = document.querySelectorAll('.org-box');
                orgBoxes.forEach(box => {
                    box.style.opacity = '0';
                    box.style.transform = 'translateY(20px)';
                    box.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                });

                // Event listener untuk pilihan Statistik
                statistikTab.addEventListener('click', function() {
                    resetTabs();
                    statistikContent.classList.remove('hidden');
                    statistikTab.classList.remove('inactive');
                    statistikTab.classList.add('active');
                    statistikTab.querySelector('svg').classList.remove('text-gray-500');
                    statistikTab.querySelector('svg').classList.add('text-blue-600');
                    statistikTab.querySelector('span').classList.remove('text-gray-700');
                    statistikTab.querySelector('span').classList.add('text-blue-600');
                });

                // Event listener untuk pilihan Anggaran
                anggaranTab.addEventListener('click', function() {
                    resetTabs();
                    anggaranContent.classList.remove('hidden');
                    anggaranTab.classList.remove('inactive');
                    anggaranTab.classList.add('active');
                    anggaranTab.querySelector('svg').classList.remove('text-gray-500');
                    anggaranTab.querySelector('svg').classList.add('text-blue-600');
                    anggaranTab.querySelector('span').classList.remove('text-gray-700');
                    anggaranTab.querySelector('span').classList.add('text-blue-600');

                    // Initialize budget charts when tab is opened
                    initializeBudgetCharts();
                });

                // Event listener untuk pilihan Profil Organisasi
                profilTab.addEventListener('click', function() {
                    resetTabs();
                    profilContent.classList.remove('hidden');
                    profilTab.classList.remove('inactive');
                    profilTab.classList.add('active');
                    profilTab.querySelector('svg').classList.remove('text-gray-500');
                    profilTab.querySelector('svg').classList.add('text-blue-600');
                    profilTab.querySelector('span').classList.remove('text-gray-700');
                    profilTab.querySelector('span').classList.add('text-blue-600');

                    // Aktifkan animasi struktur organisasi
                    setTimeout(animateOrgChart, 300);
                });

                // Initialize budget charts
                function initializeBudgetCharts() {
                    // Chart Anggaran per Program
                    const ctxAnggaran = document.getElementById('chartAnggaran');
                    if (ctxAnggaran) {
                        const ctx = ctxAnggaran.getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Pencegahan', 'Pemberantasan', 'Rehabilitasi', 'Diklat', 'Kerjasama',
                                    'Operasional'
                                ],
                                datasets: [{
                                    label: 'Anggaran (Miliar)',
                                    data: [2.5, 3.2, 4.8, 1.8, 0.9, 1.9],
                                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Realisasi (Miliar)',
                                    data: [1.8, 2.1, 2.4, 1.62, 0.27, 0.52],
                                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                    borderColor: 'rgba(16, 185, 129, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Jumlah (Miliar Rupiah)'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    }

                    // Chart Trend Anggaran Bulanan
                    const ctxTrendAnggaran = document.getElementById('chartTrendAnggaran');
                    if (ctxTrendAnggaran) {
                        const ctx = ctxTrendAnggaran.getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt',
                                    'Nov', 'Des'
                                ],
                                datasets: [{
                                    label: 'Realisasi Kumulatif (%)',
                                    data: [5, 12, 18, 28, 35, 42, 48, 52, 55, 57, 57, 57],
                                    borderColor: 'rgba(245, 158, 11, 1)',
                                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                    tension: 0.4,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 100,
                                        title: {
                                            display: true,
                                            text: 'Persentase Realisasi (%)'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    }

                    // Pie Chart Distribusi Anggaran (3D style seperti gambar)
                    const ctxAnggaranPie = document.getElementById('chartAnggaranPie');
                    if (ctxAnggaranPie) {
                        const ctx = ctxAnggaranPie.getContext('2d');

                        // Generate colors untuk setiap kegiatan (sebelum/setelah blokir)
                        const labels = Object.keys(anggaranPie);
                        const colors = [];
                        const borderColors = [];

                        for (let i = 0; i < labels.length; i++) {
                            if (labels[i].includes('Sebelum Blokir')) {
                                colors.push('rgba(239, 68, 68, 0.8)'); // Red untuk "Sebelum Blokir"
                                borderColors.push('rgba(239, 68, 68, 1)');
                            } else if (labels[i].includes('Setelah Blokir')) {
                                colors.push('rgba(34, 197, 94, 0.8)'); // Green untuk "Setelah Blokir"
                                borderColors.push('rgba(34, 197, 94, 1)');
                            } else {
                                // Fallback colors untuk item lainnya
                                const fallbackColors = [
                                    'rgba(59, 130, 246, 0.8)', // Blue
                                    'rgba(168, 85, 247, 0.8)', // Purple
                                    'rgba(245, 158, 11, 0.8)', // Yellow
                                    'rgba(236, 72, 153, 0.8)', // Pink
                                    'rgba(14, 165, 233, 0.8)', // Sky Blue
                                    'rgba(16, 185, 129, 0.8)' // Emerald
                                ];
                                const fallbackBorders = [
                                    'rgba(59, 130, 246, 1)',
                                    'rgba(168, 85, 247, 1)',
                                    'rgba(245, 158, 11, 1)',
                                    'rgba(236, 72, 153, 1)',
                                    'rgba(14, 165, 233, 1)',
                                    'rgba(16, 185, 129, 1)'
                                ];
                                const colorIndex = i % fallbackColors.length;
                                colors.push(fallbackColors[colorIndex]);
                                borderColors.push(fallbackBorders[colorIndex]);
                            }
                        }

                        new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: Object.keys(anggaranPie),
                                datasets: [{
                                    data: Object.values(anggaranPie),
                                    backgroundColor: colors,
                                    borderColor: borderColors,
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 10,
                                            boxWidth: 12,
                                            fontSize: 11,
                                            generateLabels: function(chart) {
                                                const data = chart.data;
                                                const total = data.datasets[0].data.reduce((a, b) => a + b, 0);

                                                return data.labels.map((label, index) => {
                                                    const value = data.datasets[0].data[index];
                                                    const percentage = ((value / total) * 100).toFixed(1);
                                                    return {
                                                        text: label + ': ' + percentage + '%',
                                                        fillStyle: data.datasets[0].backgroundColor[index],
                                                        strokeStyle: data.datasets[0].borderColor[index],
                                                        lineWidth: 2,
                                                        pointStyle: 'circle'
                                                    };
                                                });
                                            }
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const value = context.parsed;
                                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                const percentage = ((value / total) * 100).toFixed(1);
                                                return context.label + ': ' + percentage + '%';
                                            }
                                        }
                                    }
                                },
                                // Efek 3D dengan shadow
                                elements: {
                                    arc: {
                                        borderWidth: 2,
                                        borderColor: '#fff'
                                    }
                                }
                            }
                        });
                    }
                }
            }

            // Functions for switching to data detail tabs
            function switchToDataKabupatenTab() {
                hideAllTabs();
                showDataTab('dataKabupatenTab', 'dataKabupatenContent');
            }

            function switchToDataKecamatanTab() {
                hideAllTabs();
                showDataTab('dataKecamatanTab', 'dataKecamatanContent');
            }

            function switchToDataKabupatenNikTab() {
                hideAllTabs();
                showDataTab('dataKabupatenNikTab', 'dataKabupatenNikContent');
            }

            function switchToDataKecamatanNikTab() {
                hideAllTabs();
                showDataTab('dataKecamatanNikTab', 'dataKecamatanNikContent');
            }

            function switchToStatistikTab() {
                hideAllTabs();
                showMainTab('statistikTab', 'statistikContent');
            }

            function hideAllTabs() {
                // Hide all content
                const allContents = document.querySelectorAll('.dashboard-content');
                allContents.forEach(content => content.classList.add('hidden'));

                // Hide all data tabs
                const dataTabs = ['dataKabupatenTab', 'dataKecamatanTab', 'dataKabupatenNikTab', 'dataKecamatanNikTab'];
                dataTabs.forEach(tabId => {
                    const tab = document.getElementById(tabId);
                    if (tab) tab.classList.add('hidden');
                });

                // Reset all tab buttons to inactive
                const allTabButtons = document.querySelectorAll('.tab-button');
                allTabButtons.forEach(button => {
                    button.classList.remove('active');
                    button.classList.add('inactive');
                    const svg = button.querySelector('svg');
                    const span = button.querySelector('span');
                    if (svg) {
                        svg.classList.remove('text-blue-600');
                        svg.classList.add('text-gray-500');
                    }
                    if (span) {
                        span.classList.remove('text-blue-600');
                        span.classList.add('text-gray-700');
                    }
                });
            }

            function showDataTab(tabId, contentId) {
                const tab = document.getElementById(tabId);
                const content = document.getElementById(contentId);

                if (tab && content) {
                    // Show the tab and content
                    tab.classList.remove('hidden', 'inactive');
                    tab.classList.add('active');
                    content.classList.remove('hidden');

                    // Update tab styling
                    const svg = tab.querySelector('svg');
                    const span = tab.querySelector('span');
                    if (svg) {
                        svg.classList.remove('text-gray-500');
                        svg.classList.add('text-blue-600');
                    }
                    if (span) {
                        span.classList.remove('text-gray-700');
                        span.classList.add('text-blue-600');
                    }
                }
            }

            function showMainTab(tabId, contentId) {
                const tab = document.getElementById(tabId);
                const content = document.getElementById(contentId);

                if (tab && content) {
                    // Show main tabs
                    const mainTabs = ['statistikTab', 'anggaranTab', 'profilTab'];
                    mainTabs.forEach(mainTabId => {
                        const mainTab = document.getElementById(mainTabId);
                        if (mainTab) mainTab.classList.remove('hidden');
                    });

                    // Show the content
                    content.classList.remove('hidden');

                    // Update tab styling
                    tab.classList.remove('inactive');
                    tab.classList.add('active');
                    const svg = tab.querySelector('svg');
                    const span = tab.querySelector('span');
                    if (svg) {
                        svg.classList.remove('text-gray-500');
                        svg.classList.add('text-blue-600');
                    }
                    if (span) {
                        span.classList.remove('text-gray-700');
                        span.classList.add('text-blue-600');
                    }
                }
            }

            function initializeAnggaranModal() {
                // Ambil elemen-elemen modal
                const openModalBtn = document.getElementById('openModalBtn');
                const modal = document.getElementById('tambahAnggaranModal');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const cancelModalBtn = document.getElementById('cancelModalBtn');

                if (!modal) {
                    console.log('Modal anggaran tidak ditemukan');
                    return;
                }

                // Fungsi untuk membuka modal
                const openModal = () => {
                    modal.classList.remove('hidden');
                };

                // Fungsi untuk menutup modal
                const closeModal = () => {
                    modal.classList.add('hidden');
                };

                // Event listener untuk tombol "Tambah Anggaran"
                if (openModalBtn) {
                    openModalBtn.addEventListener('click', (e) => {
                        e.preventDefault(); // Mencegah link default
                        openModal();
                    });
                }

                // Event listener untuk tombol close 'X' dan 'Batal'
                if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
                if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

                // Event listener untuk menutup modal saat mengklik di luar area modal
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            }

            // Function to toggle parent selection based on anggaran type
            function toggleParentSelection() {
                const tipeMain = document.getElementById('tipe_main');
                const tipeSub = document.getElementById('tipe_sub');
                const parentSelection = document.getElementById('parent_selection');
                const parentSelect = document.getElementById('parent_id');

                if (tipeSub.checked) {
                    parentSelection.classList.remove('hidden');
                    parentSelect.required = true;
                } else {
                    parentSelection.classList.add('hidden');
                    parentSelect.required = false;
                    parentSelect.value = '';
                }
            }

            // Function to handle anggaran modal (for edit)
            function tambahAnggaranModal(data) {
                const modal = document.getElementById('tambahAnggaranModal');
                const form = modal.querySelector('form');
                const title = modal.querySelector('h3');

                // Reset form
                form.reset();
                form.action = "{{ route('super-admin.anggaran.store') }}";
                title.textContent = 'Tambah Anggaran Baru';

                // Reset radio buttons
                document.getElementById('tipe_main').checked = true;
                document.getElementById('tipe_sub').checked = false;
                toggleParentSelection();

                // If editing existing anggaran
                if (data && data.id) {
                    title.textContent = 'Edit Anggaran';
                    form.action = `/super-admin/anggaran/${data.id}`;

                    // Add method override for PUT request
                    if (!form.querySelector('input[name="_method"]')) {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        form.appendChild(methodInput);
                    }

                    // Fetch anggaran data and populate form
                    fetch(`/super-admin/anggaran/${data.id}`)
                        .then(response => response.json())
                        .then(anggaran => {
                            document.getElementById('akun').value = anggaran.akun || '';
                            document.getElementById('kegiatan').value = anggaran.kegiatan || '';
                            document.getElementById('anggaran_sebelum').value = anggaran.anggaran_sebelum || '';
                            document.getElementById('blokir').value = anggaran.blokir || '';

                            // Set type based on is_main_activity
                            if (anggaran.is_main_activity) {
                                document.getElementById('tipe_main').checked = true;
                                document.getElementById('tipe_sub').checked = false;
                            } else {
                                document.getElementById('tipe_sub').checked = true;
                                document.getElementById('tipe_main').checked = false;
                                document.getElementById('parent_id').value = anggaran.parent_id || '';
                            }

                            toggleParentSelection();
                        })
                        .catch(error => {
                            console.error('Error fetching anggaran data:', error);
                        });
                }

                // Show modal
                modal.classList.remove('hidden');
            }

            function autoCalcKosong() {
                const j = document.getElementById('komposisi_dsp_jumlah');
                const t = document.getElementById('komposisi_dsp_terisi');
                const k = document.getElementById('komposisi_dsp_kosong');
                const calc = () => {
                    const total = parseInt(j.value || 0, 10);
                    const terisi = parseInt(t.value || 0, 10);
                    k.value = Math.max(0, total - terisi);
                };
                j.removeEventListener?.('__calc', j.__calc);
                t.removeEventListener?.('__calc', t.__calc);
                j.__calc = calc;
                t.__calc = calc;
                j.addEventListener('input', calc);
                t.addEventListener('input', calc);
                calc();
            }

            function openKomposisiModal(row = null) {
                const modal = document.getElementById('komposisiModal');
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('komposisiForm');
                const methodInput = document.getElementById('komposisiFormMethod');
                const title = document.getElementById('komposisiModalTitle');

                if (row && row.id) {
                    form.action = `{{ url('super-admin/komposisi') }}/${row.id}`;
                    methodInput.value = 'PUT';
                    title.textContent = 'Edit Komposisi';

                    document.getElementById('komposisi_bidang').value = row.bidang || '';
                    document.getElementById('komposisi_jumlah_personil').value = row.jumlah_personil ?? 0;
                    document.getElementById('komposisi_dsp_jumlah').value = row.dsp_jumlah ?? 0;
                    document.getElementById('komposisi_dsp_terisi').value = row.dsp_terisi ?? 0;
                    document.getElementById('komposisi_dsp_kosong').value = row.dsp_kosong ?? 0;
                    document.getElementById('komposisi_keterangan').value = row.keterangan || '';
                } else {
                    form.action = `{{ route('super-admin.komposisi.store') }}`;
                    methodInput.value = 'POST';
                    title.textContent = 'Tambah Komposisi';
                    form.reset();
                }

                autoCalcKosong();
            }

            // Function to open and populate the Anggaran modal (Edit)
            function openAnggaranModal(row = null) {
                const modal = document.getElementById('anggaranModal'); // Modal ID for Anggaran
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('anggaranForm'); // Form ID for Anggaran
                const methodInput = document.getElementById('anggaranFormMethod'); // Method input ID for Anggaran
                const title = document.getElementById('anggaranModalTitle'); // Modal title ID for Anggaran

                if (row && row.id) {
                    // If data exists, populate the form for editing
                    form.action =
                        `{{ url('super-admin/anggaran') }}/${row.id}`; // Update the URL for the specific Anggaran record
                    methodInput.value = 'PUT'; // Use PUT for editing existing data
                    title.textContent = 'Edit Anggaran'; // Set modal title to 'Edit Anggaran'

                    // Populate the form fields with the selected row data
                    document.getElementById('anggaran_akun').value = row.akun || '';
                    document.getElementById('anggaran_kegiatan').value = row.kegiatan || '';
                    document.getElementById('anggaran_sebelum').value = row.anggaran_sebelum ?? 0;
                    document.getElementById('anggaran_blokir').value = row.blokir ?? 0;
                    document.getElementById('anggaran_setelah').value = row.anggaran_sebelum - (row.blokir ?? 0);
                } else {
                    // If no data, prepare the form for creating a new entry
                    form.action = `{{ route('super-admin.anggaran.store') }}`; // Use POST for creating new data
                    methodInput.value = 'POST'; // Set method to POST
                    title.textContent = 'Tambah Anggaran'; // Set modal title to 'Tambah Anggaran'
                    form.reset(); // Reset the form fields
                }

                // Optionally, you can perform any calculation or adjustments here if necessary
                autoCalcAnggaran(); // Example of auto-calculation function
            }


            function closeKomposisiModal() {
                const modal = document.getElementById('komposisiModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden'); // lepas kunci scroll
            }

            function confirmDeleteKomposisi(event) {
                event.preventDefault(); // Mencegah form untuk langsung submit

                // SweetAlert2 Confirmation Popup
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika konfirmasi diterima, kirimkan form
                        event.target.submit();
                    }
                });
            }

            function confirmDeleteAnggaran(event) {
                event.preventDefault(); // Mencegah form untuk langsung submit

                // SweetAlert2 Confirmation Popup
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika konfirmasi diterima, kirimkan form
                        event.target.submit();
                    }
                });
            }

            function openPegawaiModal() {
                const el = document.getElementById('pegawaiModal');
                if (!el) return;
                el.classList.remove('hidden');
                el.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            function closePegawaiModal() {
                const el = document.getElementById('pegawaiModal');
                if (!el) return;
                el.classList.add('hidden');
                el.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            // ADD/REMOVE FIELD NAMA[]
            function addNamaField() {
                const wrap = document.getElementById('namaWrapper');
                const row = document.createElement('div');
                row.className = 'flex gap-2';
                row.innerHTML = `
      <input type="text" name="nama[]" class="w-full border rounded px-3 py-2" placeholder="Nama Pegawai" required>
      <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-500 text-white rounded">-</button>
    `;
                wrap.appendChild(row);
            }

            // FILL EDIT FORM
            function fillEditForm(data) {
                const form = document.getElementById('pegawaiEditForm');
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_nama').value = data.nama || '';
                // set value; kalau tidak ada di list, sisipkan extra option
                const sel = document.getElementById('edit_jabatan');
                const has = [...sel.options].some(o => o.value === data.jabatan);
                if (!has && data.jabatan) {
                    const extra = document.getElementById('edit_jabatan_extra');
                    extra.value = data.jabatan;
                    extra.textContent = data.jabatan;
                    extra.classList.remove('hidden');
                }
                sel.value = data.jabatan || '';

                // action PUT ke /super-admin/pegawai/{id}
                form.action = `{{ url('super-admin/pegawai') }}/${data.id}`;
            }

            // CLEAR EDIT FORM
            function clearEditForm() {
                const form = document.getElementById('pegawaiEditForm');
                form.reset();
                form.action = '#';
                document.getElementById('edit_id').value = '';
            }

            function closeAddPhotoModal() {
                const modal = document.getElementById('addPhotoModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            // Close modal when clicking outside
            function initializePhotoModal() {
                const modal = document.getElementById('addPhotoModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeAddPhotoModal();
                        }
                    });
                }

                // Image preview functionality
                const imageInput = document.getElementById('image');
                const imagePreview = document.getElementById('imagePreview');
                const previewImage = document.getElementById('previewImage');

                if (imageInput && imagePreview && previewImage) {
                    imageInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImage.src = e.target.result;
                                imagePreview.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            }

            // Function to remove preview
            function removePreview() {
                const imageInput = document.getElementById('image');
                const imagePreview = document.getElementById('imagePreview');
                const previewImage = document.getElementById('previewImage');

                if (imageInput) imageInput.value = '';
                if (imagePreview) imagePreview.style.display = 'none';
                if (previewImage) previewImage.src = '';
            }

            // Function to delete current image
            function deleteCurrentImage() {
                if (gallery.length === 0) return;

                const currentImage = gallery[activeIndex];
                const imageName = currentImage.description || 'Foto ini';

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `
                        <div class="text-center">
                            <div class="mb-4">
                                <svg class="w-16 h-16 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-gray-800 mb-2">Apakah Anda yakin ingin menghapus foto?</p>
                            <p class="text-sm text-gray-600 mb-1"><strong>Foto:</strong> ${imageName}</p>
                            <p class="text-sm text-red-600 font-medium">âš ï¸ Tindakan ini tidak dapat dibatalkan!</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: `
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Ya, Hapus!
                    `,
                    cancelButtonText: `
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    `,
                    reverseButtons: true,
                    focusCancel: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'px-6 py-3 rounded-lg font-semibold',
                        cancelButton: 'px-6 py-3 rounded-lg font-semibold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        const deleteBtn = document.getElementById('deleteCurrentBtn');
                        if (deleteBtn) {
                            deleteBtn.innerHTML = `
                                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            `;
                            deleteBtn.disabled = true;
                        }

                        // Show loading SweetAlert
                        Swal.fire({
                            title: 'Menghapus Foto...',
                            html: `
                                <div class="text-center">
                                    <div class="mb-4">
                                        <svg class="w-12 h-12 text-blue-500 mx-auto animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600">Sedang memproses penghapusan foto...</p>
                                </div>
                            `,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });

                        // Send delete request
                        fetch(`/super-admin/gallery/${currentImage.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Remove image from gallery array
                                    gallery.splice(activeIndex, 1);

                                    if (gallery.length === 0) {
                                        // Show success message then reload
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            html: `
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-800 mb-2">Foto berhasil dihapus!</p>
                                                <p class="text-sm text-gray-600">Halaman akan dimuat ulang...</p>
                                            </div>
                                        `,
                                            icon: 'success',
                                            timer: 2000,
                                            showConfirmButton: false,
                                            customClass: {
                                                popup: 'rounded-2xl'
                                            }
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        // Adjust active index if needed
                                        if (activeIndex >= gallery.length) {
                                            activeIndex = gallery.length - 1;
                                        }

                                        // Update gallery display
                                        updateGallery();
                                        resetTimer();

                                        // Show success message
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            html: `
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-800 mb-2">Foto berhasil dihapus!</p>
                                                <p class="text-sm text-gray-600">Galeri telah diperbarui</p>
                                            </div>
                                        `,
                                            icon: 'success',
                                            timer: 2000,
                                            showConfirmButton: false,
                                            customClass: {
                                                popup: 'rounded-2xl'
                                            }
                                        });
                                    }
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        html: `
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <svg class="w-16 h-16 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-800 mb-2">Gagal menghapus foto!</p>
                                            <p class="text-sm text-gray-600">${data.message || 'Terjadi kesalahan yang tidak diketahui'}</p>
                                        </div>
                                    `,
                                        icon: 'error',
                                        confirmButtonText: 'OK',
                                        customClass: {
                                            popup: 'rounded-2xl',
                                            confirmButton: 'px-6 py-3 rounded-lg font-semibold'
                                        }
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    html: `
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <svg class="w-16 h-16 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-lg font-semibold text-gray-800 mb-2">Terjadi Kesalahan!</p>
                                        <p class="text-sm text-gray-600">Tidak dapat menghapus foto. Silakan coba lagi.</p>
                                    </div>
                                `,
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'rounded-2xl',
                                        confirmButton: 'px-6 py-3 rounded-lg font-semibold'
                                    }
                                });
                            })
                            .finally(() => {
                                // Restore delete button
                                if (deleteBtn) {
                                    deleteBtn.innerHTML = `
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                `;
                                    deleteBtn.disabled = false;
                                }
                            });
                    }
                });
            }







            // News Modal Functions
            function initializeNewsModal() {
                // Open Add News Modal
                const addNewsBtn = document.getElementById('addNewsBtn');
                if (addNewsBtn) {
                    addNewsBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const modal = document.getElementById('addNewsModal');
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                            document.body.classList.add('overflow-hidden');
                        }
                    });
                }

                // Close modal when clicking outside
                const modal = document.getElementById('addNewsModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeAddNewsModal();
                        }
                    });
                }

                // News URL preview functionality
                const newsUrlInput = document.getElementById('newsUrl');
                const newsPreview = document.getElementById('newsPreview');

                if (newsUrlInput && newsPreview) {
                    let previewTimeout;
                    newsUrlInput.addEventListener('input', function() {
                        clearTimeout(previewTimeout);
                        const url = this.value.trim();

                        if (url && isValidUrl(url)) {
                            previewTimeout = setTimeout(() => {
                                fetchNewsPreview(url);
                            }, 1000); // Wait 1 second after user stops typing
                        } else {
                            newsPreview.classList.add('hidden');
                        }
                    });
                }

                // News form submission
                const newsForm = document.getElementById('newsForm');
                if (newsForm) {
                    newsForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const url = document.getElementById('newsUrl').value;
                        const submitBtn = document.getElementById('submitNewsBtn');

                        if (!url) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'URL berita tidak boleh kosong',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }

                        // Show loading state
                        if (submitBtn) {
                            submitBtn.innerHTML = `
                                <svg class="w-4 h-4 inline mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Menyimpan...
                            `;
                            submitBtn.disabled = true;
                        }

                        // Send request to save news
                        fetch('/super-admin/news/store', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    url: url
                                })
                            })
                            .then(response => {
                                console.log('Response status:', response.status);
                                return response.json();
                            })
                            .then(data => {
                                console.log('Response data:', data);
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Berita berhasil ditambahkan',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // Scroll to news section
                                        const newsSection = document.getElementById('beritaSection');
                                        if (newsSection) {
                                            newsSection.scrollIntoView({
                                                behavior: 'smooth',
                                                block: 'start'
                                            });
                                        }
                                        // Close modal
                                        closeAddNewsModal();
                                        // Reload page to show new news
                                        setTimeout(() => {
                                            location.reload();
                                        }, 500);
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: data.message || 'Gagal menambahkan berita',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat menyimpan berita. Periksa console untuk detail error.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            })
                            .finally(() => {
                                // Restore submit button
                                if (submitBtn) {
                                    submitBtn.innerHTML = `
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Berita
                                `;
                                    submitBtn.disabled = false;
                                }
                            });
                    });
                }
            }

            // Utility functions
            function isValidUrl(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            }

            function fetchNewsPreview(url) {
                fetch('/super-admin/news/preview', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            url: url
                        })
                    })
                    .then(response => {
                        console.log('Preview response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Preview response data:', data);
                        if (data.success) {
                            const previewImage = document.getElementById('previewImage');
                            const previewTitle = document.getElementById('previewTitle');
                            const previewDescription = document.getElementById('previewDescription');
                            const previewSource = document.getElementById('previewSource');
                            const newsPreview = document.getElementById('newsPreview');

                            if (previewImage) previewImage.src = data.image_url ||
                                '{{ asset('images/default-news.jpg') }}';
                            if (previewTitle) previewTitle.textContent = data.title || 'Judul tidak ditemukan';
                            if (previewDescription) previewDescription.textContent = data.description ||
                                'Deskripsi tidak ditemukan';
                            if (previewSource) previewSource.textContent = data.source || 'Sumber tidak diketahui';

                            if (newsPreview) newsPreview.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching preview:', error);
                    });
            }


            // News Modal Functions
            function closeAddNewsModal() {
                const modal = document.getElementById('addNewsModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            // Delete news function
            function deleteNews(newsId) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `
                        <div class="text-center">
                            <div class="mb-4">
                                <svg class="w-16 h-16 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-gray-800 mb-2">Apakah Anda yakin ingin menghapus berita ini?</p>
                            <p class="text-sm text-red-600 font-medium">âš ï¸ Tindakan ini tidak dapat dibatalkan!</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/super-admin/news/${newsId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Berita berhasil dihapus',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // Scroll to news section
                                        const newsSection = document.getElementById('beritaSection');
                                        if (newsSection) {
                                            newsSection.scrollIntoView({
                                                behavior: 'smooth',
                                                block: 'start'
                                            });
                                        }
                                        // Reload page to update news list
                                        setTimeout(() => {
                                            location.reload();
                                        }, 500);
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: data.message || 'Gagal menghapus berita',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat menghapus berita',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                    }
                });
            }


            // Open "Add Photo" Modal - Already initialized in initializePhotoModal()
            function initializePegawaiModal() {
                const addPhotoBtn = document.getElementById('addPhotoBtn');
                if (addPhotoBtn) {
                    addPhotoBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const modal = document.getElementById('addPhotoModal');
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                            document.body.classList.add('overflow-hidden');
                        }
                    });
                }
            }

            // Tupoksi Modal Functions
            function openTugasModal(tugasData = null) {
                const modal = document.getElementById('tugasModal');
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('tugasForm');
                const methodInput = document.getElementById('tugasFormMethod');
                const title = document.getElementById('tugasModalTitle');

                if (tugasData && tugasData.id) {
                    // Edit mode
                    form.action = `{{ url('super-admin/tupoksi/tugas') }}/${tugasData.id}`;
                    methodInput.value = 'PUT';
                    title.textContent = 'Edit Tugas Pokok';
                    document.getElementById('tugas_pasal').value = tugasData.pasal || '';
                    document.getElementById('tugas_isi').value = tugasData.isi || '';
                } else {
                    // Add mode
                    form.action = `{{ route('super-admin.tupoksi.tugas.store') }}`;
                    methodInput.value = 'POST';
                    title.textContent = 'Tambah Tugas Pokok';
                    form.reset();
                }

                loadTugasList();
            }

            function closeTugasModal() {
                const modal = document.getElementById('tugasModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            function openFungsiModal(fungsiData = null) {
                const modal = document.getElementById('fungsiModal');
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('fungsiForm');
                const methodInput = document.getElementById('fungsiFormMethod');
                const title = document.getElementById('fungsiModalTitle');

                if (fungsiData && fungsiData.id) {
                    // Edit mode
                    form.action = `{{ url('super-admin/tupoksi/fungsi') }}/${fungsiData.id}`;
                    methodInput.value = 'PUT';
                    title.textContent = 'Edit Fungsi';
                    loadFungsiForEdit(fungsiData.id);
                } else {
                    // Add mode
                    form.action = `{{ route('super-admin.tupoksi.fungsi.store') }}`;
                    methodInput.value = 'POST';
                    title.textContent = 'Kelola Fungsi';
                    loadAllFungsiForEdit();
                }

                loadFungsiList();
            }

            function closeFungsiModal() {
                const modal = document.getElementById('fungsiModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            // Load Tugas List
            function loadTugasList() {
                fetch('{{ route('super-admin.tupoksi.tugas.get', ':id') }}'.replace(':id', ''))
                    .then(response => response.json())
                    .then(data => {
                        const tugasList = document.getElementById('tugasList');
                        tugasList.innerHTML = '';

                        if (data.success && data.data) {
                            data.data.forEach(tugas => {
                                const tugasItem = document.createElement('div');
                                tugasItem.className = 'bg-gray-50 p-4 rounded-lg border';
                                tugasItem.innerHTML = `
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h5 class="font-semibold text-gray-800">${tugas.pasal}</h5>
                                            <p class="text-gray-600 mt-2">${tugas.isi}</p>
                                        </div>
                                        <div class="flex gap-2 ml-4">
                                            <button onclick="editTugas(${tugas.id})"
                                                class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                                Edit
                                            </button>
                                            <button onclick="deleteTugas(${tugas.id})"
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                `;
                                tugasList.appendChild(tugasItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error loading tugas list:', error);
                    });
            }

            // Load Fungsi List
            function loadFungsiList() {
                fetch('{{ route('super-admin.tupoksi.fungsi.get', ':id') }}'.replace(':id', ''))
                    .then(response => response.json())
                    .then(data => {
                        const fungsiList = document.getElementById('fungsiList');
                        fungsiList.innerHTML = '';

                        if (data.success && data.data) {
                            data.data.forEach(fungsi => {
                                const fungsiItem = document.createElement('div');
                                fungsiItem.className = 'bg-gray-50 p-4 rounded-lg border';
                                fungsiItem.innerHTML = `
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-gray-600">${fungsi.isi}</p>
                                        </div>
                                        <div class="flex gap-2 ml-4">
                                            <button onclick="editFungsi(${fungsi.id})"
                                                class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                                Edit
                                            </button>
                                            <button onclick="deleteFungsi(${fungsi.id})"
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                `;
                                fungsiList.appendChild(fungsiItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error loading fungsi list:', error);
                    });
            }

            // Load all functions for editing
            function loadAllFungsiForEdit() {
                fetch('{{ route('super-admin.tupoksi.fungsi.get', ':id') }}'.replace(':id', ''))
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('fungsiFieldsContainer');
                        container.innerHTML = '';

                        if (data.success && data.data && data.data.length > 0) {
                            data.data.forEach((fungsi, index) => {
                                addFungsiField(fungsi.isi, fungsi.id, index + 1);
                            });
                        } else {
                            // Add one empty field if no data
                            addFungsiField('', '', 1);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading functions for edit:', error);
                        // Add one empty field on error
                        addFungsiField('', '', 1);
                    });
            }

            // Load single function for editing
            function loadFungsiForEdit(id) {
                fetch(`{{ url('super-admin/tupoksi/fungsi') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('fungsiFieldsContainer');
                        container.innerHTML = '';

                        if (data.success && data.data) {
                            addFungsiField(data.data.isi, data.data.id, 1);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading function for edit:', error);
                    });
            }

            // Add function field
            function addFungsiField(value = '', id = '', number = null) {
                const container = document.getElementById('fungsiFieldsContainer');
                const fieldCount = container.children.length;
                const fieldNumber = number || fieldCount + 1;

                const fieldDiv = document.createElement('div');
                fieldDiv.className = 'flex items-start gap-3 p-3 bg-gray-50 rounded-lg border';
                fieldDiv.innerHTML = `
                    <div class="flex-shrink-0 mt-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-500 text-white text-xs font-bold">
                            ${fieldNumber}
                        </span>
                    </div>
                    <div class="flex-1">
                        <textarea name="fungsi_isi[]" rows="3"
                            class="w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan isi fungsi ${fieldNumber}..." required>${value}</textarea>
                        ${id ? `<input type="hidden" name="fungsi_id[]" value="${id}">` : ''}
                    </div>
                    <div class="flex-shrink-0 mt-2">
                        <button type="button" onclick="removeFungsiField(this)"
                            class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                container.appendChild(fieldDiv);
                updateFungsiNumbers();
            }

            // Remove function field
            function removeFungsiField(button) {
                const fieldDiv = button.closest('.flex.items-start.gap-3');
                fieldDiv.remove();
                updateFungsiNumbers();
            }

            // Update function numbers
            function updateFungsiNumbers() {
                const container = document.getElementById('fungsiFieldsContainer');
                const fields = container.children;

                Array.from(fields).forEach((field, index) => {
                    const numberSpan = field.querySelector('.bg-green-500');
                    if (numberSpan) {
                        numberSpan.textContent = index + 1;
                    }

                    const textarea = field.querySelector('textarea');
                    if (textarea) {
                        textarea.placeholder = `Masukkan isi fungsi ${index + 1}...`;
                    }
                });
            }

            // Edit Functions
            function editTugas(id) {
                fetch(`{{ url('super-admin/tupoksi/tugas') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            openTugasModal(data.data);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading tugas:', error);
                    });
            }

            function editFungsi(id) {
                fetch(`{{ url('super-admin/tupoksi/fungsi') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            openFungsiModal(data.data);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading fungsi:', error);
                    });
            }

            // Delete Functions
            function deleteTugas(id) {
                if (confirm('Apakah Anda yakin ingin menghapus tugas pokok ini?')) {
                    fetch(`{{ url('super-admin/tupoksi/tugas') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                loadTugasList();
                                // Refresh dashboard content
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting tugas:', error);
                            alert('Terjadi kesalahan saat menghapus data');
                        });
                }
            }

            function deleteFungsi(id) {
                if (confirm('Apakah Anda yakin ingin menghapus fungsi ini?')) {
                    fetch(`{{ url('super-admin/tupoksi/fungsi') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                loadFungsiList();
                                // Refresh dashboard content
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting fungsi:', error);
                            alert('Terjadi kesalahan saat menghapus data');
                        });
                }
            }

            // Handle form submission with success callback
            function initializeTupoksiModals() {
                // Handle tugas form submission
                const tugasForm = document.getElementById('tugasForm');
                if (tugasForm) {
                    tugasForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        const url = this.action;
                        const method = document.getElementById('tugasFormMethod').value;

                        fetch(url, {
                                method: method,
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    closeTugasModal();
                                    location.reload();
                                } else {
                                    alert('Error: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan data');
                            });
                    });
                }

                // Handle fungsi form submission
                const fungsiForm = document.getElementById('fungsiForm');
                if (fungsiForm) {
                    fungsiForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        const url = this.action;

                        fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    closeFungsiModal();
                                    location.reload();
                                } else {
                                    alert('Error: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan data');
                            });
                    });
                }
            }
        </script>
