<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Kode Etik MAPALA Politala</h1>
        <p class="text-gray-600">Pedoman dan aturan yang harus dipatuhi oleh setiap anggota MAPALA</p>
    </div>
    
    <div class="space-y-6">
        <?php foreach ($kode_etik as $kode): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2"><?= $kode['judul'] ?></h2>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 font-medium">
                                Urutan: <?= $kode['urutan'] ?>
                            </span>
                            <span class="px-2 py-1 rounded 
                                       <?= $kode['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?> font-medium">
                                <?= ucfirst($kode['status']) ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="prose max-w-none">
                    <div class="text-gray-600 leading-relaxed">
                        <?= nl2br($kode['konten']) ?>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <a href="/kode-etik/<?= $kode['slug'] ?>" 
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>