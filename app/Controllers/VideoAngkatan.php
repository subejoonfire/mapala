<?php

namespace App\Controllers;

use App\Models\VideoAngkatanModel;

class VideoAngkatan extends BaseController
{
    public function index()
    {
        $videoModel = new VideoAngkatanModel();
        
        $data = [
            'title' => 'Video Angkatan',
            'videos' => $videoModel->where('status', 'published')->orderBy('angkatan', 'DESC')->findAll(),
        ];
        
        return view('video_angkatan/index', $data);
    }
    
    public function show($id)
    {
        $videoModel = new VideoAngkatanModel();
        $video = $videoModel->where('status', 'published')->find($id);
        
        if (!$video) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'title' => $video['judul'],
            'video' => $video,
        ];
        
        return view('video_angkatan/show', $data);
    }
}