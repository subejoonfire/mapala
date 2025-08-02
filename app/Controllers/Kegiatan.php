<?php

namespace App\Controllers;

use App\Models\KegiatanModel;

class Kegiatan extends BaseController
{
    public function index()
    {
        $kegiatanModel = new KegiatanModel();
        
        $data = [
            'title' => 'Kegiatan MAPALA',
            'kegiatan' => $kegiatanModel->where('status', 'published')->orderBy('tanggal_mulai', 'DESC')->findAll(),
        ];
        
        return view('kegiatan/index', $data);
    }
    
    public function show($slug)
    {
        $kegiatanModel = new KegiatanModel();
        $kegiatan = $kegiatanModel->where('slug', $slug)->where('status', 'published')->first();
        
        if (!$kegiatan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'title' => $kegiatan['judul'],
            'kegiatan' => $kegiatan,
        ];
        
        return view('kegiatan/show', $data);
    }
}