<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use App\Models\DivisiModel;

class Search extends BaseController
{
    public function index()
    {
        $query = $this->request->getGet('q');
        
        $kegiatanModel = new KegiatanModel();
        $divisiModel = new DivisiModel();
        
        $kegiatan = $kegiatanModel->like('judul', $query)->orLike('deskripsi', $query)->findAll();
        $divisi = $divisiModel->like('nama', $query)->orLike('deskripsi', $query)->findAll();
        
        $result = [
            'kegiatan' => $kegiatan,
            'divisi' => $divisi,
        ];
        
        return $this->response->setJSON($result);
    }
}