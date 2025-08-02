<?php
// Database fix script
// This script will manually fix the database structure

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
    
    // Check if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() == 0) {
        echo "Users table does not exist. Creating it...\n";
        
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
        echo "Users table created successfully.\n";
    } else {
        echo "Users table exists. Checking structure...\n";
        
        // Check if required columns exist
        $stmt = $pdo->query("DESCRIBE users");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $requiredColumns = [
            'pekerjaan_ayah' => "ALTER TABLE users ADD COLUMN pekerjaan_ayah VARCHAR(200) NOT NULL AFTER no_telp_orangtua",
            'pekerjaan_ibu' => "ALTER TABLE users ADD COLUMN pekerjaan_ibu VARCHAR(200) NOT NULL AFTER pekerjaan_ayah"
        ];
        
        foreach ($requiredColumns as $column => $sql) {
            if (!in_array($column, $columns)) {
                echo "Adding column: $column\n";
                $pdo->exec($sql);
            } else {
                echo "Column $column already exists.\n";
            }
        }
        
        // Remove old pekerjaan_orangtua column if it exists
        if (in_array('pekerjaan_orangtua', $columns)) {
            echo "Removing old column: pekerjaan_orangtua\n";
            $pdo->exec("ALTER TABLE users DROP COLUMN pekerjaan_orangtua");
        }
    }
    
    echo "Database structure fixed successfully!\n";
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}