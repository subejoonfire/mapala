<?php

// Script untuk mengecek semua view files yang diperlukan

echo "🔍 Mengecek View Files\n";
echo "=====================\n\n";

$viewFiles = [
    // Dashboard
    'app/Views/dashboard/index.php',
    
    // Profile
    'app/Views/profile/index.php',
    
    // Divisi
    'app/Views/divisi/index.php',
    'app/Views/divisi/show.php',
    
    // Kegiatan
    'app/Views/kegiatan/index.php',
    'app/Views/kegiatan/show.php',
    
    // Kode Etik
    'app/Views/kode_etik/index.php',
    'app/Views/kode_etik/show.php',
    
    // Video Angkatan
    'app/Views/video_angkatan/index.php',
    'app/Views/video_angkatan/show.php',
    
    // Admin
    'app/Views/admin/dashboard/index.php',
];

$allGood = true;

foreach ($viewFiles as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - OK\n";
    } else {
        echo "❌ {$file} - Tidak ditemukan\n";
        $allGood = false;
    }
}

// Cek layout file
$layoutFile = 'app/Views/layout/main.php';
if (file_exists($layoutFile)) {
    echo "✅ {$layoutFile} - OK\n";
} else {
    echo "❌ {$layoutFile} - Tidak ditemukan\n";
    $allGood = false;
}

if ($allGood) {
    echo "\n🎉 Semua view files sudah ada!\n";
    echo "💡 Aplikasi siap digunakan\n";
} else {
    echo "\n❌ Ada view files yang hilang\n";
    echo "💡 Buat view files yang hilang terlebih dahulu\n";
}

echo "\n📋 Ringkasan View Files:\n";
echo "   - Dashboard: Member dan Admin\n";
echo "   - Profile: User profile management\n";
echo "   - Divisi: Public divisi pages\n";
echo "   - Kegiatan: Public kegiatan pages\n";
echo "   - Kode Etik: Public kode etik pages\n";
echo "   - Video Angkatan: Member video pages\n";
echo "   - Layout: Main layout template\n";