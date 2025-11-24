<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl">
            <!-- Logo Bank -->
            <div class="flex justify-center">
                <div class="w-65 h-15 mb-4 relative">
                     <img src="{{ asset('/assets/LOGO_PANJANG_OK.png') }}" 
                         alt="Logo BPR Sarimadu" 
                         class="w-full h-full object-contain"
                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center text-gray-400 text-xs text-center p-2\'>[LOGO 200x200]</div>'">
                </div>
            </div>
            <!-- Header -->
            <div class="text-center">
                <p class="text-gray-600">Sistem Manajemen Arsip Dokumen Nasabah</p>
                <p class="text-sm text-gray-500 mt-2">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                    <x-text-input id="email" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                  type="email" 
                                  name="email" 
                                  :value="old('email')" 
                                  required 
                                  autofocus 
                                  autocomplete="username" 
                                  placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                    <x-text-input id="password" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                  type="password"
                                  name="password"
                                  required 
                                  autocomplete="current-password"
                                  placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="space-y-4">
                    <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5">
                        {{ __('Login') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Footer -->
            <div class="text-center pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500">© 2025 PT BPR Sarimadu. All rights reserved.</p>
            </div>
        </div>
    </div>
</x-guest-layout>