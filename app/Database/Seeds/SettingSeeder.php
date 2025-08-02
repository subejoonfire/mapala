<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'key' => 'whatsapp_group_link',
                'value' => 'https://chat.whatsapp.com/example',
                'description' => 'Link grup WhatsApp MAPALA Politala',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'whatsapp_group_name',
                'value' => 'MAPALA Politala Official',
                'description' => 'Nama grup WhatsApp MAPALA Politala',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'contact_email',
                'value' => 'mapala@politala.ac.id',
                'description' => 'Email kontak MAPALA Politala',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'contact_phone',
                'value' => '+6281234567890',
                'description' => 'Nomor telepon kontak MAPALA Politala',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('settings')->insertBatch($data);
    }
}