<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl">
            <!-- Logo Bank -->
            <div class="flex justify-center">
                <div class="bg-blue-600 p-4 rounded-xl shadow-lg">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </div>
            </div>

            <!-- Header -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Akun Staff</h2>
                <p class="text-gray-600">PT BPR Sarimadu</p>
                <p class="text-sm text-gray-500 mt-2">Lengkapi data diri Anda untuk mendaftar</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-semibold" />
                        <x-text-input id="name" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                      type="text" 
                                      name="name" 
                                      :value="old('name')" 
                                      required 
                                      autofocus 
                                      autocomplete="name" 
                                      placeholder="Nama lengkap Anda" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                        <x-text-input id="email" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                      type="email" 
                                      name="email" 
                                      :value="old('email')" 
                                      required 
                                      autocomplete="username" 
                                      placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-input-label for="phone" :value="__('Nomor Telepon')" class="text-gray-700 font-semibold" />
                        <x-text-input id="phone" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                      type="text" 
                                      name="phone" 
                                      :value="old('phone')" 
                                      placeholder="08xxxxxxxxxx" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Role (Hidden, default to staff) -->
                    <input type="hidden" name="role" value="staff">

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <x-input-label for="address" :value="__('Alamat')" class="text-gray-700 font-semibold" />
                        <textarea id="address" name="address" rows="3" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" placeholder="Alamat lengkap Anda">{{ old('address') }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                        <x-text-input id="password" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                      type="password"
                                      name="password"
                                      required 
                                      autocomplete="new-password" 
                                      placeholder="Min. 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold" />
                        <x-text-input id="password_confirmation" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                      type="password"
                                      name="password_confirmation"
                                      required 
                                      autocomplete="new-password" 
                                      placeholder="Ulangi password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="space-y-4 pt-4">
                    <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5">
                        {{ __('Daftar') }}
                    </x-primary-button>

                    <div class="text-center">
                        <span class="text-gray-600">Sudah punya akun? </span>
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                            Login Sekarang
                        </a>
                    </div>
                </div>
            </form>

            <!-- Footer -->
            <div class="text-center pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500">© 2024 PT BPR Sarimadu. All rights reserved.</p>
            </div>
        </div>
    </div>
</x-guest-layout>