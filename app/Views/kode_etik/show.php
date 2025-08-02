<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-800"><?= $kode_etik['judul'] ?></h1>
                <div class="flex items-center space-x-3">
                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-medium">
                        Urutan: <?= $kode_etik['urutan'] ?>
                    </span>
                    <span class="px-3 py-1 rounded-full 
                               <?= $kode_etik['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?> font-medium">
                        <?= ucfirst($kode_etik['status']) ?>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="prose max-w-none">
            <div class="text-gray-700 leading-relaxed text-lg">
                <?= nl2br($kode_etik['konten']) ?>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="/kode-etik" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Kembali ke Daftar Kode Etik
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>