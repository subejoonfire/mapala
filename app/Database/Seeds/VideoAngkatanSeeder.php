<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VideoAngkatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'angkatan' => 2020,
                'judul' => 'Dokumentasi Kegiatan Angkatan 2020',
                'deskripsi' => 'Video dokumentasi lengkap kegiatan MAPALA Politala angkatan 2020, termasuk pendakian, pelatihan, dan kegiatan sosial.',
                'video_url' => 'https://youtube.com/watch?v=angkatan2020',
                'thumbnail' => 'angkatan-2020-thumb.jpg',
                'durasi' => '15:30',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'angkatan' => 2021,
                'judul' => 'Dokumentasi Kegiatan Angkatan 2021',
                'deskripsi' => 'Video dokumentasi lengkap kegiatan MAPALA Politala angkatan 2021, termasuk pendakian, pelatihan, dan kegiatan sosial.',
                'video_url' => 'https://youtube.com/watch?v=angkatan2021',
                'thumbnail' => 'angkatan-2021-thumb.jpg',
                'durasi' => '18:45',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'angkatan' => 2022,
                'judul' => 'Dokumentasi Kegiatan Angkatan 2022',
                'deskripsi' => 'Video dokumentasi lengkap kegiatan MAPALA Politala angkatan 2022, termasuk pendakian, pelatihan, dan kegiatan sosial.',
                'video_url' => 'https://youtube.com/watch?v=angkatan2022',
                'thumbnail' => 'angkatan-2022-thumb.jpg',
                'durasi' => '20:15',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'angkatan' => 2023,
                'judul' => 'Dokumentasi Kegiatan Angkatan 2023',
                'deskripsi' => 'Video dokumentasi lengkap kegiatan MAPALA Politala angkatan 2023, termasuk pendakian, pelatihan, dan kegiatan sosial.',
                'video_url' => 'https://youtube.com/watch?v=angkatan2023',
                'thumbnail' => 'angkatan-2023-thumb.jpg',
                'durasi' => '22:30',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'angkatan' => 2024,
                'judul' => 'Dokumentasi Kegiatan Angkatan 2024',
                'deskripsi' => 'Video dokumentasi lengkap kegiatan MAPALA Politala angkatan 2024, termasuk pendakian, pelatihan, dan kegiatan sosial.',
                'video_url' => 'https://youtube.com/watch?v=angkatan2024',
                'thumbnail' => 'angkatan-2024-thumb.jpg',
                'durasi' => '25:00',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('video_angkatan')->insertBatch($data);
    }
}