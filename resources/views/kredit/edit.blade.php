<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('kredit.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Edit Pengajuan Kredit</h1>
                <p class="text-gray-600 mt-1">Update data pengajuan kredit</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                    <p class="text-sm text-green-700 font-semibold">No. Pengajuan: {{ $kredit->no_pengajuan }}</p>
                </div>

                <form action="{{ route('kredit.update', $kredit) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Nasabah <span class="text-red-500">*</span></label>
                            <select name="nasabah_id" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-green-500">
                                @foreach($nasabahs as $nasabah)
                                <option value="{{ $nasabah->id }}" {{ $kredit->nasabah_id == $nasabah->id ? 'selected' : '' }}>
                                    {{ $nasabah->no_nasabah }} - {{ $nasabah->nama_lengkap }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kredit <span class="text-red-500">*</span></label>
                            <select name="jenis_kredit" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-green-500">
                                <option value="KUR" {{ $kredit->jenis_kredit == 'KUR' ? 'selected' : '' }}>KUR</option>
                                <option value="KPR" {{ $kredit->jenis_kredit == 'KPR' ? 'selected' : '' }}>KPR</option>
                                <option value="Kredit Usaha" {{ $kredit->jenis_kredit == 'Kredit Usaha' ? 'selected' : '' }}>Kredit Usaha</option>
                                <option value="Kredit Konsumtif" {{ $kredit->jenis_kredit == 'Kredit Konsumtif' ? 'selected' : '' }}>Kredit Konsumtif</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pengajuan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_pengajuan" value="{{ $kredit->tanggal_pengajuan->format('Y-m-d') }}" required class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Pengajuan <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-500">Rp</span>
                                <input type="number" name="jumlah_pengajuan" value="{{ $kredit->jumlah_pengajuan }}" required class="w-full pl-12 pr-4 py-3 border rounded-lg">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jangka Waktu (Bulan) <span class="text-red-500">*</span></label>
                            <input type="number" name="jangka_waktu" value="{{ $kredit->jangka_waktu }}" required class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Bunga (%) <span class="text-red-500">*</span></label>
                            <input type="number" name="bunga" value="{{ $kredit->bunga }}" step="0.01" required class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-green-500">
                                <option value="Pending" {{ $kredit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Disetujui" {{ $kredit->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ $kredit->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tujuan Pengajuan <span class="text-red-500">*</span></label>
                            <textarea name="tujuan_pengajuan" rows="4" required class="w-full px-4 py-3 border rounded-lg">{{ $kredit->tujuan_pengajuan }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
                            <textarea name="catatan" rows="3" class="w-full px-4 py-3 border rounded-lg" placeholder="Catatan tambahan (opsional)">{{ $kredit->catatan }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t">
                        <a href="{{ route('kredit.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg">Batal</a>
                        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>