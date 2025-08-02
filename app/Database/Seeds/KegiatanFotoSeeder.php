<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KegiatanFotoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Foto untuk Pendakian Gunung Batur
            [
                'kegiatan_id' => 1,
                'judul' => 'Tim Pendakian di Basecamp',
                'deskripsi' => 'Tim pendakian MAPALA Politala di basecamp sebelum memulai pendakian',
                'foto' => 'batur-basecamp.jpg',
                'urutan' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 1,
                'judul' => 'Perjalanan Menuju Puncak',
                'deskripsi' => 'Tim sedang mendaki menuju puncak Gunung Batur',
                'foto' => 'batur-pendakian.jpg',
                'urutan' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 1,
                'judul' => 'Foto Bersama di Puncak',
                'deskripsi' => 'Tim MAPALA Politala berfoto bersama di puncak Gunung Batur',
                'foto' => 'batur-puncak.jpg',
                'urutan' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Foto untuk Rock Climbing
            [
                'kegiatan_id' => 2,
                'judul' => 'Pelatihan Dasar Rock Climbing',
                'deskripsi' => 'Anggota baru sedang belajar teknik dasar rock climbing',
                'foto' => 'climbing-dasar.jpg',
                'urutan' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 2,
                'judul' => 'Praktik Memanjat',
                'deskripsi' => 'Praktik memanjat tebing dengan peralatan keselamatan',
                'foto' => 'climbing-praktik.jpg',
                'urutan' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 2,
                'judul' => 'Tim Rock Climbing',
                'deskripsi' => 'Tim Divisi Rock Climbing MAPALA Politala',
                'foto' => 'climbing-tim.jpg',
                'urutan' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Foto untuk Arung Jeram
            [
                'kegiatan_id' => 3,
                'judul' => 'Persiapan Arung Jeram',
                'deskripsi' => 'Tim sedang mempersiapkan peralatan arung jeram',
                'foto' => 'arung-persiapan.jpg',
                'urutan' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 3,
                'judul' => 'Kegiatan Arung Jeram',
                'deskripsi' => 'Tim sedang mengarungi Sungai Citarum',
                'foto' => 'arung-kegiatan.jpg',
                'urutan' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 3,
                'judul' => 'Tim Arung Jeram',
                'deskripsi' => 'Tim Divisi Arung Jeram MAPALA Politala',
                'foto' => 'arung-tim.jpg',
                'urutan' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Foto untuk Penelitian Mangrove
            [
                'kegiatan_id' => 4,
                'judul' => 'Penelitian Ekosistem Mangrove',
                'deskripsi' => 'Tim sedang melakukan penelitian di hutan mangrove',
                'foto' => 'mangrove-penelitian.jpg',
                'urutan' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 4,
                'judul' => 'Pengambilan Data',
                'deskripsi' => 'Pengambilan data keanekaragaman hayati mangrove',
                'foto' => 'mangrove-data.jpg',
                'urutan' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 4,
                'judul' => 'Tim Penelitian',
                'deskripsi' => 'Tim Divisi Penelitian & Lingkungan MAPALA Politala',
                'foto' => 'mangrove-tim.jpg',
                'urutan' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Foto untuk SAR
            [
                'kegiatan_id' => 5,
                'judul' => 'Pelatihan SAR Dasar',
                'deskripsi' => 'Pelatihan teknik pencarian dan pertolongan',
                'foto' => 'sar-pelatihan.jpg',
                'urutan' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 5,
                'judul' => 'Praktik First Aid',
                'deskripsi' => 'Praktik pertolongan pertama pada korban',
                'foto' => 'sar-firstaid.jpg',
                'urutan' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 5,
                'judul' => 'Tim SAR',
                'deskripsi' => 'Tim Divisi SAR MAPALA Politala',
                'foto' => 'sar-tim.jpg',
                'urutan' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('kegiatan_foto')->insertBatch($data);
    }
}