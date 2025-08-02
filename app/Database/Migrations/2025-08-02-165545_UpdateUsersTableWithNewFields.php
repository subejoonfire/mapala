<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUsersTableWithNewFields extends Migration
{
    public function up()
    {
        // First, rename tempat_tinggal to alamat
        $this->forge->modifyColumn('users', [
            'tempat_tinggal' => [
                'name' => 'alamat',
                'type' => 'TEXT',
                'null' => false
            ]
        ]);
        
        // Drop old columns that are no longer needed (excluding tempat_tinggal since it's now alamat)
        $this->forge->dropColumn('users', ['nim', 'email', 'no_wa', 'no_hp', 'pengalaman_organisasi', 'alasan_mapala']);
        
        // Add new columns
        $fields = [
            'nama_panggilan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'after' => 'nama_lengkap'
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null' => false,
                'after' => 'tanggal_lahir'
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'after' => 'jenis_kelamin'
            ],
            'gol_darah' => [
                'type' => 'ENUM',
                'constraint' => ['A', 'B', 'AB', 'O'],
                'null' => false,
                'after' => 'program_studi'
            ],
            'nama_ayah' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'penyakit'
            ],
            'nama_ibu' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'nama_ayah'
            ],
            'alamat_orangtua' => [
                'type' => 'TEXT',
                'null' => false,
                'after' => 'nama_ibu'
            ],
            'no_telp_orangtua' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'after' => 'alamat_orangtua'
            ],
            'pekerjaan_ayah' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'no_telp_orangtua'
            ],
            'pekerjaan_ibu' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'pekerjaan_ayah'
            ]
        ];
        
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        // Drop new columns first
        $this->forge->dropColumn('users', [
            'nama_panggilan', 'jenis_kelamin', 'no_telp', 'gol_darah', 
            'nama_ayah', 'nama_ibu', 'alamat_orangtua', 'no_telp_orangtua', 
            'pekerjaan_ayah', 'pekerjaan_ibu'
        ]);
        
        // Rename alamat back to tempat_tinggal
        $this->forge->modifyColumn('users', [
            'alamat' => [
                'name' => 'tempat_tinggal',
                'type' => 'TEXT',
                'null' => false
            ]
        ]);
        
        // Add back old columns (excluding tempat_tinggal since it now exists)
        $oldFields = [
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'unique' => true,
                'after' => 'id'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'unique' => true,
                'after' => 'nama_lengkap'
            ],
            'no_wa' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'after' => 'email'
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'after' => 'no_wa'
            ],
            'pengalaman_organisasi' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'penyakit'
            ],
            'alasan_mapala' => [
                'type' => 'TEXT',
                'null' => false,
                'after' => 'pengalaman_organisasi'
            ]
        ];
        
        $this->forge->addColumn('users', $oldFields);
    }
}
