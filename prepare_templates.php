<?php

require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

echo "=== Preparing Templates with Placeholders ===\n";

// Create sample data templates by copying and modifying existing templates
function prepareFormTemplate() {
    $originalPath = 'app/Formulir Pendaftaran Calang.docx';
    $newPath = 'app/template_formulir_pendaftaran.docx';
    
    // Copy original template
    if (file_exists($originalPath)) {
        copy($originalPath, $newPath);
        echo "✅ Created template copy: $newPath\n";
        
        // Since we cannot directly edit DOCX content programmatically,
        // we'll create instructions for manual editing
        echo "📝 Please manually edit $newPath and add these placeholders:\n";
        echo "   Replace actual data with:\n";
        echo "   - Nama lengkap field → \${nama_lengkap}\n";
        echo "   - Nama panggilan field → \${nama_panggilan}\n";
        echo "   - Tempat lahir field → \${tempat_lahir}\n";
        echo "   - Tanggal lahir field → \${tanggal_lahir}\n";
        echo "   - Tempat, tanggal lahir field → \${tempat_tanggal_lahir}\n";
        echo "   - Jenis kelamin field → \${jenis_kelamin}\n";
        echo "   - Alamat field → \${alamat}\n";
        echo "   - No. telp field → \${no_telp}\n";
        echo "   - Agama field → \${agama}\n";
        echo "   - Program studi field → \${program_studi}\n";
        echo "   - Golongan darah field → \${gol_darah}\n";
        echo "   - Penyakit field → \${penyakit}\n";
        echo "   - Nama ayah field → \${nama_ayah}\n";
        echo "   - Nama ibu field → \${nama_ibu}\n";
        echo "   - Alamat orangtua field → \${alamat_orangtua}\n";
        echo "   - No. telp orangtua field → \${no_telp_orangtua}\n";
        echo "   - Pekerjaan ayah field → \${pekerjaan_ayah}\n";
        echo "   - Pekerjaan ibu field → \${pekerjaan_ibu}\n";
        echo "   - Tanggal daftar field → \${tanggal_daftar}\n";
        echo "   - Angkatan field → \${angkatan}\n";
        echo "   - Status field → \${status}\n";
        echo "   - Photo area → \${foto}\n";
        
        return true;
    }
    
    return false;
}

function prepareIdCardTemplate() {
    $originalPath = 'app/ID CARD.docx';
    $newPath = 'app/template_id_card.docx';
    
    // Copy original template
    if (file_exists($originalPath)) {
        copy($originalPath, $newPath);
        echo "✅ Created template copy: $newPath\n";
        
        echo "📝 Please manually edit $newPath and add these placeholders:\n";
        echo "   Replace actual data with:\n";
        echo "   - Nama lengkap field → \${nama_lengkap}\n";
        echo "   - Nama panggilan field → \${nama_panggilan}\n";
        echo "   - Program studi field → \${program_studi}\n";
        echo "   - Angkatan field → \${angkatan}\n";
        echo "   - Jenis kelamin field → \${jenis_kelamin}\n";
        echo "   - Golongan darah field → \${gol_darah}\n";
        echo "   - No. telp field → \${no_telp}\n";
        echo "   - Status field → \${status}\n";
        echo "   - Tanggal terbit field → \${tanggal_terbit}\n";
        echo "   - Tahun field → \${tahun}\n";
        echo "   - Photo area → \${foto}\n";
        
        return true;
    }
    
    return false;
}

// Create templates
if (prepareFormTemplate()) {
    echo "\n";
}

if (prepareIdCardTemplate()) {
    echo "\n";
}

// Create a simple working template if the manual editing is not done
echo "=== Creating Simple Working Templates ===\n";

