<?php

namespace App\Controllers;

use App\Models\KodeEtikModel;

class KodeEtik extends BaseController
{
    public function index()
    {
        $kodeEtikModel = new KodeEtikModel();
        
        $data = [
            'title' => 'Kode Etik MAPALA',
            'kode_etik' => $kodeEtikModel->where('status', 'published')->orderBy('urutan', 'ASC')->findAll(),
        ];
        
        return view('kode_etik/index', $data);
    }
    
    public function show($slug)
    {
        $kodeEtikModel = new KodeEtikModel();
        $kodeEtik = $kodeEtikModel->where('slug', $slug)->where('status', 'published')->first();
        
        if (!$kodeEtik) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'title' => $kodeEtik['judul'],
            'kode_etik' => $kodeEtik,
        ];
        
        return view('kode_etik/show', $data);
    }
}