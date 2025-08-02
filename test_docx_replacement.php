<?php

require_once 'vendor/autoload.php';

/**
 * Script untuk test replacement DOCX dengan data dummy
 */

echo "🧪 TEST DOCX REPLACEMENT\n";
echo "=" . str_repeat("=", 40) . "\n\n";

// Data dummy untuk testing
$userData = [
    'nama_lengkap' => 'John Doe Test',
    'nama_panggilan' => 'John',
    'tempat_lahir' => 'Jakarta',
    'tanggal_lahir' => '1995-05-15',
    'jenis_kelamin' => 'Laki-laki',
    'alamat' => 'Jl. Test No. 123, Jakarta',
    'no_telp' => '081234567890',
    'agama' => 'Islam',
    'program_studi' => 'Teknologi Informasi',
    'gol_darah' => 'O',
    'penyakit' => 'Tidak ada',
    'nama_ayah' => 'Bapak Test',
    'nama_ibu' => 'Ibu Test',
    'alamat_orangtua' => 'Jl. Orangtua No. 456, Jakarta',
    'no_telp_orangtua' => '087654321098',
    'pekerjaan_ayah' => 'Pegawai Swasta',
    'pekerjaan_ibu' => 'Ibu Rumah Tangga',
    'angkatan' => 2024
];

