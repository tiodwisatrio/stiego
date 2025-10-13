<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        @include('layouts.partials.navbar') {{-- atau 'partials.navbar' sesuai struktur --}}

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts.partials.footer') {{-- atau 'partials.footer' sesuai struktur --}}
    </div>
</body>
