<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Formulir Pendaftaran MAPALA Politala</h1>
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
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('nama_lengkap') ?>" placeholder="Masukkan nama lengkap">
                        </div>
                        
                        <div>
                            <label for="nama_panggilan" class="block text-sm font-medium text-gray-700 mb-2">Nama Panggilan *</label>
                            <input type="text" id="nama_panggilan" name="nama_panggilan" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('nama_panggilan') ?>" placeholder="Masukkan nama panggilan">
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
                        
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <?php foreach ($genders as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= old('jenis_kelamin') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div>
                            <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-2">No. Telp/ HP *</label>
                            <input type="text" id="no_telp" name="no_telp" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('no_telp') ?>" placeholder="Contoh: 081234567890">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                            <textarea id="alamat" name="alamat" required rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Masukkan alamat lengkap"><?= old('alamat') ?></textarea>
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
                            <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-2">Prodi / Jurusan *</label>
                            <select id="program_studi" name="program_studi" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Program Studi</option>
                                <?php foreach ($program_studies as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= old('program_studi') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div>
                            <label for="gol_darah" class="block text-sm font-medium text-gray-700 mb-2">Gol. Darah *</label>
                            <select id="gol_darah" name="gol_darah" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Golongan Darah</option>
                                <?php foreach ($blood_types as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= old('gol_darah') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div>
                            <label for="penyakit" class="block text-sm font-medium text-gray-700 mb-2">Penyakit yang diderita</label>
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
                
                <!-- Data Orangtua -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Data Orangtua</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah *</label>
                            <input type="text" id="nama_ayah" name="nama_ayah" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('nama_ayah') ?>" placeholder="Masukkan nama ayah">
                        </div>
                        
                        <div>
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu *</label>
                            <input type="text" id="nama_ibu" name="nama_ibu" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('nama_ibu') ?>" placeholder="Masukkan nama ibu">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="alamat_orangtua" class="block text-sm font-medium text-gray-700 mb-2">Alamat Orangtua *</label>
                            <textarea id="alamat_orangtua" name="alamat_orangtua" required rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Masukkan alamat orangtua"><?= old('alamat_orangtua') ?></textarea>
                        </div>
                        
                        <div>
                            <label for="no_telp_orangtua" class="block text-sm font-medium text-gray-700 mb-2">No. Telp./ HP Orangtua *</label>
                            <input type="text" id="no_telp_orangtua" name="no_telp_orangtua" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('no_telp_orangtua') ?>" placeholder="Contoh: 081234567890">
                        </div>
                        
                        <div></div> <!-- Empty div for spacing -->
                        
                        <div>
                            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ayah *</label>
                            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('pekerjaan_ayah') ?>" placeholder="Masukkan pekerjaan ayah">
                        </div>
                        
                        <div>
                            <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ibu *</label>
                            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="<?= old('pekerjaan_ibu') ?>" placeholder="Masukkan pekerjaan ibu">
                        </div>
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