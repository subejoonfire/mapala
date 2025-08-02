<?php
// Comprehensive fix script for MAPALA Politala registration system
// This script will fix database structure, create necessary directories, and initialize settings

echo "=== MAPALA Politala System Fix Script ===\n\n";

// 1. Create necessary directories
echo "1. Creating necessary directories...\n";
$directories = [
    'public/uploads',
    'public/uploads/fotos',
    'public/uploads/documents',
    'writable/logs',
    'writable/session'
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "  ✓ Created directory: $dir\n";
        } else {
            echo "  ✗ Failed to create directory: $dir\n";
        }
    } else {
        echo "  ✓ Directory exists: $dir\n";
    }
}

// 2. Fix database structure
echo "\n2. Fixing database structure...\n";

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mapala_db';

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "  ✓ Connected to database successfully.\n";
    
    // Check if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() == 0) {
        echo "  Creating users table...\n";
        
        // Create users table with correct structure
        $sql = "CREATE TABLE users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nama_lengkap VARCHAR(100) NOT NULL,
            nama_panggilan VARCHAR(50) NOT NULL,
            tempat_lahir VARCHAR(100) NOT NULL,
            tanggal_lahir DATE NOT NULL,
            jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
            alamat TEXT NOT NULL,
            no_telp VARCHAR(20) NOT NULL,
            agama VARCHAR(20) NOT NULL,
            program_studi VARCHAR(50) NOT NULL,
            gol_darah ENUM('A', 'B', 'AB', 'O') NOT NULL,
            penyakit TEXT NULL,
            nama_ayah VARCHAR(100) NOT NULL,
            nama_ibu VARCHAR(100) NOT NULL,
            alamat_orangtua TEXT NOT NULL,
            no_telp_orangtua VARCHAR(20) NOT NULL,
            pekerjaan_ayah VARCHAR(200) NOT NULL,
            pekerjaan_ibu VARCHAR(200) NOT NULL,
            foto VARCHAR(255) NULL,
            status VARCHAR(20) DEFAULT 'pending',
            angkatan INT(4) NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL
        )";
        
        $pdo->exec($sql);
        echo "  ✓ Users table created successfully.\n";
    } else {
        echo "  ✓ Users table exists. Checking structure...\n";
        
        // Check if required columns exist
        $stmt = $pdo->query("DESCRIBE users");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $requiredColumns = [
            'pekerjaan_ayah' => "ALTER TABLE users ADD COLUMN pekerjaan_ayah VARCHAR(200) NOT NULL AFTER no_telp_orangtua",
            'pekerjaan_ibu' => "ALTER TABLE users ADD COLUMN pekerjaan_ibu VARCHAR(200) NOT NULL AFTER pekerjaan_ayah"
        ];
        
        foreach ($requiredColumns as $column => $sql) {
            if (!in_array($column, $columns)) {
                echo "  Adding column: $column\n";
                $pdo->exec($sql);
                echo "  ✓ Added column: $column\n";
            } else {
                echo "  ✓ Column $column already exists.\n";
            }
        }
        
        // Remove old pekerjaan_orangtua column if it exists
        if (in_array('pekerjaan_orangtua', $columns)) {
            echo "  Removing old column: pekerjaan_orangtua\n";
            $pdo->exec("ALTER TABLE users DROP COLUMN pekerjaan_orangtua");
            echo "  ✓ Removed old column: pekerjaan_orangtua\n";
        }
    }
    
    // 3. Initialize settings table
    echo "\n3. Initializing settings table...\n";
    
    // Check if settings table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'settings'");
    if ($stmt->rowCount() == 0) {
        echo "  Creating settings table...\n";
        
        // Create settings table
        $sql = "CREATE TABLE settings (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `key` VARCHAR(100) NOT NULL UNIQUE,
            value TEXT NOT NULL,
            description TEXT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL
        )";
        
        $pdo->exec($sql);
        echo "  ✓ Settings table created successfully.\n";
    } else {
        echo "  ✓ Settings table exists.\n";
    }
    
    // Insert default settings
    $defaultSettings = [
        [
            'key' => 'whatsapp_group_link',
            'value' => 'https://chat.whatsapp.com/your-group-link-here',
            'description' => 'WhatsApp group link for new member registration'
        ],
        [
            'key' => 'whatsapp_group_name',
            'value' => 'MAPALA Politala Official',
            'description' => 'WhatsApp group name'
        ],
        [
            'key' => 'admin_email',
            'value' => 'admin@mapala-politala.ac.id',
            'description' => 'Admin email address'
        ],
        [
            'key' => 'admin_phone',
            'value' => '081234567890',
            'description' => 'Admin phone number'
        ]
    ];
    
    foreach ($defaultSettings as $setting) {
        // Check if setting already exists
        $stmt = $pdo->prepare("SELECT id FROM settings WHERE `key` = ?");
        $stmt->execute([$setting['key']]);
        
        if ($stmt->rowCount() == 0) {
            // Insert new setting
            $stmt = $pdo->prepare("INSERT INTO settings (`key`, value, description, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
            $stmt->execute([$setting['key'], $setting['value'], $setting['description']]);
            echo "  ✓ Added setting: " . $setting['key'] . "\n";
        } else {
            echo "  ✓ Setting already exists: " . $setting['key'] . "\n";
        }
    }
    
    echo "\n✓ Database structure fixed successfully!\n";
    
} catch (PDOException $e) {
    echo "\n✗ Database error: " . $e->getMessage() . "\n";
    echo "Please make sure MySQL is running and the database 'mapala_db' exists.\n";
    echo "You can create the database with: CREATE DATABASE mapala_db;\n";
}

echo "\n=== Fix Script Completed ===\n";
echo "The registration system should now work properly.\n";
echo "Try registering a new user to test the system.\n";