<?php
// Script setup database MAPALA Politala dengan sistem baru
// Sistem: Free registration untuk semua user, login hanya untuk admin

echo "🚀 Setup Database MAPALA Politala (Sistem Baru)\n";
echo "==============================================\n\n";

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mapala_db';

try {
    // Koneksi ke MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Berhasil terhubung ke MySQL\n";
    
    // Buat database jika belum ada
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8 COLLATE utf8_general_ci");
    echo "✅ Database '$database' berhasil dibuat/ditemukan\n";
    
    // Pilih database
    $pdo->exec("USE `$database`");
    echo "✅ Database '$database' dipilih\n";
    
} catch (PDOException $e) {
    echo "❌ Error koneksi database: " . $e->getMessage() . "\n";
    exit(1);
}

// Jalankan migration
echo "\n📊 Menjalankan migration...\n";
$migrationOutput = shell_exec('php spark migrate:refresh --all 2>&1');
echo $migrationOutput;

if (strpos($migrationOutput, 'Error') !== false || strpos($migrationOutput, 'Exception') !== false) {
    echo "❌ Error saat menjalankan migration\n";
    echo "💡 Coba jalankan manual: php spark migrate:refresh --all\n";
} else {
    echo "✅ Migration berhasil dijalankan\n";
}

// Jalankan seeder
echo "\n🌱 Menjalankan seeder...\n";
$seederOutput = shell_exec('php spark db:seed MainSeeder 2>&1');
echo $seederOutput;

if (strpos($seederOutput, 'Error') !== false || strpos($seederOutput, 'Exception') !== false) {
    echo "❌ Error saat menjalankan seeder\n";
    echo "💡 Coba jalankan manual: php spark db:seed MainSeeder\n";
} else {
    echo "✅ Seeder berhasil dijalankan\n";
}

// Buat direktori uploads
echo "\n📁 Membuat direktori uploads...\n";
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

echo "\n🎉 Setup selesai!\n";
echo "==============================================\n";
echo "📋 Informasi Sistem:\n";
echo "   - Sistem: Free registration untuk semua user\n";
echo "   - Login: Hanya untuk admin\n";
echo "   - Admin default: admin/admin123\n";
echo "   - Admin ketua: ketua/ketua123\n";
echo "\n🌐 Cara Menjalankan:\n";
echo "   php spark serve\n";
echo "\n🔗 URL Penting:\n";
echo "   - Beranda: http://localhost:8080\n";
echo "   - Daftar MAPALA: http://localhost:8080/daftar\n";
echo "   - Login Admin: http://localhost:8080/login\n";
echo "   - Admin Dashboard: http://localhost:8080/admin\n";
echo "\n📝 Fitur Utama:\n";
echo "   - Pendaftaran MAPALA (free)\n";
echo "   - Admin panel untuk verifikasi\n";
echo "   - Generate PDF formulir & ID Card\n";
echo "   - Integrasi WhatsApp grup\n";
echo "\n💡 Tips:\n";
echo "   - Semua user bisa daftar tanpa login\n";
echo "   - Hanya admin yang bisa login\n";
echo "   - Setelah daftar, admin akan verifikasi\n";
echo "   - User akan mendapat PDF dan link WhatsApp\n";