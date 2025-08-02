<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SettingModel;

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
            ]
        ];

        return view('daftar/index', $data);
    }

    public function store()
    {
        $rules = [
            'nim' => 'required|min_length[8]|max_length[20]|is_unique[users.nim]',
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'no_wa' => 'required|min_length[10]|max_length[20]',
            'no_hp' => 'required|min_length[10]|max_length[20]',
            'tempat_lahir' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'tempat_tinggal' => 'required|min_length[10]',
            'program_studi' => 'required|min_length[3]|max_length[50]',
            'agama' => 'required|min_length[3]|max_length[20]',
            'penyakit' => 'permit_empty',
            'pengalaman_organisasi' => 'permit_empty',
            'alasan_mapala' => 'required|min_length[20]',
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
            'nim' => $this->request->getPost('nim'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_wa' => $this->request->getPost('no_wa'),
            'no_hp' => $this->request->getPost('no_hp'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'tempat_tinggal' => $this->request->getPost('tempat_tinggal'),
            'program_studi' => $this->request->getPost('program_studi'),
            'agama' => $this->request->getPost('agama'),
            'penyakit' => $this->request->getPost('penyakit'),
            'pengalaman_organisasi' => $this->request->getPost('pengalaman_organisasi'),
            'alasan_mapala' => $this->request->getPost('alasan_mapala'),
            'foto' => $fotoName,
            'status' => 'pending',
            'angkatan' => date('Y')
        ];

        // Save user
        if ($this->userModel->insert($userData)) {
            $userId = $this->userModel->insertID();
            
            // Generate PDFs
            $registrationPdfPath = $this->generateRegistrationPDF($userData);
            $idCardPdfPath = $this->generateIdCardPDF($userData);
            
            // Get WhatsApp link from settings
            $whatsappLink = $this->settingModel->getValue('whatsapp_group_link', 'https://chat.whatsapp.com/example');
            $whatsappName = $this->settingModel->getValue('whatsapp_group_name', 'MAPALA Politala Official');
            
            // Store PDF paths in session for download
            session()->set([
                'registration_pdf' => $registrationPdfPath,
                'id_card_pdf' => $idCardPdfPath,
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
            'registration_pdf' => session()->get('registration_pdf'),
            'id_card_pdf' => session()->get('id_card_pdf'),
            'whatsapp_link' => session()->get('whatsapp_link'),
            'whatsapp_name' => session()->get('whatsapp_name'),
            'user_data' => session()->get('user_data')
        ];

        return view('daftar/success', $data);
    }

    private function generateRegistrationPDF($userData)
    {
        // Create PDF content
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .title { font-size: 24px; font-weight: bold; color: #16a34a; }
                .subtitle { font-size: 18px; color: #666; }
                .section { margin-bottom: 20px; }
                .section-title { font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px; }
                .field { margin-bottom: 10px; }
                .label { font-weight: bold; color: #555; }
                .value { color: #333; }
                .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="title">FORMULIR PENDAFTARAN MAPALA POLITALA</div>
                <div class="subtitle">Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut</div>
            </div>
            
            <div class="section">
                <div class="section-title">DATA PRIBADI</div>
                <div class="field">
                    <span class="label">NIM:</span>
                    <span class="value">' . $userData['nim'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Nama Lengkap:</span>
                    <span class="value">' . $userData['nama_lengkap'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Email:</span>
                    <span class="value">' . $userData['email'] . '</span>
                </div>
                <div class="field">
                    <span class="label">No. WhatsApp:</span>
                    <span class="value">' . $userData['no_wa'] . '</span>
                </div>
                <div class="field">
                    <span class="label">No. HP:</span>
                    <span class="value">' . $userData['no_hp'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Tempat Lahir:</span>
                    <span class="value">' . $userData['tempat_lahir'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Tanggal Lahir:</span>
                    <span class="value">' . $userData['tanggal_lahir'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Tempat Tinggal:</span>
                    <span class="value">' . $userData['tempat_tinggal'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Program Studi:</span>
                    <span class="value">' . $userData['program_studi'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Agama:</span>
                    <span class="value">' . $userData['agama'] . '</span>
                </div>
                <div class="field">
                    <span class="label">Riwayat Penyakit:</span>
                    <span class="value">' . ($userData['penyakit'] ?: 'Tidak ada') . '</span>
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">PENGALAMAN ORGANISASI</div>
                <div class="field">
                    <span class="value">' . ($userData['pengalaman_organisasi'] ?: 'Tidak ada') . '</span>
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">ALASAN MASUK MAPALA</div>
                <div class="field">
                    <span class="value">' . $userData['alasan_mapala'] . '</span>
                </div>
            </div>
            
            <div class="footer">
                <p>Dokumen ini dibuat otomatis pada tanggal ' . date('d/m/Y H:i:s') . '</p>
                <p>Status: PENDING - Menunggu persetujuan admin</p>
            </div>
        </body>
        </html>';

        // Save PDF to file
        $filename = 'registration_' . $userData['nim'] . '_' . date('Y-m-d_H-i-s') . '.pdf';
        $filepath = ROOTPATH . 'public/uploads/pdfs/' . $filename;
        
        // Ensure directory exists
        if (!is_dir(dirname($filepath))) {
            mkdir(dirname($filepath), 0755, true);
        }
        
        // For now, we'll save as HTML file (you can integrate with a PDF library later)
        file_put_contents($filepath, $html);
        
        return $filename;
    }

    private function generateIdCardPDF($userData)
    {
        // Create ID Card PDF content
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .id-card { width: 400px; height: 250px; border: 2px solid #16a34a; padding: 20px; margin: 0 auto; }
                .header { text-align: center; margin-bottom: 20px; }
                .logo { font-size: 24px; font-weight: bold; color: #16a34a; }
                .org-name { font-size: 14px; color: #666; }
                .photo-area { width: 80px; height: 100px; border: 1px solid #ccc; float: right; text-align: center; line-height: 100px; color: #999; }
                .info { margin-left: 20px; }
                .field { margin-bottom: 8px; }
                .label { font-size: 10px; color: #666; }
                .value { font-size: 12px; font-weight: bold; color: #333; }
                .footer { text-align: center; margin-top: 20px; font-size: 10px; color: #666; }
            </style>
        </head>
        <body>
            <div class="id-card">
                <div class="header">
                    <div class="logo">MAPALA</div>
                    <div class="org-name">Mahasiswa Pecinta Alam</div>
                    <div class="org-name">Politeknik Negeri Tanah Laut</div>
                </div>
                
                <div class="photo-area">FOTO</div>
                
                <div class="info">
                    <div class="field">
                        <div class="label">Nama</div>
                        <div class="value">' . $userData['nama_lengkap'] . '</div>
                    </div>
                    <div class="field">
                        <div class="label">NIM</div>
                        <div class="value">' . $userData['nim'] . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Program Studi</div>
                        <div class="value">' . $userData['program_studi'] . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Angkatan</div>
                        <div class="value">' . $userData['angkatan'] . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Status</div>
                        <div class="value">CALON ANGGOTA</div>
                    </div>
                </div>
                
                <div class="footer">
                    <p>ID Card ini berlaku sampai persetujuan admin</p>
                </div>
            </div>
        </body>
        </html>';

        // Save PDF to file
        $filename = 'id_card_' . $userData['nim'] . '_' . date('Y-m-d_H-i-s') . '.pdf';
        $filepath = ROOTPATH . 'public/uploads/pdfs/' . $filename;
        
        // Ensure directory exists
        if (!is_dir(dirname($filepath))) {
            mkdir(dirname($filepath), 0755, true);
        }
        
        // For now, we'll save as HTML file (you can integrate with a PDF library later)
        file_put_contents($filepath, $html);
        
        return $filename;
    }
}