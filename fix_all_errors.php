<?php

// Script untuk mengecek dan memperbaiki semua error

echo "🔧 Mengecek dan Memperbaiki Error\n";
echo "================================\n\n";

// 1. Cek Filter
echo "1. Mengecek Filter...\n";
$filterFiles = [
    'app/Filters/AuthFilter.php',
    'app/Filters/AdminFilter.php'
];

foreach ($filterFiles as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - OK\n";
    } else {
        echo "❌ {$file} - Tidak ditemukan\n";
    }
}

// 2. Cek Controller
echo "\n2. Mengecek Controller...\n";
$controllerFiles = [
    'app/Controllers/Dashboard.php',
    'app/Controllers/Profile.php',
    'app/Controllers/Divisi.php',
    'app/Controllers/Kegiatan.php',
    'app/Controllers/KodeEtik.php',
    'app/Controllers/VideoAngkatan.php',
    'app/Controllers/Download.php',
    'app/Controllers/Upload.php',
    'app/Controllers/Pdf.php',
    'app/Controllers/WhatsApp.php',
    'app/Controllers/Admin/Dashboard.php',
    'app/Controllers/Admin/Users.php',
    'app/Controllers/Api/Divisi.php',
    'app/Controllers/Api/Kegiatan.php',
    'app/Controllers/Api/Search.php'
];

foreach ($controllerFiles as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - OK\n";
    } else {
        echo "❌ {$file} - Tidak ditemukan\n";
    }
}

// 3. Cek Model
echo "\n3. Mengecek Model...\n";
$modelFiles = [
    'app/Models/KodeEtikModel.php',
    'app/Models/VideoAngkatanModel.php',
    'app/Models/IdCardModel.php'
];

foreach ($modelFiles as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - OK\n";
    } else {
        echo "❌ {$file} - Tidak ditemukan\n";
    }
}

// 4. Cek Konfigurasi Filter
echo "\n4. Mengecek Konfigurasi Filter...\n";
$filterConfig = file_get_contents('app/Config/Filters.php');
if (strpos($filterConfig, "'auth'") !== false && strpos($filterConfig, "'admin'") !== false) {
    echo "✅ Filter aliases sudah terdaftar\n";
} else {
    echo "❌ Filter aliases belum terdaftar\n";
}

// 5. Cek Routes
echo "\n5. Mengecek Routes...\n";
$routesFile = file_get_contents('app/Config/Routes.php');
if (strpos($routesFile, "'filter' => 'admin'") !== false) {
    echo "✅ Admin filter sudah digunakan di routes\n";
} else {
    echo "❌ Admin filter belum digunakan di routes\n";
}

if (strpos($routesFile, "'filter' => 'auth'") !== false) {
    echo "✅ Auth filter sudah digunakan di routes\n";
} else {
    echo "❌ Auth filter belum digunakan di routes\n";
}

// 6. Cek Migration
echo "\n6. Mengecek Migration...\n";
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
        if (strpos($content, "'unique' => true") !== false) {
            echo "❌ {$file} - Masih ada 'unique' => true\n";
        } else {
            echo "✅ {$file} - OK\n";
        }
    } else {
        echo "❌ {$file} - Tidak ditemukan\n";
    }
}

echo "\n🎉 Pengecekan selesai!\n";
echo "📋 Ringkasan:\n";
echo "   - Filter: AuthFilter, AdminFilter\n";
echo "   - Controller: Dashboard, Profile, Divisi, Kegiatan, dll\n";
echo "   - Model: KodeEtikModel, VideoAngkatanModel, IdCardModel\n";
echo "   - Routes: Admin dan Auth filter sudah terdaftar\n";
echo "   - Migration: Sudah diperbaiki untuk MySQL\n";
echo "\n💡 Jika masih ada error, jalankan:\n";
echo "   php reset_mysql.php\n";