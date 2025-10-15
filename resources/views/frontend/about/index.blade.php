@extends('layouts.frontend')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- About Stiego -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center ">
            <div class="space-y-6">
                <h6 class="text-red-700 font-semibold">About</h6>
                <h2 class="text-4xl font-semibold text-gray-900">Toko pakaian jadi dengan pilihan variasi dan model yang lengkap untukmu!</h2>
                <p class="text-gray-600 leading-relaxed">
                    Kami punya solusi nya, tunjukan karakter kamu lewat outfit dari stiego, dan style yang nunjukin gaya kamu. Kami menyediakan berbagai pilihan pakaian yang trendy dan kekinian, mulai dari casual wear hingga formal. Setiap produk kami dirancang dengan perhatian terhadap detail dan kualitas bahan terbaik untuk memastikan kenyamanan dan kepuasan pelanggan.
                </p>
               
               <div class="flex flex-wrap justify-center md:justify-between gap-6 mt-8">
                    <div class="text-center p-4 bg-gray-50 rounded-lg flex-1 min-w-[150px]">
                        <h3 class="text-2xl font-bold text-red-600">100.000+</h3>
                        <p class="text-gray-600">Pelanggan</p>
                    </div>

                    <div class="text-center p-4 bg-gray-50 rounded-lg flex-1 min-w-[150px]">
                        <h3 class="text-2xl font-bold text-red-600">10.000+</h3>
                        <p class="text-gray-600">Produk</p>
                    </div>

                    <div class="text-center p-4 bg-gray-50 rounded-lg flex-1 min-w-[150px]">
                        <h3 class="text-2xl font-bold text-red-600">5+</h3>
                        <p class="text-gray-600">Tahun Beroperasi</p>
                    </div>
                </div>

            </div>
            <div class="relative h-96">
                <img src="{{ asset('images/about_stiego_image.png') }}" alt="About Us Image" 
                     class="rounded-lg shadow-lg object-cover w-full h-full">
            </div>
        </div>

        <!-- About Stiego Store -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mt-24 md:mt-32">
                <div class="relative h-96">
                    <img src="{{ asset('images/about_stiego_store_image.png') }}" alt="About Us Image" 
                        class="rounded-lg shadow-lg object-cover w-full h-full">
                </div>
                <div class="space-y-6">
                    <h6 class="text-red-700 font-semibold">About Stiego Store</h6>
                    <h2 class="text-4xl font-semibold text-gray-900">Belanja Langsung di Offline Store Kami dan Rasakan Pengalamannya!</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Stiego store adalah toko pakaian multibrand  atau tempat yang menjual pakaian jadi wanita & pria dewasa, seperti baju,celana, hijab, dan produk tekstil lainnya yang dikenakan manusia.
                    </p>
                
                <div class="flex flex-wrap justify-center md:justify-between gap-6 mt-8">
                        <div class="text-center p-4 bg-gray-50 rounded-lg flex-1 min-w-[150px]">
                            <h3 class="text-2xl font-bold text-red-600">100.000+</h3>
                            <p class="text-gray-600">Pelanggan</p>
                        </div>

                        <div class="text-center p-4 bg-gray-50 rounded-lg flex-1 min-w-[150px]">
                            <h3 class="text-2xl font-bold text-red-600">10.000+</h3>
                            <p class="text-gray-600">Produk</p>
                        </div>

                        <div class="text-center p-4 bg-gray-50 rounded-lg flex-1 min-w-[150px]">
                            <h3 class="text-2xl font-bold text-red-600">5+</h3>
                            <p class="text-gray-600">Tahun Beroperasi</p>
                        </div>
                    </div>

                </div>
            </div>


        <!-- Values Section -->
        <div class="mt-24">
            <h2 class="text-3xl font-semibold text-center text-gray-900 mb-12">Nilai Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Kualitas</h3>
                        <p class="text-gray-600">Kualitas bahan yang terbaik untuk setiap produk kami untuk setiap pelanggan.</p>
                    </div>
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tepat & Terpercaya</h3>
                        <p class="text-gray-600">Selalu tepat waktu dan bisa diandalkan untuk belanja tanpa ribet.</p>
                    </div>
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Prioritas Pelanggan</h3>
                        <p class="text-gray-600">Kepuasan pelanggan nomor satu, feedback kamu penting bagi kami.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full-bleed Promo Banner (Tailwind) -->
        <!-- Stiego Minimal Banner -->
            <section class="relative md:mt-24 mt-16 md:mb-24 mb-16">
            <div class="w-screen left-1/2 relative -translate-x-1/2">
                <div class="bg-red-900 h-80">
                
                <!-- Grid Layout Container -->
                <div class="h-full max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 items-center gap-8">
                    
                    <!-- Left: Brand Info -->
                    <div class="space-y-6">
                    <div>
                        <p class="text-red-700 text-sm font-medium tracking-widest">AUTHENTIC STREETWEAR</p>
                    </div>
                    
                    <div>
                        <h2 class="text-2xl md:text-3xl font-light mb-4">
                        Fashion yang Bicara
                        <span class="font-bold text-red-700">Tentang Karaktermu</span>
                        </h2>
                        <p class="text-red-100 leading-relaxed">
                        Koleksi streetwear premium dengan desain eksklusif untuk anak muda yang berani tampil beda dan autentik.
                        </p>
                    </div>
                    </div>
                    
                    <!-- Right: Actions -->
                    <div class="text-center lg:text-right space-y-6">
                    <div class="space-y-4">
                        <button class="block w-full lg:w-auto text-white bg-red-600 px-10 py-4 font-bold text-lg transition-colors">
                        BELANJA SEKARANG
                        </button>
                        <button class="block w-full lg:w-auto border-2 border-white  px-10 py-4 font-bold text-lg text-red-900 transition-colors">
                        <span class="animate-bounce">LIHAT KOLEKSI</span>
                        </button>
                    </div>
                    
                    <div class="flex justify-center lg:justify-end gap-6 text-red-200 text-sm">
                        <span>✓ Original Design</span>
                        <span>✓ Premium Quality</span>
                        <span>✓ Fast Shipping</span>
                    </div>
                    </div>
                    
                </div>
                </div>
            </div>
            </section>
</div>
@endsection