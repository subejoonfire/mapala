<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Tentang MAPALA Politala</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Mahasiswa Pecinta Alam Politeknik Negeri Tanjung Enim - Organisasi yang berdedikasi untuk melestarikan alam dan mengembangkan kemampuan outdoor.
            </p>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-mapala-green-600 mb-2"><?= $stats['divisi']['aktif'] ?></div>
                <div class="text-gray-600">Divisi Aktif</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-mapala-green-600 mb-2"><?= $stats['members']['approved'] ?></div>
                <div class="text-gray-600">Anggota Aktif</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-mapala-green-600 mb-2">5</div>
                <div class="text-gray-600">Tahun Berdiri</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-mapala-green-600 mb-2">50+</div>
                <div class="text-gray-600">Kegiatan</div>
            </div>
        </div>

        <!-- About Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Sejarah Kami</h2>
                <p class="text-gray-600 mb-4">
                    MAPALA Politala didirikan pada tahun 2019 dengan visi untuk mengembangkan minat dan bakat mahasiswa 
                    dalam kegiatan alam terbuka dan konservasi lingkungan.
                </p>
                <p class="text-gray-600 mb-4">
                    Sejak awal berdirinya, organisasi ini telah berkomitmen untuk melaksanakan berbagai kegiatan 
                    yang bertujuan untuk melestarikan alam dan mengembangkan kemampuan outdoor mahasiswa.
                </p>
                <p class="text-gray-600">
                    Dengan semangat kebersamaan dan dedikasi tinggi, MAPALA Politala terus berkembang menjadi 
                    organisasi yang diakui di kalangan pecinta alam.
                </p>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Visi & Misi</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Visi</h3>
                        <p class="text-gray-600">
                            Menjadi organisasi pecinta alam yang unggul dalam pengembangan kemampuan outdoor, 
                            pelestarian lingkungan, dan pembentukan karakter mahasiswa yang berintegritas.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Misi</h3>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Mengembangkan kemampuan outdoor dan survival</li>
                            <li>• Melaksanakan kegiatan konservasi lingkungan</li>
                            <li>• Membangun karakter kepemimpinan dan teamwork</li>
                            <li>• Menjalin kerjasama dengan organisasi pecinta alam lainnya</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divisi Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Divisi Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($divisi as $div): ?>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="w-12 h-12 bg-mapala-green-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2"><?= $div['nama'] ?></h3>
                    <p class="text-gray-600 mb-4"><?= $div['deskripsi'] ?></p>
                    <div class="text-sm text-gray-500">
                        <span class="font-semibold"><?= $div['jumlah_anggota'] ?></span> Anggota
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-mapala-green-600 to-mapala-green-700 rounded-lg p-8 text-white text-center">
            <h2 class="text-3xl font-bold mb-4">Bergabung dengan Kami</h2>
            <p class="text-xl mb-6 text-mapala-green-100">
                Mari bergabung dengan MAPALA Politala untuk mengembangkan kemampuan outdoor dan melestarikan alam.
            </p>
            <a href="/daftar" class="bg-white text-mapala-green-600 hover:bg-mapala-green-50 px-8 py-3 rounded-lg font-semibold transition-colors">
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>