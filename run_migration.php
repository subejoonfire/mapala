<?php

// Script untuk menjalankan migration dan seeder MAPALA Politala
// Pastikan CodeIgniter 4 sudah terinstall

echo "🏔️ MAPALA Politala - Database Setup\n";
echo "=====================================\n\n";

// Cek apakah CodeIgniter sudah terinstall
if (!file_exists('spark')) {
    echo "❌ Error: CodeIgniter 4 tidak ditemukan. Pastikan Anda berada di root directory project.\n";
    exit(1);
}

// Buat database SQLite jika belum ada
$dbPath = __DIR__ . '/writable/mapala.db';
$dbDir = dirname($dbPath);

if (!is_dir($dbDir)) {
    mkdir($dbDir, 0755, true);
    echo "✅ Created database directory: {$dbDir}\n";
}

if (!file_exists($dbPath)) {
    touch($dbPath);
    chmod($dbPath, 0644);
    echo "✅ Created SQLite database: {$dbPath}\n";
} else {
    echo "ℹ️  Database already exists: {$dbPath}\n";
}

// Jalankan migration
echo "\n📊 Running migrations...\n";
echo "Executing: php spark migrate\n";

$migrationOutput = shell_exec('php spark migrate 2>&1');
echo $migrationOutput;

if (strpos($migrationOutput, 'error') !== false || strpos($migrationOutput, 'Error') !== false) {
    echo "❌ Migration failed. Please check the error above.\n";
    exit(1);
}

echo "✅ Migrations completed successfully!\n";

// Jalankan seeder
echo "\n🌱 Running seeders...\n";
echo "Executing: php spark db:seed MainSeeder\n";

$seederOutput = shell_exec('php spark db:seed MainSeeder 2>&1');
echo $seederOutput;

if (strpos($seederOutput, 'error') !== false || strpos($seederOutput, 'Error') !== false) {
    echo "❌ Seeding failed. Please check the error above.\n";
    exit(1);
}

echo "✅ Seeding completed successfully!\n";

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
        echo "✅ Created upload directory: {$dir}\n";
    }
}

echo "\n🎉 Database setup completed successfully!\n";
echo "=====================================\n";
echo "📋 Summary:\n";
echo "   - Database: SQLite at {$dbPath}\n";
echo "   - Tables: users, divisi, kegiatan, kegiatan_foto, video_angkatan, kode_etik, id_card\n";
echo "   - Sample data: 5 divisi, 5 users, 5 kegiatan, 15 foto kegiatan, 5 video angkatan\n";
echo "\n🔑 Default login credentials:\n";
echo "   Email: ahmad.rizki@politala.ac.id\n";
echo "   Password: password123\n";
echo "\n🌐 Next steps:\n";
echo "   1. Run: php spark serve\n";
echo "   2. Open: http://localhost:8080\n";
echo "   3. Test the application\n";
echo "\n📚 Documentation: README_MAPALA.md\n";
echo "🔧 Installation guide: INSTALLATION.md\n";