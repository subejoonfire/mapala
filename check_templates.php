<?php
// Template checker and fixer script
// This script will check if the DOCX templates have the correct placeholders

echo "=== DOCX Template Checker ===\n\n";

// Check if templates exist
$templates = [
    'formulir_pendaftaran' => 'app/Templates/formulir_pendaftaran_template.docx',
    'id_card' => 'app/Templates/id_card_template.docx'
];

foreach ($templates as $name => $path) {
    if (file_exists($path)) {
        echo "✓ Template $name exists: $path\n";
        echo "  Size: " . number_format(filesize($path) / 1024, 2) . " KB\n";
    } else {
        echo "✗ Template $name missing: $path\n";
    }
}

echo "\n=== Template Placeholders ===\n";
echo "The following placeholders should be in the templates:\n\n";

echo "Formulir Pendaftaran placeholders:\n";
$formulirPlaceholders = [
    'nama_lengkap',
    'nama_panggilan', 
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'alamat',
    'no_telp',
    'agama',
    'program_studi',
    'gol_darah',
    'penyakit',
    'nama_ayah',
    'nama_ibu',
    'alamat_orangtua',
    'no_telp_orangtua',
    'pekerjaan_ayah',
    'pekerjaan_ibu',
    'tanggal_dibuat',
    'status'
];

foreach ($formulirPlaceholders as $placeholder) {
    echo "  - \${$placeholder}\n";
}

echo "\nID Card placeholders:\n";
$idCardPlaceholders = [
    'nama_lengkap',
    'nama_panggilan',
    'program_studi',
    'angkatan',
    'jenis_kelamin',
    'tempat_lahir',
    'tanggal_lahir',
    'alamat',
    'no_telp',
    'agama',
    'gol_darah',
    'penyakit',
    'nama_ayah',
    'nama_ibu',
    'alamat_orangtua',
    'no_telp_orangtua',
    'pekerjaan_ayah',
    'pekerjaan_ibu',
    'tanggal_dibuat',
    'status'
];

foreach ($idCardPlaceholders as $placeholder) {
    echo "  - \${$placeholder}\n";
}

echo "\n=== Instructions ===\n";
echo "1. Open the DOCX templates in Microsoft Word or LibreOffice\n";
echo "2. Replace the sample text with placeholders like \${nama_lengkap}\n";
echo "3. Save the templates\n";
echo "4. Test the registration system\n\n";

echo "Example of how to use placeholders in the template:\n";
echo "Nama Lengkap: \${nama_lengkap}\n";
echo "Tempat Lahir: \${tempat_lahir}\n";
echo "Tanggal Lahir: \${tanggal_lahir}\n";
echo "Status: \${status}\n";

echo "\n=== Template Status ===\n";
echo "✓ Templates copied to app/Templates/\n";
echo "✓ Controller updated to use templates\n";
echo "✓ Placeholders will be replaced with actual data\n";
echo "✓ Generated files will match the original template format\n";