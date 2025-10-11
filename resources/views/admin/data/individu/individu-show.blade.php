@extends('layouts.admin-master')

@section('title', 'Detail Data Individu TSK')
@section('content')
    @include('components.admin-navbar')

    <div class="mx-auto px-4 py-3">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 light:text-white">Detail Data Individu</h1>
                <p class="text-sm text-gray-500">Informasi lengkap data individu TSK.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.data.individu.edit', $individu->id) }}"
                    class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.data.individu') }}"
                    class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
            <div class="lg:col-span-5">
                <!-- Detail Data -->
                <div class="bg-white light:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-blue-600 mb-4">Informasi Pribadi</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Data Pribadi -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">NIK</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->nik }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nomor Kartu Keluarga</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->nkk }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                                <p class="mt-1 text-sm text-gray-900 font-medium">{{ $individu->nama }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $individu->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tempat Lahir</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->tempat_lahir }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Lahir</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($individu->tgl_lahir)->format('d F Y') }}</p>
                            </div>
                        </div>

                        <!-- Data Alamat -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Provinsi</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->provinsi }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Kabupaten/Kota</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->kabupaten }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Kecamatan</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->kecamatan }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Kelurahan/Desa</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->kelurahan }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Alamat Lengkap</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Keluarga -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-blue-600 mb-4">Data Keluarga</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nama Ayah</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->nama_ayah ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">NIK Ayah</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->nik_ayah ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nama Ibu</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->nama_ibu ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">NIK Ibu</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->nik_ibu ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Kontak -->
                    @if ($individu->telepon->count() > 0 || $individu->rekening->count() > 0 || $individu->ewallet->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Data Kontak & Keuangan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @if ($individu->telepon->count() > 0)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                                        @foreach ($individu->telepon as $telepon)
                                            <p class="mt-1 text-sm text-gray-900">{{ $telepon->nomor_telepon }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                @if ($individu->rekening->count() > 0)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">No. Rekening</label>
                                        @foreach ($individu->rekening as $rekening)
                                            <p class="mt-1 text-sm text-gray-900">{{ $rekening->no_rekening }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                @if ($individu->ewallet->count() > 0)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">No. E-Wallet</label>
                                        @foreach ($individu->ewallet as $ewallet)
                                            <p class="mt-1 text-sm text-gray-900">{{ $ewallet->no_ewallet }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Data Kasus -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-blue-600 mb-4">Data Kasus</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Peran dalam Jaringan</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->peran_jaringan ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Status</label>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if ($individu->status == 'Voluntary') bg-green-100 text-green-800
                                    @elseif($individu->status == 'Compulsary') bg-yellow-100 text-yellow-800
                                    @elseif($individu->status == 'Proses Hukum Lanjut') bg-blue-100 text-blue-800
                                    @elseif($individu->status == 'Narapidana') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $individu->status ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Residivis</label>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $individu->residivis ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $individu->residivis ? 'Ya' : 'Tidak' }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Sumber Informasi</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $individu->sumber_informasi ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Narkotika -->
                    @if ($individu->modus_operasi || $individu->jenis_narkotika || $individu->jumlah_barang_bukti)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Data Narkotika</h3>
                            <div class="space-y-4">
                                @if ($individu->modus_operasi)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Modus Operasi</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->modus_operasi }}</p>
                                    </div>
                                @endif
                                @if ($individu->jenis_narkotika)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Jenis Narkotika</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->jenis_narkotika }}</p>
                                    </div>
                                @endif
                                @if ($individu->jumlah_barang_bukti || $individu->satuan_barang_bukti)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Jumlah Barang Bukti</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $individu->jumlah_barang_bukti }} {{ $individu->satuan_barang_bukti }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Data IPWL -->
                    @if ($individu->ipwl_id || $individu->ipwl_compulsary_id)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Data IPWL</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if ($individu->ipwl_id)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">IPWL Voluntary</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->ipwlLembaga->nama ?? '-' }}</p>
                                    </div>
                                @endif
                                @if ($individu->ipwl_compulsary_id)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">IPWL Compulsary</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $individu->ipwlCompulsaryLembaga->nama ?? '-' }}</p>
                                    </div>
                                @endif
                                @if ($individu->rekomendasi)
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-500">Rekomendasi</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->rekomendasi }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Detail Status Voluntary -->
                    @if ($individu->status == 'Voluntary' && $individu->ipwl_id)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Detail Status Voluntary</h3>
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Lembaga IPWL</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->ipwlLembaga->nama ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Detail Status Compulsary -->
                    @if ($individu->compulsaryStatus)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Detail Status Compulsary (Upaya Paksa)</h3>
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if ($individu->compulsaryStatus->no_kasus)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">a. Nomor Kasus
                                                (LKN/LI/LP)</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->compulsaryStatus->no_kasus) as $kasus)
                                                    @if (trim($kasus))
                                                        <span
                                                            class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($kasus) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->compulsaryStatus->tanggal_kasus)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">b. Tanggal Kasus</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($individu->compulsaryStatus->tanggal_kasus)->format('d F Y') }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($individu->compulsaryStatus->satuan_kerja)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">c. Satuan Kerja yang
                                                menangani</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $individu->compulsaryStatus->satuan_kerja }}</p>
                                        </div>
                                    @endif

                                    @if ($individu->compulsaryStatus->aph_menangani)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">d. APH yang
                                                menangani</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->compulsaryStatus->aph_menangani) as $aph)
                                                    @if (trim($aph))
                                                        <span
                                                            class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($aph) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->compulsaryStatus->pasal_disangkakan)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">e. Pasal yang
                                                disangkakan</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->compulsaryStatus->pasal_disangkakan) as $pasal)
                                                    @if (trim($pasal))
                                                        <span
                                                            class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($pasal) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->compulsaryStatus->ipwl_id)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">f. Rekomendasi
                                                IPWL</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $individu->compulsaryStatus->ipwlLembaga->nama ?? '-' }}</p>
                                        </div>
                                    @endif

                                    @if ($individu->compulsaryStatus->rekomendasi)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">g.
                                                Rekomendasi</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->compulsaryStatus->rekomendasi) as $rek)
                                                    @if (trim($rek))
                                                        <span
                                                            class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($rek) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @if ($individu->compulsaryStatus->tkp_lokasi)
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-500 mb-2">h. TKP (Tempat Kejadian
                                            Perkara)</label>
                                        @php
                                            $tkpData = json_decode($individu->compulsaryStatus->tkp_lokasi, true);
                                        @endphp
                                        @if ($tkpData && is_array($tkpData))
                                            <div class="space-y-2">
                                                @foreach ($tkpData as $index => $tkp)
                                                    <div class="bg-white p-3 rounded border border-gray-200">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                                                            <div><strong>Provinsi:</strong> {{ $tkp['provinsi'] ?? '-' }}
                                                            </div>
                                                            <div><strong>Kabupaten:</strong> {{ $tkp['kabupaten'] ?? '-' }}
                                                            </div>
                                                            <div><strong>Kecamatan:</strong> {{ $tkp['kecamatan'] ?? '-' }}
                                                            </div>
                                                            <div><strong>Desa/Kelurahan:</strong> {{ $tkp['desa'] ?? '-' }}
                                                            </div>
                                                            @if (!empty($tkp['lokasi']))
                                                                <div class="md:col-span-2"><strong>Detail Lokasi:</strong>
                                                                    {{ $tkp['lokasi'] }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Detail Status Proses Hukum Lanjut -->
                    @if ($individu->prosesHukumStatus)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Detail Status Proses Hukum Lanjut</h3>
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if ($individu->prosesHukumStatus->no_kasus)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">a. Nomor Kasus
                                                (LKN/LI/LP)</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->prosesHukumStatus->no_kasus) as $kasus)
                                                    @if (trim($kasus))
                                                        <span
                                                            class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($kasus) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->prosesHukumStatus->tanggal_kasus)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">b. Tanggal Kasus</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($individu->prosesHukumStatus->tanggal_kasus)->format('d F Y') }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($individu->prosesHukumStatus->satuan_kerja)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">c. Satuan Kerja yang
                                                menangani</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $individu->prosesHukumStatus->satuan_kerja }}</p>
                                        </div>
                                    @endif

                                    @if ($individu->prosesHukumStatus->aph_menangani)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">d. APH yang
                                                menangani</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->prosesHukumStatus->aph_menangani) as $aph)
                                                    @if (trim($aph))
                                                        <span
                                                            class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($aph) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->prosesHukumStatus->pasal_disangkakan)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">e. Pasal yang
                                                disangkakan</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->prosesHukumStatus->pasal_disangkakan) as $pasal)
                                                    @if (trim($pasal))
                                                        <span
                                                            class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($pasal) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->prosesHukumStatus->ipwl_id)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">f. Rekomendasi
                                                IPWL</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $individu->prosesHukumStatus->ipwlLembaga->nama ?? '-' }}</p>
                                        </div>
                                    @endif

                                    @if ($individu->prosesHukumStatus->rekomendasi)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">g.
                                                Rekomendasi</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->prosesHukumStatus->rekomendasi) as $rek)
                                                    @if (trim($rek))
                                                        <span
                                                            class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($rek) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Detail Status Narapidana -->
                    @if ($individu->narapidanaStatus)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Detail Status Narapidana</h3>
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if ($individu->narapidanaStatus->no_kasus)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">a. Nomor Kasus
                                                (LKN/LI/LP)</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->narapidanaStatus->no_kasus) as $kasus)
                                                    @if (trim($kasus))
                                                        <span
                                                            class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($kasus) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->narapidanaStatus->tanggal_kasus)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">b. Tanggal Kasus</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($individu->narapidanaStatus->tanggal_kasus)->format('d F Y') }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($individu->narapidanaStatus->satuan_kerja)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">c. Satuan Kerja yang
                                                menangani</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $individu->narapidanaStatus->satuan_kerja }}</p>
                                        </div>
                                    @endif

                                    @if ($individu->narapidanaStatus->aph_menangani)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">d. APH yang
                                                menangani</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->narapidanaStatus->aph_menangani) as $aph)
                                                    @if (trim($aph))
                                                        <span
                                                            class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($aph) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->narapidanaStatus->pasal_disangkakan)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">e. Pasal yang
                                                disangkakan</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->narapidanaStatus->pasal_disangkakan) as $pasal)
                                                    @if (trim($pasal))
                                                        <span
                                                            class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($pasal) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($individu->narapidanaStatus->ipwl_id)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">f. Rekomendasi
                                                IPWL</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $individu->narapidanaStatus->ipwlLembaga->nama ?? '-' }}</p>
                                        </div>
                                    @endif

                                    @if ($individu->narapidanaStatus->rekomendasi)
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">g.
                                                Rekomendasi</label>
                                            <div class="space-y-1">
                                                @foreach (explode(',', $individu->narapidanaStatus->rekomendasi) as $rek)
                                                    @if (trim($rek))
                                                        <span
                                                            class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ trim($rek) }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Data Nomor Kasus (Legacy) -->
                    @if ($individu->noKasus_compulsary || $individu->noKasus_prosesHukum || $individu->noKasus_narapidana)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Nomor Kasus (Legacy)</h3>
                            <div class="space-y-4">
                                @if ($individu->noKasus_compulsary)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Compulsary</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->noKasus_compulsary }}</p>
                                    </div>
                                @endif
                                @if ($individu->noKasus_prosesHukum)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Proses Hukum Lanjut</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->noKasus_prosesHukum }}</p>
                                    </div>
                                @endif
                                @if ($individu->noKasus_narapidana)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Narapidana</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->noKasus_narapidana }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Data Residivis -->
                    @if ($individu->file_residivis || $individu->vonis_residivis || $individu->lapas_akhir_residivis)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-blue-600 mb-4">Data Residivis</h3>
                            <div class="space-y-4">
                                @if ($individu->file_residivis)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">File Putusan
                                            Pengadilan</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->file_residivis }}</p>
                                    </div>
                                @endif
                                @if ($individu->vonis_residivis)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Vonis Kasus Terakhir</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->vonis_residivis }}</p>
                                    </div>
                                @endif
                                @if ($individu->lapas_akhir_residivis)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Lapas Akhir</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $individu->lapas_akhir_residivis }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Timestamp -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                            <div>
                                <label class="block font-medium">Dibuat pada:</label>
                                <p>{{ $individu->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Terakhir diperbarui:</label>
                                <p>{{ $individu->updated_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-2">
                <div class="bg-white light:bg-gray-800 shadow rounded-lg p-4 text-xs">
                    <h2 class="text-base font-semibold text-blue-600 mb-3">Informasi Penting</h2>
                    <div class="bg-blue-50 text-blue-700 text-xs p-2 rounded mb-3">
                        <ul class="list-disc pl-4">
                            <li>Data ini terhubung dengan sistem kasus narkoba.</li>
                            <li>Status menunjukkan kondisi terkini individu.</li>
                            <li>Data residivis menunjukkan riwayat hukum.</li>
                        </ul>
                    </div>
                    <div class="bg-yellow-50 text-black text-xs p-2 rounded flex items-center">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span class="ml-2">Data ini dapat diedit dengan mengklik tombol Edit di atas.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
