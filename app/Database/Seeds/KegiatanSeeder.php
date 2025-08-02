<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul' => 'Pendakian Gunung Batur',
                'slug' => 'pendakian-gunung-batur-2024',
                'deskripsi' => 'Kegiatan pendakian Gunung Batur yang dilaksanakan oleh Divisi Gunung Hutan. Kegiatan ini bertujuan untuk melatih kemampuan navigasi, survival, dan kerja tim dalam kondisi alam terbuka.',
                'tanggal_mulai' => '2024-03-15',
                'tanggal_selesai' => '2024-03-17',
                'lokasi' => 'Gunung Batur, Bali',
                'divisi_id' => 1,
                'jenis_kegiatan' => 'pendakian',
                'status' => 'completed',
                'foto_cover' => 'gunung-batur-cover.jpg',
                'laporan_pdf' => 'laporan-pendakian-batur.pdf',
                'rencana_anggaran' => 'anggaran-pendakian-batur.xlsx',
                'lpj_pdf' => 'lpj-pendakian-batur.pdf',
                'video_url' => 'https://youtube.com/watch?v=example1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Pelatihan Rock Climbing Dasar',
                'slug' => 'pelatihan-rock-climbing-dasar-2024',
                'deskripsi' => 'Pelatihan dasar rock climbing untuk anggota baru Divisi Rock Climbing. Kegiatan ini melatih teknik memanjat, penggunaan peralatan keselamatan, dan pengembangan mental.',
                'tanggal_mulai' => '2024-02-10',
                'tanggal_selesai' => '2024-02-12',
                'lokasi' => 'Tebing Citatah, Bandung',
                'divisi_id' => 2,
                'jenis_kegiatan' => 'rock_climbing',
                'status' => 'completed',
                'foto_cover' => 'rock-climbing-cover.jpg',
                'laporan_pdf' => 'laporan-rock-climbing.pdf',
                'rencana_anggaran' => 'anggaran-rock-climbing.xlsx',
                'lpj_pdf' => 'lpj-rock-climbing.pdf',
                'video_url' => 'https://youtube.com/watch?v=example2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Arung Jeram Sungai Citarum',
                'slug' => 'arung-jeram-citarum-2024',
                'deskripsi' => 'Kegiatan arung jeram di Sungai Citarum yang dilaksanakan oleh Divisi Arung Jeram. Kegiatan ini melatih teknik mengarungi sungai dan keselamatan di air.',
                'tanggal_mulai' => '2024-04-20',
                'tanggal_selesai' => '2024-04-22',
                'lokasi' => 'Sungai Citarum, Jawa Barat',
                'divisi_id' => 3,
                'jenis_kegiatan' => 'arung_jeram',
                'status' => 'completed',
                'foto_cover' => 'arung-jeram-cover.jpg',
                'laporan_pdf' => 'laporan-arung-jeram.pdf',
                'rencana_anggaran' => 'anggaran-arung-jeram.xlsx',
                'lpj_pdf' => 'lpj-arung-jeram.pdf',
                'video_url' => 'https://youtube.com/watch?v=example3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Penelitian Ekosistem Hutan Mangrove',
                'slug' => 'penelitian-mangrove-2024',
                'deskripsi' => 'Penelitian ekosistem hutan mangrove yang dilaksanakan oleh Divisi Penelitian & Lingkungan. Kegiatan ini bertujuan untuk mengkaji keanekaragaman hayati dan kondisi lingkungan.',
                'tanggal_mulai' => '2024-05-10',
                'tanggal_selesai' => '2024-05-15',
                'lokasi' => 'Hutan Mangrove Muara Angke, Jakarta',
                'divisi_id' => 4,
                'jenis_kegiatan' => 'penelitian',
                'status' => 'completed',
                'foto_cover' => 'mangrove-cover.jpg',
                'laporan_pdf' => 'laporan-penelitian-mangrove.pdf',
                'rencana_anggaran' => 'anggaran-penelitian-mangrove.xlsx',
                'lpj_pdf' => 'lpj-penelitian-mangrove.pdf',
                'video_url' => 'https://youtube.com/watch?v=example4',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Pelatihan SAR Dasar',
                'slug' => 'pelatihan-sar-dasar-2024',
                'deskripsi' => 'Pelatihan Search and Rescue dasar yang dilaksanakan oleh Divisi SAR. Kegiatan ini melatih teknik pencarian, pertolongan pertama, dan koordinasi tim dalam kondisi darurat.',
                'tanggal_mulai' => '2024-06-15',
                'tanggal_selesai' => '2024-06-17',
                'lokasi' => 'Gunung Salak, Jawa Barat',
                'divisi_id' => 5,
                'jenis_kegiatan' => 'sar',
                'status' => 'completed',
                'foto_cover' => 'sar-cover.jpg',
                'laporan_pdf' => 'laporan-pelatihan-sar.pdf',
                'rencana_anggaran' => 'anggaran-pelatihan-sar.xlsx',
                'lpj_pdf' => 'lpj-pelatihan-sar.pdf',
                'video_url' => 'https://youtube.com/watch?v=example5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('kegiatan')->insertBatch($data);
    }
}