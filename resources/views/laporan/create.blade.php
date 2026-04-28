<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('laporan.riwayat') }}" class="inline-flex items-center text-yellow-600 hover:text-yellow-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Buat Laporan Baru</h1>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('laporan.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Laporan <span class="text-red-500">*</span></label>
                            <select name="jenis_laporan" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500">
                                <option value="">-- Pilih Jenis Laporan --</option>
                                <option value="Nasabah">Laporan Nasabah</option>
                                <option value="Kredit">Laporan Kredit</option>
                                <option value="Dokumen">Laporan Dokumen</option>
                                <option value="Transaksi">Laporan Transaksi</option>
                            </select>
                            @error('jenis_laporan')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Laporan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_laporan" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 border rounded-lg">
                            @error('tanggal_laporan')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Laporan <span class="text-red-500">*</span></label>
                            <textarea name="deskripsi" rows="6" required class="w-full px-4 py-3 border rounded-lg" placeholder="Tulis deskripsi lengkap laporan..."></textarea>
                            @error('deskripsi')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t">
                        <a href="{{ route('laporan.riwayat') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg">Batal</a>
                        <button type="submit" class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg">Simpan Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
