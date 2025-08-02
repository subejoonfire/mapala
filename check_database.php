<?php

// Script untuk mengecek status database MAPALA Politala

echo "🔍 MAPALA Politala - Database Status Check\n";
echo "==========================================\n\n";

// Cek file database
$dbPath = __DIR__ . '/writable/mapala.db';

if (!file_exists($dbPath)) {
    echo "❌ Database file not found: {$dbPath}\n";
    echo "💡 Run: php run_migration.php to setup database\n";
    exit(1);
}

echo "✅ Database file exists: {$dbPath}\n";
echo "📊 File size: " . number_format(filesize($dbPath)) . " bytes\n";

// Cek apakah SQLite extension tersedia
if (!extension_loaded('sqlite3')) {
    echo "❌ SQLite3 extension not loaded\n";
    echo "💡 Install: sudo apt install php8.0-sqlite3\n";
    exit(1);
}

echo "✅ SQLite3 extension loaded\n";

// Coba koneksi ke database
try {
    $db = new SQLite3($dbPath);
    echo "✅ Database connection successful\n";
    
    // Cek tabel yang ada
    $tables = [
        'users',
        'divisi', 
        'kegiatan',
        'kegiatan_foto',
        'video_angkatan',
        'kode_etik',
        'id_card'
    ];
    
    echo "\n📋 Checking tables:\n";
    foreach ($tables as $table) {
        $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='{$table}'");
        if ($result->fetchArray()) {
            // Hitung jumlah record
            $countResult = $db->query("SELECT COUNT(*) as count FROM {$table}");
            $count = $countResult->fetchArray()['count'];
            echo "   ✅ {$table}: {$count} records\n";
        } else {
            echo "   ❌ {$table}: Table not found\n";
        }
    }
    
    // Cek sample data
    echo "\n📊 Sample data check:\n";
    
    // Cek divisi
    $divisiCount = $db->querySingle("SELECT COUNT(*) FROM divisi");
    echo "   - Divisi: {$divisiCount}/5\n";
    
    // Cek users
    $usersCount = $db->querySingle("SELECT COUNT(*) FROM users");
    echo "   - Users: {$usersCount}/5\n";
    
    // Cek kegiatan
    $kegiatanCount = $db->querySingle("SELECT COUNT(*) FROM kegiatan");
    echo "   - Kegiatan: {$kegiatanCount}/5\n";
    
    // Cek foto kegiatan
    $fotoCount = $db->querySingle("SELECT COUNT(*) FROM kegiatan_foto");
    echo "   - Foto kegiatan: {$fotoCount}/15\n";
    
    // Cek video angkatan
    $videoCount = $db->querySingle("SELECT COUNT(*) FROM video_angkatan");
    echo "   - Video angkatan: {$videoCount}/5\n";
    
    // Cek kode etik
    $etikCount = $db->querySingle("SELECT COUNT(*) FROM kode_etik");
    echo "   - Kode etik: {$etikCount}/1\n";
    
    // Cek ID card
    $idCardCount = $db->querySingle("SELECT COUNT(*) FROM id_card");
    echo "   - ID Card: {$idCardCount}/5\n";
    
    $db->close();
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Cek folder uploads
echo "\n📁 Upload directories check:\n";
$uploadDirs = [
    'public/uploads',
    'public/uploads/fotos',
    'public/uploads/documents', 
    'public/uploads/id-cards',
    'public/uploads/temp'
];

foreach ($uploadDirs as $dir) {
    if (is_dir($dir)) {
        echo "   ✅ {$dir}\n";
    } else {
        echo "   ❌ {$dir} (missing)\n";
    }
}

echo "\n🎯 Status Summary:\n";
echo "==================\n";

if (file_exists($dbPath) && $divisiCount >= 5 && $usersCount >= 5) {
    echo "✅ Database is ready for use!\n";
    echo "✅ Sample data is complete\n";
    echo "✅ System is ready to run\n";
    echo "\n🌐 Next steps:\n";
    echo "   1. Run: php spark serve\n";
    echo "   2. Open: http://localhost:8080\n";
    echo "   3. Login with: ahmad.rizki@politala.ac.id / password123\n";
} else {
    echo "⚠️  Database needs setup\n";
    echo "💡 Run: php run_migration.php\n";
}

echo "\n📚 Documentation: README_MAPALA.md\n";
echo "🔧 Installation: INSTALLATION.md\n";