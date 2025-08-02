<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Settings extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Sistem',
            'settings' => $this->settingModel->getAllSettings()
        ];

        return view('admin/settings/index', $data);
    }

    public function update()
    {
        $whatsappGroupLink = $this->request->getPost('whatsapp_group_link');
        $whatsappGroupName = $this->request->getPost('whatsapp_group_name');
        $contactEmail = $this->request->getPost('contact_email');
        $contactPhone = $this->request->getPost('contact_phone');

        // Update settings
        $this->settingModel->setValue('whatsapp_group_link', $whatsappGroupLink, 'Link grup WhatsApp MAPALA Politala');
        $this->settingModel->setValue('whatsapp_group_name', $whatsappGroupName, 'Nama grup WhatsApp MAPALA Politala');
        $this->settingModel->setValue('contact_email', $contactEmail, 'Email kontak MAPALA Politala');
        $this->settingModel->setValue('contact_phone', $contactPhone, 'Nomor telepon kontak MAPALA Politala');

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}