<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKegiatanFoto extends Migration
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
            'kegiatan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'urutan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
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
        $this->forge->addForeignKey('kegiatan_id', 'kegiatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kegiatan_foto');
    }

    public function down()
    {
        $this->forge->dropTable('kegiatan_foto');
    }
}