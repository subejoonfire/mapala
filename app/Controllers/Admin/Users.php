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
            'title' => 'Manajemen User',
            'users' => $userModel->findAll(),
        ];
        
        return view('admin/users/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Tambah User',
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
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
        ];
        
        $userModel->insert($data);
        
        return redirect()->to('/admin/users')->with('success', 'User berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'title' => 'Edit User',
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
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
        ];
        
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        
        $userModel->update($id, $data);
        
        return redirect()->to('/admin/users')->with('success', 'User berhasil diperbarui.');
    }
    
    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        
        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus.');
    }
    
    public function approve($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, ['status' => 'approved']);
        
        return redirect()->to('/admin/users')->with('success', 'User berhasil disetujui.');
    }
    
    public function reject($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, ['status' => 'rejected']);
        
        return redirect()->to('/admin/users')->with('success', 'User berhasil ditolak.');
    }
}