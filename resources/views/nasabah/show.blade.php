<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <a href="{{ route('nasabah.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Kembali
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Nasabah</h1>
                    <p class="text-gray-600 mt-1">Informasi lengkap nasabah {{ $nasabah->nama_lengkap }}</p>
                </div>
                <a href="{{ route('nasabah.edit', $nasabah) }}" class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow-lg transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                    Edit Data
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-center">
                            <div class="mx-auto w-32 h-32 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                                {{ substr($nasabah->nama_lengkap, 0, 1) }}
                            </div>
                            <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $nasabah->nama_lengkap }}</h2>
                            <p class="text-blue-600 font-semibold mt-1">{{ $nasabah->no_nasabah }}</p>
                            <div class="mt-4 inline-block bg-green-100 px-4 py-2 rounded-full">
                                <span class="text-green-800 text-sm font-semibold">Nasabah Aktif</span>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="space-y-4">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500">Terdaftar sejak</p>
                                        <p class="font-semibold">{{ $nasabah->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500">Diinput oleh</p>
                                        <p class="font-semibold">{{ $nasabah->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="lg:col-span-2">
                    <!-- Personal Info -->
                    <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Pribadi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">NIK</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $nasabah->nik }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Tanggal Lahir</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $nasabah->tanggal_lahir->format('d F Y') }} ({{ $nasabah->tanggal_lahir->age }} tahun)</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Jenis Kelamin</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $nasabah->jenis_kelamin }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Pekerjaan</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $nasabah->pekerjaan }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Penghasilan</label>
                                <p class="mt-1 text-gray-900 font-medium">
                                    {{ $nasabah->penghasilan ? 'Rp ' . number_format($nasabah->penghasilan, 0, ',', '.') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            Informasi Kontak
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Nomor Telepon</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $nasabah->telepon }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-500 font-semibold">Email</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $nasabah->email ?: '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-sm text-gray-500 font-semibold">Alamat Lengkap</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $nasabah->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kredit History -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Riwayat Kredit
                        </h3>
                        @if($nasabah->kredits->count() > 0)
                        <div class="space-y-4">
                            @foreach($nasabah->kredits as $kredit)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $kredit->jenis_kredit }}</p>
                                        <p class="text-sm text-gray-600 mt-1">{{ $kredit->no_pengajuan }}</p>
                                        <p class="text-sm text-gray-500 mt-1">Rp {{ number_format($kredit->jumlah_pengajuan, 0, ',', '.') }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($kredit->status == 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($kredit->status == 'Disetujui') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $kredit->status }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500 text-center py-8">Belum ada riwayat kredit</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>