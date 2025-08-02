<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KodeEtikSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul' => 'Kode Etik MAPALA Politala',
                'slug' => 'kode-etik-mapala',
                'konten' => '<div class="space-y-6">
                    <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500">
                        <h2 class="text-xl font-bold text-green-800 mb-4">KODE ETIK MAPALA POLITALA</h2>
                        <p class="text-green-700 mb-4">Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut</p>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">1. PRINSIP DASAR</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-700">
                                <li>Mengutamakan keselamatan diri dan tim dalam setiap kegiatan</li>
                                <li>Menjunjung tinggi nilai persaudaraan dan solidaritas</li>
                                <li>Menghormati dan melestarikan alam serta lingkungan</li>
                                <li>Mengembangkan kemampuan dan pengetahuan secara berkelanjutan</li>
                                <li>Berperilaku sopan dan santun dalam setiap interaksi</li>
                            </ul>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">2. ETIKA DALAM KEGIATAN</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-700">
                                <li>Selalu membawa perlengkapan keselamatan yang memadai</li>
                                <li>Mengikuti briefing dan briefing ulang dengan seksama</li>
                                <li>Menjaga kebersihan dan tidak meninggalkan sampah di alam</li>
                                <li>Menghormati adat istiadat dan budaya setempat</li>
                                <li>Tidak melakukan vandalisme atau merusak lingkungan</li>
                                <li>Menggunakan peralatan dengan benar dan merawatnya dengan baik</li>
                            </ul>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">3. ETIKA DALAM ORGANISASI</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-700">
                                <li>Menjunjung tinggi nama baik organisasi MAPALA Politala</li>
                                <li>Mengikuti kegiatan organisasi dengan aktif dan bertanggung jawab</li>
                                <li>Menghormati dan mendukung keputusan pengurus</li>
                                <li>Membantu sesama anggota dalam pengembangan kemampuan</li>
                                <li>Menjaga kerahasiaan informasi internal organisasi</li>
                                <li>Berpartisipasi dalam kegiatan sosial dan konservasi lingkungan</li>
                            </ul>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">4. SANKSI PELANGGARAN</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-700">
                                <li>Peringatan lisan untuk pelanggaran ringan</li>
                                <li>Peringatan tertulis untuk pelanggaran sedang</li>
                                <li>Suspensi keanggotaan untuk pelanggaran berat</li>
                                <li>Pemberhentian keanggotaan untuk pelanggaran sangat berat</li>
                            </ul>
                        </div>

                        <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500">
                            <p class="text-green-700 font-medium">"Kami berkomitmen untuk menjadi pecinta alam yang bertanggung jawab, menghormati alam, dan berkontribusi positif bagi masyarakat."</p>
                        </div>
                    </div>
                </div>',
                'urutan' => 1,
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('kode_etik')->insertBatch($data);
    }
}