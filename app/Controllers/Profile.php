<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        
        $data = [
            'title' => 'Profile',
            'user' => $user,
        ];
        
        return view('profile/index', $data);
    }
    
    public function update()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');
        
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_wa' => $this->request->getPost('no_wa'),
            'no_hp' => $this->request->getPost('no_hp'),
            'tempat_tinggal' => $this->request->getPost('tempat_tinggal'),
        ];
        
        $userModel->update($userId, $data);
        
        return redirect()->to('/profile')->with('success', 'Profile berhasil diperbarui.');
    }
}