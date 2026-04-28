<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <a href="{{ route('kredit.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Kembali
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Pengajuan Kredit</h1>
                    <p class="text-gray-600 mt-1">{{ $kredit->no_pengajuan }}</p>
                </div>
                <a href="{{ route('kredit.edit', $kredit) }}" class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                    Edit
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="text-center border-b pb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $kredit->jenis_kredit }}</h3>
                        <p class="text-sm text-gray-500 mt-2">{{ $kredit->no_pengajuan }}</p>
                        <div class="mt-4">
                            <span class="px-4 py-2 text-sm font-semibold rounded-full 
                                @if($kredit->status == 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($kredit->status == 'Disetujui') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $kredit->status }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Pengajuan</p>
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($kredit->jumlah_pengajuan, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jangka Waktu</p>
                            <p class="text-xl font-semibold text-gray-900">{{ $kredit->jangka_waktu }} Bulan</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Bunga</p>
                            <p class="text-xl font-semibold text-gray-900">{{ $kredit->bunga }}% / tahun</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                            <p class="text-lg font-medium text-gray-900">{{ $kredit->tanggal_pengajuan->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Nasabah</h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Nama Lengkap</label>
                                <p class="text-gray-900 font-medium">{{ $kredit->nasabah->nama_lengkap }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">No. Nasabah</label>
                                <p class="text-gray-900 font-medium">{{ $kredit->nasabah->no_nasabah }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">NIK</label>
                                <p class="text-gray-900 font-medium">{{ $kredit->nasabah->nik }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Telepon</label>
                                <p class="text-gray-900 font-medium">{{ $kredit->nasabah->telepon }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tujuan Pengajuan</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $kredit->tujuan_pengajuan }}</p>
                    </div>

                    @if($kredit->catatan)
                    <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Catatan</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $kredit->catatan }}</p>
                    </div>
                    @endif

                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Dokumen Pendukung</h3>
                        @if($dokumens->count() > 0)
                        <div class="space-y-6">
                            @foreach($dokumens as $dokumen)
                            @php
                                $extension = strtolower(pathinfo($dokumen->nama_file, PATHINFO_EXTENSION));
                                $fileExists = $dokumen->file_path && \Storage::disk('public')->exists($dokumen->file_path);
                                $fileUrl = $fileExists ? route('dokumen.view', $dokumen->id) : null;
                            @endphp
                            <div class="border border-gray-200 rounded-lg p-5">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $dokumen->jenis_dokumen }}</p>
                                        <p class="text-sm text-gray-500 break-all">{{ $dokumen->nama_file }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Tanggal: {{ $dokumen->tanggal_upload->format('d M Y') }}</p>
                                        @if($dokumen->keterangan)
                                        <p class="text-sm text-gray-700 mt-2">{{ $dokumen->keterangan }}</p>
                                        @endif
                                    </div>
                                    @if($fileExists)
                                    <div class="flex items-center gap-3">
                                        <a href="{{ $fileUrl }}" target="_blank" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg">Lihat</a>
                                        <a href="{{ route('dokumen.download', $dokumen->id) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg">Download</a>
                                    </div>
                                    @endif
                                </div>

                                @if($fileExists && $extension === 'pdf')
                                <div class="border border-gray-200 rounded-lg overflow-hidden h-96">
                                    <iframe src="{{ $fileUrl }}" class="w-full h-full" frameborder="0"></iframe>
                                </div>
                                @elseif($fileExists && in_array($extension, ['jpg', 'jpeg', 'png']))
                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <img src="{{ $fileUrl }}" alt="{{ $dokumen->nama_file }}" class="w-full h-auto">
                                </div>
                                @elseif(!$fileExists)
                                <div class="bg-red-50 text-red-700 text-sm font-semibold rounded-lg p-4">File dokumen tidak ditemukan.</div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500 text-center py-8">Belum ada dokumen pendukung untuk nasabah ini.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
