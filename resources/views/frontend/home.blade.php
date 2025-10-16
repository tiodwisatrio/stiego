@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row items-center justify-between gap-8 py-8 lg:py-16">
        <!-- Left Side - Text Content -->
        <div class="w-full lg:w-5/12 space-y-6 px-0 lg:px-5">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 text-center lg:text-left">
                Ingin tampil stylish dengan pakaian yang trendy & kekinian?
            </h1>
            <p class="text-lg text-gray-600 text-center lg:text-left">
                Kami punya solusi nya, tunjukan karakter kamu lewat outfit dari stiego, dan style yang nunjukin gaya kamu.
            </p>
            <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 pt-6">
                <a href="{{ route('frontend.products.index') }}" 
                   class="w-full sm:w-auto px-8 py-4 rounded-full bg-[#B62127] text-white font-medium hover:bg-[#FF0000] transition-colors text-center">
                    Belanja Sekarang
                </a>
                <a href="#promo" 
                   class="w-full sm:w-auto px-8 py-4 rounded-full border-2 border-[#B62127] text-[#B62127] font-medium hover:bg-[#FF0000] hover:text-white transition-colors text-center">
                    Lihat Promo
                </a>
            </div>
        </div>

        <!-- Right Side - Image Grid -->
        <div class="w-full lg:w-7/12 mt-8 lg:mt-0">
            <div class="grid grid-cols-4 gap-3 md:gap-4">
                <!-- Main large image (takes 3 columns) -->
                <div class="col-span-3">
                    <img src="{{ asset('images/image_hero1.png') }}" 
                         alt="Main fashion image"
                         class="w-full h-[250px] sm:h-[300px] md:h-[350px] lg:h-[400px] object-cover rounded-lg shadow-lg">
                </div>
                <!-- Two smaller images stacked vertically -->
                <div class="space-y-3 md:space-y-4">
                    <img src="{{ asset('images/image_hero2.png') }}"
                         alt="Fashion detail 1"
                         class="w-full h-[120px] sm:h-[145px] md:h-[170px] lg:h-[190px] object-cover rounded-lg shadow-md">
                    <img src="{{ asset('images/image_hero3.png') }}"
                         alt="Fashion detail 2"
                         class="w-full h-[120px] sm:h-[145px] md:h-[170px] lg:h-[190px] object-cover rounded-lg shadow-md">
                </div>
            </div>
        </div>
    </div>

<!-- Banner Slider Section -->
<!-- Banner Slider Section -->
<div id="banner-slider" class="relative py-6 md:py-8"
     x-data="{ 
        currentIndex: 0, 
        banners: {{ json_encode($banners) }},
        autoplayInterval: null,
        startX: 0,
        endX: 0,
        isDragging: false,
        
        startAutoplay() {
            this.autoplayInterval = setInterval(() => this.next(), 5000)
        },
        stopAutoplay() {
            clearInterval(this.autoplayInterval)
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.banners.length
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.banners.length) % this.banners.length
        },
        handleStart(e) {
            this.stopAutoplay()
            this.isDragging = true
            this.startX = e.touches ? e.touches[0].clientX : e.clientX
        },
        handleMove(e) {
            if (!this.isDragging) return
            this.endX = e.touches ? e.touches[0].clientX : e.clientX
        },
        handleEnd() {
            if (!this.isDragging) return
            const distance = this.endX - this.startX
            if (Math.abs(distance) > 50) {
                if (distance < 0) this.next()
                else this.prev()
            }
            this.isDragging = false
            this.startAutoplay()
        }
     }"
     x-init="startAutoplay()"
     @mouseenter="stopAutoplay()"
     @mouseleave="startAutoplay()">

    <div class="overflow-hidden rounded-lg relative w-full">
        <!-- Slides Container -->
        <div class="flex transition-transform duration-500 ease-in-out w-full select-none"
             :style="`transform: translateX(-${currentIndex * 100}%);`"
             @mousedown="handleStart($event)"
             @mousemove="handleMove($event)"
             @mouseup="handleEnd()"
             @mouseleave="isDragging && handleEnd()"
             @touchstart="handleStart($event)"
             @touchmove="handleMove($event)"
             @touchend="handleEnd()">
             
            @foreach ($banners as $index => $banner)
            <div class="flex-shrink-0 w-full">
                <div class="w-full aspect-[16/9] sm:aspect-[16/7] md:aspect-[16/6] lg:aspect-[16/5] flex flex-row gap-3">
                    <img src="{{ Storage::url($banner->banner_image) }}" 
                         alt="{{ $banner->banner_title }}" 
                         class="w-full h-full object-contain rounded-lg pointer-events-none">
                </div>
            </div>
            @endforeach
        </div>

        <!-- Previous Button -->
        <button @click.prevent="prev()" 
                class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-1 sm:p-2 rounded-full focus:outline-none z-10">
            <svg class="w-4 sm:w-6 h-4 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <!-- Next Button -->
        <button @click.prevent="next()" 
                class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-1 sm:p-2 rounded-full focus:outline-none z-10">
            <svg class="w-4 sm:w-6 h-4 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    <!-- Dots Navigation -->
    <div class="absolute -bottom-3 sm:-bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        @foreach ($banners as $index => $banner)
        <button @click="currentIndex = {{ $index }}" 
                :class="{'bg-[#B62127]': currentIndex === {{ $index }}, 'bg-gray-400': currentIndex !== {{ $index }}}"
                class="w-2 sm:w-3 h-2 sm:h-3 rounded-full focus:outline-none transition-colors">
        </button>
        @endforeach
    </div>
