<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IdCardSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'nomor_id' => 'MAPALA-2024-001',
                'divisi_id' => 1,
                'jabatan' => 'Ketua Divisi',
                'tanggal_bergabung' => '2024-01-15',
                'masa_berlaku' => '2025-01-15',
                'status' => 'aktif',
                'foto_id' => 'id-card-001.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'nomor_id' => 'MAPALA-2024-002',
                'divisi_id' => 2,
                'jabatan' => 'Ketua Divisi',
                'tanggal_bergabung' => '2024-01-20',
                'masa_berlaku' => '2025-01-20',
                'status' => 'aktif',
                'foto_id' => 'id-card-002.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'nomor_id' => 'MAPALA-2024-003',
                'divisi_id' => 3,
                'jabatan' => 'Ketua Divisi',
                'tanggal_bergabung' => '2024-02-01',
                'masa_berlaku' => '2025-02-01',
                'status' => 'aktif',
                'foto_id' => 'id-card-003.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 4,
                'nomor_id' => 'MAPALA-2024-004',
                'divisi_id' => 4,
                'jabatan' => 'Ketua Divisi',
                'tanggal_bergabung' => '2024-02-10',
                'masa_berlaku' => '2025-02-10',
                'status' => 'aktif',
                'foto_id' => 'id-card-004.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 5,
                'nomor_id' => 'MAPALA-2024-005',
                'divisi_id' => 5,
                'jabatan' => 'Ketua Divisi',
                'tanggal_bergabung' => '2024-02-15',
                'masa_berlaku' => '2025-02-15',
                'status' => 'aktif',
                'foto_id' => 'id-card-005.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('id_card')->insertBatch($data);
    }
}