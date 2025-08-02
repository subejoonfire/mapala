<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DivisiModel;
use App\Models\KegiatanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $divisiModel = new DivisiModel();
        $kegiatanModel = new KegiatanModel();
        
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'divisi' => $divisiModel->findAll(),
            'kegiatan_terbaru' => $kegiatanModel->orderBy('created_at', 'DESC')->limit(5)->find(),
        ];
        
        return view('dashboard/index', $data);
    }
}