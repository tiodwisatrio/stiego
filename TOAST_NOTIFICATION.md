# Toast Notification System

## Cara Penggunaan

### 1. Dari Controller (Laravel Session)

```php
// Success (hijau)
return back()->with('success', '✅ Berhasil!');

// Error (merah maroon)
return back()->with('error', '❌ Gagal!');

// Warning (kuning)
return back()->with('warning', '⚠️ Peringatan!');

// Info (biru)
return back()->with('info', 'ℹ️ Informasi');
```

### 2. Dari JavaScript

```javascript
// Success
showToast("Produk berhasil ditambahkan!", "success");

// Error
showToast("Kombinasi warna dan ukuran tidak ada!", "error");

// Warning
showToast("Stok terbatas!", "warning");

// Info
showToast("Produk ini sedang diskon!", "info");
```

### 3. Fitur Toast

-   ✅ Animasi slide in dari kanan
-   ✅ Auto dismiss setelah 5 detik
-   ✅ Progress bar animasi
-   ✅ Tombol close manual
-   ✅ Multiple toast (stack)
-   ✅ Icon per tipe notifikasi
-   ✅ Responsive mobile & desktop
-   ✅ Warna tema:
    -   Success: Hijau
    -   Error: Merah maroon/merah tua
    -   Warning: Kuning
    -   Info: Biru

### 4. Contoh Notifikasi Cart

-   ✅ "Produk berhasil ditambahkan ke keranjang!"
-   ❌ "Stok tidak cukup! Stok tersedia: 5 item"
-   ⚠️ "Silakan pilih ukuran dan warna terlebih dahulu!"
-   ✅ "Produk berhasil dihapus dari keranjang!"
-   ✅ "Jumlah produk berhasil diupdate!"