</div>




    <!-- Product Best Seller -->
    <section id="best-seller" class="py-8 md:py-12">
        <div class="flex flex-row items-center justify-between mb-2 sm:mb-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 sm:text-start md:text-center">🌟Best Sellers</h2>
            <a href="{{ route('frontend.catalog.type', 'best_seller') }}" 
               class="text-sm text-red-600 hover:text-red-700 font-medium">
                View All →
            </a>
        </div>
        @if($bestSellers->isEmpty())
            <p class="text-center text-gray-600">Tidak ada produk best seller saat ini.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach($bestSellers as $product)
                    @include('frontend.catalog.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </section>

    <!-- Product New Series -->
     <section id="best-seller" class="py-8 md:py-12">
        <div class="flex flex-row items-center justify-between mb-2 sm:mb-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 sm:text-start md:text-center">🆕New Series</h2>
            <a href="{{ route('frontend.catalog.type', 'best_seller') }}" 
               class="text-sm text-red-600 hover:text-red-700 font-medium">
                View All →
            </a>
        </div>
        @if($newSeries->isEmpty())
            <p class="text-center text-gray-600">Tidak ada produk new series saat ini.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach($newSeries as $product)
                    @include('frontend.catalog.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </section>

    <!-- Cara Order  -->
     <section class="py-12 bg-white">
    <div class="container mx-auto">
        <!-- Judul -->
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-6">Cara Order</h2>

        <!-- Langkah-langkah -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Step 1 -->
            <div class="border rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 flex items-center justify-center bg-red-700 text-white font-bold rounded-full">
                        1
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Pilih Produk Favoritmu</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Telusuri koleksi kami dan pilih model, ukuran, serta warna yang kamu suka. 
                    Klik tombol “Tambah ke Keranjang” atau langsung “Beli Sekarang”.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="border rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 flex items-center justify-center bg-red-700 text-white font-bold rounded-full">
                        2
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Isi Data & Checkout</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Masukkan nama, alamat pengiriman, dan metode pembayaran di halaman checkout. 
                    Pastikan semua data sudah benar agar pesananmu diproses dengan cepat.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="border rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 flex items-center justify-center bg-red-700 text-white font-bold rounded-full">
                        3
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Konfirmasi via WhatsApp</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Setelah klik “Pesan via WhatsApp”, lalu tim kami akan segera mengonfirmasi dan 
                    memproses pesananmu.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white" 
         x-data="testimonialMarquee({{ json_encode($testimonials) }})" 
         x-init="startAutoplay()">
    <div class="container mx-auto text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-10">Testimonials</h2>

        <div class="relative overflow-hidden group">
            <!-- Track -->
            <div class="flex space-x-6"
                 :style="`transform: translateX(-${offset}px); transition: transform 0.1s linear;`"
                 @mouseenter="pause()" 
                 @mouseleave="resume()">
                
                <!-- Loop card -->
                <template x-for="(item, index) in [...testimonials, ...testimonials]" :key="index">
                    <div class="flex-shrink-0" style="width:400px;">
                        <div class="bg-teal-800 text-white rounded-xl p-5 flex flex-col items-start gap-4 h-full min-h-[200px]">
                            <div class="flex flex-row gap-3">
                                <img :src="item.image" alt="User"
                                     class="w-14 h-14 rounded-md object-cover">
                                <div>
                                    <h3 class="font-semibold text-sm md:text-base text-start" x-text="item.name"></h3>
                                    <p class="text-xs md:text-sm leading-relaxed text-left" x-text="item.message"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Alpine.js Script -->
    <script>
        function testimonialMarquee(testimonialData) {
            return {
                offset: 0,
                speed: 1,
                paused: false,
                testimonials: testimonialData,
                startAutoplay() {
                    const step = () => {
                        if (!this.paused) {
                            this.offset += this.speed;
                            const totalWidth = this.testimonials.length * 400; // width card
                            if (this.offset >= totalWidth) this.offset = 0;
                        }
                        requestAnimationFrame(step);
                    };
                    requestAnimationFrame(step);
                },
                pause() {
                    this.paused = true;
                },
                resume() {
                    this.paused = false;
                }
            };
        }
    </script>
</section>





</main>
@endsection
