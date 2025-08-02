<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
        
        <!-- User Info -->
        <div class="bg-blue-50 rounded-lg p-4 mb-6">
            <h2 class="text-xl font-semibold text-blue-800 mb-2">Selamat Datang, <?= $user['nama_lengkap'] ?>!</h2>
            <p class="text-blue-600">NIM: <?= $user['nim'] ?> | Status: <?= ucfirst($user['status']) ?></p>
        </div>
        
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-green-100 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-green-800">Divisi</h3>
                <p class="text-2xl font-bold text-green-600"><?= count($divisi) ?></p>
            </div>
            <div class="bg-blue-100 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-blue-800">Kegiatan Terbaru</h3>
                <p class="text-2xl font-bold text-blue-600"><?= count($kegiatan_terbaru) ?></p>
            </div>
            <div class="bg-purple-100 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-purple-800">Status</h3>
                <p class="text-2xl font-bold text-purple-600"><?= ucfirst($user['role']) ?></p>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kegiatan Terbaru</h2>
            <?php if (!empty($kegiatan_terbaru)): ?>
                <div class="space-y-4">
                    <?php foreach ($kegiatan_terbaru as $kegiatan): ?>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <h3 class="font-semibold text-gray-800"><?= $kegiatan['judul'] ?></h3>
                            <p class="text-gray-600 text-sm"><?= date('d M Y', strtotime($kegiatan['tanggal_mulai'])) ?></p>
                            <a href="/kegiatan/<?= $kegiatan['slug'] ?>" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Detail →</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500">Belum ada kegiatan terbaru.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>