<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <?php if ($kegiatan['foto_cover']): ?>
            <img src="/uploads/fotos/<?= $kegiatan['foto_cover'] ?>" alt="<?= $kegiatan['judul'] ?>" 
                 class="w-full h-64 object-cover">
        <?php endif; ?>
        
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="px-3 py-1 rounded text-sm font-semibold 
                           <?= $kegiatan['jenis_kegiatan'] === 'pendakian' ? 'bg-green-100 text-green-800' : 
                               ($kegiatan['jenis_kegiatan'] === 'pelatihan' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') ?>">
                    <?= ucfirst($kegiatan['jenis_kegiatan']) ?>
                </span>
                <span class="ml-2 px-3 py-1 rounded text-sm font-semibold 
                           <?= $kegiatan['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                    <?= ucfirst($kegiatan['status']) ?>
                </span>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-4"><?= $kegiatan['judul'] ?></h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-3">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal</p>
                            <p class="font-medium"><?= date('d M Y', strtotime($kegiatan['tanggal_mulai'])) ?> - <?= date('d M Y', strtotime($kegiatan['tanggal_selesai'])) ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="font-medium"><?= $kegiatan['lokasi'] ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <?php if ($kegiatan['laporan_pdf']): ?>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Laporan</p>
                                <a href="/download/<?= $kegiatan['laporan_pdf'] ?>" class="font-medium text-blue-600 hover:text-blue-800">Download PDF</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($kegiatan['video_url']): ?>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Video</p>
                                <a href="<?= $kegiatan['video_url'] ?>" target="_blank" class="font-medium text-blue-600 hover:text-blue-800">Tonton Video</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="prose max-w-none">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi</h2>
                <div class="text-gray-600 leading-relaxed">
                    <?= nl2br($kegiatan['deskripsi']) ?>
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <a href="/kegiatan" class="text-blue-600 hover:text-blue-800 font-medium">
                    ← Kembali ke Daftar Kegiatan
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>