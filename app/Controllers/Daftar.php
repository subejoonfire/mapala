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
            // Path ke template DOCX asli
            $templatePath = APPPATH . 'Views/templates/formulir_template.docx';
            
            // Buat TemplateProcessor
            $templateProcessor = new TemplateProcessor($templatePath);
            
            // Replace semua placeholder dengan data user
            $templateProcessor->setValue('nama_lengkap', $userData['nama_lengkap']);
            $templateProcessor->setValue('nama_panggilan', $userData['nama_panggilan']);
            $templateProcessor->setValue('tempat_tanggal_lahir', $userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir'])));
            $templateProcessor->setValue('jenis_kelamin', $userData['jenis_kelamin']);
            $templateProcessor->setValue('alamat', $userData['alamat']);
            $templateProcessor->setValue('no_telp', $userData['no_telp']);
            $templateProcessor->setValue('agama', $userData['agama']);
            $templateProcessor->setValue('program_studi', $userData['program_studi']);
            $templateProcessor->setValue('gol_darah', $userData['gol_darah']);
            $templateProcessor->setValue('penyakit', $userData['penyakit'] ?: '-');
            $templateProcessor->setValue('nama_ayah', $userData['nama_ayah']);
            $templateProcessor->setValue('nama_ibu', $userData['nama_ibu']);
            $templateProcessor->setValue('alamat_orangtua', $userData['alamat_orangtua']);
            $templateProcessor->setValue('no_telp_orangtua', $userData['no_telp_orangtua']);
            $templateProcessor->setValue('pekerjaan_orangtua', $userData['pekerjaan_orangtua']);
            $templateProcessor->setValue('tanggal', date('d F Y'));
            $templateProcessor->setValue('tahun', date('Y'));
            
            // Generate filename
            $filename = 'formulir_pendaftaran_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            // Save hasil ke file baru
            $templateProcessor->saveAs($filepath);
            
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