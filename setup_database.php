<?php

/**
 * Setup Database untuk Form Pendaftaran MAPALA Politala
 * 
 * Script ini akan membuat struktur database yang diperlukan
 * untuk form pendaftaran dengan field-field baru.
 */

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mapala_db';

try {
    // Create connection
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to MySQL server successfully\n";
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database '$database' created or already exists\n";
    
    // Use the database
    $pdo->exec("USE `$database`");
    
    // Read SQL file
    $sql = file_get_contents('setup_database.sql');
    
    // Split SQL commands
    $commands = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($commands as $command) {
        if (!empty($command) && $command !== 'COMMIT') {
            try {
                $pdo->exec($command);
                echo "✓ Executed: " . substr($command, 0, 50) . "...\n";
            } catch (PDOException $e) {
                echo "✗ Error executing command: " . $e->getMessage() . "\n";
                echo "Command: " . substr($command, 0, 100) . "...\n";
            }
        }
    }
    
    echo "\n✅ Database setup completed successfully!\n";
    echo "\nDatabase structure:\n";
    echo "- users: Table untuk data pendaftar dengan field baru\n";
    echo "- divisi: Table untuk divisi MAPALA\n";
    echo "- kegiatan: Table untuk kegiatan MAPALA\n";
    echo "- settings: Table untuk pengaturan aplikasi\n";
    echo "- admins: Table untuk admin (username: admin, password: admin123)\n";
    
    // Verify tables created
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\nTables created:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
    }
    
    // Show users table structure
    echo "\nUsers table structure:\n";
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "- {$column['Field']}: {$column['Type']}\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n🎉 Setup completed! You can now use the registration form.\n";
echo "\nNext steps:\n";
echo "1. Configure your database connection in app/Config/Database.php\n";
echo "2. Make sure the database credentials match:\n";
echo "   - Host: $host\n";
echo "   - Database: $database\n";
echo "   - Username: $username\n";
echo "3. Test the registration form at /daftar\n";
?>