<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Hasil Pencarian</h1>
            <p class="text-xl text-gray-600">
                Hasil pencarian untuk: <span class="font-semibold text-mapala-green-600">"<?= $keyword ?>"</span>
            </p>
        </div>

        <!-- Search Results -->
        <div class="space-y-8">
            <!-- Divisi Results -->
            <?php if (!empty($divisi_results)): ?>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Divisi (<?= count($divisi_results) ?> hasil)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($divisi_results as $divisi): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="h-32 bg-gradient-to-br from-<?= str_replace('#', '', $divisi['warna']) ?>-500 to-<?= str_replace('#', '', $divisi['warna']) ?>-600 flex items-center justify-center">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold"><?= $divisi['nama'] ?></h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4 line-clamp-3"><?= $divisi['deskripsi'] ?></p>
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <span class="font-semibold"><?= $divisi['jumlah_anggota'] ?></span> Anggota
                                </div>
                                <a href="/divisi/<?= $divisi['slug'] ?>" class="text-mapala-green-600 hover:text-mapala-green-700 font-semibold text-sm">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Kegiatan Results -->
            <?php if (!empty($kegiatan_results)): ?>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Kegiatan (<?= count($kegiatan_results) ?> hasil)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($kegiatan_results as $kegiatan): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="h-48 bg-gray-200 relative">
                            <?php if ($kegiatan['foto_cover']): ?>
                                <img src="/uploads/kegiatan/<?= $kegiatan['foto_cover'] ?>" alt="<?= $kegiatan['judul'] ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-mapala-green-400 to-mapala-green-600 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2"><?= $kegiatan['judul'] ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-3"><?= $kegiatan['deskripsi'] ?></p>
                            <div class="flex items-center justify-between">
                                <span class="bg-mapala-green-100 text-mapala-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                                    <?= ucfirst(str_replace('_', ' ', $kegiatan['jenis_kegiatan'])) ?>
                                </span>
                                <a href="/kegiatan/<?= $kegiatan['slug'] ?>" class="text-mapala-green-600 hover:text-mapala-green-700 font-semibold text-sm">
                                    Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- No Results -->
            <?php if (empty($divisi_results) && empty($kegiatan_results)): ?>
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada hasil ditemukan</h3>
                <p class="text-gray-600 mb-6">
                    Maaf, tidak ada hasil yang ditemukan untuk pencarian "<?= $keyword ?>".
                </p>
                <div class="space-y-4">
                    <p class="text-sm text-gray-500">Coba kata kunci lain seperti:</p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <a href="/search?q=gunung" class="bg-mapala-green-100 text-mapala-green-800 px-3 py-1 rounded-full text-sm hover:bg-mapala-green-200">
                            Gunung
                        </a>
                        <a href="/search?q=caving" class="bg-mapala-green-100 text-mapala-green-800 px-3 py-1 rounded-full text-sm hover:bg-mapala-green-200">
                            Caving
                        </a>
                        <a href="/search?q=rafting" class="bg-mapala-green-100 text-mapala-green-800 px-3 py-1 rounded-full text-sm hover:bg-mapala-green-200">
                            Rafting
                        </a>
                        <a href="/search?q=climbing" class="bg-mapala-green-100 text-mapala-green-800 px-3 py-1 rounded-full text-sm hover:bg-mapala-green-200">
                            Climbing
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-12">
            <a href="/" class="inline-flex items-center px-6 py-3 border border-mapala-green-600 text-mapala-green-600 hover:bg-mapala-green-50 rounded-lg font-semibold transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>