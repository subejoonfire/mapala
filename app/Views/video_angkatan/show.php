<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-800"><?= $video['judul'] ?></h1>
                <div class="flex items-center space-x-3">
                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-medium">
                        Angkatan <?= $video['angkatan'] ?>
                    </span>
                    <span class="px-3 py-1 rounded-full 
                               <?= $video['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?> font-medium">
                        <?= ucfirst($video['status']) ?>
                    </span>
                </div>
            </div>
            
            <?php if ($video['deskripsi']): ?>
                <p class="text-gray-600 mb-4"><?= $video['deskripsi'] ?></p>
            <?php endif; ?>
        </div>
        
        <!-- Video Embed -->
        <div class="mb-6">
            <div class="relative w-full" style="padding-bottom: 56.25%;">
                <iframe src="<?= $video['video_url'] ?>" 
                        class="absolute top-0 left-0 w-full h-full rounded-lg"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
            </div>
        </div>
        
        <!-- Video Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-500">Durasi</p>
                        <p class="font-medium"><?= $video['durasi'] ?: 'Tidak diketahui' ?></p>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Upload</p>
                        <p class="font-medium"><?= date('d M Y', strtotime($video['created_at'])) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-500">Link Video</p>
                        <a href="<?= $video['video_url'] ?>" target="_blank" class="font-medium text-blue-600 hover:text-blue-800">
                            Buka di YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="/video-angkatan" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Kembali ke Daftar Video
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>