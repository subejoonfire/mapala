<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DivisiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Divisi Gunung Hutan',
                'slug' => 'gunung-hutan',
                'deskripsi' => 'Divisi yang fokus pada kegiatan pendakian gunung, eksplorasi hutan, dan kegiatan alam terbuka lainnya. Divisi ini melatih kemampuan navigasi, survival, dan teknik mendaki yang aman.',
                'icon' => 'mountain',
                'warna' => '#16a34a',
                'ketua' => 'Ahmad Rizki',
                'jumlah_anggota' => 25,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi Rock Climbing',
                'slug' => 'rock-climbing',
                'deskripsi' => 'Divisi yang mengkhususkan diri pada kegiatan panjat tebing dan rock climbing. Melatih teknik memanjat, penggunaan peralatan keselamatan, dan pengembangan mental serta fisik.',
                'icon' => 'climbing',
                'warna' => '#dc2626',
                'ketua' => 'Siti Nurhaliza',
                'jumlah_anggota' => 18,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi Arung Jeram',
                'slug' => 'arung-jeram',
                'deskripsi' => 'Divisi yang fokus pada kegiatan arung jeram dan water rescue. Melatih teknik mengarungi sungai, penggunaan peralatan arung jeram, dan keselamatan di air.',
                'icon' => 'water',
                'warna' => '#2563eb',
                'ketua' => 'Muhammad Fadli',
                'jumlah_anggota' => 15,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi Penelitian & Lingkungan',
                'slug' => 'penelitian-lingkungan',
                'deskripsi' => 'Divisi yang melakukan penelitian terkait lingkungan, konservasi alam, dan pengembangan ilmu pengetahuan alam. Fokus pada edukasi lingkungan dan penelitian ekosistem.',
                'icon' => 'research',
                'warna' => '#059669',
                'ketua' => 'Dewi Sartika',
                'jumlah_anggota' => 20,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi SAR',
                'slug' => 'sar',
                'deskripsi' => 'Divisi Search and Rescue yang melatih kemampuan pencarian dan pertolongan dalam kondisi darurat. Melatih teknik rescue, first aid, dan koordinasi tim dalam situasi kritis.',
                'icon' => 'rescue',
                'warna' => '#ea580c',
                'ketua' => 'Rizki Pratama',
                'jumlah_anggota' => 22,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('divisi')->insertBatch($data);
    }
}