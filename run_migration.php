<?php

// Simple migration runner script
require_once 'vendor/autoload.php';

// Define FCPATH if not defined
if (!defined('FCPATH')) {
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
}

// Load CodeIgniter
$pathsPath = realpath(FCPATH . 'app/Config/Paths.php');
require_once $pathsPath;

$paths = new Config\Paths();
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = require realpath($bootstrap) ?: $bootstrap;

// Run migration
try {
    echo "Starting migration process...\n";
    
    // Get migration service
    $runner = service('migrations');
    
    echo "Running migration: UpdateUsersTableWithNewFields\n";
    
    // Run the migration
    $result = $runner->latest();
    
    if ($result) {
        echo "Migration completed successfully!\n";
    } else {
        echo "Migration failed or no migrations to run.\n";
    }
    
} catch (Exception $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}