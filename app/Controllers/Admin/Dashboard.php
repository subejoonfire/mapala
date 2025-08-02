<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
        
        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => $userModel->countAll(),
            'pending_users' => $userModel->where('status', 'pending')->countAllResults(),
            'total_divisi' => $divisiModel->countAll(),
            'total_kegiatan' => $kegiatanModel->countAll(),
            'recent_users' => $userModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'recent_kegiatan' => $kegiatanModel->orderBy('created_at', 'DESC')->limit(5)->find(),
        ];
        
        return view('admin/dashboard/index', $data);
    }
}