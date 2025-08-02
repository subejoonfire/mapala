<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;

class Kegiatan extends BaseController
{
    public function index()
    {
        $kegiatanModel = new KegiatanModel();
        $kegiatan = $kegiatanModel->where('status', 'published')->findAll();
        
        return $this->response->setJSON($kegiatan);
    }
}