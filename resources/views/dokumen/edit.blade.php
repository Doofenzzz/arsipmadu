<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Dokumen</h1>
                    <p class="text-gray-600 mt-1">Perbarui informasi dokumen nasabah</p>
                </div>
                <a href="{{ route('dokumen.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition duration-150">
                    &larr; Kembali
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nasabah_id" class="block text-sm font-semibold text-gray-700 mb-2">Nama Nasabah</label>
                        <select name="nasabah_id" id="nasabah_id" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-200">
                            @foreach($nasabahs as $nasabah)
                                <option value="{{ $nasabah->id }}" {{ $dokumen->nasabah_id == $nasabah->id ? 'selected' : '' }}>
                                    {{ $nasabah->nama_lengkap }} - {{ $nasabah->no_nasabah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="jenis_dokumen" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Dokumen</label>
                        <select name="jenis_dokumen" id="jenis_dokumen" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-200">
                            <option value="KTP" {{ $dokumen->jenis_dokumen == 'KTP' ? 'selected' : '' }}>KTP</option>
                            <option value="KK" {{ $dokumen->jenis_dokumen == 'KK' ? 'selected' : '' }}>Kartu Keluarga</option>
                            <option value="NPWP" {{ $dokumen->jenis_dokumen == 'NPWP' ? 'selected' : '' }}>NPWP</option>
                            <option value="Slip Gaji" {{ $dokumen->jenis_dokumen == 'Slip Gaji' ? 'selected' : '' }}>Slip Gaji</option>
                            <option value="Jaminan" {{ $dokumen->jenis_dokumen == 'Jaminan' ? 'selected' : '' }}>Dokumen Jaminan</option>
                            <option value="Lainnya" {{ $dokumen->jenis_dokumen == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <label class="block text-sm font-semibold text-blue-800 mb-2">File Dokumen</label>
                        
                        <div class="flex items-center mb-3 text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            <span>File saat ini: <strong>{{ $dokumen->nama_file }}</strong></span>
                        </div>

                        <input type="file" name="file" id="file" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-100 file:text-blue-700
                            hover:file:bg-blue-200
                            transition duration-200"
                            accept=".pdf,.jpg,.jpeg,.png">
                        <p class="text-xs text-gray-500 mt-2">*Upload file baru HANYA JIKA ingin mengganti file lama.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggal_upload" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dokumen</label>
                            <input type="date" name="tanggal_upload" id="tanggal_upload" 
                                value="{{ $dokumen->tanggal_upload->format('Y-m-d') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-200">
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">Keterangan (Opsional)</label>
                            <input type="text" name="keterangan" id="keterangan" 
                                value="{{ $dokumen->keterangan }}"
                                class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-200" 
                                placeholder="Contoh: Scan asli">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200 transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>