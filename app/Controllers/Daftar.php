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
            'pekerjaan_ayah' => 'required|min_length[3]|max_length[100]',
            'pekerjaan_ibu' => 'required|min_length[3]|max_length[100]',
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
            'pekerjaan_ayah' => $this->request->getPost('pekerjaan_ayah'),
            'pekerjaan_ibu' => $this->request->getPost('pekerjaan_ibu'),
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
            // Load the actual template
            $templatePath = ROOTPATH . 'Formulir Pendaftaran Calang.docx';
            
            if (!file_exists($templatePath)) {
                // Fallback: create simple document if template not found
                return $this->generateSimpleRegistrationDOCX($userData);
            }

            $templateProcessor = new TemplateProcessor($templatePath);
            
            // Replace placeholders with actual data
            // Common placeholder patterns: ${field_name} or {field_name}
            $templateProcessor->setValue('nama_lengkap', $userData['nama_lengkap']);
            $templateProcessor->setValue('nama_panggilan', $userData['nama_panggilan']);
            $templateProcessor->setValue('tempat_lahir', $userData['tempat_lahir']);
            $templateProcessor->setValue('tanggal_lahir', date('d F Y', strtotime($userData['tanggal_lahir'])));
            $templateProcessor->setValue('tempat_tanggal_lahir', $userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir'])));
            $templateProcessor->setValue('jenis_kelamin', $userData['jenis_kelamin']);
            $templateProcessor->setValue('alamat', $userData['alamat']);
            $templateProcessor->setValue('no_telp', $userData['no_telp']);
            $templateProcessor->setValue('no_hp', $userData['no_telp']); // alias
            $templateProcessor->setValue('agama', $userData['agama']);
            $templateProcessor->setValue('program_studi', $userData['program_studi']);
            $templateProcessor->setValue('prodi', $userData['program_studi']); // alias
            $templateProcessor->setValue('jurusan', $userData['program_studi']); // alias
            $templateProcessor->setValue('gol_darah', $userData['gol_darah']);
            $templateProcessor->setValue('golongan_darah', $userData['gol_darah']); // alias
            $templateProcessor->setValue('penyakit', $userData['penyakit'] ?: 'Tidak ada');
            $templateProcessor->setValue('penyakit_diderita', $userData['penyakit'] ?: 'Tidak ada');
            
            // Data Orangtua
            $templateProcessor->setValue('nama_ayah', $userData['nama_ayah']);
            $templateProcessor->setValue('nama_ibu', $userData['nama_ibu']);
            $templateProcessor->setValue('alamat_orangtua', $userData['alamat_orangtua']);
            $templateProcessor->setValue('no_telp_orangtua', $userData['no_telp_orangtua']);
            $templateProcessor->setValue('no_hp_orangtua', $userData['no_telp_orangtua']); // alias
            $templateProcessor->setValue('pekerjaan_ayah', $userData['pekerjaan_ayah']);
            $templateProcessor->setValue('pekerjaan_ibu', $userData['pekerjaan_ibu']);
            
            // Additional common fields
            $templateProcessor->setValue('tanggal_daftar', date('d F Y'));
            $templateProcessor->setValue('tanggal', date('d F Y'));
            $templateProcessor->setValue('status', 'CALON ANGGOTA');
            $templateProcessor->setValue('angkatan', $userData['angkatan']);
            
            // Try different placeholder formats
            $placeholders = [
                'NAMA_LENGKAP', 'NAMA_PANGGILAN', 'TEMPAT_LAHIR', 'TANGGAL_LAHIR',
                'TEMPAT_TANGGAL_LAHIR', 'JENIS_KELAMIN', 'ALAMAT', 'NO_TELP', 'NO_HP',
                'AGAMA', 'PROGRAM_STUDI', 'PRODI', 'JURUSAN', 'GOL_DARAH', 'GOLONGAN_DARAH',
                'PENYAKIT', 'PENYAKIT_DIDERITA', 'NAMA_AYAH', 'NAMA_IBU', 'ALAMAT_ORANGTUA',
                'NO_TELP_ORANGTUA', 'NO_HP_ORANGTUA', 'PEKERJAAN_AYAH', 'PEKERJAAN_IBU',
                'TANGGAL_DAFTAR', 'TANGGAL', 'STATUS', 'ANGKATAN'
            ];
            
            // Try uppercase versions
            foreach ($placeholders as $placeholder) {
                $value = '';
                switch($placeholder) {
                    case 'NAMA_LENGKAP':
                        $value = $userData['nama_lengkap'];
                        break;
                    case 'NAMA_PANGGILAN':
                        $value = $userData['nama_panggilan'];
                        break;
                    case 'TEMPAT_LAHIR':
                        $value = $userData['tempat_lahir'];
                        break;
                    case 'TANGGAL_LAHIR':
                        $value = date('d F Y', strtotime($userData['tanggal_lahir']));
                        break;
                    case 'TEMPAT_TANGGAL_LAHIR':
                        $value = $userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir']));
                        break;
                    case 'JENIS_KELAMIN':
                        $value = $userData['jenis_kelamin'];
                        break;
                    case 'ALAMAT':
                        $value = $userData['alamat'];
                        break;
                    case 'NO_TELP':
                    case 'NO_HP':
                        $value = $userData['no_telp'];
                        break;
                    case 'AGAMA':
                        $value = $userData['agama'];
                        break;
                    case 'PROGRAM_STUDI':
                    case 'PRODI':
                    case 'JURUSAN':
                        $value = $userData['program_studi'];
                        break;
                    case 'GOL_DARAH':
                    case 'GOLONGAN_DARAH':
                        $value = $userData['gol_darah'];
                        break;
                    case 'PENYAKIT':
                    case 'PENYAKIT_DIDERITA':
                        $value = $userData['penyakit'] ?: 'Tidak ada';
                        break;
                    case 'NAMA_AYAH':
                        $value = $userData['nama_ayah'];
                        break;
                    case 'NAMA_IBU':
                        $value = $userData['nama_ibu'];
                        break;
                    case 'ALAMAT_ORANGTUA':
                        $value = $userData['alamat_orangtua'];
                        break;
                    case 'NO_TELP_ORANGTUA':
                    case 'NO_HP_ORANGTUA':
                        $value = $userData['no_telp_orangtua'];
                        break;
                    case 'PEKERJAAN_AYAH':
                        $value = $userData['pekerjaan_ayah'];
                        break;
                    case 'PEKERJAAN_IBU':
                        $value = $userData['pekerjaan_ibu'];
                        break;
                    case 'TANGGAL_DAFTAR':
                    case 'TANGGAL':
                        $value = date('d F Y');
                        break;
                    case 'STATUS':
                        $value = 'CALON ANGGOTA';
                        break;
                    case 'ANGKATAN':
                        $value = $userData['angkatan'];
                        break;
                }
                
                try {
                    $templateProcessor->setValue($placeholder, $value);
                } catch (\Exception $e) {
                    // Ignore if placeholder doesn't exist
                }
            }
            
            // Save the generated document
            $filename = 'formulir_pendaftaran_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            $templateProcessor->saveAs($filepath);
            
            return $filename;
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating registration DOCX: ' . $e->getMessage());
            // Fallback to simple document
            return $this->generateSimpleRegistrationDOCX($userData);
        }
    }

    private function generateIdCardDOCX($userData)
    {
        try {
            // Load the actual template
            $templatePath = ROOTPATH . 'ID CARD.docx';
            
            if (!file_exists($templatePath)) {
                // Fallback: create simple document if template not found
                return $this->generateSimpleIdCardDOCX($userData);
            }

            $templateProcessor = new TemplateProcessor($templatePath);
            
            // Replace placeholders with actual data
            $templateProcessor->setValue('nama_lengkap', $userData['nama_lengkap']);
            $templateProcessor->setValue('nama', $userData['nama_lengkap']); // alias
            $templateProcessor->setValue('program_studi', $userData['program_studi']);
            $templateProcessor->setValue('prodi', $userData['program_studi']); // alias
            $templateProcessor->setValue('jurusan', $userData['program_studi']); // alias
            $templateProcessor->setValue('angkatan', $userData['angkatan']);
            $templateProcessor->setValue('status', 'CALON ANGGOTA');
            $templateProcessor->setValue('tanggal_berlaku', date('d F Y'));
            $templateProcessor->setValue('tanggal', date('d F Y'));
            
            // Try uppercase versions
            $templateProcessor->setValue('NAMA_LENGKAP', $userData['nama_lengkap']);
            $templateProcessor->setValue('NAMA', $userData['nama_lengkap']);
            $templateProcessor->setValue('PROGRAM_STUDI', $userData['program_studi']);
            $templateProcessor->setValue('PRODI', $userData['program_studi']);
            $templateProcessor->setValue('JURUSAN', $userData['program_studi']);
            $templateProcessor->setValue('ANGKATAN', $userData['angkatan']);
            $templateProcessor->setValue('STATUS', 'CALON ANGGOTA');
            $templateProcessor->setValue('TANGGAL_BERLAKU', date('d F Y'));
            $templateProcessor->setValue('TANGGAL', date('d F Y'));
            
            // Save the generated document
            $filename = 'id_card_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            $templateProcessor->saveAs($filepath);
            
            return $filename;
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating ID Card DOCX: ' . $e->getMessage());
            // Fallback to simple document
            return $this->generateSimpleIdCardDOCX($userData);
        }
    }

    // Fallback methods for simple document generation
    private function generateSimpleRegistrationDOCX($userData)
    {
        try {
            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
            
            // Header
            $headerStyle = ['name' => 'Arial', 'size' => 16, 'bold' => true];
            $section->addText('FORMULIR PENDAFTARAN MAPALA POLITALA', $headerStyle, ['alignment' => 'center']);
            $section->addText('Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut', ['name' => 'Arial', 'size' => 12], ['alignment' => 'center']);
            $section->addTextBreak(2);
            
            // Data Pribadi
            $section->addText('DATA PRIBADI', ['name' => 'Arial', 'size' => 12, 'bold' => true]);
            $section->addTextBreak();
            
            $tableStyle = ['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80];
            $table = $section->addTable($tableStyle);
            
            // Add rows
            $table->addRow();
            $table->addCell(4000)->addText('Nama Lengkap', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['nama_lengkap']);
            
            $table->addRow();
            $table->addCell(4000)->addText('Nama Panggilan', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['nama_panggilan']);
            
            $table->addRow();
            $table->addCell(4000)->addText('Tempat dan Tanggal Lahir', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir'])));
            
            $table->addRow();
            $table->addCell(4000)->addText('Jenis Kelamin', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['jenis_kelamin']);
            
            $table->addRow();
            $table->addCell(4000)->addText('Alamat', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['alamat']);
            
            $table->addRow();
            $table->addCell(4000)->addText('No. Telp/ HP', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['no_telp']);
            
            $table->addRow();
            $table->addCell(4000)->addText('Agama', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['agama']);
            
            $table->addRow();
            $table->addCell(4000)->addText('Prodi / Jurusan', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['program_studi']);
            
            $table->addRow();
            $table->addCell(4000)->addText('Gol. Darah', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['gol_darah']);
            
            $table->addRow();
            $table->addCell(4000)->addText('Penyakit yang diderita', ['bold' => true]);
            $table->addCell(500)->addText(':');
            $table->addCell(4000)->addText($userData['penyakit'] ?: 'Tidak ada');
            
            $section->addTextBreak(2);
            
            // Data Orangtua
            $section->addText('DATA ORANGTUA', ['name' => 'Arial', 'size' => 12, 'bold' => true]);
            $section->addTextBreak();
            
            $table2 = $section->addTable($tableStyle);
            
            $table2->addRow();
            $table2->addCell(4000)->addText('Nama Ayah', ['bold' => true]);
            $table2->addCell(500)->addText(':');
            $table2->addCell(4000)->addText($userData['nama_ayah']);
            
            $table2->addRow();
            $table2->addCell(4000)->addText('Nama Ibu', ['bold' => true]);
            $table2->addCell(500)->addText(':');
            $table2->addCell(4000)->addText($userData['nama_ibu']);
            
            $table2->addRow();
            $table2->addCell(4000)->addText('Alamat Orangtua', ['bold' => true]);
            $table2->addCell(500)->addText(':');
            $table2->addCell(4000)->addText($userData['alamat_orangtua']);
            
            $table2->addRow();
            $table2->addCell(4000)->addText('No. Telp./ HP Orangtua', ['bold' => true]);
            $table2->addCell(500)->addText(':');
            $table2->addCell(4000)->addText($userData['no_telp_orangtua']);
            
            $table2->addRow();
            $table2->addCell(4000)->addText('Pekerjaan Ayah', ['bold' => true]);
            $table2->addCell(500)->addText(':');
            $table2->addCell(4000)->addText($userData['pekerjaan_ayah']);
            
            $table2->addRow();
            $table2->addCell(4000)->addText('Pekerjaan Ibu', ['bold' => true]);
            $table2->addCell(500)->addText(':');
            $table2->addCell(4000)->addText($userData['pekerjaan_ibu']);
            
            $section->addTextBreak(2);
            
            // Footer
            $section->addText('Dokumen ini dibuat otomatis pada tanggal ' . date('d F Y'), ['name' => 'Arial', 'size' => 10], ['alignment' => 'center']);
            $section->addText('Status: PENDING - Menunggu persetujuan admin', ['name' => 'Arial', 'size' => 10], ['alignment' => 'center']);
            
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
            log_message('error', 'Error generating simple registration DOCX: ' . $e->getMessage());
            return null;
        }
    }

    private function generateSimpleIdCardDOCX($userData)
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
            log_message('error', 'Error generating simple ID Card DOCX: ' . $e->getMessage());
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