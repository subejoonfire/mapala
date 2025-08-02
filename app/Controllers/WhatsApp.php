<?php

namespace App\Controllers;

class WhatsApp extends BaseController
{
    public function join()
    {
        $phone = '6281234567890'; // Ganti dengan nomor WhatsApp admin
        $message = 'Halo, saya ingin bergabung dengan MAPALA Politala!';
        
        $url = "https://wa.me/{$phone}?text=" . urlencode($message);
        
        return redirect()->to($url);
    }
}