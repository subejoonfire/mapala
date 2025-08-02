<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('user_id')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                // Set session
                session()->set([
                    'user_id' => $user['id'],
                    'user_email' => $user['email'],
                    'user_name' => $user['nama_lengkap'],
                    'user_role' => $user['role'],
                    'user_nim' => $user['nim']
                ]);

                // Redirect berdasarkan role
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, ' . $user['nama_lengkap']);
                } else {
                    return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $user['nama_lengkap']);
                }
            } else {
                return redirect()->back()->with('error', 'Email atau password salah');
            }
        }

        $data = [
            'title' => 'Login - MAPALA Politala'
        ];

        return view('auth/login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah berhasil logout');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nim' => 'required|min_length[8]|max_length[20]|is_unique[users.nim]',
                'nama_lengkap' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]',
                'no_wa' => 'required|min_length[10]|max_length[20]',
                'no_hp' => 'required|min_length[10]|max_length[20]',
                'tempat_lahir' => 'required|min_length[2]|max_length[100]',
                'tanggal_lahir' => 'required|valid_date',
                'tempat_tinggal' => 'required|min_length[10]',
                'program_studi' => 'required|in_list[Akuntansi,Teknologi Informasi,Teknologi Otomotif,Agroindustri,TPT,TRKJ,TRKJJ,Akuntansi Perpajakan,PPA,TRPAB]',
                'agama' => 'required|in_list[Islam,Kristen,Katolik,Hindu,Buddha,Konghucu]',
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
                'password' => $this->request->getPost('password'),
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
                'role' => 'calon_anggota',
                'status' => 'pending',
                'angkatan' => date('Y')
            ];

            // Save user
            if ($this->userModel->insert($userData)) {
                // Generate PDF
                $this->generateRegistrationPDF($userData);
                
                return redirect()->to('/register/success')->with('success', 'Pendaftaran berhasil! Silakan cek email Anda untuk informasi selanjutnya.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mendaftar');
            }
        }

        $data = [
            'title' => 'Pendaftaran Anggota Baru - MAPALA Politala',
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

        return view('auth/register', $data);
    }

    public function registerSuccess()
    {
        $data = [
            'title' => 'Pendaftaran Berhasil - MAPALA Politala'
        ];

        return view('auth/register_success', $data);
    }

    public function forgotPassword()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $user = $this->userModel->where('email', $email)->first();

            if ($user) {
                // Generate reset token
                $token = bin2hex(random_bytes(32));
                $this->userModel->update($user['id'], ['reset_token' => $token]);

                // Send email (implement email service)
                // $this->sendResetEmail($user['email'], $token);

                return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda');
            } else {
                return redirect()->back()->with('error', 'Email tidak ditemukan');
            }
        }

        $data = [
            'title' => 'Lupa Password - MAPALA Politala'
        ];

        return view('auth/forgot_password', $data);
    }

    public function resetPassword($token)
    {
        $user = $this->userModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Token reset password tidak valid');
        }

        if ($this->request->getMethod() === 'post') {
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');

            if ($password !== $confirm_password) {
                return redirect()->back()->with('error', 'Password tidak cocok');
            }

            $this->userModel->update($user['id'], [
                'password' => $password,
                'reset_token' => null
            ]);

            return redirect()->to('/login')->with('success', 'Password berhasil diubah');
        }

        $data = [
            'title' => 'Reset Password - MAPALA Politala',
            'token' => $token
        ];

        return view('auth/reset_password', $data);
    }

    private function generateRegistrationPDF($userData)
    {
        // Implement PDF generation using TCPDF
        // This will be implemented in the PDF service
        return true;
    }
}