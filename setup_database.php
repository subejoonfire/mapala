<?php

// Script untuk setup database MAPALA Politala dengan MySQL
// Pastikan MySQL server sudah berjalan dan user root sudah dikonfigurasi

echo "🚀 Setting up MAPALA Politala Database (MySQL)...\n\n";

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mapala_db';

// Cek koneksi MySQL
try {
    $pdo = new PDO("mysql:host={$host}", $username, $password);
    echo "✅ MySQL connection successful\n";
} catch (PDOException $e) {
    echo "❌ MySQL connection failed: " . $e->getMessage() . "\n";
    echo "💡 Pastikan MySQL server sudah berjalan dan user root sudah dikonfigurasi\n";
    exit(1);
}

// Buat database jika belum ada
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}`");
    echo "✅ Database '{$database}' created/verified\n";
} catch (PDOException $e) {
    echo "❌ Failed to create database: " . $e->getMessage() . "\n";
    exit(1);
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
echo "   - Database: MySQL '{$database}' on {$host}\n";
echo "   - Tables: users, divisi, kegiatan, kegiatan_foto, video_angkatan, kode_etik, id_card\n";
echo "   - Sample data: 5 divisi, 5 users, 5 kegiatan, 15 foto kegiatan, 5 video angkatan\n";
echo "\n🔑 Default login credentials:\n";
echo "   Email: ahmad.rizki@politala.ac.id\n";
echo "   Password: password123\n";
echo "\n🌐 Access the application at: http://localhost:8080\n";