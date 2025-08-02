<?php

// Script setup database MAPALA Politala dengan MySQL
// Versi sederhana dan lengkap

echo "🚀 Setup Database MAPALA Politala (MySQL)\n";
echo "==========================================\n\n";

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mapala_db';

// Cek koneksi MySQL
try {
    $pdo = new PDO("mysql:host={$host}", $username, $password);
    echo "✅ Koneksi MySQL berhasil\n";
} catch (PDOException $e) {
    echo "❌ Koneksi MySQL gagal: " . $e->getMessage() . "\n";
    echo "💡 Pastikan MySQL server sudah berjalan\n";
    exit(1);
}

// Buat database
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}`");
    echo "✅ Database '{$database}' dibuat/diverifikasi\n";
} catch (PDOException $e) {
    echo "❌ Gagal membuat database: " . $e->getMessage() . "\n";
    exit(1);
}

// Perbaiki migration files
echo "\n🔧 Memperbaiki migration files...\n";
$migrationFiles = [
    'app/Database/Migrations/2024-01-01-000001_CreateUsers.php',
    'app/Database/Migrations/2024-01-01-000002_CreateDivisi.php',
    'app/Database/Migrations/2024-01-01-000003_CreateKegiatan.php',
    'app/Database/Migrations/2024-01-01-000004_CreateKegiatanFoto.php',
    'app/Database/Migrations/2024-01-01-000005_CreateVideoAngkatan.php',
    'app/Database/Migrations/2024-01-01-000006_CreateKodeEtik.php',
    'app/Database/Migrations/2024-01-01-000007_CreateIdCard.php'
];

foreach ($migrationFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        // Hapus 'unique' => true dari field definitions
        $content = preg_replace("/'unique'\s*=>\s*true,?\s*\n\s*/", "", $content);
        file_put_contents($file, $content);
        echo "✅ Fixed: " . basename($file) . "\n";
    }
}

// Jalankan migration
echo "\n📊 Menjalankan migration...\n";
$migrationOutput = shell_exec('php spark migrate:refresh --all 2>&1');
echo $migrationOutput;

if (strpos($migrationOutput, 'error') !== false || strpos($migrationOutput, 'Error') !== false) {
    echo "❌ Migration gagal. Cek error di atas.\n";
    exit(1);
}

// Jalankan seeder
echo "\n🌱 Menjalankan seeder...\n";
$seederOutput = shell_exec('php spark db:seed MainSeeder 2>&1');
echo $seederOutput;

if (strpos($seederOutput, 'error') !== false || strpos($seederOutput, 'Error') !== false) {
    echo "❌ Seeding gagal. Cek error di atas.\n";
    exit(1);
}

// Buat folder uploads
$uploadDirs = [
    'public/uploads',
    'public/uploads/fotos',
    'public/uploads/documents',
    'public/uploads/id-cards',
    'public/uploads/temp'
];

foreach ($uploadDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "✅ Folder upload dibuat: {$dir}\n";
    }
}

echo "\n🎉 Setup database selesai!\n";
echo "==========================\n";
echo "📋 Ringkasan:\n";
echo "   - Database: MySQL '{$database}' di {$host}\n";
echo "   - Tables: users, divisi, kegiatan, kegiatan_foto, video_angkatan, kode_etik, id_card\n";
echo "   - Data sample: 5 divisi, 5 users, 5 kegiatan, 15 foto, 5 video\n";
echo "\n🔑 Login default:\n";
echo "   Email: ahmad.rizki@politala.ac.id\n";
echo "   Password: password123\n";
echo "\n🌐 Langkah selanjutnya:\n";
echo "   1. Jalankan: php spark serve\n";
echo "   2. Buka: http://localhost:8080\n";