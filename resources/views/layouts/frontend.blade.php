<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}?v={{ time() }}"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fallback styles untuk production -->
    @production
        @php
            $manifestPath = public_path('build/manifest.json');
            $manifest = json_decode(file_get_contents($manifestPath), true);
            $cssFile = $manifest['resources/css/app.css']['file'];
        @endphp
        <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
    @endproduction
    
    <!-- Prevent FOUC -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        @include('layouts.partials.frontend.navbar')
        
        <main class="px-8">
            @yield('content')
        </main>
        
        @include('layouts.partials.frontend.footer')
    </div>
    
    @stack('scripts')
</body>
<script>
        document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.bannerSwiper', {
            // Opsi konfigurasi
            loop: true, // Membuat slider berputar terus-menerus
            
            // Konfigurasi untuk dots/indikator
            pagination: {
                el: '.swiper-pagination', // Target elemen untuk dots
                clickable: true, // Membuat dots bisa diklik
            },

            // Konfigurasi untuk tombol navigasi (opsional)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Konfigurasi autoplay (opsional)
            autoplay: {
                delay: 3000, // Waktu perpindahan slide (dalam milidetik)
                disableOnInteraction: false, // Autoplay tidak berhenti saat user interaksi
            },
        });
    });
</script>
</html>