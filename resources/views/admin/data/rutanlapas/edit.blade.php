@extends('layouts.admin-master')

@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-6">Edit Jaringan Rutan/Lapas</h2>
        <form action="{{ route('admin.data.rutanlapas.update', $rutanlapas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label class="block font-semibold mb-1">Nama Napi</label>
                        <input type="text" name="nama_napi" value="{{ old('nama_napi', $rutanlapas->nama_napi) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Jenis Napi</label>
                        <select name="jenis_napi" class="w-full border-gray-300 rounded px-3 py-2" required>
                            <option value="">-- Pilih Jenis Napi --</option>
                            @foreach($jenisNapiOptions as $jenis)
                                <option value="{{ $jenis }}" {{ (old('jenis_napi', $rutanlapas->jenis_napi) == $jenis) ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Lapas</label>
                        <input type="text" name="lapas" value="{{ old('lapas', $rutanlapas->lapas) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Peran dalam Jaringan</label>
                        <input type="text" name="peran_dalam_jaringan" value="{{ old('peran_dalam_jaringan', $rutanlapas->peran_dalam_jaringan) }}" class="w-full border-gray-300 rounded px-3 py-2">
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label class="block font-semibold mb-1">Lokasi Lapas</label>
                        <textarea name="lokasi_lapas" rows="3" class="w-full border-gray-300 rounded px-3 py-2 resize-none" required placeholder="Masukkan lokasi lapas...">{{ old('lokasi_lapas', $rutanlapas->lokasi_lapas) }}</textarea>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Status Proses</label>
                        <select name="status_proses" class="w-full border-gray-300 rounded px-3 py-1" required>
                            <option value="">-- Pilih Status Proses --</option>
                            @foreach($statusProsesOptions as $status)
                                <option value="{{ $status }}" {{ (old('status_proses', $rutanlapas->status_proses) == $status) ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="w-full border-gray-300 rounded px-3 py-1 resize-none" placeholder="Masukkan keterangan...">{{ old('keterangan', $rutanlapas->keterangan) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex gap-2 mt-8">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.data.rutanlapas.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle line breaks in textareas
    const textareas = document.querySelectorAll('textarea');

    textareas.forEach(textarea => {
        // Preserve line breaks when displaying existing data
        if (textarea.value) {
            textarea.value = textarea.value.replace(/\\n/g, '\n');
        }

        // Handle enter key properly
        textarea.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                // Allow normal enter behavior in textarea
                return true;
            }
        });

        // Auto-resize textarea based on content
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
});
</script>
@endsection
