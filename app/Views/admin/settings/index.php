<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Pengaturan Sistem</h1>
        </div>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <form action="/admin/settings/update" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            
            <!-- WhatsApp Settings -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan WhatsApp</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="whatsapp_group_link" class="block text-sm font-medium text-gray-700 mb-2">
                            Link Grup WhatsApp *
                        </label>
                        <input type="url" id="whatsapp_group_link" name="whatsapp_group_link" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= $settings['whatsapp_group_link'] ?? 'https://chat.whatsapp.com/example' ?>"
                               placeholder="https://chat.whatsapp.com/...">
                        <p class="text-xs text-gray-500 mt-1">Link grup WhatsApp yang akan ditampilkan setelah pendaftaran</p>
                    </div>
                    
                    <div>
                        <label for="whatsapp_group_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Grup WhatsApp *
                        </label>
                        <input type="text" id="whatsapp_group_name" name="whatsapp_group_name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= $settings['whatsapp_group_name'] ?? 'MAPALA Politala Official' ?>"
                               placeholder="Nama grup WhatsApp">
                        <p class="text-xs text-gray-500 mt-1">Nama grup yang akan ditampilkan</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Settings -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Kontak</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Kontak *
                        </label>
                        <input type="email" id="contact_email" name="contact_email" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= $settings['contact_email'] ?? 'mapala@politala.ac.id' ?>"
                               placeholder="Email kontak MAPALA">
                        <p class="text-xs text-gray-500 mt-1">Email yang akan ditampilkan di halaman kontak</p>
                    </div>
                    
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon Kontak *
                        </label>
                        <input type="text" id="contact_phone" name="contact_phone" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= $settings['contact_phone'] ?? '+6281234567890' ?>"
                               placeholder="Nomor telepon kontak">
                        <p class="text-xs text-gray-500 mt-1">Nomor telepon yang akan ditampilkan di halaman kontak</p>
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md transition-colors">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>