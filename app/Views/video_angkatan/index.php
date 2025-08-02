<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Video Angkatan MAPALA</h1>
        <p class="text-gray-600">Kumpulan video dokumentasi angkatan MAPALA Politala</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($videos as $video): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <?php if ($video['thumbnail']): ?>
                    <img src="/uploads/fotos/<?= $video['thumbnail'] ?>" alt="<?= $video['judul'] ?>" 
                         class="w-full h-48 object-cover">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                <?php endif; ?>
                
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-800">
                            Angkatan <?= $video['angkatan'] ?>
                        </span>
                        <span class="ml-2 px-2 py-1 rounded text-xs font-semibold 
                                   <?= $video['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                            <?= ucfirst($video['status']) ?>
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= $video['judul'] ?></h3>
                    <p class="text-gray-600 text-sm mb-4"><?= substr($video['deskripsi'], 0, 100) ?>...</p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <?php if ($video['durasi']): ?>
                            <span>Durasi: <?= $video['durasi'] ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <a href="/video-angkatan/<?= $video['id'] ?>" 
                       class="block w-full text-center bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                        Tonton Video
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>