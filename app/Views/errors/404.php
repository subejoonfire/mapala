<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 mb-8">
                Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan.
            </p>
            <div class="space-y-4">
                <a href="/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Kembali ke Beranda
                </a>
                <div class="text-sm text-gray-500">
                    <p>Atau coba:</p>
                    <div class="mt-2 space-y-1">
                        <a href="/daftar" class="block text-blue-600 hover:text-blue-500">Daftar MAPALA</a>
                        <a href="/divisi" class="block text-blue-600 hover:text-blue-500">Lihat Divisi</a>
                        <a href="/kegiatan" class="block text-blue-600 hover:text-blue-500">Lihat Kegiatan</a>
                        <a href="/contact" class="block text-blue-600 hover:text-blue-500">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>