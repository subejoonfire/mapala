<?php

// Script untuk setup database MAPALA Politala
// Pastikan folder writable sudah ada dan bisa ditulis

echo "🚀 Setting up MAPALA Politala Database...\n\n";

// Buat folder untuk database jika belum ada
$dbPath = __DIR__ . '/writable/mapala.db';
$dbDir = dirname($dbPath);

if (!is_dir($dbDir)) {
    mkdir($dbDir, 0755, true);
    echo "✅ Created database directory: {$dbDir}\n";
}

// Buat database SQLite jika belum ada
if (!file_exists($dbPath)) {
    touch($dbPath);
    chmod($dbPath, 0644);
    echo "✅ Created SQLite database: {$dbPath}\n";
} else {
    echo "ℹ️  Database already exists: {$dbPath}\n";
}

// Jalankan migration
echo "\n📊 Running migrations...\n";
$migrationCommand = "php spark migrate";
$migrationOutput = shell_exec($migrationCommand);
echo $migrationOutput;

// Jalankan seeder
echo "\n🌱 Running seeders...\n";
$seederCommand = "php spark db:seed MainSeeder";
$seederOutput = shell_exec($seederCommand);
echo $seederOutput;

echo "\n✅ Database setup completed!\n";
echo "📋 Summary:\n";
echo "   - Database: SQLite at {$dbPath}\n";
echo "   - Tables: users, divisi, kegiatan, kegiatan_foto, video_angkatan, kode_etik, id_card\n";
echo "   - Sample data: 5 divisi, 5 users, 5 kegiatan, 15 foto kegiatan, 5 video angkatan\n";
echo "\n🔑 Default login credentials:\n";
echo "   Email: ahmad.rizki@politala.ac.id\n";
echo "   Password: password123\n";
echo "\n🌐 Access the application at: http://localhost:8080\n";