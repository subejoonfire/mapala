<?php

require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

// Function to check template content
function checkTemplate($templatePath, $templateName) {
    echo "\n=== Checking $templateName ===\n";
    
    if (!file_exists($templatePath)) {
        echo "❌ Template not found: $templatePath\n";
        return;
    }
    
    echo "✅ Template found: $templatePath\n";
    echo "📁 File size: " . filesize($templatePath) . " bytes\n";
    
    try {
        // Try to read with TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);
        echo "✅ Template can be loaded with TemplateProcessor\n";
        
        // Get available variables (this is limited in PHPWord but we can try)
        echo "📋 Template is ready for variable replacement\n";
        
    } catch (Exception $e) {
        echo "❌ Error loading template: " . $e->getMessage() . "\n";
    }
    
    try {
        // Try to read content structure
        $phpWord = IOFactory::load($templatePath);
        echo "✅ Template can be loaded with IOFactory\n";
        
        $sections = $phpWord->getSections();
        echo "📄 Number of sections: " . count($sections) . "\n";
        
    } catch (Exception $e) {
        echo "❌ Error reading template structure: " . $e->getMessage() . "\n";
    }
}

// Check both templates
$formTemplate = 'app/Formulir Pendaftaran Calang.docx';
$idCardTemplate = 'app/ID CARD.docx';

checkTemplate($formTemplate, 'Formulir Pendaftaran');
checkTemplate($idCardTemplate, 'ID Card');

echo "\n=== Template Preparation Instructions ===\n";
echo "To use these templates with automatic data filling:\n";
echo "1. Open each template in Microsoft Word\n";
echo "2. Replace data fields with placeholders like: \${nama_lengkap}\n";
echo "3. Available placeholders for Formulir Pendaftaran:\n";
echo "   - \${nama_lengkap}\n";
echo "   - \${nama_panggilan}\n";
echo "   - \${tempat_lahir}\n";
echo "   - \${tanggal_lahir}\n";
echo "   - \${tempat_tanggal_lahir}\n";
echo "   - \${jenis_kelamin}\n";
echo "   - \${alamat}\n";
echo "   - \${no_telp}\n";
echo "   - \${agama}\n";
echo "   - \${program_studi}\n";
echo "   - \${gol_darah}\n";
echo "   - \${penyakit}\n";
echo "   - \${nama_ayah}\n";
echo "   - \${nama_ibu}\n";
echo "   - \${alamat_orangtua}\n";
echo "   - \${no_telp_orangtua}\n";
echo "   - \${pekerjaan_ayah}\n";
echo "   - \${pekerjaan_ibu}\n";
echo "   - \${tanggal_daftar}\n";
echo "   - \${angkatan}\n";
echo "   - \${status}\n";
echo "   - \${foto} (for image)\n";
echo "\n4. Available placeholders for ID Card:\n";
echo "   - \${nama_lengkap}\n";
echo "   - \${nama_panggilan}\n";
echo "   - \${program_studi}\n";
echo "   - \${angkatan}\n";
echo "   - \${jenis_kelamin}\n";
echo "   - \${gol_darah}\n";
echo "   - \${no_telp}\n";
echo "   - \${status}\n";
echo "   - \${tanggal_terbit}\n";
echo "   - \${tahun}\n";
echo "   - \${foto} (for image)\n";
echo "\n5. Save the templates after adding placeholders\n";

?>