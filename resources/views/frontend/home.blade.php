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




    <!-- New Arrivals -->
    
</main>
@endsection
