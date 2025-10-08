@extends('layouts.admin-master')

@section('title', 'Detail Akun Media Sosial')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Detail Akun Media Sosial</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <strong>Nama Media Sosial:</strong>
                        <div class="text-gray-700 mt-1">{{ $medsos->nama_media_sosial }}</div>
                    </div>

                    <div>
                        <strong>Jenis Akun:</strong>
                        <div class="mt-1">
                            <span
                                class="px-3 py-1 text-sm rounded-full {{ $medsos->jenis_akun == 'personal' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ $medsos->jenis_akun == 'personal' ? 'Personal' : 'Kelompok/Komunitas' }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <strong>Nama Akun:</strong>
                        <div class="text-gray-700 mt-1">{{ $medsos->nama_akun }}</div>
                    </div>

                    <div>
                        <strong>Link Akun:</strong>
                        <div class="text-gray-700 mt-1">
                            @if ($medsos->link_akun)
                                <a href="{{ $medsos->link_akun }}" class="text-blue-600 underline hover:text-blue-800"
                                    target="_blank">{{ $medsos->link_akun }}</a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    @if ($medsos->jenis_akun == 'personal' && $medsos->individu)
                        <div>
                            <strong>Profil Individu:</strong>
                            <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-900">{{ $medsos->individu->nama }}</div>
                                    <div class="text-gray-600 mt-1">NIK: {{ $medsos->individu->nik }}</div>
                                    <div class="text-gray-600">{{ $medsos->individu->kabupaten }},
                                        {{ $medsos->individu->kecamatan }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <strong>Dibuat:</strong>
                        <div class="text-gray-700 mt-1">{{ $medsos->created_at->format('d F Y H:i') }}</div>
                    </div>

                    <div>
                        <strong>Terakhir Diperbarui:</strong>
                        <div class="text-gray-700 mt-1">{{ $medsos->updated_at->format('d F Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('admin.data.medsos.edit', $medsos->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Edit</a>
                <a href="{{ route('admin.data.medsos.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
            </div>
        </div>
    </div>
@endsection
