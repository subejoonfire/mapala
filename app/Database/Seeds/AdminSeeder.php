<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Administrator',
                'email' => 'admin@mapala-politala.ac.id',
                'role' => 'admin',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'ketua',
                'password' => password_hash('ketua123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Ketua MAPALA',
                'email' => 'ketua@mapala-politala.ac.id',
                'role' => 'admin',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('admins')->insertBatch($data);
    }
}