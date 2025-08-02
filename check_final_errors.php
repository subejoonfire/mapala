<?php

// Script untuk mengecek error terakhir di sistem MAPALA

echo "🔍 Mengecek Error Terakhir di Sistem MAPALA\n";
echo "==========================================\n\n";

// Cek file yang mungkin error
$filesToCheck = [
    'app/Controllers/Home.php',
    'app/Controllers/Auth.php',
    'app/Controllers/Daftar.php',
    'app/Controllers/Admin/Users.php',
    'app/Controllers/Admin/Dashboard.php',
    'app/Models/UserModel.php',
    'app/Models/AdminModel.php',
    'app/Views/home/index.php',
    'app/Views/home/about.php',
    'app/Views/home/contact.php',
    'app/Views/home/search.php',
    'app/Views/auth/login.php',
    'app/Views/daftar/index.php',
    'app/Views/daftar/success.php',
    'app/Views/admin/users/index.php',
    'app/Views/admin/users/create.php',
    'app/Views/admin/users/edit.php',
    'app/Views/layout/main.php',
];

echo "📁 Mengecek file-file utama...\n";
foreach ($filesToCheck as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - OK\n";
    } else {
        echo "❌ {$file} - Tidak ditemukan\n";
    }
}

// Cek method yang mungkin tidak ada
echo "\n🔍 Mengecek method yang mungkin error...\n";

$methodChecks = [
    'app/Models/DivisiModel.php' => ['getActiveDivisi', 'getDivisiStats', 'searchDivisi'],
    'app/Models/KegiatanModel.php' => ['getRecentKegiatan', 'getUpcomingKegiatan', 'getKegiatanStats', 'searchKegiatan', 'getPublishedKegiatan'],
    'app/Models/UserModel.php' => ['countAll', 'where', 'findAll'],
    'app/Models/AdminModel.php' => ['authenticate'],
];

foreach ($methodChecks as $file => $methods) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        foreach ($methods as $method) {
            if (strpos($content, "function {$method}") !== false) {
                echo "✅ {$file} -> {$method}() - OK\n";
            } else {
                echo "❌ {$file} -> {$method}() - Tidak ditemukan\n";
            }
        }
    } else {
        echo "❌ {$file} - File tidak ditemukan\n";
    }
}

// Cek key yang mungkin error
echo "\n🔍 Mengecek key yang mungkin error...\n";

$keyChecks = [
    'app/Views/home/index.php' => ['$stats[\'members\'][\'approved\']', '$stats[\'divisi\'][\'aktif\']', '$stats[\'kegiatan\'][\'this_year\']'],
    'app/Views/home/about.php' => ['$stats[\'members\'][\'approved\']', '$stats[\'divisi\'][\'aktif\']'],
    'app/Views/admin/users/index.php' => ['$user[\'status\']', '$user[\'nama_lengkap\']', '$user[\'nim\']', '$user[\'email\']'],
];

foreach ($keyChecks as $file => $keys) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        foreach ($keys as $key) {
            if (strpos($content, $key) !== false) {
                echo "✅ {$file} -> {$key} - OK\n";
            } else {
                echo "❌ {$file} -> {$key} - Tidak ditemukan\n";
            }
        }
    } else {
        echo "❌ {$file} - File tidak ditemukan\n";
    }
}

// Cek route yang mungkin error
echo "\n🔍 Mengecek route yang mungkin error...\n";

$routeChecks = [
    'app/Config/Routes.php' => ['/daftar', '/login', '/admin', '/divisi', '/kegiatan'],
];

foreach ($routeChecks as $file => $routes) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        foreach ($routes as $route) {
            if (strpos($content, $route) !== false) {
                echo "✅ {$file} -> {$route} - OK\n";
            } else {
                echo "❌ {$file} -> {$route} - Tidak ditemukan\n";
            }
        }
    } else {
        echo "❌ {$file} - File tidak ditemukan\n";
    }
}

// Cek database migration
echo "\n🔍 Mengecek migration yang mungkin error...\n";

$migrationFiles = [
    'app/Database/Migrations/2024-01-01-000001_CreateUsers.php',
    'app/Database/Migrations/2024-01-01-000008_CreateAdmins.php',
];

foreach ($migrationFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if (strpos($content, 'password') !== false && strpos($content, 'role') !== false) {
            echo "✅ {$file} - Migration OK\n";
        } else {
            echo "⚠️  {$file} - Perlu dicek ulang\n";
        }
    } else {
        echo "❌ {$file} - File tidak ditemukan\n";
    }
}

echo "\n🎉 Pengecekan selesai!\n";
echo "==========================================\n";
echo "💡 Tips untuk menjalankan aplikasi:\n";
echo "   1. php setup_mapala_new.php\n";
echo "   2. php spark serve\n";
echo "   3. Buka http://localhost:8080\n";
echo "\n🔗 URL Penting:\n";
echo "   - Daftar: http://localhost:8080/daftar\n";
echo "   - Login: http://localhost:8080/login\n";
echo "   - Admin: http://localhost:8080/admin\n";