<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
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
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_wa' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'tempat_tinggal' => [
                'type' => 'TEXT',
            ],
            'program_studi' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'penyakit' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'pengalaman_organisasi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alasan_mapala' => [
                'type' => 'TEXT',
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'calon_anggota',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'pending',
            ],
            'angkatan' => [
                'type'       => 'INT',
                'constraint' => 4,
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
        $this->forge->addUniqueKey('nim');
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}