<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center mb-6">
            <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-6" 
                 style="background-color: <?= $divisi['warna'] ?>">
                <?= substr($divisi['nama'], 0, 1) ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800"><?= $divisi['nama'] ?></h1>
                <p class="text-gray-600"><?= $divisi['jumlah_anggota'] ?> Anggota</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi</h2>
                <p class="text-gray-600 leading-relaxed"><?= nl2br($divisi['deskripsi']) ?></p>
            </div>
            
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Divisi</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Status:</span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                   <?= $divisi['status'] === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                            <?= ucfirst($divisi['status']) ?>
                        </span>
                    </div>
                    
                    <?php if ($divisi['ketua']): ?>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Ketua:</span>
                            <span class="text-gray-600"><?= $divisi['ketua'] ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Jumlah Anggota:</span>
                        <span class="text-gray-600"><?= $divisi['jumlah_anggota'] ?> Orang</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Warna:</span>
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded mr-2" style="background-color: <?= $divisi['warna'] ?>"></div>
                            <span class="text-gray-600"><?= $divisi['warna'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="/divisi" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Kembali ke Daftar Divisi
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>