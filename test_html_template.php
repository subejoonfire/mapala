<?php

// Define ROOTPATH for testing
if (!defined('ROOTPATH')) {
    define('ROOTPATH', __DIR__ . '/');
}

require_once 'vendor/autoload.php';

use App\Libraries\DocxGenerator;

echo "=== Testing HTML Template to DOCX Conversion ===\n";

// Sample user data untuk testing
$sampleUserData = [
    'nama_lengkap' => 'Siti Fatimah Azzahra',
    'nama_panggilan' => 'Fatimah',
    'tempat_lahir' => 'Banjarbaru',
    'tanggal_lahir' => '2003-07-20',
    'jenis_kelamin' => 'Perempuan',
    'alamat' => 'Jl. Ahmad Yani No. 456, Banjarbaru, Kalimantan Selatan',
    'no_telp' => '082345678901',
    'agama' => 'Islam',
    'program_studi' => 'Akuntansi',
    'gol_darah' => 'B',
    'penyakit' => 'Asma ringan',
    'nama_ayah' => 'Ahmad Hidayat',
    'nama_ibu' => 'Aminah Sari',
    'alamat_orangtua' => 'Jl. Ahmad Yani No. 456, Banjarbaru, Kalimantan Selatan',
    'no_telp_orangtua' => '082345678902',
    'pekerjaan_ayah' => 'Wiraswasta',
    'pekerjaan_ibu' => 'Guru',
    'foto' => 'dummy_photo.jpg',
    'status' => 'pending',
    'angkatan' => '2024'
];

// Test 1: Formulir Pendaftaran
echo "\n=== Test 1: Formulir Pendaftaran ===\n";
try {
    $docxGenerator = new DocxGenerator();
    $formResult = $docxGenerator->generateFormulirPendaftaran($sampleUserData);
    
    if ($formResult) {
        echo "✅ Formulir generated: $formResult\n";
        $filepath = ROOTPATH . 'public/uploads/documents/' . $formResult;
        if (file_exists($filepath)) {
            echo "✅ File exists, size: " . filesize($filepath) . " bytes\n";
        } else {
            echo "❌ File not found: $filepath\n";
        }
    } else {
        echo "❌ Formulir generation failed\n";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

// Test 2: ID Card
echo "\n=== Test 2: ID Card ===\n";
try {
    $docxGenerator = new DocxGenerator();
    $idCardResult = $docxGenerator->generateIdCard($sampleUserData);
    
    if ($idCardResult) {
        echo "✅ ID Card generated: $idCardResult\n";
        $filepath = ROOTPATH . 'public/uploads/documents/' . $idCardResult;
        if (file_exists($filepath)) {
            echo "✅ File exists, size: " . filesize($filepath) . " bytes\n";
        } else {
            echo "❌ File not found: $filepath\n";
        }
    } else {
        echo "❌ ID Card generation failed\n";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

// Test 3: Template loading (debug)
echo "\n=== Test 3: Template Loading Debug ===\n";
try {
    echo "Checking template paths...\n";
    
    $formTemplatePath = ROOTPATH . 'template_docx/formulir_pendaftaran/index.php';
    $idCardTemplatePath = ROOTPATH . 'template_docx/id_card/index.php';
    
    if (file_exists($formTemplatePath)) {
        echo "✅ Formulir template found: $formTemplatePath\n";
    } else {
        echo "❌ Formulir template not found: $formTemplatePath\n";
    }
    
    if (file_exists($idCardTemplatePath)) {
        echo "✅ ID Card template found: $idCardTemplatePath\n";
    } else {
        echo "❌ ID Card template not found: $idCardTemplatePath\n";
    }
    
    // Check ROOTPATH
    echo "ROOTPATH: " . ROOTPATH . "\n";
    echo "Current directory: " . getcwd() . "\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== Test Summary ===\n";
if (isset($formResult) && isset($idCardResult) && $formResult && $idCardResult) {
    echo "🎉 All tests passed! HTML template to DOCX conversion is working.\n";
    echo "Generated files:\n";
    echo "📄 $formResult\n";
    echo "📄 $idCardResult\n";
} else {
    echo "❌ Some tests failed. Check errors above.\n";
}

// List all generated files
echo "\n=== Generated Files ===\n";
$files = glob('public/uploads/documents/*.docx');
foreach ($files as $file) {
    echo "📄 " . basename($file) . " (" . filesize($file) . " bytes) - " . date('Y-m-d H:i:s', filemtime($file)) . "\n";
}

?>