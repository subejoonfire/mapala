<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Jalankan seeder dalam urutan yang benar
        $this->call('DivisiSeeder');
        $this->call('UserSeeder');
        $this->call('IdCardSeeder');
        $this->call('KodeEtikSeeder');
        $this->call('KegiatanSeeder');
        $this->call('KegiatanFotoSeeder');
        $this->call('VideoAngkatanSeeder');
    }
}