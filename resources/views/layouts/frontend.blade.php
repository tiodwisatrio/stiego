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

    <!-- Scripts -->
    @if (file_exists(public_path('build/manifest.json')))
        {{-- Production: Load dari build --}}
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
    @elseif (file_exists(public_path('hot')))
        {{-- Development: Vite dev server --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Fallback: Direct load --}}
        <link rel="stylesheet" href="/build/assets/app-CjNikGHE.css">
        <link rel="stylesheet" href="/build/assets/app-C8ec8cn4.css">
        <script type="module" src="/build/assets/app-knBiJOF6.js"></script>
    @endif
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        @include('layouts.partials.frontend.navbar')
        
        <main class="px-4">
            @yield('content')
        </main>
        
        @include('layouts.partials.frontend.footer')
    </div>
    
    <!-- Toast Notification -->
    @include('components.toast-notification')
    
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