<?php

namespace App\Controllers;

use App\Models\UserModel;

class Daftar extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('daftar/index');
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

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            try {
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/fotos';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $fotoName = $foto->getRandomName();
                $foto->move($uploadPath, $fotoName);
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload foto: ' . $e->getMessage());
            }
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
        try {
            if ($this->userModel->insert($userData)) {
                // Generate PDF
                $this->generateRegistrationPDF($userData);
                
                return redirect()->to('/daftar/success')->with('success', 'Pendaftaran berhasil! Silakan cek email Anda untuk informasi selanjutnya.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mendaftar');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('daftar/success');
    }

    private function generateRegistrationPDF($userData)
    {
        // Implement PDF generation using TCPDF
        // This will be implemented in the PDF service
        return true;
    }
}