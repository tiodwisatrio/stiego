<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if (file_exists(public_path('build/manifest.json')))
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
            $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
        @endphp
        @if($cssFile)
            <link rel="stylesheet" href="/build/{{ $cssFile }}">
        @endif
        @if($jsFile)
            <script type="module" src="/build/{{ $jsFile }}"></script>
        @endif
    @else
        <link rel="stylesheet" href="/build/assets/app-Yn1F0h7W.css">
        <script type="module" src="/build/assets/app-CXDpL9bK.js"></script>
    @endif
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-white shadow-sm w-64">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-white border-b border-gray-200">
                <span class="text-2xl font-semibold text-gray-800">Stiego Admin</span>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <div class="px-4 space-y-4">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Categories -->
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Categories
                    </a>

                    <!-- Products -->
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-4m4 0h-4m4 0H8m8 0H8"></path>
                        </svg>
                        Products
                    </a>

                      <!-- Orders -->
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.orders.*') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <!-- <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            
                        </svg> -->
                        <!-- carikan icon orders lain -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1l1 2h13l3-6H6l-3 6zm0 0v6a2 2 0 002 2h13a2 2 0 002-2v-6M16 16a2 2 0 11-4 0 2 2 0 014 0zm6-10h.01M6 16a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Orders
                    </a>

                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <!-- icon testimonials -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        Testimonials
                    </a>

                    <!-- Banners -->
                    <a href="{{ route('admin.banners.index') }}" class="flex items
                        -center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.banners.*') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <!-- Buatkan icons banners/poster/dll -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M4 8V7a3 3 0 013-3h10a3 3 0 013 3v1m-13 4h.01M12 12h.01M16 12h.01M9 16h6"></path>
                        </svg>
                        Banners
                    </a>

                    <!-- Product Highlights -->
                    <a href="{{ route('admin.highlights.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.highlights.*') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <!-- Buatkan icons highlights -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Product Highlights
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} rounded-lg group">
                        <!-- icon users -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        {{ Auth::user()->isDeveloper() ? 'All Users' : 'Customers' }}
                    </a>


                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="ml-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-8 h-16">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-sm focus:outline-none">
                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>