<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Run AdminSeeder first
        $this->call('AdminSeeder');
        
        // Sample Users (without password)
        $users = [
            [
                'nim' => '2021001',
                'nama_lengkap' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@politala.ac.id',
                'no_wa' => '081234567890',
                'no_hp' => '081234567890',
                'tempat_lahir' => 'Tanjung Enim',
                'tanggal_lahir' => '2000-01-15',
                'tempat_tinggal' => 'Jl. Merdeka No. 123, Tanjung Enim',
                'program_studi' => 'Teknologi Informasi',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'OSIS SMA, Rohis',
                'alasan_mapala' => 'Ingin belajar tentang alam dan petualangan, serta mengembangkan kemampuan leadership dan teamwork.',
                'foto' => 'ahmad_rizki.jpg',
                'status' => 'approved',
                'angkatan' => 2021,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nim' => '2021002',
                'nama_lengkap' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@politala.ac.id',
                'no_wa' => '081234567891',
                'no_hp' => '081234567891',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '2000-03-20',
                'tempat_tinggal' => 'Jl. Sudirman No. 45, Palembang',
                'program_studi' => 'Akuntansi',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'PMR, Pramuka',
                'alasan_mapala' => 'Tertarik dengan kegiatan alam dan ingin berkontribusi dalam pelestarian lingkungan.',
                'foto' => 'siti_nurhaliza.jpg',
                'status' => 'approved',
                'angkatan' => 2021,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nim' => '2021003',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi.santoso@politala.ac.id',
                'no_wa' => '081234567892',
                'no_hp' => '081234567892',
                'tempat_lahir' => 'Lahat',
                'tanggal_lahir' => '2000-05-10',
                'tempat_tinggal' => 'Jl. Pangeran No. 67, Lahat',
                'program_studi' => 'Teknologi Otomotif',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'Karang Taruna, Pramuka',
                'alasan_mapala' => 'Ingin belajar survival dan teknik mountaineering untuk persiapan masa depan.',
                'foto' => 'budi_santoso.jpg',
                'status' => 'pending',
                'angkatan' => 2021,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nim' => '2021004',
                'nama_lengkap' => 'Dewi Sartika',
                'email' => 'dewi.sartika@politala.ac.id',
                'no_wa' => '081234567893',
                'no_hp' => '081234567893',
                'tempat_lahir' => 'Muara Enim',
                'tanggal_lahir' => '2000-07-25',
                'tempat_tinggal' => 'Jl. Ahmad Yani No. 89, Muara Enim',
                'program_studi' => 'Agroindustri',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'PMR, Rohis',
                'alasan_mapala' => 'Tertarik dengan kegiatan alam dan ingin mengembangkan kemampuan sosial.',
                'foto' => 'dewi_sartika.jpg',
                'status' => 'approved',
                'angkatan' => 2021,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nim' => '2021005',
                'nama_lengkap' => 'Rudi Hermawan',
                'email' => 'rudi.hermawan@politala.ac.id',
                'no_wa' => '081234567894',
                'no_hp' => '081234567894',
                'tempat_lahir' => 'Baturaja',
                'tanggal_lahir' => '2000-09-30',
                'tempat_tinggal' => 'Jl. Gatot Subroto No. 12, Baturaja',
                'program_studi' => 'TPT',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'OSIS, Pramuka',
                'alasan_mapala' => 'Ingin belajar tentang alam dan mengembangkan kemampuan leadership.',
                'foto' => 'rudi_hermawan.jpg',
                'status' => 'pending',
                'angkatan' => 2021,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($users);

        // Sample Divisi
        $divisi = [
            [
                'nama' => 'Divisi Gunung Hutan',
                'slug' => 'divisi-gunung-hutan',
                'deskripsi' => 'Divisi yang fokus pada kegiatan pendakian gunung, hiking, dan eksplorasi hutan.',
                'icon' => 'mountain',
                'warna' => '#16a34a',
                'ketua' => 'Ahmad Rizki',
                'jumlah_anggota' => 15,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi Caving',
                'slug' => 'divisi-caving',
                'deskripsi' => 'Divisi yang fokus pada eksplorasi gua dan kegiatan speleologi.',
                'icon' => 'cave',
                'warna' => '#7c3aed',
                'ketua' => 'Siti Nurhaliza',
                'jumlah_anggota' => 12,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi SAR',
                'slug' => 'divisi-sar',
                'deskripsi' => 'Divisi Search and Rescue yang fokus pada kegiatan penyelamatan dan pertolongan.',
                'icon' => 'rescue',
                'warna' => '#dc2626',
                'ketua' => 'Budi Santoso',
                'jumlah_anggota' => 10,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi Rock Climbing',
                'slug' => 'divisi-rock-climbing',
                'deskripsi' => 'Divisi yang fokus pada kegiatan panjat tebing dan rock climbing.',
                'icon' => 'climbing',
                'warna' => '#ea580c',
                'ketua' => 'Dewi Sartika',
                'jumlah_anggota' => 8,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Divisi Rafting',
                'slug' => 'divisi-rafting',
                'deskripsi' => 'Divisi yang fokus pada kegiatan arung jeram dan water sport.',
                'icon' => 'rafting',
                'warna' => '#0891b2',
                'ketua' => 'Rudi Hermawan',
                'jumlah_anggota' => 6,
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('divisi')->insertBatch($divisi);

        // Sample Kegiatan
        $kegiatan = [
            [
                'judul' => 'Pendakian Gunung Dempo',
                'slug' => 'pendakian-gunung-dempo',
                'deskripsi' => 'Kegiatan pendakian Gunung Dempo yang merupakan gunung tertinggi di Sumatera Selatan.',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_selesai' => '2024-01-17',
                'lokasi' => 'Gunung Dempo, Pagaralam',
                'divisi_id' => 1,
                'jenis_kegiatan' => 'pendakian',
                'status' => 'published',
                'foto_cover' => 'gunung_dempo.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Eksplorasi Gua Putri',
                'slug' => 'eksplorasi-gua-putri',
                'deskripsi' => 'Kegiatan eksplorasi Gua Putri di Baturaja yang memiliki stalaktit dan stalagmit yang indah.',
                'tanggal_mulai' => '2024-02-10',
                'tanggal_selesai' => '2024-02-12',
                'lokasi' => 'Gua Putri, Baturaja',
                'divisi_id' => 2,
                'jenis_kegiatan' => 'caving',
                'status' => 'published',
                'foto_cover' => 'gua_putri.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Pelatihan SAR Dasar',
                'slug' => 'pelatihan-sar-dasar',
                'deskripsi' => 'Pelatihan Search and Rescue dasar untuk anggota baru MAPALA.',
                'tanggal_mulai' => '2024-03-05',
                'tanggal_selesai' => '2024-03-07',
                'lokasi' => 'Kampus Politala',
                'divisi_id' => 3,
                'jenis_kegiatan' => 'pelatihan',
                'status' => 'published',
                'foto_cover' => 'pelatihan_sar.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Panjat Tebing Bukit Siguntang',
                'slug' => 'panjat-tebing-bukit-siguntang',
                'deskripsi' => 'Kegiatan panjat tebing di Bukit Siguntang dengan berbagai tingkat kesulitan.',
                'tanggal_mulai' => '2024-04-20',
                'tanggal_selesai' => '2024-04-22',
                'lokasi' => 'Bukit Siguntang, Palembang',
                'divisi_id' => 4,
                'jenis_kegiatan' => 'rock_climbing',
                'status' => 'published',
                'foto_cover' => 'bukit_siguntang.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Arung Jeram Sungai Musi',
                'slug' => 'arung-jeram-sungai-musi',
                'deskripsi' => 'Kegiatan arung jeram di Sungai Musi dengan tingkat kesulitan grade III-IV.',
                'tanggal_mulai' => '2024-05-15',
                'tanggal_selesai' => '2024-05-17',
                'lokasi' => 'Sungai Musi, Palembang',
                'divisi_id' => 5,
                'jenis_kegiatan' => 'rafting',
                'status' => 'published',
                'foto_cover' => 'sungai_musi.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('kegiatan')->insertBatch($kegiatan);

        // Sample Kegiatan Foto
        $kegiatanFoto = [
            [
                'kegiatan_id' => 1,
                'judul' => 'Puncak Gunung Dempo',
                'deskripsi' => 'Foto di puncak Gunung Dempo dengan pemandangan yang indah',
                'foto' => 'puncak_dempo.jpg',
                'urutan' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 1,
                'judul' => 'Camping Area',
                'deskripsi' => 'Area camping di Gunung Dempo',
                'foto' => 'camping_dempo.jpg',
                'urutan' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatan_id' => 2,
                'judul' => 'Stalaktit Gua Putri',
                'deskripsi' => 'Stalaktit yang indah di dalam Gua Putri',
                'foto' => 'stalaktit_gua.jpg',
                'urutan' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('kegiatan_foto')->insertBatch($kegiatanFoto);

        // Sample Video Angkatan
        $videoAngkatan = [
            [
                'angkatan' => 2021,
                'judul' => 'Video Dokumentasi Angkatan 2021',
                'deskripsi' => 'Video dokumentasi kegiatan angkatan 2021 MAPALA Politala',
                'video_url' => 'https://www.youtube.com/embed/example1',
                'thumbnail' => 'video_2021.jpg',
                'durasi' => '15:30',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'angkatan' => 2022,
                'judul' => 'Video Dokumentasi Angkatan 2022',
                'deskripsi' => 'Video dokumentasi kegiatan angkatan 2022 MAPALA Politala',
                'video_url' => 'https://www.youtube.com/embed/example2',
                'thumbnail' => 'video_2022.jpg',
                'durasi' => '18:45',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'angkatan' => 2023,
                'judul' => 'Video Dokumentasi Angkatan 2023',
                'deskripsi' => 'Video dokumentasi kegiatan angkatan 2023 MAPALA Politala',
                'video_url' => 'https://www.youtube.com/embed/example3',
                'thumbnail' => 'video_2023.jpg',
                'durasi' => '20:15',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('video_angkatan')->insertBatch($videoAngkatan);

        // Sample Kode Etik
        $kodeEtik = [
            [
                'judul' => 'Kode Etik Umum MAPALA',
                'slug' => 'kode-etik-umum-mapala',
                'konten' => 'Kode etik umum yang harus dipatuhi oleh setiap anggota MAPALA Politala dalam setiap kegiatan.',
                'urutan' => 1,
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Kode Etik Pendakian',
                'slug' => 'kode-etik-pendakian',
                'konten' => 'Kode etik khusus untuk kegiatan pendakian gunung yang harus dipatuhi.',
                'urutan' => 2,
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Kode Etik Caving',
                'slug' => 'kode-etik-caving',
                'konten' => 'Kode etik khusus untuk kegiatan eksplorasi gua yang harus dipatuhi.',
                'urutan' => 3,
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('kode_etik')->insertBatch($kodeEtik);

        // Sample ID Card
        $idCard = [
            [
                'user_id' => 1,
                'nomor_id' => 'MAPALA-2021-001',
                'divisi_id' => 1,
                'jabatan' => 'Ketua Divisi Gunung Hutan',
                'tanggal_bergabung' => '2021-09-01',
                'masa_berlaku' => '2025-08-31',
                'status' => 'aktif',
                'foto_id' => 'id_card_001.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'nomor_id' => 'MAPALA-2021-002',
                'divisi_id' => 2,
                'jabatan' => 'Ketua Divisi Caving',
                'tanggal_bergabung' => '2021-09-01',
                'masa_berlaku' => '2025-08-31',
                'status' => 'aktif',
                'foto_id' => 'id_card_002.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('id_card')->insertBatch($idCard);
    }
}