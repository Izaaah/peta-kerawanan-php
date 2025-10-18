@extends('layouts.superadmin-master')

@section('title', 'Diagram')

@section('content')
    <div class="px-4 py-8 min-h-screen bg-gray-50 light:bg-gray-900">
        <div class="flex flex-col md:flex-row gap-8">

            <!-- Main Content -->
            <main class="flex-1">
                <div class="bg-white light:bg-gray-800 rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold text-gray-800 light:text-gray-100 mb-2">Chart Jaringan Narkoba</h1>
                    <p class="text-gray-500 light:text-gray-300 mb-6">Buat dan visualisasikan jaringan pelaku narkoba secara
                        interaktif.</p>

                    <form x-data="chartJaringan" x-init="init" class="space-y-8">
                        <!-- Node Input Section -->
                        <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                            <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Tambah Node Jaringan
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Nama/ID
                                        Pelaku</label>
                                    <input type="text" x-model="newNodeName"
                                        class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white"
                                        placeholder="Contoh: Bandar A, Kurir B">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Tipe
                                        Pelaku</label>
                                    <select x-model="newNodeType"
                                        class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white">
                                        <option value="supplier">Supplier/Produsen</option>
                                        <option value="distributor">Distributor</option>
                                        <option value="kurir">Kurir</option>
                                        <option value="dealer">Dealer</option>
                                        <option value="user">User/Pengguna</option>
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" @click="addNode"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 disabled:opacity-50"
                                        :disabled="!newNodeName">
                                        <i class="fas fa-plus mr-2"></i>Tambah Node
                                    </button>
                                </div>
                            </div>
                        </section>

                        <!-- Nodes List -->
                        <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                            <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Daftar Node Jaringan
                            </h2>
                            <div class="space-y-3">
                                <template x-for="(node, index) in nodes" :key="node.id">
                                    <div
                                        class="flex items-center space-x-4 p-3 bg-white light:bg-gray-800 rounded-lg border">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-medium"
                                                    x-text="node.name || 'Node ' + (index + 1)"></span>
                                                <span class="px-2 py-1 text-xs rounded-full capitalize"
                                                    :class="{
                                                        'bg-red-100 text-red-800': node.type === 'supplier',
                                                        'bg-orange-100 text-orange-800': node.type === 'distributor',
                                                        'bg-yellow-100 text-yellow-800': node.type === 'kurir',
                                                        'bg-green-100 text-green-800': node.type === 'dealer',
                                                        'bg-blue-100 text-blue-800': node.type === 'user'
                                                    }"
                                                    x-text="node.type.replace('_', ' ')"></span>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <input type="text" x-model="node.name"
                                                class="px-2 py-1 text-sm border border-gray-300 light:border-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 light:bg-gray-700 light:text-white"
                                                placeholder="Nama node">
                                            <select x-model="node.type"
                                                class="px-2 py-1 text-sm border border-gray-300 light:border-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 light:bg-gray-700 light:text-white">
                                                <option value="supplier">Supplier</option>
                                                <option value="distributor">Distributor</option>
                                                <option value="kurir">Kurir</option>
                                                <option value="dealer">Dealer</option>
                                                <option value="user">User</option>
                                            </select>
                                            <button type="button" @click="removeNode(index)"
                                                class="text-red-600 hover:text-red-800" title="Hapus Node">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <div x-show="nodes.length === 0" class="text-center py-8 text-gray-500 light:text-gray-400">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="mt-2">Belum ada node jaringan. Tambahkan node di atas.</p>
                                </div>
                            </div>
                        </section>

                        <!-- Connection Section -->
                        <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                            <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Hubungan Antar Node
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Dari
                                        Node</label>
                                    <select x-model="connectionFrom"
                                        class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white">
                                        <option value="">Pilih node</option>
                                        <template x-for="(node, index) in nodes" :key="node.id">
                                            <option :value="index" x-text="node.name || 'Node ' + (index + 1)">
                                            </option>
                                        </template>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Ke
                                        Node</label>
                                    <select x-model="connectionTo"
                                        class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white">
                                        <option value="">Pilih node</option>
                                        <template x-for="(node, index) in nodes" :key="node.id">
                                            <option :value="index" x-text="node.name || 'Node ' + (index + 1)">
                                            </option>
                                        </template>
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" @click="addConnection(connectionFrom, connectionTo)"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 disabled:opacity-50"
                                        :disabled="connectionFrom === '' || connectionTo === '' || Number(
                                            connectionFrom) === Number(connectionTo)">
                                        <i class="fas fa-link mr-2"></i>Tambah Hubungan
                                    </button>
                                </div>
                            </div>
                        </section>

                        <!-- Visualization Preview -->
                        <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                            <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Preview Visualisasi
                                Jaringan</h2>
                            <div class="bg-white light:bg-gray-800 p-4 rounded-lg border min-h-[300px]">
                                <template x-if="nodes.length > 0">
                                    <div x-ref="mermaidEl" class="mermaid"></div>
                                </template>
                                <div x-show="nodes.length === 0"
                                    class="text-center py-12 text-gray-500 light:text-gray-400">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <p class="mt-2">Visualisasi akan muncul setelah menambahkan node</p>
                                </div>
                            </div>
                            <div class="flex gap-2 mt-4 flex-wrap">
                                <button @click="downloadSvg" class="bg-gray-700 text-white px-4 py-2 rounded text-sm">
                                    <i class="fas fa-download mr-1"></i>Download SVG
                                </button>
                                <button @click="downloadPdf" class="bg-red-500 text-white px-4 py-2 rounded text-sm">
                                    <i class="fas fa-file-pdf mr-1"></i>Download PDF
                                </button>
                            </div>
                        </section>

                        <!-- Submit/Reset Button -->
                        <div class="flex justify-end space-x-4">
                            <button type="button" @click="resetAll"
                                class="px-6 py-2 border border-gray-300 light:border-gray-600 rounded-md text-gray-700 light:text-gray-300 hover:bg-gray-50 light:hover:bg-gray-700 transition duration-200">
                                <i class="fas fa-undo mr-2"></i>Reset
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200">
                                <i class="fas fa-save mr-2"></i>Simpan & Visualisasi
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>


    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/mermaid@10.9.0/dist/mermaid.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
            onerror="console.error('Failed to load jsPDF from CDN'); loadJSPdfFallback();"></script>
        <script>
            function loadJSPdfFallback() {
                // Fallback CDN
                const script = document.createElement('script');
                script.src = 'https://unpkg.com/jspdf@2.5.1/dist/jspdf.umd.min.js';
                script.onload = function() {
                    console.log('jsPDF loaded from fallback CDN');
                };
                script.onerror = function() {
                    console.error('Failed to load jsPDF from fallback CDN too');
                    alert('Library PDF tidak dapat dimuat. Silakan periksa koneksi internet Anda.');
                };
                document.head.appendChild(script);
            }
        </script>
        <script>
            // Initialize mermaid
            if (window.mermaid) {
                window.mermaid.initialize({
                    startOnLoad: false
                });
            }

            // Check jsPDF loading
            window.addEventListener('load', function() {
                if (typeof window.jspdf === 'undefined') {
                    console.error('jsPDF library failed to load');
                } else {
                    console.log('jsPDF library loaded successfully');
                }
            });
        </script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('chartJaringan', () => ({
                    nodes: [],
                    connectionFrom: '',
                    connectionTo: '',
                    newNodeName: '',
                    newNodeType: 'supplier',
                    mermaidCode: 'graph TD\n',
                    addNode() {
                        if (!this.newNodeName) return;
                        this.nodes.push({
                            id: Date.now() + Math.random(),
                            name: this.newNodeName,
                            type: this.newNodeType,
                            connections: []
                        });
                        this.newNodeName = '';
                        this.newNodeType = 'supplier';
                        this.updateMermaid();
                    },
                    removeNode(index) {
                        // Remove all connections to this node
                        this.nodes.forEach(node => {
                            node.connections = node.connections.filter(connIdx => connIdx !==
                                index);
                        });
                        // Remove the node
                        this.nodes.splice(index, 1);
                        // Re-index connections
                        this.nodes.forEach(node => {
                            node.connections = node.connections.map(connIdx => connIdx > index ?
                                connIdx - 1 : connIdx);
                        });
                        this.updateMermaid();
                    },
                    addConnection(fromIndex, toIndex) {
                        fromIndex = Number(fromIndex);
                        toIndex = Number(toIndex);
                        if (fromIndex !== toIndex && fromIndex >= 0 && toIndex >= 0 && fromIndex < this
                            .nodes.length && toIndex < this.nodes.length) {
                            if (!this.nodes[fromIndex].connections.includes(toIndex)) {
                                this.nodes[fromIndex].connections.push(toIndex);
                                this.updateMermaid();
                            }
                        }
                    },
                    updateMermaid() {
                        let code = 'graph TD\n';
                        this.nodes.forEach((node, idx) => {
                            let label = node.name ? node.name + ' [' + node.type + ']' : 'Node' + (
                                idx + 1) + ' [' + node.type + ']';
                            code += `N${idx}["${label}"]\n`;
                        });
                        this.nodes.forEach((node, idx) => {
                            node.connections.forEach(connIdx => {
                                code += `N${idx} --> N${connIdx}\n`;
                            });
                        });
                        this.mermaidCode = code;
                        this.$nextTick(() => {
                            if (window.mermaid && this.$refs.mermaidEl) {
                                window.mermaid.render('theGraph', code).then(({
                                    svg
                                }) => {
                                    this.$refs.mermaidEl.innerHTML = svg;
                                });
                            }
                        });
                    },
                    resetAll() {
                        this.nodes = [];
                        this.connectionFrom = '';
                        this.connectionTo = '';
                        this.newNodeName = '';
                        this.newNodeType = 'supplier';
                        this.updateMermaid();
                    },
                    init() {
                        this.updateMermaid();
                    },
                    downloadSvg() {
                        console.log('Download SVG clicked');
                        const svg = this.$refs.mermaidEl.querySelector('svg');
                        if (svg) {
                            let width = svg.getAttribute('width') || 800;
                            let height = svg.getAttribute('height') || 400;
                            svg.setAttribute('width', width);
                            svg.setAttribute('height', height);
                            const blob = new Blob([svg.outerHTML], {
                                type: 'image/svg+xml'
                            });
                            const url = URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = 'jaringan.svg';
                            a.click();
                            URL.revokeObjectURL(url);
                        } else {
                            alert('Diagram tidak ditemukan. Pastikan sudah ada visualisasi jaringan.');
                        }
                    },

                    async downloadPdf() {
                        console.log('Download PDF clicked');

                        // Check if jsPDF is loaded
                        if (typeof window.jspdf === 'undefined') {
                            alert('Library PDF belum dimuat. Silakan refresh halaman dan coba lagi.');
                            console.error('jsPDF is not available');
                            return;
                        }

                        console.log('jsPDF library status:', window.jspdf);

                        const svg = this.$refs.mermaidEl.querySelector('svg');
                        console.log('SVG element found:', svg);
                        console.log('Nodes count:', this.nodes.length);
                        console.log('Mermaid element ref:', this.$refs.mermaidEl);

                        if (svg && this.nodes.length > 0) {
                            try {
                                // Show loading message
                                const originalText = 'Download PDF';
                                const button = event.target;
                                button.textContent = 'Membuat PDF...';
                                button.disabled = true;

                                // Convert SVG to image using data URL to avoid tainted canvas
                                const imgData = await new Promise((resolve, reject) => {
                                    try {
                                        // Get SVG dimensions and scale down for PDF
                                        const svgRect = svg.getBoundingClientRect();

                                        // Scale down for PDF (0.7 = 70% of original size)
                                        const scaleFactor = 0.7;
                                        const originalWidth = Math.min(svgRect.width || 800,
                                            600); // Max 600px width
                                        const originalHeight = Math.min(svgRect.height || 600,
                                            450); // Max 450px height
                                        const width = originalWidth * scaleFactor;
                                        const height = originalHeight * scaleFactor;

                                        console.log('Original SVG dimensions:', originalWidth,
                                            'x', originalHeight);
                                        console.log('Scaled dimensions for PDF:', width, 'x',
                                            height);
                                        console.log('SVG rect:', svgRect);
                                        console.log('Scale factor for PDF:', scaleFactor);

                                        // Create canvas with proper dimensions (smaller for PDF)
                                        const canvas = document.createElement('canvas');
                                        const ctx = canvas.getContext('2d');

                                        canvas.width = width;
                                        canvas.height = height;

                                        // Set white background
                                        ctx.fillStyle = 'white';
                                        ctx.fillRect(0, 0, canvas.width, canvas.height);

                                        console.log('Canvas dimensions for PDF:', canvas.width,
                                            'x', canvas.height);

                                        // Method 1: Try data URL approach
                                        const svgData = new XMLSerializer().serializeToString(
                                            svg);
                                        const svgString =
                                            `data:image/svg+xml;base64,${btoa(unescape(encodeURIComponent(svgData)))}`;

                                        // Create image from data URL
                                        const img = new Image();
                                        img.crossOrigin =
                                            'anonymous'; // This helps with CORS issues

                                        img.onload = function() {
                                            try {
                                                // Draw image to canvas with scaled dimensions
                                                ctx.drawImage(img, 0, 0, canvas.width,
                                                    canvas.height);

                                                // Convert canvas to data URL
                                                const imageData = canvas.toDataURL(
                                                    'image/png');
                                                console.log('Image data length:', imageData
                                                    .length);
                                                resolve(imageData);
                                            } catch (canvasError) {
                                                console.error('Canvas drawing error:',
                                                    canvasError);

                                                // Fallback: Try direct SVG drawing without image
                                                try {
                                                    console.log(
                                                        'Trying fallback method...');
                                                    const fallbackImageData = canvas
                                                        .toDataURL('image/png');
                                                    console.log('Fallback successful');
                                                    resolve(fallbackImageData);
                                                } catch (fallbackError) {
                                                    console.error('Fallback also failed:',
                                                        fallbackError);

                                                    // Last resort: Create a simple placeholder image
                                                    ctx.fillStyle = '#f0f0f0';
                                                    ctx.fillRect(0, 0, width, height);
                                                    ctx.fillStyle = '#333';
                                                    ctx.font = '16px Arial';
                                                    ctx.textAlign = 'center';
                                                    ctx.fillText('Diagram Jaringan', width /
                                                        2, height / 2 - 10);
                                                    ctx.fillText('(Tidak dapat diekspor)',
                                                        width / 2, height / 2 + 10);

                                                    const placeholderImageData = canvas
                                                        .toDataURL('image/png');
                                                    resolve(placeholderImageData);
                                                }
                                            }
                                        };

                                        img.onerror = (error) => {
                                            console.error('Error loading SVG image:',
                                                error);

                                            // Fallback: Create placeholder image
                                            console.log('Creating placeholder image...');
                                            ctx.fillStyle = '#f0f0f0';
                                            ctx.fillRect(0, 0, width, height);
                                            ctx.fillStyle = '#333';
                                            ctx.font = '16px Arial';
                                            ctx.textAlign = 'center';
                                            ctx.fillText('Diagram Jaringan', width / 2,
                                                height / 2 - 10);
                                            ctx.fillText('(Gagal memuat)', width / 2,
                                                height / 2 + 10);

                                            const placeholderImageData = canvas.toDataURL(
                                                'image/png');
                                            resolve(placeholderImageData);
                                        };

                                        img.src = svgString;

                                    } catch (error) {
                                        console.error('SVG processing error:', error);
                                        reject(new Error('Failed to process SVG: ' + error
                                            .message));
                                    }
                                });

                                // Create PDF document with proper error handling
                                let pdf;
                                try {
                                    pdf = new window.jspdf.jsPDF({
                                        orientation: 'portrait',
                                        unit: 'mm',
                                        format: 'a4'
                                    });
                                } catch (pdfError) {
                                    console.error('Error creating PDF:', pdfError);
                                    throw new Error('Gagal membuat dokumen PDF: ' + pdfError.message);
                                }

                                // Set default font
                                pdf.setFont('helvetica', 'normal');

                                // Add title
                                pdf.setFontSize(18);
                                pdf.text('LAPORAN JARINGAN NARKOBA', 105, 20, {
                                    align: 'center'
                                });

                                // Add date
                                pdf.setFontSize(10);
                                const currentDate = new Date().toLocaleDateString('id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                                pdf.text(`Tanggal: ${currentDate}`, 105, 30, {
                                    align: 'center'
                                });

                                let yPosition = 50;

                                // Add summary
                                pdf.setFontSize(12);
                                pdf.text('RINGKASAN JARINGAN', 20, yPosition);
                                yPosition += 10;

                                pdf.setFontSize(10);
                                pdf.text(`Total Node: ${this.nodes.length}`, 20, yPosition);
                                yPosition += 8;

                                // Count connections
                                let totalConnections = 0;
                                this.nodes.forEach(node => {
                                    totalConnections += node.connections.length;
                                });
                                pdf.text(`Total Koneksi: ${totalConnections}`, 20, yPosition);
                                yPosition += 20;

                                // Add diagram
                                pdf.setFontSize(12);
                                pdf.text('DIAGRAM JARINGAN', 20, yPosition);
                                yPosition += 10;

                                // Add the diagram image (smaller size for PDF)
                                const imgWidth = 100; // mm (reduced from 150)
                                const imgHeight = 70; // mm (reduced from 100)

                                if (yPosition + imgHeight > 270) {
                                    pdf.addPage();
                                    yPosition = 20;
                                }

                                pdf.addImage(imgData, 'PNG', 20, yPosition, imgWidth, imgHeight);
                                yPosition += imgHeight + 15;

                                // Add nodes list
                                pdf.setFontSize(12);
                                pdf.text('DAFTAR NODE JARINGAN', 20, yPosition);
                                yPosition += 10;

                                pdf.setFontSize(10);
                                this.nodes.forEach((node, index) => {
                                    if (yPosition > 270) { // Check if we need a new page
                                        pdf.addPage();
                                        yPosition = 20;
                                        pdf.setFontSize(12);
                                        pdf.text('DAFTAR NODE JARINGAN (Lanjutan)', 20,
                                            yPosition);
                                        yPosition += 10;
                                        pdf.setFontSize(10);
                                    }

                                    const nodeName = node.name || `Node ${index + 1}`;
                                    const nodeType = node.type.charAt(0).toUpperCase() + node
                                        .type
                                        .slice(1);

                                    pdf.text(`${index + 1}. ${nodeName} (${nodeType})`, 20,
                                        yPosition);
                                    yPosition += 6;

                                    if (node.connections.length > 0) {
                                        const connectionText = node.connections.map(connIdx => {
                                            const targetNode = this.nodes[connIdx];
                                            return targetNode.name ||
                                                `Node ${connIdx + 1}`;
                                        }).join(', ');
                                        pdf.text(`   Terhubung dengan: ${connectionText}`, 25,
                                            yPosition);
                                        yPosition += 6;
                                    }
                                    yPosition += 3;
                                });

                                // Add connections matrix
                                yPosition += 10;
                                if (yPosition > 250) {
                                    pdf.addPage();
                                    yPosition = 20;
                                }

                                pdf.setFontSize(12);
                                pdf.text('MATRIX KONEKSI', 20, yPosition);
                                yPosition += 10;

                                pdf.setFontSize(9);
                                pdf.text('Dari - Ke', 20, yPosition);
                                pdf.text('Tipe', 120, yPosition);
                                yPosition += 6;

                                // Draw line
                                pdf.line(20, yPosition, 180, yPosition);
                                yPosition += 6;

                                this.nodes.forEach((fromNode, fromIdx) => {
                                    fromNode.connections.forEach(toIdx => {
                                        if (yPosition > 270) {
                                            pdf.addPage();
                                            yPosition = 20;
                                        }

                                        const fromName = fromNode.name ||
                                            `Node ${fromIdx + 1}`;
                                        const toNode = this.nodes[toIdx];
                                        const toName = toNode.name ||
                                            `Node ${toIdx + 1}`;

                                        pdf.text(`${fromName} - ${toName}`, 20,
                                            yPosition);
                                        pdf.text(`${fromNode.type} - ${toNode.type}`,
                                            120,
                                            yPosition);
                                        yPosition += 6;
                                    });
                                });

                                // Save the PDF
                                try {
                                    pdf.save('laporan-jaringan-narkoba.pdf');
                                    console.log('Download PDF berhasil');
                                } catch (saveError) {
                                    console.error('Error saving PDF:', saveError);
                                    throw new Error('Gagal menyimpan file PDF: ' + saveError.message);
                                }

                                // Restore button state
                                button.textContent = originalText;
                                button.disabled = false;

                            } catch (error) {
                                console.error('Error creating PDF:', error);
                                alert('Terjadi kesalahan saat membuat file PDF: ' + error.message);

                                // Restore button state on error
                                const button = event.target;
                                button.textContent = 'Download PDF';
                                button.disabled = false;
                            }
                        } else {
                            alert(
                                'Diagram tidak ditemukan atau belum ada node. Pastikan sudah menambahkan node jaringan.'
                            );
                        }
                    }
                }));
            });
        </script>
    @endpush
@endsection
