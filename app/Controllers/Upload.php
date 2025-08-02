<?php

namespace App\Controllers;

class Upload extends BaseController
{
    public function foto()
    {
        $file = $this->request->getFile('foto');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/fotos', $newName);
            
            return $this->response->setJSON(['success' => true, 'filename' => $newName]);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Upload gagal']);
    }
    
    public function document()
    {
        $file = $this->request->getFile('document');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/documents', $newName);
            
            return $this->response->setJSON(['success' => true, 'filename' => $newName]);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Upload gagal']);
    }
}