function testDocxReplacement($templatePath, $outputPath, $userData) {
    if (!file_exists($templatePath)) {
        echo "❌ Template tidak ditemukan: $templatePath\n";
        return false;
    }
    
    // Copy template ke output
    copy($templatePath, $outputPath);
    echo "✅ Template dicopy ke: $outputPath\n";
    
    // Buka file untuk editing
    $zip = new ZipArchive();
    if ($zip->open($outputPath) === TRUE) {
        echo "✅ File DOCX berhasil dibuka\n";
        
        // Baca document.xml
        $documentXml = $zip->getFromName('word/document.xml');
        if (!$documentXml) {
            echo "❌ Tidak bisa membaca document.xml\n";
            $zip->close();
            return false;
        }
        
        echo "✅ document.xml berhasil dibaca (" . strlen($documentXml) . " bytes)\n";
        
        // Tampilkan preview konten (first 500 chars)
        echo "\n📄 Preview konten XML:\n";
        echo substr($documentXml, 0, 500) . "...\n\n";
        
        // Cari pattern text dalam XML
        echo "🔍 Mencari pattern text...\n";
        if (preg_match_all('/<w:t[^>]*>([^<]+)<\/w:t>/', $documentXml, $matches)) {
            echo "✅ Ditemukan " . count($matches[1]) . " text elements:\n";
            $uniqueTexts = array_unique($matches[1]);
            foreach (array_slice($uniqueTexts, 0, 20) as $text) { // Show first 20
                if (trim($text) && !ctype_space($text)) {
                    echo "   - \"" . trim($text) . "\"\n";
                }
            }
            if (count($uniqueTexts) > 20) {
                echo "   ... dan " . (count($uniqueTexts) - 20) . " lainnya\n";
            }
        }
        
        // Backup original XML
        $originalXml = $documentXml;
        
        // Method 1: Simple string replacement
        echo "\n🔄 Method 1: Simple String Replacement\n";
        $simpleReplacements = [
            // Ganti titik-titik atau underscore dengan data
            '.....................' => $userData['nama_lengkap'],
            '.......................' => $userData['nama_lengkap'],
            '........................' => $userData['nama_lengkap'],
            '_______________' => $userData['nama_lengkap'],
            '________________' => $userData['nama_lengkap'],
            '_________________' => $userData['nama_lengkap'],
        ];
        
        foreach ($simpleReplacements as $search => $replace) {
            if (strpos($documentXml, $search) !== false) {
                $documentXml = str_replace($search, $replace, $documentXml);
                echo "   ✅ Replaced: '$search' → '$replace'\n";
            }
        }
        
        // Method 2: Pattern-based replacement
        echo "\n🔄 Method 2: Pattern-based Replacement\n";
        
        // Replace dalam XML structure
        $patterns = [
            // Cari text yang berisi titik-titik dan ganti
            '/<w:t[^>]*>([^<]*\.{5,}[^<]*)<\/w:t>/' => function($matches) use ($userData) {
                return '<w:t>' . $userData['nama_lengkap'] . '</w:t>';
            },
            '/<w:t[^>]*>([^<]*_{5,}[^<]*)<\/w:t>/' => function($matches) use ($userData) {
                return '<w:t>' . $userData['nama_lengkap'] . '</w:t>';
            },
        ];
        
        foreach ($patterns as $pattern => $replacement) {
            if (is_callable($replacement)) {
                $documentXml = preg_replace_callback($pattern, $replacement, $documentXml);
                echo "   ✅ Applied pattern: $pattern\n";
            } else {
                $documentXml = preg_replace($pattern, $replacement, $documentXml);
                echo "   ✅ Applied pattern: $pattern\n";
            }
        }
        
        // Method 3: Specific field replacement
        echo "\n🔄 Method 3: Field-specific Replacement\n";
        
        // Cari dan ganti berdasarkan konteks
        $fieldReplacements = [
            'nama_lengkap' => $userData['nama_lengkap'],
            'nama_panggilan' => $userData['nama_panggilan'],
            'tempat_lahir' => $userData['tempat_lahir'],
            'tanggal_lahir' => date('d F Y', strtotime($userData['tanggal_lahir'])),
            'jenis_kelamin' => $userData['jenis_kelamin'],
            'alamat' => $userData['alamat'],
            'no_telp' => $userData['no_telp'],
            'agama' => $userData['agama'],
            'program_studi' => $userData['program_studi'],
            'gol_darah' => $userData['gol_darah'],
            'penyakit' => $userData['penyakit'],
            'nama_ayah' => $userData['nama_ayah'],
            'nama_ibu' => $userData['nama_ibu'],
            'alamat_orangtua' => $userData['alamat_orangtua'],
            'no_telp_orangtua' => $userData['no_telp_orangtua'],
            'pekerjaan_ayah' => $userData['pekerjaan_ayah'],
            'pekerjaan_ibu' => $userData['pekerjaan_ibu'],
        ];
        
        foreach ($fieldReplacements as $field => $value) {
            // Try different patterns for each field
            $patterns = [
                "/(<w:t[^>]*>.*?" . ucwords(str_replace('_', ' ', $field)) . ".*?<\/w:t>.*?<w:t[^>]*>)[^<]*(<\/w:t>)/i",
                "/(<w:t[^>]*>)" . $field . "(<\/w:t>)/i",
                "/(<w:t[^>]*>)" . strtoupper($field) . "(<\/w:t>)/i",
            ];
            
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $documentXml)) {
                    $documentXml = preg_replace($pattern, '${1}' . htmlspecialchars($value) . '${2}', $documentXml);
                    echo "   ✅ Field '$field' replaced with '$value'\n";
                    break;
                }
            }
        }
        
        // Check if any changes were made
        if ($documentXml !== $originalXml) {
            echo "\n✅ Changes detected, updating document...\n";
            
            // Update document.xml dalam ZIP
            $zip->addFromString('word/document.xml', $documentXml);
            echo "✅ document.xml updated\n";
        } else {
            echo "\n⚠️  No changes made to document\n";
        }
        
        $zip->close();
        echo "✅ File DOCX berhasil disimpan\n";
        
        return true;
        
    } else {
        echo "❌ Tidak bisa membuka file DOCX\n";
        return false;
    }
}

// Test Formulir Pendaftaran
echo "📄 Testing Formulir Pendaftaran...\n";
echo "-" . str_repeat("-", 35) . "\n";
$result1 = testDocxReplacement(
    'Formulir Pendaftaran Calang.docx',
    'test_formulir_output.docx',
    $userData
);

echo "\n" . str_repeat("=", 60) . "\n\n";

// Test ID Card
echo "🆔 Testing ID Card...\n";
echo "-" . str_repeat("-", 20) . "\n";
$result2 = testDocxReplacement(
    'ID CARD.docx',
    'test_idcard_output.docx',
    $userData
);

echo "\n" . str_repeat("=", 60) . "\n";

echo "\n📋 HASIL TEST:\n";
echo "- Formulir Pendaftaran: " . ($result1 ? "✅ BERHASIL" : "❌ GAGAL") . "\n";
echo "- ID Card: " . ($result2 ? "✅ BERHASIL" : "❌ GAGAL") . "\n";

if ($result1) {
    echo "\n📁 File output tersimpan:\n";
    echo "- test_formulir_output.docx\n";
}
if ($result2) {
    echo "- test_idcard_output.docx\n";
}

echo "\n💡 Buka file output dengan Microsoft Word untuk melihat hasilnya!\n";

?>