<?php

// Script untuk memperbaiki migration files
// Menghilangkan duplikasi unique key

echo "🔧 Memperbaiki Migration Files\n";
echo "==============================\n\n";

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
        echo "📝 Checking: {$file}\n";
        
        $content = file_get_contents($file);
        
        // Hapus 'unique' => true dari field definitions
        $content = preg_replace("/'unique'\s*=>\s*true,?\s*\n\s*/", "", $content);
        
        // Simpan file yang sudah diperbaiki
        file_put_contents($file, $content);
        
        echo "✅ Fixed: {$file}\n";
    } else {
        echo "❌ File not found: {$file}\n";
    }
}

echo "\n🎉 Semua migration files sudah diperbaiki!\n";
echo "📋 Perubahan yang dilakukan:\n";
echo "   - Menghapus 'unique' => true dari field definitions\n";
echo "   - Mempertahankan addUniqueKey() untuk unique constraints\n";
echo "\n💡 Sekarang coba jalankan:\n";
echo "   php spark migrate:refresh --all\n";