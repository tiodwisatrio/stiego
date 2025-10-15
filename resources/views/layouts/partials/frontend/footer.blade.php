<footer class="px-5">
  <div class="footer-section container mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row justify-between items-stretch gap-8">
      <!-- Company Info -->
      <div class="space-y-4 md:w-1/4 text-sm flex-1 flex flex-col">
        <img src="{{ asset('images/logo_stiego.png') }}" alt="Stiego Logo" class="w-20 h-auto">
        <p class="text-gray-600 text-sm flex-grow">
          Stiego store adalah toko pakaian multibrand atau tempat yang menjual pakaian jadi wanita & pria dewasa seperti baju, celana, hijab, dan produk tekstil lainnya yang dikenakan manusia.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="space-y-4 flex-1 flex flex-col">
        <h3 class="text-lg font-semibold">Links</h3>
        <ul class="space-y-2 flex-grow">
          <li><a href="{{ route('frontend.home') }}" class="text-gray-900 hover:text-[var(--color-hover)]">Home</a></li>
          <li><a href="{{ route('frontend.about') }}" class="text-gray-900 hover:text-[var(--color-hover)]">About Us</a></li>
          <li><a href="{{ route('frontend.products.index') }}" class="text-gray-900 hover:text-[var(--color-hover)]">Products</a></li>
          <li><a href="{{ route('frontend.contact') }}" class="text-gray-900 hover:text-[var(--color-hover)]">Contact</a></li>
        </ul>
      </div>

      <!-- Sosial Media -->
      <div class="space-y-4 flex-1 flex flex-col">
  <h3 class="text-lg font-semibold">Social Media</h3>
  <ul class="space-y-2 text-[var(--color-text)] flex-grow">
    <!-- Instagram -->
    <li class="flex items-center hover:text-[var(--color-hover)] transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.75 2.75h8.5a5 5 0 015 5v8.5a5 5 0 01-5 5h-8.5a5 5 0 01-5-5v-8.5a5 5 0 015-5z" />
        <circle cx="12" cy="12" r="3.5" />
        <circle cx="17" cy="7" r="0.8" fill="currentColor" />
      </svg>
      stiego.id
    </li>

    <!-- Facebook -->
    <li class="flex items-center hover:text-[var(--color-hover)] transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
        <path d="M22 12a10 10 0 10-11.5 9.9v-7H8v-2.9h2.5V9.5c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.3.2 2.3.2v2.6H15c-1.3 0-1.7.8-1.7 1.6v1.9H17l-.4 2.9h-2.3v7A10 10 0 0022 12z"/>
      </svg>
      stiego.id
    </li>

    <!-- TikTok -->
    <li class="flex items-center hover:text-[var(--color-hover)] transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12.75 2a5.5 5.5 0 005.5 5.5v2a7.5 7.5 0 01-5.5-2.5V14a5 5 0 11-5-5v2a3 3 0 103 3V2h2z"/>
      </svg>
      stiego.id
    </li>

    <!-- Shopee -->
    <li class="flex items-center hover:text-[var(--color-hover)] transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
        <path d="M7 5a5 5 0 0110 0h2.5A1.5 1.5 0 0121 6.5V19a2 2 0 01-2 2H5a2 2 0 01-2-2V6.5A1.5 1.5 0 014.5 5H7zm3-1a2 2 0 00-2 2h6a2 2 0 00-2-2h-2zM8 11a1 1 0 000 2h3.17l-.59.59a1 1 0 101.42 1.42l2-2a1 1 0 000-1.42l-2-2a1 1 0 00-1.42 1.42l.59.59H8z" />
      </svg>
      stiego
    </li>
  </ul>
</div>

       

      <!-- Contact Info -->
      <div class="space-y-4 flex-1 flex flex-col">
        <h3 class="text-lg font-semibold">Contact Us</h3>
        <ul class="space-y-2 text-[var(--color-text)] flex-grow">
          <li class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            stiegostiego@gmail.com
          </li>
          <li class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            +62 895 2766 8283
          </li>
          <li class="flex items-start">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Jalan Mayor Dasuki No. 57,<br>Jatibarang, Indramayu,<br>Jawa Barat, 45273
          </li>
        </ul>
      </div>
    </div>

    <div class="mt-12 pt-8 border-t border-gray-700 text-center text-gray-400">
      <p>&copy; {{ date('Y') }} StiegoApp. All rights reserved.</p>
    </div>
  </div>
</footer>
