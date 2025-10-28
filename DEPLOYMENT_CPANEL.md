# 🚀 Panduan Deploy Laravel ke cPanel

## 📋 Checklist Deployment

### 1. ⚙️ Persiapan File

#### A. Upload File Laravel

```
/home/username/
├── public_html/              ← Document Root (isi dari public/)
│   ├── index.php
│   ├── .htaccess
│   ├── css/
│   ├── js/
│   └── images/
├── stiegoapp/               ← Folder Laravel di luar public_html
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   │   └── app/
│   │       └── public/
│   │           └── product_images/
│   ├── vendor/
│   ├── .env
│   ├── artisan
│   └── composer.json
```

#### B. Update File `public_html/index.php`

```php
<?php
// Ubah path sesuai struktur folder Anda
require __DIR__.'/../stiegoapp/bootstrap/autoload.php';
$app = require_once __DIR__.'/../stiegoapp/bootstrap/app.php';
```

#### C. Update File `.env`

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

---

## 🖼️ Masalah Gambar Tidak Tampil

### ❓ Diagnosa

Gambar tidak tampil karena **symbolic link** `public/storage` → `storage/app/public` belum dibuat.

### ✅ Solusi 1: Script PHP (Termudah)

1. Upload file `create-storage-link-cpanel.php` ke root Laravel
2. Akses via browser: `https://yourdomain.com/create-storage-link-cpanel.php`
3. Ikuti instruksi di halaman
4. **HAPUS file tersebut setelah selesai!**

### ✅ Solusi 2: Via Terminal/SSH

Jika hosting Anda support SSH:

```bash
cd /home/username/stiegoapp
php artisan storage:link
```

### ✅ Solusi 3: Manual via File Manager

1. Login ke cPanel → File Manager
2. Navigate ke folder `public_html/`
3. Hapus folder/link `storage` jika ada
4. Klik "Add Symbolic Link" (jika tersedia)
    - **Target:** `/home/username/stiegoapp/storage/app/public`
    - **Link Name:** `storage`

### ✅ Solusi 4: Ubah Konfigurasi Laravel

Jika symbolic link tidak bisa dibuat, ubah tempat penyimpanan:

#### A. Update `config/filesystems.php`

```php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => public_path('uploads'), // Ganti dari storage_path
        'url' => env('APP_URL').'/uploads',
        'visibility' => 'public',
        'throw' => false,
    ],
],
```

#### B. Buat Folder Manual

```
public_html/
└── uploads/
    └── product_images/
```

#### C. Set Permission

Via File Manager atau FTP, set permission folder:

-   `uploads/` → 755
-   `product_images/` → 755

---

## 🔒 Set Permission Folder

### Via File Manager cPanel:

```
storage/              → 755
storage/app/          → 755
storage/app/public/   → 755
storage/framework/    → 755
storage/logs/         → 755
bootstrap/cache/      → 755
```

### Via SSH/Terminal:

```bash
cd /home/username/stiegoapp
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

---

## 📝 Update .htaccess

### File: `public_html/.htaccess`

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Redirect HTTP to HTTPS (Optional)
    # RewriteCond %{HTTPS} off
    # RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Disable Directory Browsing
Options -Indexes

# Browser Caching (dari PERFORMANCE_IMPROVEMENTS.md)
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/font-woff2 "access plus 1 year"
</IfModule>

# Gzip Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
    AddOutputFilterByType DEFLATE application/json
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE image/svg+xml
</IfModule>
```

---

## 🔧 Troubleshooting

### 1. Error 500 - Internal Server Error

**Penyebab:**

-   File `.env` tidak ada atau salah konfigurasi
-   Permission folder salah
-   PHP version tidak compatible (Laravel 11 butuh PHP 8.2+)

**Solusi:**

```bash
# Via SSH
cd /home/username/stiegoapp
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 2. Gambar Baru Tidak Tampil

**Penyebab:** Symbolic link belum dibuat atau rusak

**Solusi:** Gunakan salah satu dari 4 solusi di atas

### 3. CSS/JS Tidak Load

**Penyebab:** Path assets salah setelah deploy

**Solusi:**

```bash
npm run build  # Di localhost
# Upload hasil build ke public_html/build/
```

Update `.env`:

```env
ASSET_URL=https://yourdomain.com
```

### 4. Database Connection Error

**Cek:**

-   Database name, user, password di cPanel → MySQL Databases
-   DB_HOST di `.env` (biasanya `localhost`)
-   User sudah di-assign ke database

### 5. Session/Login Tidak Work

**Update `.env`:**

```env
SESSION_DRIVER=file
SESSION_LIFETIME=1440
SESSION_DOMAIN=yourdomain.com
```

Bersihkan cache:

```bash
php artisan session:clear
php artisan cache:clear
```

---

## 📊 Test Deployment

### 1. Test Homepage

```
https://yourdomain.com
```

### 2. Test Admin Login

```
https://yourdomain.com/admin/login
```

### 3. Test Upload Gambar

1. Login sebagai admin
2. Upload product dengan gambar
3. Cek apakah gambar tampil di:
    - Admin product list
    - Frontend product detail
    - Frontend product listing

### 4. Test Storage Link

Buka di browser:

```
https://yourdomain.com/storage/product_images/[nama-file].jpg
```

Jika muncul gambar = ✅ Storage link berhasil!
Jika 404 = ❌ Storage link belum dibuat

---

## 🎯 Quick Fix Commands

### Clear All Cache (Via Browser)

Buat file `clear-cache.php`:

```php
<?php
require __DIR__.'/../stiegoapp/bootstrap/autoload.php';
$app = require_once __DIR__.'/../stiegoapp/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('config:clear');
$kernel->call('cache:clear');
$kernel->call('route:clear');
$kernel->call('view:clear');

echo "✅ All cache cleared!";
// HAPUS FILE INI SETELAH DIGUNAKAN!
```

Akses: `https://yourdomain.com/clear-cache.php`
**HAPUS file setelah selesai!**

---

## 📞 Butuh Bantuan?

Jika masalah masih berlanjut:

1. Check error log: `storage/logs/laravel.log`
2. Check cPanel error log: cPanel → Errors → Error Log
3. Kontak hosting support untuk:
    - Enable PHP function: `symlink()`, `proc_open()`, `shell_exec()`
    - Set PHP version ke 8.2+
    - Check file permissions

---

## ✨ Post-Deployment Checklist

-   [ ] Upload semua file Laravel
-   [ ] Update `index.php` dan `.htaccess`
-   [ ] Setup database dan import data
-   [ ] Update file `.env`
-   [ ] Buat storage symbolic link
-   [ ] Set permission folder (755)
-   [ ] Clear all cache
-   [ ] Test upload gambar
-   [ ] Test frontend dan admin
-   [ ] Setup SSL certificate (HTTPS)
-   [ ] Backup database secara berkala
-   [ ] Monitoring error logs

---

**Catatan:** Simpan file ini untuk referensi deployment berikutnya!
