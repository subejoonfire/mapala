<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Daftar MAPALA Politala</h1>
                <p class="text-lg text-gray-600">Bergabunglah dengan keluarga besar MAPALA Politala</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow-lg p-8">
                <form action="/daftar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <!-- Data Pribadi -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NIM *</label>
                                <input type="text" name="nim" value="<?= old('nim') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Masukkan NIM">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Masukkan nama lengkap">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" value="<?= old('email') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Masukkan email">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp *</label>
                                <input type="text" name="no_wa" value="<?= old('no_wa') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Contoh: 081234567890">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                                <input type="text" name="no_hp" value="<?= old('no_hp') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Contoh: 081234567890">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                                <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Masukkan tempat lahir">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Tempat Tinggal *</label>
                                <textarea name="tempat_tinggal" rows="3" required 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Masukkan alamat lengkap"><?= old('tempat_tinggal') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Data Akademik -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Akademik</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi *</label>
                                <input type="text" name="program_studi" value="<?= old('program_studi') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Contoh: Teknologi Informasi">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Agama *</label>
                                <input type="text" name="agama" value="<?= old('agama') ?>" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Contoh: Islam">
                            </div>
                        </div>
                    </div>

                    <!-- Data Kesehatan -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Kesehatan</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Penyakit (Opsional)</label>
                            <textarea name="penyakit" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Jelaskan riwayat penyakit jika ada, atau tulis 'Tidak ada'"><?= old('penyakit') ?></textarea>
                        </div>
                    </div>

                    <!-- Data Organisasi -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Organisasi</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Organisasi (Opsional)</label>
                            <textarea name="pengalaman_organisasi" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Jelaskan pengalaman organisasi sebelumnya, atau tulis 'Tidak ada'"><?= old('pengalaman_organisasi') ?></textarea>
                        </div>
                    </div>

                    <!-- Motivasi -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Motivasi</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Bergabung dengan MAPALA *</label>
                            <textarea name="alasan_mapala" rows="4" required 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Jelaskan alasan Anda ingin bergabung dengan MAPALA Politala (minimal 20 karakter)"><?= old('alasan_mapala') ?></textarea>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Diri *</label>
                            <input type="file" name="foto" accept="image/*" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-center">
                        <button type="submit" 
                                class="bg-blue-600 text-white px-8 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg font-medium">
                            Daftar MAPALA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>