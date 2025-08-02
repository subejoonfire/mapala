<?php

require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

/**
 * Script untuk menganalisis template DOCX dan menampilkan placeholder yang tersedia
 */

echo "🔍 ANALISIS TEMPLATE DOCX MAPALA POLITALA\n";
echo "=" . str_repeat("=", 50) . "\n\n";

// Analyze Formulir Pendaftaran template
echo "📄 FORMULIR PENDAFTARAN TEMPLATE:\n";
echo "-" . str_repeat("-", 30) . "\n";

$templatePath1 = 'Formulir Pendaftaran Calang.docx';
if (file_exists($templatePath1)) {
    try {
        $templateProcessor1 = new TemplateProcessor($templatePath1);
        $variables1 = $templateProcessor1->getVariables();
        
        if (!empty($variables1)) {
            echo "✅ Template ditemukan! Placeholder yang tersedia:\n";
            foreach ($variables1 as $variable) {
                echo "   - \${" . $variable . "}\n";
            }
        } else {
            echo "⚠️  Template ditemukan tapi tidak ada placeholder yang terdeteksi.\n";
            echo "   Kemungkinan menggunakan format placeholder yang berbeda.\n";
        }
        
        // Try to extract text content for manual analysis
        echo "\n📝 Mencoba ekstrak konten untuk analisis manual...\n";
        
        // Create a temporary copy and try to read content
        $tempFile = 'temp_analysis.docx';
        copy($templatePath1, $tempFile);
        
        // Try to read as ZIP (DOCX is actually a ZIP file)
        $zip = new ZipArchive();
        if ($zip->open($tempFile) === TRUE) {
            // Read document.xml which contains the main content
            $documentXml = $zip->getFromName('word/document.xml');
            if ($documentXml) {
                // Look for common placeholder patterns
                $patterns = [
                    '/\$\{([^}]+)\}/',  // ${placeholder}
                    '/\{([^}]+)\}/',    // {placeholder}
                    '/\[([^\]]+)\]/',   // [placeholder]
                    '/__([^_]+)__/',    // __placeholder__
                    '/\{\{([^}]+)\}\}/' // {{placeholder}}
                ];
                
                $foundPlaceholders = [];
                foreach ($patterns as $pattern) {
                    if (preg_match_all($pattern, $documentXml, $matches)) {
                        $foundPlaceholders = array_merge($foundPlaceholders, $matches[1]);
                    }
                }
                
                if (!empty($foundPlaceholders)) {
                    echo "🎯 Placeholder ditemukan dalam dokumen:\n";
                    $foundPlaceholders = array_unique($foundPlaceholders);
                    foreach ($foundPlaceholders as $placeholder) {
                        echo "   - " . $placeholder . "\n";
                    }
                } else {
                    echo "❌ Tidak ditemukan placeholder dalam format standar.\n";
                    echo "   Template mungkin menggunakan format khusus atau sudah terisi.\n";
                }
            }
            $zip->close();
        }
        
        unlink($tempFile);
        
    } catch (Exception $e) {
        echo "❌ Error membaca template: " . $e->getMessage() . "\n";
    }
} else {
    echo "❌ File template tidak ditemukan: $templatePath1\n";
}

echo "\n" . str_repeat("=", 60) . "\n\n";

// Analyze ID Card template
echo "🆔 ID CARD TEMPLATE:\n";
echo "-" . str_repeat("-", 20) . "\n";

$templatePath2 = 'ID CARD.docx';
if (file_exists($templatePath2)) {
    try {
        $templateProcessor2 = new TemplateProcessor($templatePath2);
        $variables2 = $templateProcessor2->getVariables();
        
        if (!empty($variables2)) {
            echo "✅ Template ditemukan! Placeholder yang tersedia:\n";
            foreach ($variables2 as $variable) {
                echo "   - \${" . $variable . "}\n";
            }
        } else {
            echo "⚠️  Template ditemukan tapi tidak ada placeholder yang terdeteksi.\n";
            echo "   Kemungkinan menggunakan format placeholder yang berbeda.\n";
        }
        
        // Try to extract text content for manual analysis
        echo "\n📝 Mencoba ekstrak konten untuk analisis manual...\n";
        
        // Create a temporary copy and try to read content
        $tempFile = 'temp_analysis2.docx';
        copy($templatePath2, $tempFile);
        
        // Try to read as ZIP (DOCX is actually a ZIP file)
        $zip = new ZipArchive();
        if ($zip->open($tempFile) === TRUE) {
            // Read document.xml which contains the main content
            $documentXml = $zip->getFromName('word/document.xml');
            if ($documentXml) {
                // Look for common placeholder patterns
                $patterns = [
                    '/\$\{([^}]+)\}/',  // ${placeholder}
                    '/\{([^}]+)\}/',    // {placeholder}
                    '/\[([^\]]+)\]/',   // [placeholder]
                    '/__([^_]+)__/',    // __placeholder__
                    '/\{\{([^}]+)\}\}/' // {{placeholder}}
                ];
                
                $foundPlaceholders = [];
                foreach ($patterns as $pattern) {
                    if (preg_match_all($pattern, $documentXml, $matches)) {
                        $foundPlaceholders = array_merge($foundPlaceholders, $matches[1]);
                    }
                }
                
                if (!empty($foundPlaceholders)) {
                    echo "🎯 Placeholder ditemukan dalam dokumen:\n";
                    $foundPlaceholders = array_unique($foundPlaceholders);
                    foreach ($foundPlaceholders as $placeholder) {
                        echo "   - " . $placeholder . "\n";
                    }
                } else {
                    echo "❌ Tidak ditemukan placeholder dalam format standar.\n";
                    echo "   Template mungkin menggunakan format khusus atau sudah terisi.\n";
                }
            }
            $zip->close();
        }
        
        unlink($tempFile);
        
    } catch (Exception $e) {
        echo "❌ Error membaca template: " . $e->getMessage() . "\n";
    }
} else {
    echo "❌ File template tidak ditemukan: $templatePath2\n";
}

echo "\n" . str_repeat("=", 60) . "\n";

echo "\n💡 REKOMENDASI:\n";
echo "1. Jika tidak ada placeholder yang terdeteksi, template mungkin:\n";
echo "   - Sudah berisi data (bukan template kosong)\n";
echo "   - Menggunakan format placeholder yang tidak standar\n";
echo "   - Perlu dibuat ulang dengan placeholder yang benar\n\n";

echo "2. Format placeholder yang didukung PhpWord:\n";
echo "   - \${nama_field} (recommended)\n";
echo "   - \${NAMA_FIELD} (uppercase)\n\n";

echo "3. Untuk membuat template yang benar:\n";
echo "   - Buka template DOCX di Microsoft Word\n";
echo "   - Ganti data yang ingin dinamis dengan \${nama_field}\n";
echo "   - Simpan sebagai .docx\n\n";

echo "🚀 Template yang sudah diperbaiki akan otomatis terisi data saat pendaftaran!\n";

?>