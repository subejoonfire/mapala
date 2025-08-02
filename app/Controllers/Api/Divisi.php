<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DivisiModel;

class Divisi extends BaseController
{
    public function index()
    {
        $divisiModel = new DivisiModel();
        $divisi = $divisiModel->where('status', 'aktif')->findAll();
        
        return $this->response->setJSON($divisi);
    }
}