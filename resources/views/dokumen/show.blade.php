<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('dokumen.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 mb-4 transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali ke Daftar Dokumen
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detail Dokumen Nasabah</h1>
                <p class="text-gray-600 mt-1">Informasi lengkap dokumen yang diupload</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Document Info Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Header Card -->
                        <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-8 text-white text-center">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <svg class="w-10 h-10 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold">{{ $dokumen->jenis_dokumen }}</h3>
                            <p class="text-purple-200 text-sm mt-2">ID Dokumen: #{{ $dokumen->id }}</p>
                        </div>

                        <!-- Info Details -->
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Nama File</label>
                                <p class="text-gray-900 font-medium mt-1 break-all">{{ $dokumen->nama_file }}</p>
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Tanggal Upload</label>
                                <p class="text-gray-900 font-medium mt-1">
                                    {{ \Carbon\Carbon::parse($dokumen->tanggal_upload)->format('d F Y') }}
                                </p>
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Diupload Oleh</label>
                                <div class="flex items-center mt-2">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-purple-600 text-sm font-semibold">
                                            {{ $dokumen->user ? strtoupper(substr($dokumen->user->name, 0, 1)) : '?' }}
                                        </span>
                                    </div>
                                    <span class="text-gray-900 font-medium">{{ $dokumen->user ? $dokumen->user->name : 'Unknown' }}</span>
                                </div>
                            </div>

                            @if($dokumen->file_path && \Storage::disk('public')->exists($dokumen->file_path))
                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Ukuran File</label>
                                <p class="text-gray-900 font-medium mt-1">
                                    {{ number_format(\Storage::disk('public')->size($dokumen->file_path) / 1024, 2) }} KB
                                </p>
                            </div>
                            @endif

                            @if($dokumen->keterangan)
                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Keterangan</label>
                                <p class="text-gray-700 mt-1 leading-relaxed">{{ $dokumen->keterangan }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="px-6 pb-6 space-y-3">
                            @if($dokumen->file_path && \Storage::disk('public')->exists($dokumen->file_path))
                            <a href="{{ route('dokumen.download', $dokumen->id) }}" class="w-full inline-flex justify-center items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Download File
                            </a>
                            @else
                            <div class="w-full px-4 py-3 bg-red-100 text-red-700 text-sm font-semibold rounded-lg text-center">
                                ⚠️ File tidak tersedia
                            </div>
                            @endif

                            <a href="{{ route('dokumen.edit', $dokumen->id) }}" class="w-full inline-flex justify-center items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Dokumen
                            </a>

                            <form action="{{ route('dokumen.destroy', $dokumen->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-lg transition duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Hapus Dokumen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Nasabah Info & Preview -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Nasabah Information -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Nasabah
                        </h3>

                        @if($dokumen->nasabah)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <label class="text-xs text-blue-600 font-semibold uppercase tracking-wide">Nama Lengkap</label>
                                <p class="text-gray-900 font-bold text-lg mt-1">{{ $dokumen->nasabah->nama_lengkap }}</p>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-4">
                                <label class="text-xs text-blue-600 font-semibold uppercase tracking-wide">No. Nasabah</label>
                                <p class="text-gray-900 font-bold text-lg mt-1">{{ $dokumen->nasabah->no_nasabah }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs text-gray-600 font-semibold uppercase tracking-wide">NIK</label>
                                <p class="text-gray-900 font-medium mt-1">{{ $dokumen->nasabah->nik }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="text-xs text-gray-600 font-semibold uppercase tracking-wide">Telepon</label>
                                <p class="text-gray-900 font-medium mt-1">{{ $dokumen->nasabah->telepon }}</p>
                            </div>

                            <div class="md:col-span-2 bg-gray-50 rounded-lg p-4">
                                <label class="text-xs text-gray-600 font-semibold uppercase tracking-wide">Alamat</label>
                                <p class="text-gray-900 font-medium mt-1">{{ $dokumen->nasabah->alamat }}</p>
                            </div>

                            <div class="md:col-span-2 text-center pt-4">
                                <a href="{{ route('nasabah.show', $dokumen->nasabah->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                                    Lihat Detail Lengkap Nasabah
                                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="text-red-800 font-semibold">Data Nasabah Tidak Ditemukan</h4>
                                    <p class="text-red-700 text-sm mt-1">Nasabah yang terkait dengan dokumen ini mungkin sudah dihapus dari sistem.</p>
                                    <p class="text-red-600 text-xs mt-2">Nasabah ID: {{ $dokumen->nasabah_id ?? 'NULL' }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Document Preview -->
                    @if($dokumen->file_path && \Storage::disk('public')->exists($dokumen->file_path))
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            Preview Dokumen
                        </h3>

                        @php
                            $extension = strtolower(pathinfo($dokumen->nama_file, PATHINFO_EXTENSION));
                            $fileUrl = \Storage::url($dokumen->file_path);
                        @endphp

                        @if($extension === 'pdf')
                        <!-- PDF Preview -->
                        <div class="border-4 border-gray-200 rounded-lg overflow-hidden" style="height: 700px;">
                            <iframe src="{{ $fileUrl }}" class="w-full h-full" frameborder="0"></iframe>
                        </div>
                        <p class="text-center text-sm text-gray-500 mt-4">
                            💡 Tip: Klik tombol "Download File" jika preview tidak muncul
                        </p>
                        @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                        <!-- Image Preview -->
                        <div class="border-4 border-gray-200 rounded-lg overflow-hidden">
                            <img src="{{ $fileUrl }}" alt="{{ $dokumen->nama_file }}" class="w-full h-auto">
                        </div>
                        @else
                        <!-- Unsupported Format -->
                        <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-12 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-gray-600 font-semibold">Preview tidak tersedia untuk tipe file ini</p>
                            <p class="text-gray-500 text-sm mt-2">File: {{ strtoupper($extension) }}</p>
                            <a href="{{ route('dokumen.download', $dokumen->id) }}" class="mt-4 inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition duration-200">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Download untuk Melihat
                            </a>
                        </div>
                        @endif
                    </div>
                    @else
                    <!-- File Not Found -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="text-yellow-800 font-semibold">File Tidak Ditemukan</h4>
                                    <p class="text-yellow-700 text-sm mt-1">File dokumen tidak tersedia di server. File mungkin sudah dihapus atau dipindahkan.</p>
                                    <p class="text-yellow-600 text-xs mt-2">Path: {{ $dokumen->file_path ?? 'NULL' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>