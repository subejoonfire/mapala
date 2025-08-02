<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        $data = [
            'title' => 'Manajemen Pendaftar',
            'users' => $userModel->findAll(),
        ];
        
        return view('admin/users/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Tambah Pendaftar',
        ];
        
        return view('admin/users/create', $data);
    }
    
    public function store()
    {
        $userModel = new UserModel();
        
        $data = [
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
            'status' => $this->request->getPost('status'),
            'angkatan' => date('Y')
        ];
        
        $userModel->insert($data);
        
        return redirect()->to('/admin/users')->with('success', 'Pendaftar berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'title' => 'Edit Pendaftar',
            'user' => $user,
        ];
        
        return view('admin/users/edit', $data);
    }
    
    public function update($id)
    {
        $userModel = new UserModel();
        
        $data = [
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
            'status' => $this->request->getPost('status'),
        ];
        
        $userModel->update($id, $data);
        
        return redirect()->to('/admin/users')->with('success', 'Pendaftar berhasil diperbarui.');
    }
    
    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        
        return redirect()->to('/admin/users')->with('success', 'Pendaftar berhasil dihapus.');
    }
    
    public function approve($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, ['status' => 'approved']);
        
        return redirect()->to('/admin/users')->with('success', 'Pendaftar berhasil disetujui.');
    }
    
    public function reject($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, ['status' => 'rejected']);
        
        return redirect()->to('/admin/users')->with('success', 'Pendaftar berhasil ditolak.');
    }
}