<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="min-h-screen bg-gradient-to-br from-mapala-green-50 to-mapala-green-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pendaftaran Anggota Baru</h1>
            <p class="mt-2 text-lg text-gray-600">
                Bergabunglah dengan MAPALA Politala untuk mengembangkan kemampuan outdoor dan melestarikan alam
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            <form action="/register" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                
                <!-- Data Pribadi -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM *</label>
                            <input type="text" id="nim" name="nim" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Masukkan NIM" value="<?= old('nim') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nim'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['nim'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Masukkan nama lengkap" value="<?= old('nama_lengkap') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nama_lengkap'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['nama_lengkap'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Masukkan email" value="<?= old('email') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['email'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                            <input type="password" id="password" name="password" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Minimal 6 karakter">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['password'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password *</label>
                            <input type="password" id="confirm_password" name="confirm_password" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp *</label>
                            <input type="text" id="no_wa" name="no_wa" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Contoh: 081234567890" value="<?= old('no_wa') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['no_wa'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['no_wa'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">Nomor HP *</label>
                            <input type="text" id="no_hp" name="no_hp" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Contoh: 081234567890" value="<?= old('no_hp') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['no_hp'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['no_hp'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi Lanjutan -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi Lanjutan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   placeholder="Masukkan tempat lahir" value="<?= old('tempat_lahir') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['tempat_lahir'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['tempat_lahir'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                   value="<?= old('tanggal_lahir') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['tanggal_lahir'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['tanggal_lahir'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="md:col-span-2">
                            <label for="tempat_tinggal" class="block text-sm font-medium text-gray-700 mb-2">Tempat Tinggal *</label>
                            <textarea id="tempat_tinggal" name="tempat_tinggal" rows="3" required 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                      placeholder="Masukkan alamat lengkap"><?= old('tempat_tinggal') ?></textarea>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['tempat_tinggal'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['tempat_tinggal'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-2">Program Studi *</label>
                            <select id="program_studi" name="program_studi" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500">
                                <option value="">Pilih Program Studi</option>
                                <?php foreach ($program_studies as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= old('program_studi') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['program_studi'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['program_studi'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-2">Agama *</label>
                            <select id="agama" name="agama" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500">
                                <option value="">Pilih Agama</option>
                                <?php foreach ($religions as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= old('agama') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['agama'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['agama'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tambahan</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="penyakit" class="block text-sm font-medium text-gray-700 mb-2">Penyakit yang Diderita</label>
                            <textarea id="penyakit" name="penyakit" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                      placeholder="Jelaskan penyakit yang diderita (jika ada)"><?= old('penyakit') ?></textarea>
                        </div>

                        <div>
                            <label for="pengalaman_organisasi" class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Organisasi</label>
                            <textarea id="pengalaman_organisasi" name="pengalaman_organisasi" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                      placeholder="Jelaskan pengalaman organisasi sebelumnya (jika ada)"><?= old('pengalaman_organisasi') ?></textarea>
                        </div>

                        <div>
                            <label for="alasan_mapala" class="block text-sm font-medium text-gray-700 mb-2">Alasan Mengikuti MAPALA *</label>
                            <textarea id="alasan_mapala" name="alasan_mapala" rows="4" required 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mapala-green-500 focus:border-mapala-green-500"
                                      placeholder="Jelaskan alasan Anda ingin bergabung dengan MAPALA Politala"><?= old('alasan_mapala') ?></textarea>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['alasan_mapala'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['alasan_mapala'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Upload Foto -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Foto</h3>
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Pas Foto *</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-mapala-green-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-mapala-green-600 hover:text-mapala-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-mapala-green-500">
                                        <span>Upload foto</span>
                                        <input id="foto" name="foto" type="file" class="sr-only" accept="image/*" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                            </div>
                        </div>
                        <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['foto'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= session()->getFlashdata('errors')['foto'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <a href="/" class="text-mapala-green-600 hover:text-mapala-green-700 font-medium">
                        ← Kembali ke Beranda
                    </a>
                    <button type="submit" 
                            class="bg-mapala-green-600 hover:bg-mapala-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                        Daftar Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Informasi Pendaftaran</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Setelah mendaftar, data Anda akan diverifikasi oleh admin</li>
                            <li>Anda akan menerima email konfirmasi setelah pendaftaran berhasil</li>
                            <li>Setelah disetujui, Anda akan mendapatkan ID Card dan akses ke sistem</li>
                            <li>Untuk informasi lebih lanjut, silakan hubungi admin MAPALA</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>