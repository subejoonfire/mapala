<?php

// Script untuk mengecek migration files untuk MySQL
// Memastikan semua migration sudah sesuai dengan MySQL

echo "🔍 Mengecek Migration Files untuk MySQL\n";
echo "=====================================\n\n";

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
        
        // Cek apakah ada 'unique' => true di field definitions (tidak boleh ada)
        if (preg_match("/'unique'\s*=>\s*true/", $content)) {
            echo "❌ Masih ada 'unique' => true di field definitions\n";
            $allGood = false;
        } else {
            echo "✅ Tidak ada duplikasi unique key di field definitions\n";
        }
        
        // Cek apakah ada addUniqueKey() (harus ada)
        if (preg_match("/addUniqueKey/", $content)) {
            echo "✅ addUniqueKey() ditemukan (benar untuk MySQL)\n";
        } else {
            echo "⚠️  Tidak ada addUniqueKey()\n";
        }
        
        // Cek apakah ada addForeignKey() (untuk foreign key)
        if (preg_match("/addForeignKey/", $content)) {
            echo "✅ addForeignKey() ditemukan\n";
        }
        
        // Cek tipe data yang sesuai MySQL
        if (preg_match("/'type'\s*=>\s*'TEXT'/", $content)) {
            echo "✅ Tipe data TEXT sesuai MySQL\n";
        }
        
        if (preg_match("/'type'\s*=>\s*'LONGTEXT'/", $content)) {
            echo "✅ Tipe data LONGTEXT sesuai MySQL\n";
        }
        
        echo "\n";
    } else {
        echo "❌ File tidak ditemukan: " . basename($file) . "\n\n";
        $allGood = false;
    }
}

if ($allGood) {
    echo "🎉 Semua migration files sudah benar untuk MySQL!\n";
    echo "💡 Sekarang bisa jalankan: php reset_mysql.php\n";
} else {
    echo "❌ Ada masalah dengan migration files\n";
    echo "💡 Perbaiki migration files terlebih dahulu\n";
}

echo "\n📋 Checklist Migration MySQL:\n";
echo "✅ Tidak ada 'unique' => true di field definitions\n";
echo "✅ Menggunakan addUniqueKey() untuk unique constraints\n";
echo "✅ Menggunakan addForeignKey() untuk foreign keys\n";
echo "✅ Tipe data sesuai MySQL (TEXT, LONGTEXT, dll)\n";
echo "✅ Menggunakan 'unsigned' => true untuk foreign keys\n";