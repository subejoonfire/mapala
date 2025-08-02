<?php

namespace App\Controllers;

class Download extends BaseController
{
    public function index($filename)
    {
        $filepath = ROOTPATH . 'public/uploads/pdfs/' . $filename;
        
        if (!file_exists($filepath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
        
        // Set headers for download
        $this->response->setHeader('Content-Type', 'application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $this->response->setHeader('Content-Length', filesize($filepath));
        
        // Output file content
        readfile($filepath);
        exit;
    }
}