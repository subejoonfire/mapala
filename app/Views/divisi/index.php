<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Divisi MAPALA Politala</h1>
        <p class="text-gray-600">Kenali berbagai divisi yang ada di MAPALA Politala</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($divisi as $div): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4" 
                             style="background-color: <?= $div['warna'] ?>">
                            <?= substr($div['nama'], 0, 1) ?>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800"><?= $div['nama'] ?></h3>
                            <p class="text-gray-600 text-sm"><?= $div['jumlah_anggota'] ?> Anggota</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4"><?= substr($div['deskripsi'], 0, 100) ?>...</p>
                    
                    <?php if ($div['ketua']): ?>
                        <p class="text-sm text-gray-500 mb-4">
                            <strong>Ketua:</strong> <?= $div['ketua'] ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="flex justify-between items-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                   <?= $div['status'] === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                            <?= ucfirst($div['status']) ?>
                        </span>
                        <a href="/divisi/<?= $div['slug'] ?>" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>