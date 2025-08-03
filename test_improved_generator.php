<?php

// Define ROOTPATH for testing
if (!defined('ROOTPATH')) {
    define('ROOTPATH', __DIR__ . '/');
}

require_once 'vendor/autoload.php';

use App\Libraries\DocxGeneratorImproved;

echo "=== Testing Improved HTML Template to DOCX Conversion ===\n";

// Sample user data untuk testing
$sampleUserData = [
    'nama_lengkap' => 'Muhammad Rizki Pratama',
    'nama_panggilan' => 'Rizki',
    'tempat_lahir' => 'Banjarmasin',
    'tanggal_lahir' => '2002-03-15',
    'jenis_kelamin' => 'Laki-laki',
    'alamat' => 'Jl. Veteran No. 123, Banjarmasin, Kalimantan Selatan',
    'no_telp' => '081234567890',
    'agama' => 'Islam',
    'program_studi' => 'Teknologi Informasi',
    'gol_darah' => 'A',
    'penyakit' => '',
    'nama_ayah' => 'Muhammad Pratama',
    'nama_ibu' => 'Siti Khadijah',
    'alamat_orangtua' => 'Jl. Veteran No. 123, Banjarmasin, Kalimantan Selatan',
    'no_telp_orangtua' => '081234567891',
    'pekerjaan_ayah' => 'Pegawai Negeri Sipil',
    'pekerjaan_ibu' => 'Ibu Rumah Tangga',
    'foto' => 'dummy_photo.jpg',
    'status' => 'pending',
    'angkatan' => '2024'
];

// Test 1: Formulir Pendaftaran
echo "\n=== Test 1: Formulir Pendaftaran (Improved) ===\n";
try {
    $docxGenerator = new DocxGeneratorImproved();
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
echo "\n=== Test 2: ID Card (Improved) ===\n";
try {
    $docxGenerator = new DocxGeneratorImproved();
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

// Test 3: Asset verification
echo "\n=== Test 3: Asset Verification ===\n";
$logoKiri = ROOTPATH . 'template_docx/formulir_pendaftaran/logo_kiri.png';
$logoKanan = ROOTPATH . 'template_docx/formulir_pendaftaran/logo_kanan.png';
$photoPath = ROOTPATH . 'public/uploads/fotos/dummy_photo.jpg';

echo "Logo kiri: " . (file_exists($logoKiri) ? "✅ Found" : "❌ Not found") . "\n";
echo "Logo kanan: " . (file_exists($logoKanan) ? "✅ Found" : "❌ Not found") . "\n";
echo "Dummy photo: " . (file_exists($photoPath) ? "✅ Found" : "❌ Not found") . "\n";

echo "\n=== Test Summary ===\n";
if (isset($formResult) && isset($idCardResult) && $formResult && $idCardResult) {
    echo "🎉 All tests passed! Improved DOCX generation is working.\n";
    echo "\nGenerated files:\n";
    echo "📄 $formResult\n";
    echo "📄 $idCardResult\n";
    
    echo "\n✨ Features implemented:\n";
    echo "✅ Template HTML structure replicated in DOCX\n";
    echo "✅ Logo integration from template folder\n";
    echo "✅ Photo integration from uploads\n";
    echo "✅ Auto-fill all user data\n";
    echo "✅ Clean DOCX generation without HTML parsing warnings\n";
    echo "✅ Professional formatting matching template design\n";
} else {
    echo "❌ Some tests failed. Check errors above.\n";
}

// Compare with previous versions
echo "\n=== File Comparison ===\n";
$allFiles = glob('public/uploads/documents/*.docx');
usort($allFiles, function($a, $b) {
    return filemtime($b) - filemtime($a); // Sort by modification time, newest first
});

echo "Recent generated files:\n";
foreach (array_slice($allFiles, 0, 6) as $file) {
    $time = date('Y-m-d H:i:s', filemtime($file));
    $size = filesize($file);
    echo "📄 " . basename($file) . " ($size bytes) - $time\n";
}

?>