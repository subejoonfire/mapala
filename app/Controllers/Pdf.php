<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\IdCardModel;

class Pdf extends BaseController
{
    public function registration($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'user' => $user,
        ];
        
        return view('pdf/registration', $data);
    }
    
    public function idCard($id)
    {
        $idCardModel = new IdCardModel();
        $idCard = $idCardModel->find($id);
        
        if (!$idCard) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'id_card' => $idCard,
        ];
        
        return view('pdf/id_card', $data);
    }
}