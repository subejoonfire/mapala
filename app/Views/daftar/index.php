<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Daftar MAPALA Politala</h1>
            <p class="text-lg text-gray-600">Bergabunglah dengan komunitas pecinta alam terbaik di Kalimantan Selatan</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/daftar" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                
                <!-- Data Pribadi -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Data Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM *</label>
                            <input type="text" id="nim" name="nim" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('nim') ?>" placeholder="Masukkan NIM">
                        </div>
                        
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('nama_lengkap') ?>" placeholder="Masukkan nama lengkap">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('email') ?>" placeholder="Masukkan email">
                        </div>
                        
                        <div>
                            <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp *</label>
                            <input type="text" id="no_wa" name="no_wa" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('no_wa') ?>" placeholder="Contoh: 081234567890">
                        </div>
                        
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                            <input type="text" id="no_hp" name="no_hp" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('no_hp') ?>" placeholder="Contoh: 081234567890">
                        </div>
                        
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('tempat_lahir') ?>" placeholder="Masukkan tempat lahir">
                        </div>
                        
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('tanggal_lahir') ?>">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="tempat_tinggal" class="block text-sm font-medium text-gray-700 mb-2">Alamat Tempat Tinggal *</label>
                            <textarea id="tempat_tinggal" name="tempat_tinggal" required rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Masukkan alamat lengkap"><?= old('tempat_tinggal') ?></textarea>
                        </div>
                        
                        <div>
                            <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-2">Program Studi *</label>
                            <select id="program_studi" name="program_studi" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Program Studi</option>
                                <?php foreach ($program_studies as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= old('program_studi') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-2">Agama *</label>
                            <select id="agama" name="agama" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Agama</option>
                                <?php foreach ($religions as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= old('agama') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div>
                            <label for="penyakit" class="block text-sm font-medium text-gray-700 mb-2">Riwayat Penyakit</label>
                            <input type="text" id="penyakit" name="penyakit" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('penyakit') ?>" placeholder="Kosongkan jika tidak ada">
                        </div>
                        
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto *</label>
                            <input type="file" id="foto" name="foto" required accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                        </div>
                    </div>
                </div>
                
                <!-- Pengalaman Organisasi -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pengalaman Organisasi</h3>
                    <div>
                        <label for="pengalaman_organisasi" class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Organisasi (Opsional)</label>
                        <textarea id="pengalaman_organisasi" name="pengalaman_organisasi" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Ceritakan pengalaman organisasi Anda (OSIS, Pramuka, dll)"><?= old('pengalaman_organisasi') ?></textarea>
                    </div>
                </div>
                
                <!-- Alasan Masuk MAPALA -->
                <div class="pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Alasan Masuk MAPALA</h3>
                    <div>
                        <label for="alasan_mapala" class="block text-sm font-medium text-gray-700 mb-2">Alasan Masuk MAPALA *</label>
                        <textarea id="alasan_mapala" name="alasan_mapala" required rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Ceritakan alasan Anda ingin bergabung dengan MAPALA Politala (minimal 20 karakter)"><?= old('alasan_mapala') ?></textarea>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition-colors">
                        Daftar MAPALA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>