function createSimpleFormTemplate() {
    $phpWord = new PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
    
    // Header
    $headerStyle = ['name' => 'Arial', 'size' => 16, 'bold' => true];
    $section->addText('FORMULIR PENDAFTARAN MAPALA POLITALA', $headerStyle, ['alignment' => 'center']);
    $section->addText('Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut', ['name' => 'Arial', 'size' => 12], ['alignment' => 'center']);
    $section->addTextBreak(2);
    
    // Add logo placeholders
    $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
    
    $table->addRow();
    $table->addCell(3000)->addText('FOTO 3x4');
    $cell = $table->addCell(5000);
    $cell->addText('${foto}', ['name' => 'Arial', 'size' => 10]);
    
    $section->addTextBreak();
    
    // Data Pribadi
    $section->addText('DATA PRIBADI', ['name' => 'Arial', 'size' => 12, 'bold' => true]);
    $section->addTextBreak();
    
    $table2 = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
    
    $fields = [
        'Nama Lengkap' => '${nama_lengkap}',
        'Nama Panggilan' => '${nama_panggilan}',
        'Tempat, Tanggal Lahir' => '${tempat_tanggal_lahir}',
        'Jenis Kelamin' => '${jenis_kelamin}',
        'Alamat' => '${alamat}',
        'No. Telp/HP' => '${no_telp}',
        'Agama' => '${agama}',
        'Program Studi' => '${program_studi}',
        'Golongan Darah' => '${gol_darah}',
        'Penyakit yang diderita' => '${penyakit}'
    ];
    
    foreach ($fields as $label => $placeholder) {
        $table2->addRow();
        $table2->addCell(4000)->addText($label, ['bold' => true]);
        $table2->addCell(500)->addText(':');
        $table2->addCell(4000)->addText($placeholder);
    }
    
    $section->addTextBreak();
    
    // Data Orangtua
    $section->addText('DATA ORANGTUA', ['name' => 'Arial', 'size' => 12, 'bold' => true]);
    $section->addTextBreak();
    
    $table3 = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
    
    $parentFields = [
        'Nama Ayah' => '${nama_ayah}',
        'Nama Ibu' => '${nama_ibu}',
        'Alamat Orangtua' => '${alamat_orangtua}',
        'No. Telp/HP Orangtua' => '${no_telp_orangtua}',
        'Pekerjaan Ayah' => '${pekerjaan_ayah}',
        'Pekerjaan Ibu' => '${pekerjaan_ibu}'
    ];
    
    foreach ($parentFields as $label => $placeholder) {
        $table3->addRow();
        $table3->addCell(4000)->addText($label, ['bold' => true]);
        $table3->addCell(500)->addText(':');
        $table3->addCell(4000)->addText($placeholder);
    }
    
    $section->addTextBreak(2);
    
    // Footer
    $section->addText('Tanggal Pendaftaran: ${tanggal_daftar}', ['name' => 'Arial', 'size' => 10]);
    $section->addText('Angkatan: ${angkatan}', ['name' => 'Arial', 'size' => 10]);
    $section->addText('Status: ${status}', ['name' => 'Arial', 'size' => 10]);
    
    // Save template
    $filename = 'app/template_formulir_simple.docx';
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filename);
    
    echo "✅ Created simple form template: $filename\n";
}

function createSimpleIdCardTemplate() {
    $phpWord = new PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection(['marginLeft' => 1000, 'marginRight' => 1000, 'marginTop' => 1000, 'marginBottom' => 1000]);
    
    // Header
    $headerStyle = ['name' => 'Arial', 'size' => 18, 'bold' => true, 'color' => '16a34a'];
    $section->addText('MAPALA POLITALA', $headerStyle, ['alignment' => 'center']);
    $section->addText('Mahasiswa Pecinta Alam', ['name' => 'Arial', 'size' => 12], ['alignment' => 'center']);
    $section->addText('Politeknik Negeri Tanah Laut', ['name' => 'Arial', 'size' => 12], ['alignment' => 'center']);
    $section->addTextBreak(2);
    
    // ID Card Content
    $tableStyle = ['borderSize' => 6, 'borderColor' => '16a34a', 'cellMargin' => 80];
    $table = $section->addTable($tableStyle);
    
    $table->addRow();
    $table->addCell(3000)->addText('${foto}', ['name' => 'Arial', 'size' => 12], ['alignment' => 'center']);
    $cell = $table->addCell(5000);
    $cell->addText('Nama: ${nama_lengkap}', ['name' => 'Arial', 'size' => 10, 'bold' => true]);
    $cell->addText('Program Studi: ${program_studi}', ['name' => 'Arial', 'size' => 10]);
    $cell->addText('Angkatan: ${angkatan}', ['name' => 'Arial', 'size' => 10]);
    $cell->addText('Jenis Kelamin: ${jenis_kelamin}', ['name' => 'Arial', 'size' => 10]);
    $cell->addText('Gol. Darah: ${gol_darah}', ['name' => 'Arial', 'size' => 10]);
    $cell->addText('No. Telp: ${no_telp}', ['name' => 'Arial', 'size' => 10]);
    $cell->addText('Status: ${status}', ['name' => 'Arial', 'size' => 10, 'bold' => true]);
    
    $section->addTextBreak(2);
    
    // Footer
    $section->addText('Diterbitkan pada: ${tanggal_terbit}', ['name' => 'Arial', 'size' => 8], ['alignment' => 'center']);
    $section->addText('Berlaku sampai persetujuan admin', ['name' => 'Arial', 'size' => 8], ['alignment' => 'center']);
    
    // Save template
    $filename = 'app/template_id_card_simple.docx';
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filename);
    
    echo "✅ Created simple ID card template: $filename\n";
}

createSimpleFormTemplate();
createSimpleIdCardTemplate();

echo "\n=== Template Preparation Complete ===\n";
echo "Templates created with placeholders ready for automatic data filling.\n";
echo "Update your controller to use:\n";
echo "- app/template_formulir_simple.docx for form template\n";
echo "- app/template_id_card_simple.docx for ID card template\n";

?>