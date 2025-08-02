<?php

namespace App\Controllers;

use App\Models\DivisiModel;

class Divisi extends BaseController
{
    public function index()
    {
        $divisiModel = new DivisiModel();
        
        $data = [
            'title' => 'Divisi MAPALA',
            'divisi' => $divisiModel->where('status', 'aktif')->findAll(),
        ];
        
        return view('divisi/index', $data);
    }
    
    public function show($slug)
    {
        $divisiModel = new DivisiModel();
        $divisi = $divisiModel->where('slug', $slug)->where('status', 'aktif')->first();
        
        if (!$divisi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'title' => $divisi['nama'],
            'divisi' => $divisi,
        ];
        
        return view('divisi/show', $data);
    }
}