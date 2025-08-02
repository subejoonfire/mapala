<?php

namespace App\Controllers;

class Download extends BaseController
{
    public function document($filename)
    {
        $filepath = FCPATH . 'uploads/documents/' . $filename;
        
        if (!file_exists($filepath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        return $this->response->download($filepath, $filename);
    }
}