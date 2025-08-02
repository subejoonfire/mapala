<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Pendaftaran Berhasil!</h2>
            <p class="mt-2 text-sm text-gray-600">
                Terima kasih telah mendaftar di MAPALA Politala
            </p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h3 class="mt-4 text-lg font-medium text-gray-900">Pendaftaran Berhasil!</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Data pendaftaran Anda telah berhasil disimpan. Tim admin akan memverifikasi data Anda dalam waktu 1-2 hari kerja.
                </p>
                
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-blue-800 mb-2">Langkah Selanjutnya:</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Admin akan memverifikasi data Anda</li>
                        <li>• Anda akan menerima email konfirmasi</li>
                        <li>• Setelah disetujui, Anda bisa login</li>
                        <li>• Ikuti kegiatan orientasi yang akan dijadwalkan</li>
                    </ul>
                </div>
                
                <div class="mt-6 space-y-3">
                    <a href="/login" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kembali ke Login
                    </a>
                    
                    <a href="/" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>