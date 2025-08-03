<?php

echo "=== Cleaning Up Testing Files ===\n";

$testFiles = [
    'check_template.php',
    'prepare_templates.php',
    'test_document_generation.php',
    'test_with_photo.php',
    'cleanup_testing.php', // This file itself
    'public/uploads/fotos/dummy_photo.jpg'
];

$testDocuments = glob('public/uploads/documents/test_*.docx');

echo "Files to be removed:\n";

// List test PHP files
foreach ($testFiles as $file) {
    if (file_exists($file)) {
        echo "📄 $file\n";
    }
}

// List test documents
foreach ($testDocuments as $file) {
    echo "📄 $file\n";
}

echo "\nProceed with cleanup? (y/n): ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
fclose($handle);

if (trim($line) !== 'y' && trim($line) !== 'Y') {
    echo "Cleanup cancelled.\n";
    exit(0);
}

$removed = 0;
$errors = 0;

// Remove test PHP files
foreach ($testFiles as $file) {
    if (file_exists($file)) {
        if (unlink($file)) {
            echo "✅ Removed: $file\n";
            $removed++;
        } else {
            echo "❌ Failed to remove: $file\n";
            $errors++;
        }
    }
}

// Remove test documents
foreach ($testDocuments as $file) {
    if (file_exists($file)) {
        if (unlink($file)) {
            echo "✅ Removed: $file\n";
            $removed++;
        } else {
            echo "❌ Failed to remove: $file\n";
            $errors++;
        }
    }
}

echo "\n=== Cleanup Summary ===\n";
echo "✅ Files removed: $removed\n";
echo "❌ Errors: $errors\n";

if ($errors === 0) {
    echo "\n🎉 Cleanup completed successfully!\n";
    echo "The system is now clean and ready for production.\n";
    echo "\nRemaining important files:\n";
    echo "📋 SETUP_TEMPLATE_INSTRUCTIONS.md - Setup guide\n";
    echo "📄 app/template_formulir_simple.docx - Working form template\n";
    echo "📄 app/template_id_card_simple.docx - Working ID card template\n";
    echo "📄 app/Formulir Pendaftaran Calang.docx - Your original form template\n";
    echo "📄 app/ID CARD.docx - Your original ID card template\n";
    echo "🔧 app/Controllers/Daftar.php - Updated controller with template processing\n";
} else {
    echo "\n⚠️  Some files could not be removed. Please check permissions.\n";
}

?>