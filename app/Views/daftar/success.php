<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Pendaftaran Berhasil!</h2>
            <p class="mt-2 text-sm text-gray-600">Terima kasih telah mendaftar di MAPALA Politala</p>
        </div>
    </div>
    
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen yang Akan Anda Terima:</h3>
                
                <!-- Download Section -->
                <div class="space-y-4 mb-6">
                    <?php if ($registration_docx): ?>
                    <!-- Formulir Pendaftaran DOCX -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-900">Formulir Pendaftaran (DOCX)</h4>
                                    <p class="text-xs text-blue-700">Dokumen pendaftaran Anda yang sudah terisi</p>
                                </div>
                            </div>
                            <a href="/daftar/download/registration/<?= $registration_docx ?>" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Download
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($id_card_docx): ?>
                    <!-- ID Card DOCX -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-green-900">ID Card MAPALA (DOCX)</h4>
                                    <p class="text-xs text-green-700">Kartu identitas sementara yang sudah terisi</p>
                                </div>
                            </div>
                            <a href="/daftar/download/idcard/<?= $id_card_docx ?>" 
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Download
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- WhatsApp Group Link -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-green-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-green-900">Link Grup WhatsApp</h4>
                                    <p class="text-xs text-green-700"><?= $whatsapp_name ?></p>
                                </div>
                            </div>
                            <a href="<?= $whatsapp_link ?>" target="_blank" 
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Gabung
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Information Section -->
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                    <h4 class="text-sm font-medium text-blue-800 mb-2">Langkah Selanjutnya:</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Download dokumen pendaftaran dan ID Card</li>
                        <li>• Admin akan memverifikasi data Anda dalam 1-2 hari kerja</li>
                        <li>• Setelah disetujui, status Anda akan berubah menjadi "Approved"</li>
                        <li>• Ikuti kegiatan orientasi yang akan dijadwalkan</li>
                        <li>• Bergabunglah dengan grup WhatsApp untuk informasi terbaru</li>
                    </ul>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-3">
                    <a href="/" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kembali ke Beranda
                    </a>
                    <a href="/daftar" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Daftar Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>