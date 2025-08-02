<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKodeEtik extends Migration
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
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'unique'     => true,
            ],
            'konten' => [
                'type' => 'LONGTEXT',
            ],
            'urutan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'published'],
                'default'    => 'published',
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
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('kode_etik');
    }

    public function down()
    {
        $this->forge->dropTable('kode_etik');
    }
}