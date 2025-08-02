<?php

namespace App\Controllers;

use App\Models\DivisiModel;
use App\Models\KegiatanModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $divisiModel;
    protected $kegiatanModel;
    protected $userModel;

    public function __construct()
    {
        $this->divisiModel = new DivisiModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'MAPALA Politala - Mahasiswa Pecinta Alam',
            'divisi' => $this->divisiModel->getActiveDivisi(),
            'recent_kegiatan' => $this->kegiatanModel->getRecentKegiatan(6),
            'upcoming_kegiatan' => $this->kegiatanModel->getUpcomingKegiatan(3),
            'stats' => [
                'divisi' => $this->divisiModel->getDivisiStats(),
                'kegiatan' => $this->kegiatanModel->getKegiatanStats(),
                'members' => $this->userModel->getRegistrationStats()
            ]
        ];

        return view('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - MAPALA Politala',
            'divisi' => $this->divisiModel->getActiveDivisi(),
            'stats' => [
                'divisi' => $this->divisiModel->getDivisiStats(),
                'members' => $this->userModel->getRegistrationStats()
            ]
        ];

        return view('home/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Kontak - MAPALA Politala',
            'divisi' => $this->divisiModel->getActiveDivisi()
        ];

        return view('home/contact', $data);
    }

    public function search()
    {
        $keyword = $this->request->getGet('q');
        
        if (empty($keyword)) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Hasil Pencarian - MAPALA Politala',
            'keyword' => $keyword,
            'divisi_results' => $this->divisiModel->searchDivisi($keyword),
            'kegiatan_results' => $this->kegiatanModel->searchKegiatan($keyword),
            'divisi' => $this->divisiModel->getActiveDivisi()
        ];

        return view('home/search', $data);
    }

    public function sitemap()
    {
        $data = [
            'divisi' => $this->divisiModel->getActiveDivisi(),
            'kegiatan' => $this->kegiatanModel->getPublishedKegiatan()
        ];

        $this->response->setContentType('application/xml');
        return view('home/sitemap', $data);
    }

    public function robots()
    {
        $this->response->setContentType('text/plain');
        return view('home/robots');
    }
}
