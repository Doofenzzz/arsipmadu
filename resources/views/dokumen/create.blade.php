<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('dokumen.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Upload Dokumen Nasabah</h1>
                <p class="text-gray-600 mt-1">Upload dokumen pendukung nasabah</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Nasabah <span class="text-red-500">*</span></label>
                            <select name="nasabah_id" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
                                <option value="">-- Pilih Nasabah --</option>
                                @foreach($nasabahs as $nasabah)
                                <option value="{{ $nasabah->id }}">{{ $nasabah->no_nasabah }} - {{ $nasabah->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            @error('nasabah_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Dokumen <span class="text-red-500">*</span></label>
                            <select name="jenis_dokumen" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
                                <option value="">-- Pilih Jenis Dokumen --</option>
                                <option value="KTP">KTP</option>
                                <option value="Kartu Keluarga">Kartu Keluarga</option>
                                <option value="NPWP">NPWP</option>
                                <option value="Slip Gaji">Slip Gaji</option>
                                <option value="Rekening Koran">Rekening Koran</option>
                                <option value="Sertifikat">Sertifikat</option>
                                <option value="BPKB">BPKB</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('jenis_dokumen')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload File <span class="text-red-500">*</span></label>
                            <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
                            <p class="text-xs text-gray-500 mt-2">Format: PDF, JPG, PNG. Maksimal 5MB</p>
                            @error('file')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Upload <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_upload" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 border rounded-lg">
                            @error('tanggal_upload')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="w-full px-4 py-3 border rounded-lg" placeholder="Keterangan tambahan (opsional)"></textarea>
                            @error('keterangan')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t">
                        <a href="{{ route('dokumen.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg">Batal</a>
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg">Upload Dokumen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>