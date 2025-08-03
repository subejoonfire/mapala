<?php

namespace App\Libraries;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\IOFactory;

class DocxGenerator
{
    private $templatePath;
    private $userData;
    
    public function __construct($templatePath = '')
    {
        $this->templatePath = $templatePath;
    }
    
    /**
     * Generate formulir pendaftaran DOCX dari template HTML
     */
    public function generateFormulirPendaftaran($userData)
    {
        try {
            $this->userData = $userData;
            
            // Load template HTML dan replace data
            $htmlContent = $this->loadFormulirTemplate();
            $htmlContent = $this->replaceFormulirData($htmlContent);
            
            // Convert HTML ke DOCX
            $phpWord = new PhpWord();
            $section = $phpWord->addSection([
                'marginLeft' => 1134,
                'marginRight' => 1134,
                'marginTop' => 1134,
                'marginBottom' => 1134,
            ]);
            
            // Add HTML content
            Html::addHtml($section, $htmlContent, false, false);
            
            // Save document
            $filename = 'formulir_pendaftaran_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($filepath);
            
            return $filename;
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating formulir DOCX: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Generate ID card DOCX dari template HTML
     */
    public function generateIdCard($userData)
    {
        try {
            $this->userData = $userData;
            
            // Load template HTML dan replace data
            $htmlContent = $this->loadIdCardTemplate();
            $htmlContent = $this->replaceIdCardData($htmlContent);
            
            // Convert HTML ke DOCX
            $phpWord = new PhpWord();
            $section = $phpWord->addSection([
                'marginLeft' => 567,
                'marginRight' => 567,
                'marginTop' => 567,
                'marginBottom' => 567,
            ]);
            
            // Add HTML content
            Html::addHtml($section, $htmlContent, false, false);
            
            // Save document
            $filename = 'id_card_' . preg_replace('/[^a-zA-Z0-9]/', '_', $userData['nama_lengkap']) . '_' . date('Y-m-d_H-i-s') . '.docx';
            $filepath = ROOTPATH . 'public/uploads/documents/' . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($filepath);
            
            return $filename;
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating ID card DOCX: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Load template formulir pendaftaran HTML
     */
    private function loadFormulirTemplate()
    {
        $templatePath = ROOTPATH . 'template_docx/formulir_pendaftaran/index.php';
        
        if (!file_exists($templatePath)) {
            throw new \Exception('Template formulir not found: ' . $templatePath);
        }
        
        // Start output buffering
        ob_start();
        
        // Include template with data available
        $userData = $this->userData;
        include $templatePath;
        
        // Get content and clean buffer
        $htmlContent = ob_get_clean();
        
        return $htmlContent;
    }
    
    /**
     * Load template ID card HTML
     */
    private function loadIdCardTemplate()
    {
        $templatePath = ROOTPATH . 'template_docx/id_card/index.php';
        
        if (!file_exists($templatePath)) {
            throw new \Exception('Template ID card not found: ' . $templatePath);
        }
        
        // Start output buffering
        ob_start();
        
        // Include template with data available
        $userData = $this->userData;
        include $templatePath;
        
        // Get content and clean buffer
        $htmlContent = ob_get_clean();
        
        return $htmlContent;
    }
    
    /**
     * Replace data placeholders di template formulir
     */
    private function replaceFormulirData($htmlContent)
    {
        $data = $this->userData;
        
        // Replace static text dengan data
        $replacements = [
            'MAPALA POLITALA TAHUN 2020' => 'MAPALA POLITALA TAHUN ' . $data['angkatan'],
            'Pelaihari, ............................................ 2020' => 'Pelaihari, ' . date('d F Y') . '',
        ];
        
        foreach ($replacements as $search => $replace) {
            $htmlContent = str_replace($search, $replace, $htmlContent);
        }
        
        // Add dynamic data ke dotted lines
        $htmlContent = $this->addDataToFormFields($htmlContent);
        
        // Add photo jika ada
        $htmlContent = $this->addPhotoToForm($htmlContent);
        
        return $htmlContent;
    }
    
    /**
     * Replace data placeholders di template ID card
     */
    private function replaceIdCardData($htmlContent)
    {
        $data = $this->userData;
        
        // Replace static text
        $replacements = [
            'TAHUN 2023' => 'TAHUN ' . $data['angkatan'],
            'LATIHAN DASAR XIV' => 'LATIHAN DASAR XV', // Update sesuai kebutuhan
        ];
        
        foreach ($replacements as $search => $replace) {
            $htmlContent = str_replace($search, $replace, $htmlContent);
        }
        
        // Add data to info rows
        $htmlContent = $this->addDataToIdCardFields($htmlContent);
        
        // Add photo
        $htmlContent = $this->addPhotoToIdCard($htmlContent);
        
        return $htmlContent;
    }
    
    /**
     * Add data ke form fields di formulir
     */
    private function addDataToFormFields($htmlContent)
    {
        $data = $this->userData;
        
        // Data mapping untuk formulir
        $formData = [
            'Nama Lengkap' => $data['nama_lengkap'],
            'Nama Panggilan' => $data['nama_panggilan'],
            'Tempat dan Tanggal Lahir' => $data['tempat_lahir'] . ', ' . date('d F Y', strtotime($data['tanggal_lahir'])),
            'Jenis Kelamin' => $data['jenis_kelamin'],
            'Alamat' => $data['alamat'],
            'No. Telp/HP' => $data['no_telp'],
            'Agama' => $data['agama'],
            'Prodi / Jurusan' => $data['program_studi'],
            'Gol. Darah' => $data['gol_darah'],
            'Penyakit yang diderita' => $data['penyakit'] ?: 'Tidak ada',
            'Nama Orangtua' => '', // Header, tidak diisi
            'Ayah' => $data['nama_ayah'],
            'Ibu' => $data['nama_ibu'],
            'Alamat Orangtua' => $data['alamat_orangtua'],
            'No. Telp/HP Orangtua' => $data['no_telp_orangtua'],
            'Pekerjaan Orangtua' => $data['pekerjaan_ayah'] . ' / ' . $data['pekerjaan_ibu'],
        ];
        
        // Replace dotted lines dengan data
        foreach ($formData as $label => $value) {
            if (!empty($value)) {
                $pattern = '/<label>' . preg_quote($label, '/') . '<\/label>\s*<span class="dotted-line"><\/span>/';
                $replacement = '<label>' . $label . '</label><span class="dotted-line">' . htmlspecialchars($value) . '</span>';
                $htmlContent = preg_replace($pattern, $replacement, $htmlContent);
            }
        }
        
        // Replace signature name
        $htmlContent = str_replace('(................................................)', '(' . $data['nama_lengkap'] . ')', $htmlContent);
        
        return $htmlContent;
    }
    
    /**
     * Add data ke ID card fields
     */
    private function addDataToIdCardFields($htmlContent)
    {
        $data = $this->userData;
        
        // Data untuk ID card
        $idCardData = [
            'Nama' => $data['nama_lengkap'],
            'Gelar' => $data['program_studi'], // Menggunakan program studi sebagai gelar
            'Angkatan' => $data['angkatan'],
        ];
        
        // Replace info rows dengan data
        foreach ($idCardData as $label => $value) {
            $pattern = '/<span class="label">' . preg_quote($label, '/') . '<\/span>\s*<span class="colon">:<\/span>/';
            $replacement = '<span class="label">' . $label . '</span><span class="colon">:</span><span class="value">' . htmlspecialchars($value) . '</span>';
            $htmlContent = preg_replace($pattern, $replacement, $htmlContent);
        }
        
        return $htmlContent;
    }
    
    /**
     * Add photo ke formulir
     */
    private function addPhotoToForm($htmlContent)
    {
        if (!empty($this->userData['foto'])) {
            $photoPath = ROOTPATH . 'public/uploads/fotos/' . $this->userData['foto'];
            if (file_exists($photoPath)) {
                $photoData = base64_encode(file_get_contents($photoPath));
                $photoHtml = '<img src="data:image/jpeg;base64,' . $photoData . '" style="width:120px;height:160px;object-fit:cover;" />';
                
                // Replace photo box dengan foto
                $htmlContent = str_replace('<div class="photo-box">', '<div class="photo-box">' . $photoHtml, $htmlContent);
            }
        }
        
        return $htmlContent;
    }
    
    /**
     * Add photo ke ID card
     */
    private function addPhotoToIdCard($htmlContent)
    {
        if (!empty($this->userData['foto'])) {
            $photoPath = ROOTPATH . 'public/uploads/fotos/' . $this->userData['foto'];
            if (file_exists($photoPath)) {
                $photoData = base64_encode(file_get_contents($photoPath));
                $photoHtml = '<img src="data:image/jpeg;base64,' . $photoData . '" style="width:120px;height:150px;object-fit:cover;" />';
                
                // Replace photo placeholder dengan foto
                $htmlContent = str_replace('<div class="photo-placeholder"></div>', '<div class="photo-placeholder">' . $photoHtml . '</div>', $htmlContent);
            }
        }
        
        return $htmlContent;
    }
}