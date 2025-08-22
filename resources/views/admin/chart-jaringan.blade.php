@extends('layouts.admin-master')

@section('content')
@include('components.admin-navbar')

<div class="container-fluid px-4 py-8 min-h-screen bg-gray-50 light:bg-gray-900">
    <div class="flex flex-col md:flex-row gap-8">

        <!-- Main Content -->
        <main class="flex-1 mt-[90px]">
            <div class="bg-white light:bg-gray-800 rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 light:text-gray-100 mb-2">Chart Jaringan Narkoba</h1>
                <p class="text-gray-500 light:text-gray-300 mb-6">Buat dan visualisasikan jaringan pelaku narkoba secara interaktif.</p>

                <form x-data="chartJaringan" x-init="init" class="space-y-8">
                    <!-- Node Input Section -->
                    <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                        <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Tambah Node Jaringan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Nama/ID Pelaku</label>
                                <input type="text" x-model="newNodeName" class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white" placeholder="Contoh: Bandar A, Kurir B">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Tipe Pelaku</label>
                                <select x-model="newNodeType" class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white">
                                    <option value="supplier">Supplier/Produsen</option>
                                    <option value="distributor">Distributor</option>
                                    <option value="kurir">Kurir</option>
                                    <option value="dealer">Dealer</option>
                                    <option value="user">User/Pengguna</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="button" @click="addNode" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 disabled:opacity-50" :disabled="!newNodeName">
                                    <i class="fas fa-plus mr-2"></i>Tambah Node
                                </button>
                            </div>
                        </div>
                    </section>

                    <!-- Nodes List -->
                    <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                        <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Daftar Node Jaringan</h2>
                        <div class="space-y-3">
                            <template x-for="(node, index) in nodes" :key="node.id">
                                <div class="flex items-center space-x-4 p-3 bg-white light:bg-gray-800 rounded-lg border">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm font-medium" x-text="node.name || 'Node ' + (index + 1)"></span>
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
                                        <input type="text" x-model="node.name" class="px-2 py-1 text-sm border border-gray-300 light:border-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 light:bg-gray-700 light:text-white" placeholder="Nama node">
                                        <select x-model="node.type" class="px-2 py-1 text-sm border border-gray-300 light:border-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 light:bg-gray-700 light:text-white">
                                            <option value="supplier">Supplier</option>
                                            <option value="distributor">Distributor</option>
                                            <option value="kurir">Kurir</option>
                                            <option value="dealer">Dealer</option>
                                            <option value="user">User</option>
                                        </select>
                                        <button type="button" @click="removeNode(index)" class="text-red-600 hover:text-red-800" title="Hapus Node">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                            <div x-show="nodes.length === 0" class="text-center py-8 text-gray-500 light:text-gray-400">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-2">Belum ada node jaringan. Tambahkan node di atas.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Connection Section -->
                    <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                        <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Hubungan Antar Node</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Dari Node</label>
                                <select x-model="connectionFrom" class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white">
                                    <option value="">Pilih node</option>
                                    <template x-for="(node, index) in nodes" :key="node.id">
                                        <option :value="index" x-text="node.name || 'Node ' + (index + 1)"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Ke Node</label>
                                <select x-model="connectionTo" class="w-full px-3 py-2 border border-gray-300 light:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 light:bg-gray-800 light:text-white">
                                    <option value="">Pilih node</option>
                                    <template x-for="(node, index) in nodes" :key="node.id">
                                        <option :value="index" x-text="node.name || 'Node ' + (index + 1)"></option>
                                    </template>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="button"
                                    @click="addConnection(connectionFrom, connectionTo)"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 disabled:opacity-50"
                                    :disabled="connectionFrom === '' || connectionTo === '' || Number(connectionFrom) === Number(connectionTo)">
                                    <i class="fas fa-link mr-2"></i>Tambah Hubungan
                                </button>
                            </div>
                        </div>
                    </section>

                    <!-- Visualization Preview -->
                    <section class="bg-gray-50 light:bg-gray-700 p-4 rounded-lg mb-4">
                        <h2 class="text-md font-semibold mb-3 text-gray-700 light:text-gray-200">Preview Visualisasi Jaringan</h2>
                        <div class="bg-white light:bg-gray-800 p-4 rounded-lg border min-h-[300px]">
                            <template x-if="nodes.length > 0">
                                <pre x-ref="mermaidEl" class="mermaid" x-text="mermaidCode"></pre>
                            </template>
                            <div x-show="nodes.length === 0" class="text-center py-12 text-gray-500 light:text-gray-400">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <p class="mt-2">Visualisasi akan muncul setelah menambahkan node</p>
                            </div>
                        </div>
                    </section>

                    <!-- Submit/Reset Button -->
                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="resetAll" class="px-6 py-2 border border-gray-300 light:border-gray-600 rounded-md text-gray-700 light:text-gray-300 hover:bg-gray-50 light:hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-undo mr-2"></i>Reset
                        </button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200">
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
                    node.connections = node.connections.filter(connIdx => connIdx !== index);
                });
                // Remove the node
                this.nodes.splice(index, 1);
                // Re-index connections
                this.nodes.forEach(node => {
                    node.connections = node.connections.map(connIdx => connIdx > index ? connIdx - 1 : connIdx);
                });
                this.updateMermaid();
            },
            addConnection(fromIndex, toIndex) {
                fromIndex = Number(fromIndex);
                toIndex = Number(toIndex);
                if (fromIndex !== toIndex && fromIndex >= 0 && toIndex >= 0 && fromIndex < this.nodes.length && toIndex < this.nodes.length) {
                    if (!this.nodes[fromIndex].connections.includes(toIndex)) {
                        this.nodes[fromIndex].connections.push(toIndex);
                        this.updateMermaid();
                    }
                }
            },
            updateMermaid() {
                let code = 'graph TD\n';
                this.nodes.forEach((node, idx) => {
                    let label = node.name ? node.name + ' [' + node.type + ']' : 'Node' + (idx+1) + ' [' + node.type + ']';
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
                        window.mermaid.run({nodes: [this.$refs.mermaidEl]});
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
            }
        }));
    });
</script>

<script type="module">
    import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
    mermaid.initialize({ startOnLoad: true });
  </script>

@endpush
