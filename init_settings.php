<?php
// Settings initialization script
// This script will create the settings table and populate it with default values

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mapala_db';

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully.\n";
    
    // Check if settings table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'settings'");
    if ($stmt->rowCount() == 0) {
        echo "Settings table does not exist. Creating it...\n";
        
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
        echo "Settings table created successfully.\n";
    } else {
        echo "Settings table exists.\n";
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
            echo "Added setting: " . $setting['key'] . "\n";
        } else {
            echo "Setting already exists: " . $setting['key'] . "\n";
        }
    }
    
    echo "Settings initialization completed successfully!\n";
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}