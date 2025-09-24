@extends('layouts.admin-master')

@section('title', 'Edit Titik Masuk')

@section('content')
<div class="mx-auto px-4 py-3">
	<div class="bg-white rounded shadow p-6">
		<h2 class="text-xl font-bold mb-4">Edit Data Titik Masuk</h2>
		<form action="{{ route('admin.data.titik-masuk.update', $jalurMasuk->id) }}" method="POST">
			@csrf
			@method('PUT')

			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div class="mb-4">
					<label for="jenis_transportasi" class="block font-semibold mb-1">Jenis Transportasi</label>
					<select name="jenis_transportasi" id="jenis_transportasi" class="w-full border-gray-300 rounded px-3 py-2" required>
						<option value="">Pilih Jenis</option>
						<option value="Darat" {{ old('jenis_transportasi', $jalurMasuk->jenis_transportasi) === 'Darat' ? 'selected' : '' }}>Darat</option>
						<option value="Laut" {{ old('jenis_transportasi', $jalurMasuk->jenis_transportasi) === 'Laut' ? 'selected' : '' }}>Laut</option>
						<option value="Udara" {{ old('jenis_transportasi', $jalurMasuk->jenis_transportasi) === 'Udara' ? 'selected' : '' }}>Udara</option>
					</select>
					@error('jenis_transportasi')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
				</div>

				<div class="mb-4">
					<label for="nama_tempat" class="block font-semibold mb-1">Nama Tempat</label>
					<input type="text" name="nama_tempat" id="nama_tempat" value="{{ old('nama_tempat', $jalurMasuk->nama_tempat) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
					@error('nama_tempat')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
				</div>

				<div class="mb-4">
					<label for="provinsi" class="block font-semibold mb-1">Provinsi</label>
					<select name="provinsi" id="provinsi" class="w-full border-gray-300 rounded px-3 py-2" required>
						<option value="Jawa Timur" {{ old('provinsi', $jalurMasuk->provinsi) === 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
						<option value="lainnya" {{ old('provinsi', $jalurMasuk->provinsi) !== 'Jawa Timur' ? 'selected' : '' }}>Lainnya</option>
					</select>
					@error('provinsi')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
				</div>

				<div id="wilayah-jatim" class="md:col-span-2">
					<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
						<div>
							<label for="kabupaten" class="block font-semibold mb-1">Kabupaten/Kota</label>
							<select name="kabupaten" id="kabupaten" class="w-full border-gray-300 rounded px-3 py-2" required data-selected="{{ old('kabupaten', $jalurMasuk->kabupaten) }}">
								<option value="">Pilih Kabupaten</option>
							</select>
							@error('kabupaten')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
						</div>
						<div>
							<label for="kecamatan" class="block font-semibold mb-1">Kecamatan</label>
							<select name="kecamatan" id="kecamatan" class="w-full border-gray-300 rounded px-3 py-2" required data-selected="{{ old('kecamatan', $jalurMasuk->kecamatan) }}">
								<option value="">Pilih Kecamatan</option>
							</select>
							@error('kecamatan')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
						</div>
						<div>
							<label for="kelurahan" class="block font-semibold mb-1">Kelurahan/Desa</label>
							<select name="kelurahan" id="kelurahan" class="w-full border-gray-300 rounded px-3 py-2" required data-selected="{{ old('kelurahan', $jalurMasuk->kelurahan) }}">
								<option value="">Pilih Kelurahan/Desa</option>
							</select>
							@error('kelurahan')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
						</div>
					</div>
   			 </div>
   				 <div id="wilayah-lainnya" class="md:col-span-2 hidden">
					<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
						<div>
							<label class="block font-semibold mb-1">Provinsi</label>
							<input type="text" name="provinsi_lain" id="provinsi_lain" value="{{ old('provinsi', $jalurMasuk->provinsi) !== 'Jawa Timur' ? old('provinsi', $jalurMasuk->provinsi) : '' }}" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Provinsi">
						</div>
						<div>
							<label class="block font-semibold mb-1">Kabupaten</label>
							<input type="text" name="kabupaten_lain" value="{{ old('kabupaten', $jalurMasuk->provinsi) !== 'Jawa Timur' ? old('kabupaten', $jalurMasuk->kabupaten) : '' }}" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Kabupaten">
						</div>
						<div>
							<label class="block font-semibold mb-1">Kecamatan</label>
							<input type="text" name="kecamatan_lain" value="{{ old('provinsi', $jalurMasuk->provinsi) !== 'Jawa Timur' ? old('kecamatan', $jalurMasuk->kecamatan) : '' }}" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Kecamatan">
						</div>
					<div>
							<label class="block font-semibold mb-1">Kelurahan/Desa</label>
							<input type="text" name="kelurahan_lain" value="{{ old('provinsi', $jalurMasuk->provinsi) !== 'Jawa Timur' ? old('kelurahan', $jalurMasuk->kelurahan) : '' }}" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Kelurahan/Desa">
						</div>
					</div>
				</div>
			</div>

			<div class="flex gap-2 mt-6">
				<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
				<a href="{{ route('admin.data.titik-masuk.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
			</div>
		</form>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const provinsiSelect = document.getElementById('provinsi');
	const kabupatenSelect = document.getElementById('kabupaten');
	const kecamatanSelect = document.getElementById('kecamatan');
	const kelurahanSelect = document.getElementById('kelurahan');

	const selectedKabupaten = kabupatenSelect.getAttribute('data-selected') || '';
	const selectedKecamatan = kecamatanSelect.getAttribute('data-selected') || '';
	const selectedKelurahan = kelurahanSelect.getAttribute('data-selected') || '';

	function toggleWilayah() {
		const isJatim = provinsiSelect.value === 'Jawa Timur';
		document.getElementById('wilayah-jatim').classList.toggle('hidden', !isJatim);
		document.getElementById('wilayah-lainnya').classList.toggle('hidden', isJatim);
		kabupatenSelect.required = isJatim;
		kecamatanSelect.required = isJatim;
		kelurahanSelect.required = isJatim;
		document.getElementById('provinsi_lain') && (document.getElementById('provinsi_lain').required = !isJatim);
	}

	function fetchKabupatenList() {
		return fetch('/api/kabupaten-list')
			.then(r => r.json())
			.then(data => {
				kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
				data.forEach(kab => {
					const opt = document.createElement('option');
					opt.value = kab;
					opt.textContent = kab;
					if (kab === selectedKabupaten) opt.selected = true;
					kabupatenSelect.appendChild(opt);
				});
			});
	}

	function fetchKecamatanList(kabupaten) {
		kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
		kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
		if (!kabupaten) return Promise.resolve();
		return fetch(`/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
			.then(r => r.json())
			.then(data => {
				data.forEach(kec => {
					const opt = document.createElement('option');
					opt.value = kec;
					opt.textContent = kec;
					if (kec === selectedKecamatan) opt.selected = true;
					kecamatanSelect.appendChild(opt);
				});
			});
	}

	function fetchDesaList(kabupaten, kecamatan) {
		kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
		if (!kabupaten || !kecamatan) return Promise.resolve();
		return fetch(`/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`)
			.then(r => r.json())
			.then(data => {
				data.forEach(desa => {
					const opt = document.createElement('option');
					opt.value = desa;
					opt.textContent = desa;
					if (desa === selectedKelurahan) opt.selected = true;
				kelurahanSelect.appendChild(opt);
				});
			});
	}

	// Initialize
	toggleWilayah();
	fetchKabupatenList()
		.then(() => fetchKecamatanList(selectedKabupaten))
		.then(() => fetchDesaList(selectedKabupaten, selectedKecamatan));

	// Change handlers
	kabupatenSelect.addEventListener('change', function() {
		fetchKecamatanList(this.value).then(() => {
			// reset selected for kelurahan when kabupaten changes
			fetchDesaList(this.value, kecamatanSelect.value);
		});
	});

	kecamatanSelect.addEventListener('change', function() {
		fetchDesaList(kabupatenSelect.value, this.value);
	});

	provinsiSelect.addEventListener('change', toggleWilayah);
});
</script>
@endsection
