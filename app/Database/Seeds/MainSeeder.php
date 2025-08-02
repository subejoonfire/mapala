<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Run AdminSeeder first
        $this->call('AdminSeeder');
        
        // Run SettingSeeder
        $this->call('SettingSeeder');
        
        // Sample Users (without password)
        $users = [
            [
                'nim' => '2021001',
                'nama_lengkap' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@politala.ac.id',
                'no_wa' => '081234567890',
                'no_hp' => '081234567890',
                'tempat_lahir' => 'Banjarmasin',
                'tanggal_lahir' => '2000-01-15',
                'tempat_tinggal' => 'Jl. Soekarno-Hatta No. 123, Banjarmasin',
                'program_studi' => 'Teknologi Informasi',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'OSIS SMA, Pramuka',
                'alasan_mapala' => 'Ingin mengembangkan kemampuan outdoor dan melestarikan alam',
                'foto' => 'ahmad_rizki.jpg',
                'status' => 'approved',
                'angkatan' => 2021,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '2022001',
                'nama_lengkap' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@politala.ac.id',
                'no_wa' => '081234567891',
                'no_hp' => '081234567891',
                'tempat_lahir' => 'Martapura',
                'tanggal_lahir' => '2001-03-20',
                'tempat_tinggal' => 'Jl. Ahmad Yani No. 456, Martapura',
                'program_studi' => 'Akuntansi',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'Rohis, PMR',
                'alasan_mapala' => 'Tertarik dengan kegiatan alam dan ingin belajar survival',
                'foto' => 'siti_nurhaliza.jpg',
                'status' => 'approved',
                'angkatan' => 2022,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '2023001',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi.santoso@politala.ac.id',
                'no_wa' => '081234567892',
                'no_hp' => '081234567892',
                'tempat_lahir' => 'Banjarbaru',
                'tanggal_lahir' => '2002-07-10',
                'tempat_tinggal' => 'Jl. Pangeran Antasari No. 789, Banjarbaru',
                'program_studi' => 'Teknologi Otomotif',
                'agama' => 'Islam',
                'penyakit' => 'Tidak ada',
                'pengalaman_organisasi' => 'Pramuka, Karang Taruna',
                'alasan_mapala' => 'Ingin belajar mountaineering dan rock climbing',
                'foto' => 'budi_santoso.jpg',
                'status' => 'pending',
                'angkatan' => 2023,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('users')->insertBatch($users);

        // Sample Divisi
        $divisi = [
            [
                'nama' => 'Divisi Gunung Hutan',
                'deskripsi' => 'Divisi yang fokus pada kegiatan pendakian gunung dan eksplorasi hutan',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Divisi Arung Jeram',
                'deskripsi' => 'Divisi yang mengkhususkan diri pada kegiatan arung jeram dan sungai',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Divisi Caving',
                'deskripsi' => 'Divisi yang fokus pada eksplorasi gua dan speleologi',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('divisi')->insertBatch($divisi);

        // Sample Kegiatan
        $kegiatan = [
            [
                'nama' => 'Pendakian Gunung Meratus',
                'deskripsi' => 'Pendakian ke puncak Gunung Meratus untuk melatih kemampuan mountaineering',
                'tanggal_mulai' => '2024-02-15',
                'tanggal_selesai' => '2024-02-17',
                'lokasi' => 'Gunung Meratus, Kalimantan Selatan',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Arung Jeram Sungai Barito',
                'deskripsi' => 'Kegiatan arung jeram di Sungai Barito untuk melatih kemampuan water rescue',
                'tanggal_mulai' => '2024-03-10',
                'tanggal_selesai' => '2024-03-12',
                'lokasi' => 'Sungai Barito, Kalimantan Selatan',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('kegiatan')->insertBatch($kegiatan);

        // Sample Kegiatan Foto
        $kegiatanFoto = [
            [
                'kegiatan_id' => 1,
                'foto' => 'meratus_1.jpg',
                'caption' => 'Tim MAPALA di puncak Gunung Meratus',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'kegiatan_id' => 1,
                'foto' => 'meratus_2.jpg',
                'caption' => 'Pemandangan dari puncak Gunung Meratus',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'kegiatan_id' => 2,
                'foto' => 'barito_1.jpg',
                'caption' => 'Tim MAPALA saat arung jeram',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('kegiatan_foto')->insertBatch($kegiatanFoto);

        // Sample Video Angkatan
        $videoAngkatan = [
            [
                'angkatan' => 2021,
                'judul' => 'Video Dokumentasi Angkatan 2021',
                'deskripsi' => 'Kumpulan video kegiatan angkatan 2021',
                'url' => 'https://www.youtube.com/watch?v=example1',
                'thumbnail' => 'video_2021.jpg',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'angkatan' => 2022,
                'judul' => 'Video Dokumentasi Angkatan 2022',
                'deskripsi' => 'Kumpulan video kegiatan angkatan 2022',
                'url' => 'https://www.youtube.com/watch?v=example2',
                'thumbnail' => 'video_2022.jpg',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('video_angkatan')->insertBatch($videoAngkatan);

        // Sample Kode Etik
        $kodeEtik = [
            [
                'judul' => 'Kode Etik MAPALA Politala',
                'isi' => 'Kode etik yang harus dipatuhi oleh seluruh anggota MAPALA Politala',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('kode_etik')->insertBatch($kodeEtik);

        // Sample ID Card
        $idCard = [
            [
                'user_id' => 1,
                'divisi_id' => 1,
                'nomor_id' => 'MAPALA-2021-001',
                'jabatan' => 'Anggota',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'divisi_id' => 2,
                'nomor_id' => 'MAPALA-2022-001',
                'jabatan' => 'Anggota',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('id_card')->insertBatch($idCard);
    }
}