<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SettingModel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

class Daftar extends BaseController
{
    protected $userModel;
    protected $settingModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar MAPALA Politala',
            'program_studies' => [
                'Akuntansi' => 'Akuntansi',
                'Teknologi Informasi' => 'Teknologi Informasi',
                'Teknologi Otomotif' => 'Teknologi Otomotif',
                'Agroindustri' => 'Agroindustri',
                'TPT' => 'TPT',
                'TRKJ' => 'TRKJ',
                'TRKJJ' => 'TRKJJ',
                'Akuntansi Perpajakan' => 'Akuntansi Perpajakan',
                'PPA' => 'PPA',
                'TRPAB' => 'TRPAB'
            ],
            'religions' => [
                'Islam' => 'Islam',
                'Kristen' => 'Kristen',
                'Katolik' => 'Katolik',
                'Hindu' => 'Hindu',
                'Buddha' => 'Buddha',
                'Konghucu' => 'Konghucu'
            ],
            'blood_types' => [
                'A' => 'A',
                'B' => 'B',
                'AB' => 'AB',
                'O' => 'O'
            ],
            'genders' => [
                'Laki-laki' => 'Laki-laki',
                'Perempuan' => 'Perempuan'
            ]
        ];

        return view('daftar/index', $data);
    }

    public function store()
    {
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'nama_panggilan' => 'required|min_length[2]|max_length[50]',
            'tempat_lahir' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
            'alamat' => 'required|min_length[10]',
            'no_telp' => 'required|min_length[10]|max_length[20]',
            'agama' => 'required|min_length[3]|max_length[20]',
            'program_studi' => 'required|min_length[3]|max_length[50]',
            'gol_darah' => 'required|in_list[A,B,AB,O]',
            'penyakit' => 'permit_empty',
            'nama_ayah' => 'required|min_length[3]|max_length[100]',
            'nama_ibu' => 'required|min_length[3]|max_length[100]',
            'alamat_orangtua' => 'required|min_length[10]',
            'no_telp_orangtua' => 'required|min_length[10]|max_length[20]',
            'pekerjaan_orangtua' => 'required|min_length[3]|max_length[200]',
            'foto' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $foto = $this->request->getFile('foto');
        $fotoName = null;

        if ($foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/fotos', $fotoName);
        }

        // Prepare user data
        $userData = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nama_panggilan' => $this->request->getPost('nama_panggilan'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp'),
            'agama' => $this->request->getPost('agama'),
            'program_studi' => $this->request->getPost('program_studi'),
            'gol_darah' => $this->request->getPost('gol_darah'),
            'penyakit' => $this->request->getPost('penyakit'),
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'alamat_orangtua' => $this->request->getPost('alamat_orangtua'),
            'no_telp_orangtua' => $this->request->getPost('no_telp_orangtua'),
            'pekerjaan_orangtua' => $this->request->getPost('pekerjaan_orangtua'),
            'foto' => $fotoName,
            'status' => 'pending',
            'angkatan' => date('Y')
        ];

        // Save user
        if ($this->userModel->insert($userData)) {
            $userId = $this->userModel->insertID();
            
            // Generate DOCX files
            $registrationDocxPath = $this->generateRegistrationDOCX($userData);
            $idCardDocxPath = $this->generateIdCardDOCX($userData);
            
            // Get WhatsApp link from settings
            $whatsappLink = $this->settingModel->getValue('whatsapp_group_link', 'https://chat.whatsapp.com/example');
            $whatsappName = $this->settingModel->getValue('whatsapp_group_name', 'MAPALA Politala Official');
            
            // Store DOCX paths in session for download
            session()->set([
                'registration_docx' => $registrationDocxPath,
                'id_card_docx' => $idCardDocxPath,
                'whatsapp_link' => $whatsappLink,
                'whatsapp_name' => $whatsappName,
                'user_data' => $userData
            ]);
            
            return redirect()->to('/daftar/success')->with('success', 'Pendaftaran berhasil! Silakan download dokumen Anda.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mendaftar');
        }
    }

    public function success()
    {
        $data = [
            'title' => 'Pendaftaran Berhasil - MAPALA Politala',
            'registration_docx' => session()->get('registration_docx'),
            'id_card_docx' => session()->get('id_card_docx'),
            'whatsapp_link' => session()->get('whatsapp_link'),
            'whatsapp_name' => session()->get('whatsapp_name'),
            'user_data' => session()->get('user_data')
        ];

        return view('daftar/success', $data);
    }

    private function generateRegistrationDOCX($userData)
    {
        try {
            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
            
            // Header dengan logo (placeholder untuk logo MAPALA)
            $headerTable = $section->addTable(['borderSize' => 0, 'cellMargin' => 80]);
            $headerTable->addRow();
            $headerTable->addCell(2000)->addText('[LOGO MAPALA]', ['name' => 'Arial', 'size' => 10, 'color' => '999999'], ['alignment' => 'center']);
            $headerCell = $headerTable->addCell(6000);
            $headerCell->addText('FORMULIR PENDAFTARAN CALON ANGGOTA BARU', ['name' => 'Arial', 'size' => 14, 'bold' => true], ['alignment' => 'center']);
            $headerCell->addText('MAPALA POLITALA TAHUN ' . date('Y'), ['name' => 'Arial', 'size' => 12, 'bold' => true], ['alignment' => 'center']);
            $headerTable->addCell(2000)->addText('Pas Foto\n3x4 Warna', ['name' => 'Arial', 'size' => 10, 'color' => '999999'], ['alignment' => 'center']);
            
            $section->addTextBreak(2);
            
            // Form fields sesuai template DOCX asli
            $tableStyle = ['borderSize' => 0, 'cellMargin' => 80];
            $table = $section->addTable($tableStyle);
            
            // Nama Lengkap
            $table->addRow();
            $table->addCell(3000)->addText('Nama Lengkap', ['name' => 'Arial', 'size' => 11]);
            $table->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table->addCell(5000)->addText($userData['nama_lengkap'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Nama Panggilan
            $table2 = $section->addTable($tableStyle);
            $table2->addRow();
            $table2->addCell(3000)->addText('Nama Panggilan', ['name' => 'Arial', 'size' => 11]);
            $table2->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table2->addCell(5000)->addText($userData['nama_panggilan'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Tempat dan Tanggal Lahir
            $table3 = $section->addTable($tableStyle);
            $table3->addRow();
            $table3->addCell(3000)->addText('Tempat dan Tanggal Lahir', ['name' => 'Arial', 'size' => 11]);
            $table3->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table3->addCell(5000)->addText($userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir'])), ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Jenis Kelamin
            $table4 = $section->addTable($tableStyle);
            $table4->addRow();
            $table4->addCell(3000)->addText('Jenis Kelamin', ['name' => 'Arial', 'size' => 11]);
            $table4->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table4->addCell(5000)->addText($userData['jenis_kelamin'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Alamat
            $table5 = $section->addTable($tableStyle);
            $table5->addRow();
            $table5->addCell(3000)->addText('Alamat', ['name' => 'Arial', 'size' => 11]);
            $table5->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table5->addCell(5000)->addText($userData['alamat'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // No. Telp/ HP
            $table6 = $section->addTable($tableStyle);
            $table6->addRow();
            $table6->addCell(3000)->addText('No. Telp/ HP', ['name' => 'Arial', 'size' => 11]);
            $table6->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table6->addCell(5000)->addText($userData['no_telp'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Agama
            $table7 = $section->addTable($tableStyle);
            $table7->addRow();
            $table7->addCell(3000)->addText('Agama', ['name' => 'Arial', 'size' => 11]);
            $table7->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table7->addCell(5000)->addText($userData['agama'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Prodi / Jurusan
            $table8 = $section->addTable($tableStyle);
            $table8->addRow();
            $table8->addCell(3000)->addText('Prodi / Jurusan', ['name' => 'Arial', 'size' => 11]);
            $table8->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table8->addCell(5000)->addText($userData['program_studi'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Gol. Darah
            $table9 = $section->addTable($tableStyle);
            $table9->addRow();
            $table9->addCell(3000)->addText('Gol. Darah', ['name' => 'Arial', 'size' => 11]);
            $table9->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table9->addCell(5000)->addText($userData['gol_darah'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Penyakit yang diderita
            $table10 = $section->addTable($tableStyle);
            $table10->addRow();
            $table10->addCell(3000)->addText('Penyakit yang diderita', ['name' => 'Arial', 'size' => 11]);
            $table10->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table10->addCell(5000)->addText($userData['penyakit'] ?: '-', ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak(2);
            
            // Nama Orangtua
            $section->addText('Nama Orangtua', ['name' => 'Arial', 'size' => 11, 'bold' => true]);
            $section->addTextBreak();
            
            // Ayah
            $table11 = $section->addTable($tableStyle);
            $table11->addRow();
            $table11->addCell(3000)->addText('Ayah', ['name' => 'Arial', 'size' => 11]);
            $table11->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table11->addCell(5000)->addText($userData['nama_ayah'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Ibu
            $table12 = $section->addTable($tableStyle);
            $table12->addRow();
            $table12->addCell(3000)->addText('Ibu', ['name' => 'Arial', 'size' => 11]);
            $table12->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table12->addCell(5000)->addText($userData['nama_ibu'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Alamat Orangtua
            $table13 = $section->addTable($tableStyle);
            $table13->addRow();
            $table13->addCell(3000)->addText('Alamat Orangtua', ['name' => 'Arial', 'size' => 11]);
            $table13->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table13->addCell(5000)->addText($userData['alamat_orangtua'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // No. Telp./ HP Orangtua
            $table14 = $section->addTable($tableStyle);
            $table14->addRow();
            $table14->addCell(3000)->addText('No. Telp./ HP Orangtua', ['name' => 'Arial', 'size' => 11]);
            $table14->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table14->addCell(5000)->addText($userData['no_telp_orangtua'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak();
            
            // Pekerjaan Orangtua (sesuai template asli)
            $table15 = $section->addTable($tableStyle);
            $table15->addRow();
            $table15->addCell(3000)->addText('Pekerjaan Orangtua', ['name' => 'Arial', 'size' => 11]);
            $table15->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $table15->addCell(5000)->addText($userData['pekerjaan_orangtua'], ['name' => 'Arial', 'size' => 11]);
            
            $section->addTextBreak(3);
            
            // Footer sesuai template asli
            $footerTable = $section->addTable(['borderSize' => 0, 'cellMargin' => 80]);
            $footerTable->addRow();
            $footerTable->addCell(5000)->addText('');
            $footerCell = $footerTable->addCell(3000);
            $footerCell->addText('Pelaihari, ' . date('d F Y'), ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
            $footerCell->addTextBreak();
            $footerCell->addText('Hormat saya,', ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
            $footerCell->addTextBreak(3);
            $footerCell->addText('(' . $userData['nama_lengkap'] . ')', ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
            
            // Save the generated document
            $filename = 'formulir_pendaftaran_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($filepath);
            
            return $filename;
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating registration DOCX: ' . $e->getMessage());
            return null;
        }
    }

    private function generateIdCardDOCX($userData)
    {
        try {
            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['marginLeft' => 1000, 'marginRight' => 1000, 'marginTop' => 1000, 'marginBottom' => 1000]);
            
            // Header
            $headerStyle = ['name' => 'Arial', 'size' => 18, 'bold' => true, 'color' => '16a34a'];
            $section->addText('MAPALA POLITALA', $headerStyle, ['alignment' => 'center']);
            $section->addText('Mahasiswa Pecinta Alam', ['name' => 'Arial', 'size' => 12], ['alignment' => 'center']);
            $section->addText('Politeknik Negeri Tanah Laut', ['name' => 'Arial', 'size' => 12], ['alignment' => 'center']);
            $section->addTextBreak(2);
            
            // ID Card Content
            $tableStyle = ['borderSize' => 6, 'borderColor' => '16a34a', 'cellMargin' => 80];
            $table = $section->addTable($tableStyle);
            
            $table->addRow();
            $table->addCell(3000)->addText('FOTO', ['name' => 'Arial', 'size' => 12, 'color' => '999999'], ['alignment' => 'center']);
            $cell = $table->addCell(5000);
            $cell->addText('Nama: ' . $userData['nama_lengkap'], ['name' => 'Arial', 'size' => 10, 'bold' => true]);
            $cell->addText('Program Studi: ' . $userData['program_studi'], ['name' => 'Arial', 'size' => 10]);
            $cell->addText('Angkatan: ' . $userData['angkatan'], ['name' => 'Arial', 'size' => 10]);
            $cell->addText('Status: CALON ANGGOTA', ['name' => 'Arial', 'size' => 10, 'bold' => true]);
            
            $section->addTextBreak(2);
            
            // Footer
            $section->addText('ID Card ini berlaku sampai persetujuan admin', ['name' => 'Arial', 'size' => 8], ['alignment' => 'center']);
            $section->addText('Diterbitkan pada: ' . date('d F Y'), ['name' => 'Arial', 'size' => 8], ['alignment' => 'center']);
            
            // Save the generated document
            $filename = 'id_card_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($filepath);
            
            return $filename;
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating ID Card DOCX: ' . $e->getMessage());
            return null;
        }
    }

    public function downloadDocument($type, $filename)
    {
        $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
        
        if (!file_exists($filepath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
        }
        
        return $this->response->download($filepath, null);
    }
}