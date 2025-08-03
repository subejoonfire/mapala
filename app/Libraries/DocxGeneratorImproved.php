<?php

namespace App\Libraries;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;

class DocxGeneratorImproved
{
    private $userData;
    
    public function __construct()
    {
        // Constructor
    }
    
    /**
     * Generate formulir pendaftaran DOCX dari template HTML
     */
    public function generateFormulirPendaftaran($userData)
    {
        try {
            $this->userData = $userData;
            
            // Create new PhpWord instance
            $phpWord = new PhpWord();
            
            // Set document properties
            $properties = $phpWord->getDocInfo();
            $properties->setCreator('MAPALA POLITALA System');
            $properties->setTitle('Formulir Pendaftaran MAPALA POLITALA');
            
            // Add section with A4 settings
            $section = $phpWord->addSection([
                'marginLeft' => 1134,
                'marginRight' => 1134,
                'marginTop' => 1134,
                'marginBottom' => 1134,
            ]);
            
            // Build formulir content
            $this->buildFormulirContent($section);
            
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
            
            // Create new PhpWord instance
            $phpWord = new PhpWord();
            
            // Set document properties
            $properties = $phpWord->getDocInfo();
            $properties->setCreator('MAPALA POLITALA System');
            $properties->setTitle('ID Card MAPALA POLITALA');
            
            // Add section for ID card (smaller dimensions)
            $section = $phpWord->addSection([
                'marginLeft' => 567,
                'marginRight' => 567,
                'marginTop' => 567,
                'marginBottom' => 567,
            ]);
            
            // Build ID card content
            $this->buildIdCardContent($section);
            
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
     * Build formulir content manually mengikuti template HTML
     */
    private function buildFormulirContent($section)
    {
        $data = $this->userData;
        
        // Header section dengan logo dan title
        $headerTable = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80
        ]);
        
        $headerTable->addRow();
        
        // Logo kiri
        $cell1 = $headerTable->addCell(2000);
        $logoKiri = ROOTPATH . 'template_docx/formulir_pendaftaran/logo_kiri.png';
        if (file_exists($logoKiri)) {
            $cell1->addImage($logoKiri, [
                'width' => 80,
                'height' => 80,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
            ]);
        }
        
        // Title section
        $cell2 = $headerTable->addCell(6000);
        $cell2->addText('FORMULIR PENDAFTARAN CALON ANGGOTA BARU', [
            'name' => 'Arial',
            'size' => 14,
            'bold' => true
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        $cell2->addText('MAPALA POLITALA TAHUN ' . $data['angkatan'], [
            'name' => 'Arial',
            'size' => 12,
            'bold' => true
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        // Logo kanan
        $cell3 = $headerTable->addCell(2000);
        $logoKanan = ROOTPATH . 'template_docx/formulir_pendaftaran/logo_kanan.png';
        if (file_exists($logoKanan)) {
            $cell3->addImage($logoKanan, [
                'width' => 80,
                'height' => 80,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
            ]);
        }
        
        $section->addTextBreak(2);
        
        // Main content dengan foto
        $contentTable = $section->addTable();
        
        $contentTable->addRow();
        
        // Left column dengan form fields
        $leftCell = $contentTable->addCell(7000);
        $this->addFormFields($leftCell);
        
        // Right column dengan foto
        $rightCell = $contentTable->addCell(3000);
        $this->addPhotoSection($rightCell);
        
        $section->addTextBreak(2);
        
        // Signature section
        $section->addText('Pelaihari, ' . date('d F Y'), [
            'name' => 'Arial',
            'size' => 12
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
        
        $section->addText('Hormat saya,', [
            'name' => 'Arial',
            'size' => 12
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
        
        $section->addTextBreak(3);
        
        $section->addText('(' . $data['nama_lengkap'] . ')', [
            'name' => 'Arial',
            'size' => 12
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
    }
    
    /**
     * Add form fields ke left column
     */
    private function addFormFields($cell)
    {
        $data = $this->userData;
        
        // Data fields
        $fields = [
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
        ];
        
        foreach ($fields as $label => $value) {
            $fieldTable = $cell->addTable();
            $fieldTable->addRow();
            $fieldTable->addCell(3500)->addText($label, ['name' => 'Arial', 'size' => 11]);
            $fieldTable->addCell(300)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $fieldTable->addCell(3200)->addText($value, ['name' => 'Arial', 'size' => 11]);
        }
        
        $cell->addTextBreak();
        $cell->addText('DATA ORANGTUA', ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $cell->addTextBreak();
        
        // Data orangtua
        $parentFields = [
            'Nama Ayah' => $data['nama_ayah'],
            'Nama Ibu' => $data['nama_ibu'],
            'Alamat Orangtua' => $data['alamat_orangtua'],
            'No. Telp/HP Orangtua' => $data['no_telp_orangtua'],
            'Pekerjaan Ayah' => $data['pekerjaan_ayah'],
            'Pekerjaan Ibu' => $data['pekerjaan_ibu'],
        ];
        
        foreach ($parentFields as $label => $value) {
            $fieldTable = $cell->addTable();
            $fieldTable->addRow();
            $fieldTable->addCell(3500)->addText($label, ['name' => 'Arial', 'size' => 11]);
            $fieldTable->addCell(300)->addText(':', ['name' => 'Arial', 'size' => 11]);
            $fieldTable->addCell(3200)->addText($value, ['name' => 'Arial', 'size' => 11]);
        }
    }
    
    /**
     * Add photo section ke right column
     */
    private function addPhotoSection($cell)
    {
        // Create photo box
        $photoTable = $cell->addTable([
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80
        ]);
        
        $photoTable->addRow(4000); // Height 4000 twips ≈ 160px
        $photoCell = $photoTable->addCell(3000); // Width 3000 twips ≈ 120px
        
        if (!empty($this->userData['foto'])) {
            $photoPath = ROOTPATH . 'public/uploads/fotos/' . $this->userData['foto'];
            if (file_exists($photoPath)) {
                $photoCell->addImage($photoPath, [
                    'width' => 120,
                    'height' => 160,
                    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
                ]);
            } else {
                $photoCell->addText('Pas Foto', ['name' => 'Arial', 'size' => 10], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                $photoCell->addText('3x4 Warna', ['name' => 'Arial', 'size' => 10], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            }
        } else {
            $photoCell->addText('Pas Foto', ['name' => 'Arial', 'size' => 10], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $photoCell->addText('3x4 Warna', ['name' => 'Arial', 'size' => 10], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        }
    }
    
    /**
     * Build ID card content manually mengikuti template HTML
     */
    private function buildIdCardContent($section)
    {
        $data = $this->userData;
        
        // Main card container
        $cardTable = $section->addTable([
            'borderSize' => 12,
            'borderColor' => '000000',
            'cellMargin' => 200
        ]);
        
        $cardTable->addRow(9500); // Total height for ID card
        $cardCell = $cardTable->addCell(6300); // Width for ID card
        
        // Header
        $cardCell->addText('LATIHAN DASAR XV', [
            'name' => 'Arial',
            'size' => 14,
            'bold' => true
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        $cardCell->addText('MAPALA POLITALA', [
            'name' => 'Arial',
            'size' => 20,
            'bold' => true
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        $cardCell->addText('TAHUN ' . $data['angkatan'], [
            'name' => 'Arial',
            'size' => 16,
            'bold' => true
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        $cardCell->addTextBreak();
        
        // Photo section
        if (!empty($data['foto'])) {
            $photoPath = ROOTPATH . 'public/uploads/fotos/' . $data['foto'];
            if (file_exists($photoPath)) {
                $cardCell->addImage($photoPath, [
                    'width' => 120,
                    'height' => 150,
                    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
                ]);
            }
        }
        
        $cardCell->addTextBreak();
        
        // Info section
        $infoTable = $cardCell->addTable();
        
        $infoFields = [
            'Nama' => $data['nama_lengkap'],
            'Gelar' => $data['program_studi'],
            'Angkatan' => $data['angkatan']
        ];
        
        foreach ($infoFields as $label => $value) {
            $infoTable->addRow();
            $infoTable->addCell(2000)->addText($label, ['name' => 'Arial', 'size' => 14, 'bold' => true]);
            $infoTable->addCell(300)->addText(':', ['name' => 'Arial', 'size' => 14, 'bold' => true]);
            $infoTable->addCell(3000)->addText($value, ['name' => 'Arial', 'size' => 12]);
        }
        
        $cardCell->addTextBreak(2);
        
        // Footer
        $cardCell->addText('"Meningkatkan Jiwa Mentalisme, Totalitas Dan', [
            'name' => 'Arial',
            'size' => 10,
            'italic' => true
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        $cardCell->addText('Loyalitas Dalam Berorganisasi"', [
            'name' => 'Arial',
            'size' => 10,
            'italic' => true
        ], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
    }
}