<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Kegiatan MAPALA Politala</h1>
        <p class="text-gray-600">Lihat berbagai kegiatan yang telah dan akan dilaksanakan</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($kegiatan as $keg): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <?php if ($keg['foto_cover']): ?>
                    <img src="/uploads/fotos/<?= $keg['foto_cover'] ?>" alt="<?= $keg['judul'] ?>" 
                         class="w-full h-48 object-cover">
                <?php endif; ?>
                
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 rounded text-xs font-semibold 
                                   <?= $keg['jenis_kegiatan'] === 'pendakian' ? 'bg-green-100 text-green-800' : 
                                       ($keg['jenis_kegiatan'] === 'pelatihan' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') ?>">
                            <?= ucfirst($keg['jenis_kegiatan']) ?>
                        </span>
                        <span class="ml-2 px-2 py-1 rounded text-xs font-semibold 
                                   <?= $keg['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                            <?= ucfirst($keg['status']) ?>
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= $keg['judul'] ?></h3>
                    <p class="text-gray-600 text-sm mb-4"><?= substr($keg['deskripsi'], 0, 100) ?>...</p>
                    
                    <div class="space-y-2 text-sm text-gray-500 mb-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <?= date('d M Y', strtotime($keg['tanggal_mulai'])) ?> - <?= date('d M Y', strtotime($keg['tanggal_selesai'])) ?>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <?= $keg['lokasi'] ?>
                        </div>
                    </div>
                    
                    <a href="/kegiatan/<?= $keg['slug'] ?>" 
                       class="block w-full text-center bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                        Lihat Detail
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>