<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Laporan & Riwayat Sistem</h1>
                    <p class="text-gray-600 mt-1">Riwayat aktivitas dan laporan sistem</p>
                </div>
                @unless(Auth::user()->isAdmin())
                <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Laporan
                </a>
                @endunless
            </div>

            <!-- Laporan List -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Riwayat Aktivitas & Laporan</h2>
                    <span class="px-4 py-2 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                        {{ $laporans->count() }} Laporan
                    </span>
                </div>
                <div class="space-y-4">
                    @forelse($laporans as $laporan)
                    <div class="border border-gray-200 rounded-lg p-6 hover:bg-gray-50 hover:shadow-md transition duration-200">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $laporan->jenis_laporan }}</span>
                                    <span class="text-sm text-gray-500">{{ $laporan->tanggal_laporan->format('d F Y') }}</span>
                                    <span class="text-sm text-gray-500">• {{ $laporan->user->name }}</span>
                                </div>
                                <p class="text-gray-900 font-medium leading-relaxed">{{ $laporan->deskripsi }}</p>
                            </div>
                            <a href="{{ route('laporan.show', $laporan) }}" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition duration-200">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-gray-500 text-lg font-semibold">Belum ada riwayat laporan</p>
                        <p class="text-gray-400 text-sm mt-2">Belum ada aktivitas laporan yang tercatat</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
