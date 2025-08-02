<?php
// Simple setup script untuk MAPALA Politala
// Fokus pada pembuatan direktori dan file yang diperlukan

echo "🚀 Setup Dasar MAPALA Politala\n";
echo "==============================\n\n";

// Buat direktori uploads
echo "📁 Membuat direktori uploads...\n";
$uploadDirs = [
    'public/uploads',
    'public/uploads/fotos',
    'public/uploads/documents',
    'public/uploads/id_cards',
    'public/uploads/kegiatan',
    'public/uploads/divisi'
];

foreach ($uploadDirs as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "✅ Direktori '$dir' berhasil dibuat\n";
        } else {
            echo "❌ Gagal membuat direktori '$dir'\n";
        }
    } else {
        echo "✅ Direktori '$dir' sudah ada\n";
    }
}

// Set permissions
echo "\n🔐 Mengatur permission...\n";
foreach ($uploadDirs as $dir) {
    if (is_dir($dir)) {
        chmod($dir, 0755);
        echo "✅ Permission '$dir' diatur\n";
    }
}

// Create .htaccess for uploads directory
echo "\n📄 Membuat .htaccess untuk uploads...\n";
$htaccessContent = "Options -Indexes\n";
$htaccessFile = 'public/uploads/.htaccess';
if (file_put_contents($htaccessFile, $htaccessContent)) {
    echo "✅ .htaccess berhasil dibuat\n";
} else {
    echo "❌ Gagal membuat .htaccess\n";
}

echo "\n🎉 Setup dasar selesai!\n";
echo "==============================\n";
echo "📋 Yang sudah diperbaiki:\n";
echo "   ✅ UserModel methods (countAll, where, findAll)\n";
echo "   ✅ 404 error page\n";
echo "   ✅ Upload directories\n";
echo "   ✅ File upload handling di Daftar controller\n";
echo "   ✅ Button text sudah 'Daftar MAPALA'\n";
echo "\n🔗 URL Penting:\n";
echo "   - Beranda: http://localhost:8080\n";
echo "   - Daftar MAPALA: http://localhost:8080/daftar\n";
echo "   - Login Admin: http://localhost:8080/login\n";
echo "   - Admin Dashboard: http://localhost:8080/admin\n";
echo "\n💡 Untuk menjalankan aplikasi:\n";
echo "   php spark serve\n";
echo "\n⚠️  Catatan:\n";
echo "   - Database perlu dikonfigurasi secara manual\n";
echo "   - Pastikan MySQL berjalan dan dapat diakses\n";
echo "   - Setelah database siap, jalankan: php spark migrate\n";