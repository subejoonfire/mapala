<?php

// Script untuk mengecek semua view files yang diperlukan

echo "🔍 Mengecek Semua View Files\n";
echo "============================\n\n";

$viewFiles = [
    // Auth Views
    'app/Views/auth/login.php',
    'app/Views/auth/register.php',
    'app/Views/auth/register_success.php',
    'app/Views/auth/forgot_password.php',
    'app/Views/auth/reset_password.php',
    
    // Dashboard Views
    'app/Views/dashboard/index.php',
    
    // Profile Views
    'app/Views/profile/index.php',
    
    // Divisi Views
    'app/Views/divisi/index.php',
    'app/Views/divisi/show.php',
    
    // Kegiatan Views
    'app/Views/kegiatan/index.php',
    'app/Views/kegiatan/show.php',
    
    // Kode Etik Views
    'app/Views/kode_etik/index.php',
    'app/Views/kode_etik/show.php',
    
    // Video Angkatan Views
    'app/Views/video_angkatan/index.php',
    'app/Views/video_angkatan/show.php',
    
    // Admin Views
    'app/Views/admin/dashboard/index.php',
    'app/Views/admin/users/index.php',
    'app/Views/admin/users/create.php',
    'app/Views/admin/users/edit.php',
    
    // Home Views
    'app/Views/home/index.php',
    'app/Views/home/about.php',
    'app/Views/home/contact.php',
    'app/Views/home/search.php',
    
    // Error Views
    'app/Views/errors/404.php',
    'app/Views/errors/500.php',
    
    // Layout
    'app/Views/layout/main.php',
];

$allGood = true;
$missingFiles = [];

foreach ($viewFiles as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - OK\n";
    } else {
        echo "❌ {$file} - Tidak ditemukan\n";
        $missingFiles[] = $file;
        $allGood = false;
    }
}

echo "\n📊 Ringkasan:\n";
echo "Total files: " . count($viewFiles) . "\n";
echo "Found: " . (count($viewFiles) - count($missingFiles)) . "\n";
echo "Missing: " . count($missingFiles) . "\n";

if ($allGood) {
    echo "\n🎉 Semua view files sudah ada!\n";
    echo "💡 Aplikasi siap digunakan\n";
} else {
    echo "\n❌ Ada view files yang hilang:\n";
    foreach ($missingFiles as $file) {
        echo "   - {$file}\n";
    }
    echo "\n💡 Buat view files yang hilang terlebih dahulu\n";
}

echo "\n📋 Kategori View Files:\n";
echo "   - Auth: Login, Register, Forgot Password, Reset Password\n";
echo "   - Dashboard: Member dan Admin\n";
echo "   - Profile: User profile management\n";
echo "   - Divisi: Public divisi pages\n";
echo "   - Kegiatan: Public kegiatan pages\n";
echo "   - Kode Etik: Public kode etik pages\n";
echo "   - Video Angkatan: Member video pages\n";
echo "   - Admin: User management, dashboard\n";
echo "   - Home: Public pages\n";
echo "   - Errors: 404, 500 error pages\n";
echo "   - Layout: Main layout template\n";