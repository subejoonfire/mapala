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
            // Path to template - using the simple template with placeholders
            $templatePath = ROOTPATH . 'app/template_formulir_simple.docx';
            
            if (!file_exists($templatePath)) {
                log_message('error', 'Template not found: ' . $templatePath);
                return null;
            }
            
            // Create template processor
            $templateProcessor = new TemplateProcessor($templatePath);
            
            // Prepare data for template replacement
            $templateData = [
                'nama_lengkap' => $userData['nama_lengkap'],
                'nama_panggilan' => $userData['nama_panggilan'],
                'tempat_lahir' => $userData['tempat_lahir'],
                'tanggal_lahir' => date('d F Y', strtotime($userData['tanggal_lahir'])),
                'tempat_tanggal_lahir' => $userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir'])),
                'jenis_kelamin' => $userData['jenis_kelamin'],
                'alamat' => $userData['alamat'],
                'no_telp' => $userData['no_telp'],
                'agama' => $userData['agama'],
                'program_studi' => $userData['program_studi'],
                'gol_darah' => $userData['gol_darah'],
                'penyakit' => $userData['penyakit'] ?: 'Tidak ada',
                'nama_ayah' => $userData['nama_ayah'],
                'nama_ibu' => $userData['nama_ibu'],
                'alamat_orangtua' => $userData['alamat_orangtua'],
                'no_telp_orangtua' => $userData['no_telp_orangtua'],
                'pekerjaan_ayah' => $userData['pekerjaan_ayah'],
                'pekerjaan_ibu' => $userData['pekerjaan_ibu'],
                'tanggal_daftar' => date('d F Y'),
                'angkatan' => $userData['angkatan'],
                'status' => 'PENDING - Menunggu persetujuan admin'
            ];
            
            // Replace text placeholders
            foreach ($templateData as $placeholder => $value) {
                $templateProcessor->setValue($placeholder, $value);
            }
            
            // Handle photo if exists
            if (!empty($userData['foto'])) {
                $photoPath = ROOTPATH . 'public/uploads/fotos/' . $userData['foto'];
                if (file_exists($photoPath)) {
                    // Add photo to template (size in cm)
                    $templateProcessor->setImageValue('foto', [
                        'path' => $photoPath,
                        'width' => 300, // pixels
                        'height' => 400, // pixels
                        'ratio' => false
                    ]);
                } else {
                    // If photo not found, set placeholder text
                    $templateProcessor->setValue('foto', 'Foto tidak tersedia');
                }
            } else {
                $templateProcessor->setValue('foto', 'Foto tidak tersedia');
            }
            
            // Save the generated document
            $filename = 'formulir_pendaftaran_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            // Save the document
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
            // Path to template - using the simple template with placeholders
            $templatePath = ROOTPATH . 'app/template_id_card_simple.docx';
            
            if (!file_exists($templatePath)) {
                log_message('error', 'Template not found: ' . $templatePath);
                return null;
            }
            
            // Create template processor
            $templateProcessor = new TemplateProcessor($templatePath);
            
            // Prepare data for template replacement
            $templateData = [
                'nama_lengkap' => $userData['nama_lengkap'],
                'nama_panggilan' => $userData['nama_panggilan'],
                'program_studi' => $userData['program_studi'],
                'angkatan' => $userData['angkatan'],
                'jenis_kelamin' => $userData['jenis_kelamin'],
                'gol_darah' => $userData['gol_darah'],
                'no_telp' => $userData['no_telp'],
                'status' => 'CALON ANGGOTA',
                'tanggal_terbit' => date('d F Y'),
                'tahun' => date('Y')
            ];
            
            // Replace text placeholders
            foreach ($templateData as $placeholder => $value) {
                $templateProcessor->setValue($placeholder, $value);
            }
            
            // Handle photo if exists
            if (!empty($userData['foto'])) {
                $photoPath = ROOTPATH . 'public/uploads/fotos/' . $userData['foto'];
                if (file_exists($photoPath)) {
                    // Add photo to template (smaller size for ID card)
                    $templateProcessor->setImageValue('foto', [
                        'path' => $photoPath,
                        'width' => 200, // pixels
                        'height' => 250, // pixels
                        'ratio' => false
                    ]);
                } else {
                    // If photo not found, set placeholder text
                    $templateProcessor->setValue('foto', 'Foto tidak tersedia');
                }
            } else {
                $templateProcessor->setValue('foto', 'Foto tidak tersedia');
            }
            
            // Save the generated document
            $filename = 'id_card_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            // Save the document
            $templateProcessor->saveAs($filepath);
            
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