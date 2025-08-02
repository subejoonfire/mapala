<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-mapala-green-600 to-mapala-green-700 text-white overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-10"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    MAPALA <span class="text-mapala-green-200">Politala</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-mapala-green-100">
                    Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut
                </p>
                <p class="text-lg mb-8 text-mapala-green-100">
                    Mengembangkan kemampuan outdoor, melestarikan alam, dan membangun karakter mahasiswa yang tangguh dan bertanggung jawab.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/register" class="bg-white text-mapala-green-600 hover:bg-mapala-green-50 px-8 py-3 rounded-lg font-semibold text-center transition-colors">
                        Daftar Sekarang
                    </a>
                    <a href="/about" class="border-2 border-white text-white hover:bg-white hover:text-mapala-green-600 px-8 py-3 rounded-lg font-semibold text-center transition-colors">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="absolute inset-0 bg-mapala-green-500 rounded-2xl transform rotate-3"></div>
                    <div class="relative bg-white rounded-2xl p-8 shadow-2xl">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-mapala-green-600"><?= $stats['divisi']['aktif'] ?></div>
                                <div class="text-sm text-gray-600">Divisi Aktif</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-mapala-green-600"><?= $stats['members']['anggota'] ?></div>
                                <div class="text-sm text-gray-600">Anggota</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-mapala-green-600"><?= $stats['kegiatan']['this_year'] ?></div>
                                <div class="text-sm text-gray-600">Kegiatan 2024</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-mapala-green-600">5</div>
                                <div class="text-sm text-gray-600">Tahun Berdiri</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divisi Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Divisi MAPALA</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Setiap divisi memiliki fokus dan keahlian khusus dalam kegiatan alam terbuka dan konservasi lingkungan.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($divisi as $div): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <div class="h-48 bg-gradient-to-br from-<?= str_replace('#', '', $div['warna']) ?>-500 to-<?= str_replace('#', '', $div['warna']) ?>-600 flex items-center justify-center">
                    <div class="text-white text-center">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <?php if ($div['icon'] === 'mountain'): ?>
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                <?php elseif ($div['icon'] === 'climbing'): ?>
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                <?php elseif ($div['icon'] === 'water'): ?>
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                <?php elseif ($div['icon'] === 'research'): ?>
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                <?php else: ?>
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                <?php endif; ?>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold"><?= $div['nama'] ?></h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4 line-clamp-3"><?= $div['deskripsi'] ?></p>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            <span class="font-semibold"><?= $div['jumlah_anggota'] ?></span> Anggota
                        </div>
                        <a href="/divisi/<?= $div['slug'] ?>" class="text-mapala-green-600 hover:text-mapala-green-700 font-semibold text-sm">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="/divisi" class="inline-flex items-center px-6 py-3 border border-mapala-green-600 text-mapala-green-600 hover:bg-mapala-green-50 rounded-lg font-semibold transition-colors">
                Lihat Semua Divisi
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Kegiatan Terbaru -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kegiatan Terbaru</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Dokumentasi kegiatan terbaru yang telah dilaksanakan oleh MAPALA Politala.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($recent_kegiatan as $kegiatan): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <div class="h-48 bg-gray-200 relative">
                    <?php if ($kegiatan['foto_cover']): ?>
                        <img src="/uploads/kegiatan/<?= $kegiatan['foto_cover'] ?>" alt="<?= $kegiatan['judul'] ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-mapala-green-400 to-mapala-green-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-4 right-4">
                        <span class="bg-mapala-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            <?= ucfirst(str_replace('_', ' ', $kegiatan['jenis_kegiatan'])) ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2"><?= $kegiatan['judul'] ?></h3>
                    <p class="text-gray-600 mb-4 line-clamp-2"><?= $kegiatan['deskripsi'] ?></p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <?= date('d M Y', strtotime($kegiatan['tanggal_mulai'])) ?>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <?= $kegiatan['lokasi'] ?>
                        </div>
                    </div>
                    <a href="/kegiatan/<?= $kegiatan['slug'] ?>" class="text-mapala-green-600 hover:text-mapala-green-700 font-semibold text-sm">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="/kegiatan" class="inline-flex items-center px-6 py-3 border border-mapala-green-600 text-mapala-green-600 hover:bg-mapala-green-50 rounded-lg font-semibold transition-colors">
                Lihat Semua Kegiatan
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Kegiatan Mendatang -->
<?php if (!empty($upcoming_kegiatan)): ?>
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kegiatan Mendatang</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Kegiatan yang akan dilaksanakan dalam waktu dekat.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($upcoming_kegiatan as $kegiatan): ?>
            <div class="bg-gradient-to-br from-mapala-green-50 to-mapala-green-100 rounded-xl p-6 border border-mapala-green-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-mapala-green-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900"><?= $kegiatan['judul'] ?></h3>
                        <p class="text-sm text-gray-600"><?= date('d M Y', strtotime($kegiatan['tanggal_mulai'])) ?></p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4"><?= $kegiatan['deskripsi'] ?></p>
                <div class="flex items-center justify-between">
                    <span class="bg-mapala-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        <?= ucfirst(str_replace('_', ' ', $kegiatan['jenis_kegiatan'])) ?>
                    </span>
                    <a href="/kegiatan/<?= $kegiatan['slug'] ?>" class="text-mapala-green-600 hover:text-mapala-green-700 font-semibold text-sm">
                        Detail →
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-mapala-green-600 to-mapala-green-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Bergabung dengan MAPALA Politala</h2>
        <p class="text-xl mb-8 text-mapala-green-100 max-w-3xl mx-auto">
            Mari bergabung dengan kami untuk mengembangkan kemampuan outdoor, melestarikan alam, dan membangun persaudaraan yang kuat.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/register" class="bg-white text-mapala-green-600 hover:bg-mapala-green-50 px-8 py-3 rounded-lg font-semibold transition-colors">
                Daftar Sekarang
            </a>
            <a href="/contact" class="border-2 border-white text-white hover:bg-white hover:text-mapala-green-600 px-8 py-3 rounded-lg font-semibold transition-colors">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-mapala-green-400 mb-2"><?= $stats['divisi']['aktif'] ?></div>
                <div class="text-gray-400">Divisi Aktif</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-mapala-green-400 mb-2"><?= $stats['members']['anggota'] ?></div>
                <div class="text-gray-400">Anggota Aktif</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-mapala-green-400 mb-2"><?= $stats['kegiatan']['this_year'] ?></div>
                <div class="text-gray-400">Kegiatan 2024</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-mapala-green-400 mb-2">5</div>
                <div class="text-gray-400">Tahun Berdiri</div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>