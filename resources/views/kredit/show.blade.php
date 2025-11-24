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
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Catatan</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $kredit->catatan }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>