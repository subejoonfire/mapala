<?php

require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

echo "=== Testing Document Generation ===\n";

// Create test directories
if (!is_dir('public/uploads/documents')) {
    mkdir('public/uploads/documents', 0755, true);
    echo "✅ Created documents directory\n";
}

if (!is_dir('public/uploads/fotos')) {
    mkdir('public/uploads/fotos', 0755, true);
    echo "✅ Created fotos directory\n";
}

// Sample user data for testing
$sampleUserData = [
    'nama_lengkap' => 'Ahmad Rizki Pratama',
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
    'foto' => null, // No photo for testing
    'status' => 'pending',
    'angkatan' => '2024'
];

function testFormGeneration($userData) {
    echo "\n=== Testing Form Generation ===\n";
    
    try {
        $templatePath = 'app/template_formulir_simple.docx';
        
        if (!file_exists($templatePath)) {
            echo "❌ Template not found: $templatePath\n";
            return false;
        }
        
        echo "✅ Template found: $templatePath\n";
        
        // Create template processor
        $templateProcessor = new TemplateProcessor($templatePath);
        echo "✅ Template processor created\n";
        
        // Prepare data for template replacement
        $templateData = [
            'nama_lengkap' => $userData['nama_lengkap'],
            'nama_panggilan' => $userData['nama_panggilan'],
            'tempat_lahir' => $userData['tempat_lahir'],
            'tanggal_lahir' => date('d F Y', strtotime($userData['tanggal_lahir'])),
            'tempat_tanggal_lahir' => $userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir'])),
            'jenis_kelamin' => $userData['jenis_kelamin'],
            'alamat' => $userData['alamat'],
            'no_telp' => $userData['no_telp'],
            'agama' => $userData['agama'],
            'program_studi' => $userData['program_studi'],
            'gol_darah' => $userData['gol_darah'],
            'penyakit' => $userData['penyakit'] ?: 'Tidak ada',
            'nama_ayah' => $userData['nama_ayah'],
            'nama_ibu' => $userData['nama_ibu'],
            'alamat_orangtua' => $userData['alamat_orangtua'],
            'no_telp_orangtua' => $userData['no_telp_orangtua'],
            'pekerjaan_ayah' => $userData['pekerjaan_ayah'],
            'pekerjaan_ibu' => $userData['pekerjaan_ibu'],
            'tanggal_daftar' => date('d F Y'),
            'angkatan' => $userData['angkatan'],
            'status' => 'PENDING - Menunggu persetujuan admin'
        ];
        
        // Replace text placeholders
        foreach ($templateData as $placeholder => $value) {
            $templateProcessor->setValue($placeholder, $value);
        }
        echo "✅ Text placeholders replaced\n";
        
        // Handle photo placeholder
        $templateProcessor->setValue('foto', 'Foto akan diisi setelah upload');
        
        // Save the generated document
        $filename = 'test_formulir_pendaftaran_' . date('Y-m-d_H-i-s') . '.docx';
        $filepath = 'public/uploads/documents/' . $filename;
        
        $templateProcessor->saveAs($filepath);
        echo "✅ Document saved: $filepath\n";
        
        if (file_exists($filepath)) {
            echo "✅ Document file exists and size: " . filesize($filepath) . " bytes\n";
            return $filename;
        } else {
            echo "❌ Document file not created\n";
            return false;
        }
        
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
        return false;
    }
}

function testIdCardGeneration($userData) {
    echo "\n=== Testing ID Card Generation ===\n";
    
    try {
        $templatePath = 'app/template_id_card_simple.docx';
        
        if (!file_exists($templatePath)) {
            echo "❌ Template not found: $templatePath\n";
            return false;
        }
        
        echo "✅ Template found: $templatePath\n";
        
        // Create template processor
        $templateProcessor = new TemplateProcessor($templatePath);
        echo "✅ Template processor created\n";
        
        // Prepare data for template replacement
        $templateData = [
            'nama_lengkap' => $userData['nama_lengkap'],
            'nama_panggilan' => $userData['nama_panggilan'],
            'program_studi' => $userData['program_studi'],
            'angkatan' => $userData['angkatan'],
            'jenis_kelamin' => $userData['jenis_kelamin'],
            'gol_darah' => $userData['gol_darah'],
            'no_telp' => $userData['no_telp'],
            'status' => 'CALON ANGGOTA',
            'tanggal_terbit' => date('d F Y'),
            'tahun' => date('Y')
        ];
        
        // Replace text placeholders
        foreach ($templateData as $placeholder => $value) {
            $templateProcessor->setValue($placeholder, $value);
        }
        echo "✅ Text placeholders replaced\n";
        
        // Handle photo placeholder
        $templateProcessor->setValue('foto', 'Foto akan diisi setelah upload');
        
        // Save the generated document
        $filename = 'test_id_card_' . date('Y-m-d_H-i-s') . '.docx';
        $filepath = 'public/uploads/documents/' . $filename;
        
        $templateProcessor->saveAs($filepath);
        echo "✅ Document saved: $filepath\n";
        
        if (file_exists($filepath)) {
            echo "✅ Document file exists and size: " . filesize($filepath) . " bytes\n";
            return $filename;
        } else {
            echo "❌ Document file not created\n";
            return false;
        }
        
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
        return false;
    }
}

// Run tests
$formResult = testFormGeneration($sampleUserData);
$idCardResult = testIdCardGeneration($sampleUserData);

echo "\n=== Test Results ===\n";
if ($formResult) {
    echo "✅ Form generation: SUCCESS - $formResult\n";
} else {
    echo "❌ Form generation: FAILED\n";
}

if ($idCardResult) {
    echo "✅ ID Card generation: SUCCESS - $idCardResult\n";
} else {
    echo "❌ ID Card generation: FAILED\n";
}

if ($formResult && $idCardResult) {
    echo "\n🎉 All tests passed! Document generation is working correctly.\n";
    echo "The system is ready to generate documents with user data.\n";
    echo "\nNext steps:\n";
    echo "1. Test with actual user registration\n";
    echo "2. Add photo integration when photos are uploaded\n";
    echo "3. Test download functionality\n";
} else {
    echo "\n❌ Some tests failed. Please check the errors above.\n";
}

?>