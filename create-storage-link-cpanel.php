<?php
/**
 * Script untuk membuat symbolic link storage di cPanel
 * Upload file ini ke root folder Laravel Anda (sejajar dengan folder app, storage, dll)
 * Akses via browser: https://yourdomain.com/create-storage-link-cpanel.php
 * 
 * SETELAH SELESAI, HAPUS FILE INI UNTUK KEAMANAN!
 */

echo "<h2>Create Storage Link for cPanel</h2>";
echo "<hr>";

// Path ke folder storage/app/public
$targetPath = __DIR__ . '/storage/app/public';

// Path ke public_html/storage (atau public/storage jika struktur berbeda)
// Sesuaikan dengan struktur hosting Anda
$linkPath = __DIR__ . '/public/storage';

// Cek apakah target path ada
if (!file_exists($targetPath)) {
    echo "<p style='color: red;'>❌ Target path tidak ditemukan: {$targetPath}</p>";
    echo "<p>Pastikan folder <code>storage/app/public</code> ada.</p>";
    exit;
}

// Hapus link lama jika ada
if (file_exists($linkPath)) {
    // Cek apakah ini symbolic link
    if (is_link($linkPath)) {
        unlink($linkPath);
        echo "<p style='color: orange;'>⚠️ Symbolic link lama dihapus.</p>";
    } elseif (is_dir($linkPath)) {
        echo "<p style='color: red;'>❌ PERHATIAN: 'public/storage' adalah folder biasa, bukan symbolic link!</p>";
        echo "<p>Anda perlu menghapus folder ini secara manual via File Manager cPanel, lalu jalankan script ini lagi.</p>";
        exit;
    } else {
        unlink($linkPath);
        echo "<p style='color: orange;'>⚠️ File lama dihapus.</p>";
    }
}

// Buat symbolic link baru
try {
    if (symlink($targetPath, $linkPath)) {
        echo "<p style='color: green;'>✅ Symbolic link berhasil dibuat!</p>";
        echo "<p><strong>Target:</strong> {$targetPath}</p>";
        echo "<p><strong>Link:</strong> {$linkPath}</p>";
        echo "<hr>";
        echo "<h3>Testing:</h3>";
        
        // Test: cari gambar di storage
        $images = glob($targetPath . '/product_images/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        if (!empty($images)) {
            echo "<p>Ditemukan " . count($images) . " gambar di storage/app/public/product_images/</p>";
            
            // Tampilkan salah satu gambar untuk test
            $firstImage = basename($images[0]);
            $imageUrl = '/storage/product_images/' . $firstImage;
            echo "<p>Test image URL: <a href='{$imageUrl}' target='_blank'>{$imageUrl}</a></p>";
            echo "<img src='{$imageUrl}' style='max-width: 200px; border: 2px solid green;' alt='Test Image'>";
        } else {
            echo "<p style='color: orange;'>⚠️ Tidak ada gambar ditemukan di folder product_images</p>";
        }
        
        echo "<hr>";
        echo "<h3 style='color: red;'>PENTING: HAPUS FILE INI SETELAH SELESAI!</h3>";
        echo "<p>Hapus file <code>create-storage-link-cpanel.php</code> dari server untuk keamanan.</p>";
    } else {
        echo "<p style='color: red;'>❌ Gagal membuat symbolic link.</p>";
        echo "<p>Kemungkinan penyebab:</p>";
        echo "<ul>";
        echo "<li>Server tidak mengizinkan fungsi <code>symlink()</code></li>";
        echo "<li>Permission folder tidak sesuai</li>";
        echo "</ul>";
        echo "<p><strong>Solusi Alternatif:</strong> Lihat di bawah untuk konfigurasi manual.</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>Informasi Server:</h3>";
echo "<ul>";
echo "<li><strong>PHP Version:</strong> " . PHP_VERSION . "</li>";
echo "<li><strong>Current Directory:</strong> " . __DIR__ . "</li>";
echo "<li><strong>Symlink Function:</strong> " . (function_exists('symlink') ? '✅ Available' : '❌ Not Available') . "</li>";
echo "</ul>";

?>

<hr>
<h2>Solusi Alternatif Jika Symbolic Link Gagal:</h2>

<h3>Opsi 1: Update config/filesystems.php</h3>
<p>Ubah disk 'public' agar langsung mengarah ke folder yang accessible:</p>
<pre style="background: #f5f5f5; padding: 10px; border: 1px solid #ccc;">
'public' => [
    'driver' => 'local',
    'root' => public_path('uploads'), // Ganti ke folder di public_html
    'url' => env('APP_URL').'/uploads',
    'visibility' => 'public',
],
</pre>

<h3>Opsi 2: Buat Folder Manual + .htaccess</h3>
<ol>
    <li>Buat folder <code>public_html/uploads/product_images/</code></li>
    <li>Upload semua gambar dari <code>storage/app/public/product_images/</code> ke sana</li>
    <li>Update Controller untuk menyimpan ke <code>public_path('uploads')</code></li>
    <li>Update view untuk load gambar dari <code>/uploads/product_images/</code></li>
</ol>

<h3>Opsi 3: Kontak Hosting Support</h3>
<p>Minta hosting support untuk:</p>
<ul>
    <li>Enable fungsi <code>symlink()</code></li>
    <li>Atau buatkan symbolic link manual via SSH</li>
</ul>
