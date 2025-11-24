<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-xl p-8 mb-8 text-white">
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-blue-100">Sistem Informasi Manajemen Arsip Dokumen Nasabah PT BPR Sarimadu</p>
                <div class="mt-4 inline-block bg-white/20 px-4 py-2 rounded-lg">
                    <span class="text-sm font-semibold">Role: {{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold">Total Nasabah</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_nasabah'] }}</p>
                        </div>
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold">Total Kredit</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_kredit'] }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold">Total Dokumen</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_dokumen'] }}</p>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold">Kredit Pending</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['kredit_pending'] }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Kredit -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Pengajuan Kredit Terbaru</h2>
                    </div>
                    <div class="p-6">
                        @if($recent_kredits->count() > 0)
                        <div class="space-y-4">
                            @foreach($recent_kredits as $kredit)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">{{ $kredit->nasabah->nama_lengkap }}</p>
                                    <p class="text-sm text-gray-600">{{ $kredit->jenis_kredit }} - Rp {{ number_format($kredit->jumlah_pengajuan, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $kredit->tanggal_pengajuan->format('d M Y') }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($kredit->status == 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($kredit->status == 'Disetujui') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $kredit->status }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500 text-center py-8">Belum ada pengajuan kredit</p>
                        @endif
                        <a href="{{ route('kredit.index') }}" class="block mt-4 text-center text-blue-600 hover:text-blue-800 font-semibold">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <!-- Recent Documents -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Dokumen Terbaru</h2>
                    </div>
                    <div class="p-6">
                        @if($recent_dokumens->count() > 0)
                        <div class="space-y-4">
                            @foreach($recent_dokumens as $dokumen)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center space-x-3 flex-1">
                                    <div class="bg-purple-100 p-2 rounded">
                                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $dokumen->jenis_dokumen }}</p>
                                        <p class="text-sm text-gray-600">{{ $dokumen->nasabah->nama_lengkap }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $dokumen->tanggal_upload->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500 text-center py-8">Belum ada dokumen</p>
                        @endif
                        <a href="{{ route('dokumen.index') }}" class="block mt-4 text-center text-blue-600 hover:text-blue-800 font-semibold">
                            Lihat Semua →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('nasabah.create') }}" class="flex flex-col items-center justify-center p-6 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                        <svg class="w-10 h-10 text-blue-600 mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Tambah Nasabah</span>
                    </a>
                    <a href="{{ route('kredit.create') }}" class="flex flex-col items-center justify-center p-6 bg-green-50 rounded-lg hover:bg-green-100 transition">
                        <svg class="w-10 h-10 text-green-600 mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Ajukan Kredit</span>
                    </a>
                    <a href="{{ route('dokumen.create') }}" class="flex flex-col items-center justify-center p-6 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                        <svg class="w-10 h-10 text-purple-600 mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Upload Dokumen</span>
                    </a>
                    <a href="{{ route('laporan.riwayat') }}" class="flex flex-col items-center justify-center p-6 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                        <svg class="w-10 h-10 text-yellow-600 mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Lihat Laporan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>