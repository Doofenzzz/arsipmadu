<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('laporan.index') }}" class="inline-flex items-center text-yellow-600 hover:text-yellow-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detail Laporan</h1>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="border-b pb-6 mb-6">
                    <span class="px-4 py-2 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $laporan->jenis_laporan }}</span>
                    <p class="text-sm text-gray-500 mt-4">Tanggal: {{ $laporan->tanggal_laporan->format('d F Y') }}</p>
                    <p class="text-sm text-gray-500">Dibuat oleh: {{ $laporan->user->name }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Laporan</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $laporan->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>