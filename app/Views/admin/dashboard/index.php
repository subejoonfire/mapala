<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <p class="text-gray-600">Selamat datang di panel admin MAPALA Politala</p>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $total_users ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Users</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $pending_users ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Divisi</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $total_divisi ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Kegiatan</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $total_kegiatan ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">User Terbaru</h2>
            <?php if (!empty($recent_users)): ?>
                <div class="space-y-3">
                    <?php foreach ($recent_users as $user): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800"><?= $user['nama_lengkap'] ?></p>
                                <p class="text-sm text-gray-600"><?= $user['email'] ?></p>
                            </div>
                            <span class="px-2 py-1 rounded text-xs font-semibold 
                                       <?= $user['status'] === 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($user['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') ?>">
                                <?= ucfirst($user['status']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-4">
                    <a href="/admin/users" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Semua User →</a>
                </div>
            <?php else: ?>
                <p class="text-gray-500">Belum ada user terbaru.</p>
            <?php endif; ?>
        </div>
        
        <!-- Recent Kegiatan -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kegiatan Terbaru</h2>
            <?php if (!empty($recent_kegiatan)): ?>
                <div class="space-y-3">
                    <?php foreach ($recent_kegiatan as $kegiatan): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800"><?= $kegiatan['judul'] ?></p>
                                <p class="text-sm text-gray-600"><?= date('d M Y', strtotime($kegiatan['tanggal_mulai'])) ?></p>
                            </div>
                            <span class="px-2 py-1 rounded text-xs font-semibold 
                                       <?= $kegiatan['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                <?= ucfirst($kegiatan['status']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-4">
                    <a href="/admin/kegiatan" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Semua Kegiatan →</a>
                </div>
            <?php else: ?>
                <p class="text-gray-500">Belum ada kegiatan terbaru.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>