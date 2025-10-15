<nav x-data="{ open: false }">
    <div class="container mx-auto px-10">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('frontend.home') }}" class="text-xl font-bold text-gray-800">
                    <img src="{{ asset('images/logo_stiego.png') }}" alt="StiegoApp Logo" class="h-8 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex space-x-6">
                <a href="{{ route('frontend.home') }}" 
                   class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium 
                          {{ request()->routeIs('frontend.home') ? 'text-red-600' : '' }}">
                    Home
                </a>
                <a href="{{ route('frontend.about') }}" 
                   class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('frontend.about') ? 'text-red-600' : '' }}">
                    About
                </a>
                <a href="{{ route('frontend.catalog.index') }}" 
                   class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('frontend.catalog.*') ? 'text-red-600' : '' }}">
                    Catalog
                </a>
                <a href="{{ route('frontend.products.index') }}" 
                   class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('frontend.products.*') ? 'text-red-600' : '' }}">
                    Products
                </a>
                <a href="{{ route('frontend.contact') }}" 
                   class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('frontend.contact') ? 'text-red-600' : '' }}">
                    Contact
                </a>
            </div>

            <!-- Cart & Login -->
            <div class="hidden sm:flex items-center space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('frontend.cart.index') }}" 
                   class="relative text-gray-700 hover:text-red-600 p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @php
                        $cartCount = count(session()->get('cart', []));
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                
                <!-- Login Button -->
                <a href="{{ route('login') }}" 
                   class="px-8 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition duration-150 ease-in-out text-sm">
                    Login
                </a>
            </div>

            <!-- Mobile Cart & Menu -->
            <div class="sm:hidden flex items-center space-x-2">
                <!-- Mobile Cart Icon -->
                <a href="{{ route('frontend.cart.index') }}" 
                   class="relative text-gray-700 hover:text-red-600 p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @php
                        $cartCount = count(session()->get('cart', []));
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                
                <!-- Mobile menu button -->
                <button @click="open = !open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-red-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-500">
                    <svg class="h-6 w-6" x-show="!open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-show="open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" class="sm:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('frontend.home') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-gray-100
                      {{ request()->routeIs('frontend.home') ? 'text-red-600 bg-gray-100' : '' }}">
                Home
            </a>

            <a href="{{ route('frontend.about') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-gray-100
                      {{ request()->routeIs('frontend.about') ? 'text-red-600 bg-gray-100' : '' }}">
                About
            </a>
            <a href="{{ route('frontend.catalog.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-gray-50
                      {{ request()->routeIs('frontend.catalog.*') ? 'text-red-600 bg-gray-100' : '' }}">
                Catalog
            </a>
            <a href="{{ route('frontend.products.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-gray-50
                      {{ request()->routeIs('frontend.products.*') ? 'text-red-600 bg-gray-100' : '' }}">
                Products
            </a>
            <a href="{{ route('frontend.contact') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-gray-100
                      {{ request()->routeIs('frontend.contact') ? 'text-red-600 bg-gray-100' : '' }}">
                Contact
            </a>
            <div class="mt-4 px-3">
                <a href="{{ route('login') }}" 
                   class="block w-full px-4 py-2 bg-red-600 text-white text-center rounded-md hover:bg-red-700 transition duration-150 ease-in-out">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>