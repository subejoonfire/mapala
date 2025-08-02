<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVideoAngkatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'angkatan' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'video_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'thumbnail' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'durasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'draft',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('video_angkatan');
    }

    public function down()
    {
        $this->forge->dropTable('video_angkatan');
    }
}