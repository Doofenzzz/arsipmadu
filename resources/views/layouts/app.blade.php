<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'PT BPR Sarimadu' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-gradient-to-r from-blue-700 to-blue-600 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::user()->isAdmin() ? route('laporan.riwayat') : route('home') }}" class="flex items-center space-x-3 group">
                        <div class="bg-white/10 p-2 rounded-lg backdrop-blur-sm group-hover:bg-white/20 transition duration-300">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        </div>
                        <div class="text-white">
                            <h1 class="text-lg font-bold leading-tight">PT BPR Sarimadu</h1>
                            <p class="text-[10px] text-blue-200 font-medium tracking-wider">ARSIP DIGITAL</p>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex items-center">
                    @php
                        $navClass = "px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out ";
                        $activeClass = "bg-blue-800 text-white shadow-inner";
                        $inactiveClass = "text-blue-100 hover:bg-blue-500/50 hover:text-white";
                    @endphp

                    {{-- --- LOGIKA NON-ADMIN (NASABAH) --- --}}
                    {{-- Kalau BUKAN admin, tampilin menu-menu ini --}}
                    @if(!Auth::user()->isAdmin())
                        <a href="{{ route('home') }}" class="{{ $navClass }} {{ request()->routeIs('home') ? $activeClass : $inactiveClass }}">
                            Home
                        </a>
                        <a href="{{ route('about') }}" class="{{ $navClass }} {{ request()->routeIs('about') ? $activeClass : $inactiveClass }}">
                            Tentang Bank
                        </a>
                        <a href="{{ route('nasabah.index') }}" class="{{ $navClass }} {{ request()->routeIs('nasabah.*') ? $activeClass : $inactiveClass }}">
                            Data Nasabah
                        </a>
                        <a href="{{ route('kredit.index') }}" class="{{ $navClass }} {{ request()->routeIs('kredit.*') ? $activeClass : $inactiveClass }}">
                            Pengajuan Kredit
                        </a>
                    @endif

                    {{-- --- LOGIKA SHARED (SEMUA BISA LIHAT) --- --}}
                    {{-- Karena Admin dan Nasabah sama-sama butuh akses Laporan --}}
                    <a href="{{ route('laporan.riwayat') }}" class="{{ $navClass }} {{ request()->routeIs('laporan.*') ? $activeClass : $inactiveClass }}">
                        Laporan
                    </a>

                    {{-- --- LOGIKA KHUSUS ADMIN --- --}}
                    {{-- Cuma Admin yang bisa lihat ini --}}
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.users.index') }}" class="{{ $navClass }} {{ request()->routeIs('admin.*') ? $activeClass : $inactiveClass }}">
                            Kelola User
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-white bg-blue-800/50 hover:bg-blue-800 focus:outline-none transition ease-in-out duration-150 backdrop-blur-sm">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center mr-2 border-2 border-blue-400">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                        <div class="px-4 py-3 border-b bg-gray-50">
                            <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
        <!-- Page Content -->
        <main>
            @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>
</html>
