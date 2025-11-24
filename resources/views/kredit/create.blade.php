<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('kredit.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Ajukan Kredit Baru</h1>
                <p class="text-gray-600 mt-1">Lengkapi form pengajuan kredit</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('kredit.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nasabah -->
                        <div class="md:col-span-2">
                            <label for="nasabah_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Nasabah <span class="text-red-500">*</span></label>
                            <select name="nasabah_id" id="nasabah_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('nasabah_id') border-red-500 @enderror">
                                <option value="">-- Pilih Nasabah --</option>
                                @foreach($nasabahs as $nasabah)
                                <option value="{{ $nasabah->id }}" {{ old('nasabah_id') == $nasabah->id ? 'selected' : '' }}>
                                    {{ $nasabah->no_nasabah }} - {{ $nasabah->nama_lengkap }}
                                </option>
                                @endforeach
                            </select>
                            @error('nasabah_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kredit -->
                        <div>
                            <label for="jenis_kredit" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kredit <span class="text-red-500">*</span></label>
                            <select name="jenis_kredit" id="jenis_kredit" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('jenis_kredit') border-red-500 @enderror">
                                <option value="">Pilih Jenis Kredit</option>
                                <option value="KUR" {{ old('jenis_kredit') == 'KUR' ? 'selected' : '' }}>KUR (Kredit Usaha Rakyat)</option>
                                <option value="KPR" {{ old('jenis_kredit') == 'KPR' ? 'selected' : '' }}>KPR (Kredit Pemilikan Rumah)</option>
                                <option value="Kredit Usaha" {{ old('jenis_kredit') == 'Kredit Usaha' ? 'selected' : '' }}>Kredit Usaha</option>
                                <option value="Kredit Konsumtif" {{ old('jenis_kredit') == 'Kredit Konsumtif' ? 'selected' : '' }}>Kredit Konsumtif</option>
                            </select>
                            @error('jenis_kredit')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Pengajuan -->
                        <div>
                            <label for="tanggal_pengajuan" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pengajuan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('tanggal_pengajuan') border-red-500 @enderror">
                            @error('tanggal_pengajuan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Pengajuan -->
                        <div>
                            <label for="jumlah_pengajuan" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Pengajuan <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-500">Rp</span>
                                <input type="number" name="jumlah_pengajuan" id="jumlah_pengajuan" value="{{ old('jumlah_pengajuan') }}" required min="0"
                                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('jumlah_pengajuan') border-red-500 @enderror"
                                       placeholder="50000000">
                            </div>
                            @error('jumlah_pengajuan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jangka Waktu -->
                        <div>
                            <label for="jangka_waktu" class="block text-sm font-semibold text-gray-700 mb-2">Jangka Waktu (Bulan) <span class="text-red-500">*</span></label>
                            <input type="number" name="jangka_waktu" id="jangka_waktu" value="{{ old('jangka_waktu') }}" required min="1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('jangka_waktu') border-red-500 @enderror"
                                   placeholder="12">
                            @error('jangka_waktu')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bunga -->
                        <div>
                            <label for="bunga" class="block text-sm font-semibold text-gray-700 mb-2">Bunga (%) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" name="bunga" id="bunga" value="{{ old('bunga') }}" required min="0" max="100" step="0.01"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('bunga') border-red-500 @enderror"
                                       placeholder="6.5">
                                <span class="absolute right-4 top-3.5 text-gray-500">%</span>
                            </div>
                            @error('bunga')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tujuan Pengajuan -->
                        <div class="md:col-span-2">
                            <label for="tujuan_pengajuan" class="block text-sm font-semibold text-gray-700 mb-2">Tujuan Pengajuan <span class="text-red-500">*</span></label>
                            <textarea name="tujuan_pengajuan" id="tujuan_pengajuan" rows="4" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('tujuan_pengajuan') border-red-500 @enderror"
                                      placeholder="Jelaskan tujuan pengajuan kredit...">{{ old('tujuan_pengajuan') }}</textarea>
                            @error('tujuan_pengajuan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-sm text-blue-700 font-semibold">Informasi</p>
                                <p class="text-xs text-blue-600 mt-1">Pengajuan kredit akan diproses oleh tim kami. Status pengajuan akan diupdate dalam 3-5 hari kerja.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('kredit.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                            Ajukan Kredit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>