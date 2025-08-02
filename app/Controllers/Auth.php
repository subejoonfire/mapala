<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login()
    {
        // Jika sudah login, redirect ke admin dashboard
        if (session()->get('admin_id')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->authenticate($username, $password);

        if ($admin) {
            // Set session
            session()->set([
                'admin_id' => $admin['id'],
                'admin_username' => $admin['username'],
                'admin_nama' => $admin['nama_lengkap'],
                'admin_role' => $admin['role'],
                'admin_email' => $admin['email'],
            ]);

            return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, ' . $admin['nama_lengkap']);
        } else {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout');
    }
}