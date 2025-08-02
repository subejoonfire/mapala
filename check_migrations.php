<?php

// Script untuk mengecek migration files
// Memastikan tidak ada duplikasi unique key

echo "🔍 Mengecek Migration Files\n";
echo "===========================\n\n";

$migrationFiles = [
    'app/Database/Migrations/2024-01-01-000001_CreateUsers.php',
    'app/Database/Migrations/2024-01-01-000002_CreateDivisi.php',
    'app/Database/Migrations/2024-01-01-000003_CreateKegiatan.php',
    'app/Database/Migrations/2024-01-01-000004_CreateKegiatanFoto.php',
    'app/Database/Migrations/2024-01-01-000005_CreateVideoAngkatan.php',
    'app/Database/Migrations/2024-01-01-000006_CreateKodeEtik.php',
    'app/Database/Migrations/2024-01-01-000007_CreateIdCard.php'
];

$allGood = true;

foreach ($migrationFiles as $file) {
    if (file_exists($file)) {
        echo "📝 Checking: " . basename($file) . "\n";
        
        $content = file_get_contents($file);
        
        // Cek apakah ada 'unique' => true di field definitions
        if (preg_match("/'unique'\s*=>\s*true/", $content)) {
            echo "❌ Masih ada 'unique' => true di field definitions\n";
            $allGood = false;
        } else {
            echo "✅ Tidak ada duplikasi unique key\n";
        }
        
        // Cek apakah ada addUniqueKey()
        if (preg_match("/addUniqueKey/", $content)) {
            echo "✅ addUniqueKey() ditemukan (benar)\n";
        } else {
            echo "⚠️  Tidak ada addUniqueKey()\n";
        }
        
        echo "\n";
    } else {
        echo "❌ File tidak ditemukan: " . basename($file) . "\n\n";
        $allGood = false;
    }
}

if ($allGood) {
    echo "🎉 Semua migration files sudah benar!\n";
    echo "💡 Sekarang bisa jalankan: php spark migrate:refresh --all\n";
} else {
    echo "❌ Ada masalah dengan migration files\n";
    echo "💡 Jalankan: php fix_migrations.php\n";
}