# Performance Improvements - Stiego Website

## 📊 Issues yang Diperbaiki

### ✅ 1. **Minify JavaScript** (Est savings: 77 KiB)

**Solusi yang diterapkan:**

-   Update `vite.config.js` dengan terser minification
-   Enable CSS minification
-   Remove console.log di production
-   Code splitting untuk vendor chunks (Alpine.js)

**File yang dimodifikasi:**

-   `vite.config.js`

**Cara kerja:**

```bash
npm run build
```

---

### ✅ 2. **Efficient Cache Lifetime** (Est savings: 5,644 KiB)

**Solusi yang diterapkan:**

-   Tambahkan browser caching di `.htaccess`
-   Set cache lifetime untuk images (1 year)
-   Set cache lifetime untuk CSS/JS (1 month)
-   Set cache lifetime untuk fonts (1 year)

**File yang dimodifikasi:**

-   `public/.htaccess`

**Cache yang diterapkan:**

-   Images (jpg, png, gif, webp, svg): 1 year
-   CSS & JavaScript: 1 month
-   Fonts (woff, woff2): 1 year
-   Default: 1 month

---

### ✅ 3. **Gzip Compression**

**Solusi yang diterapkan:**

-   Enable mod_deflate di `.htaccess`
-   Compress HTML, CSS, JS, XML, JSON
-   Compress SVG images

**Benefit:**

-   Mengurangi ukuran transfer file hingga 70%
-   Mempercepat loading halaman

---

### ✅ 4. **Lazy Loading Images**

**Solusi yang diterapkan:**

-   Tambahkan `loading="lazy"` pada semua images
-   Browser akan load images saat scroll mendekati viewport
-   Menghemat bandwidth untuk images di bawah fold

**File yang sudah dioptimasi:**

-   `resources/views/frontend/home.blade.php` (hero images)
-   Semua product images sudah menggunakan lazy loading

---

### ⚠️ 5. **Render Blocking Requests** (Est savings: 16,380 ms)

**Rekomendasi:**

-   Gunakan `defer` atau `async` untuk script non-critical
-   Load Alpine.js dengan defer
-   Critical CSS inline di head
-   Non-critical CSS load async

**Cara implementasi (opsional):**

```html
<!-- Di layout frontend -->
<link rel="preload" href="{{ asset('build/assets/app.css') }}" as="style" />
<script defer src="{{ asset('build/assets/app.js') }}"></script>
```

---

### 📸 6. **Image Optimization**

**Rekomendasi untuk optimize images:**

#### Manual:

1. Gunakan tools online:

    - TinyPNG (https://tinypng.com)
    - Squoosh (https://squoosh.app)

2. Convert ke WebP format:
    ```bash
    # Install imagemagick
    magick convert image.jpg -quality 80 image.webp
    ```

#### Automatic (Package):

```bash
npm install --save-dev vite-plugin-imagemin
```

Tambahkan di `vite.config.js`:

```javascript
import viteImagemin from "vite-plugin-imagemin";

export default defineConfig({
    plugins: [
        viteImagemin({
            gifsicle: { optimizationLevel: 7 },
            optipng: { optimizationLevel: 7 },
            mozjpeg: { quality: 80 },
            pngquant: { quality: [0.8, 0.9], speed: 4 },
            svgo: { plugins: [{ name: "removeViewBox" }] },
            webp: { quality: 80 },
        }),
    ],
});
```

---

### 🚀 7. **Reduce Unused CSS** (Tailwind)

**Sudah diterapkan:**

-   Tailwind purge sudah aktif di production
-   Hanya class yang digunakan yang akan di-include

**Cara memastikan:**

```bash
# Build production akan otomatis purge unused CSS
npm run build
```

**Tips tambahan:**

-   Hindari class dinamis dengan template string
-   Gunakan safelist untuk class yang dibuat secara dinamis
-   Sudah dikonfigurasi di `tailwind.config.js`

---

## 🎯 Hasil yang Diharapkan

Setelah implementasi:

| Metric          | Before  | After   | Improvement     |
| --------------- | ------- | ------- | --------------- |
| JavaScript Size | ~300 KB | ~223 KB | ✅ 77 KB saved  |
| CSS Size        | ~150 KB | ~100 KB | ✅ 50 KB saved  |
| Cache Hit Rate  | 0%      | ~80%    | ✅ 5.6 MB saved |
| Image Load Time | 2-3s    | 0.5-1s  | ✅ 2.2 MB saved |
| Total Load Time | ~5s     | ~2s     | ✅ 60% faster   |

---

## 📝 Checklist Maintenance

### Setiap Deploy:

-   [ ] Run `npm run build` untuk production
-   [ ] Clear cache: `php artisan optimize:clear`
-   [ ] Test performa dengan Google PageSpeed Insights

### Setiap Upload Image Baru:

-   [ ] Compress dengan TinyPNG/Squoosh
-   [ ] Gunakan format WebP jika memungkinkan
-   [ ] Tambahkan `loading="lazy"` attribute

### Monitoring:

-   [ ] Cek Google PageSpeed Insights setiap bulan
-   [ ] Monitor Lighthouse scores
-   [ ] Track Core Web Vitals (LCP, FID, CLS)

---

## 🔧 Tools untuk Testing

1. **Google PageSpeed Insights**

    - https://pagespeed.web.dev/

2. **GTmetrix**

    - https://gtmetrix.com/

3. **WebPageTest**

    - https://www.webpagetest.org/

4. **Chrome DevTools**
    - Lighthouse (Ctrl+Shift+I → Lighthouse tab)
    - Network tab untuk cek cache
    - Coverage tab untuk unused CSS/JS

---

## 💡 Best Practices Moving Forward

1. **Images:**

    - Selalu compress sebelum upload
    - Gunakan lazy loading
    - Consider WebP format

2. **CSS/JS:**

    - Minify untuk production
    - Remove unused code
    - Use code splitting

3. **Caching:**

    - Set proper cache headers
    - Use versioning untuk bust cache
    - Leverage browser cache

4. **Third-party:**
    - Load analytics async
    - Defer non-critical scripts
    - Self-host fonts jika memungkinkan

---

## 📞 Support

Jika ada issue terkait performa:

1. Check browser console untuk errors
2. Clear cache browser
3. Run `php artisan optimize:clear`
4. Rebuild assets dengan `npm run build`

---

**Last Updated:** October 19, 2025
**Version:** 1.0
