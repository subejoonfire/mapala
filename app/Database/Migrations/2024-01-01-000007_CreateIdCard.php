<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIdCard extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nomor_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'divisi_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'tanggal_bergabung' => [
                'type' => 'DATE',
            ],
            'masa_berlaku' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'aktif',
            ],
            'foto_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
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
        $this->forge->addUniqueKey('nomor_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('divisi_id', 'divisi', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('id_card');
    }

    public function down()
    {
        $this->forge->dropTable('id_card');
    }
}