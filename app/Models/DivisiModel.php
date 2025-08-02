<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nama', 'slug', 'deskripsi', 'icon', 'warna', 'ketua', 
        'jumlah_anggota', 'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'slug' => 'required|min_length[3]|max_length[100]|is_unique[divisi.slug,id,{id}]',
        'deskripsi' => 'required|min_length[20]',
        'icon' => 'required|min_length[2]|max_length[255]',
        'warna' => 'required|min_length[4]|max_length[20]',
        'ketua' => 'permit_empty|min_length[3]|max_length[100]',
        'status' => 'required|in_list[aktif,nonaktif]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama divisi harus diisi',
            'min_length' => 'Nama divisi minimal 3 karakter',
            'max_length' => 'Nama divisi maksimal 100 karakter'
        ],
        'slug' => [
            'required' => 'Slug harus diisi',
            'min_length' => 'Slug minimal 3 karakter',
            'max_length' => 'Slug maksimal 100 karakter',
            'is_unique' => 'Slug sudah digunakan'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi minimal 20 karakter'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (!isset($data['data']['slug']) || empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['nama'], '-', true);
        }
        return $data;
    }

    // Methods
    public function getActiveDivisi()
    {
        return $this->where('status', 'aktif')->findAll();
    }

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getDivisiWithMembers()
    {
        return $this->select('divisi.*, COUNT(id_card.user_id) as total_members')
                   ->join('id_card', 'id_card.divisi_id = divisi.id', 'left')
                   ->where('divisi.status', 'aktif')
                   ->groupBy('divisi.id')
                   ->findAll();
    }

    public function updateMemberCount($divisiId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('id_card');
        $count = $builder->where('divisi_id', $divisiId)->countAllResults();
        
        return $this->update($divisiId, ['jumlah_anggota' => $count]);
    }

    public function getDivisiStats()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('divisi');
        
        return [
            'total' => $builder->countAllResults(),
            'aktif' => $builder->where('status', 'aktif')->countAllResults(),
            'nonaktif' => $builder->where('status', 'nonaktif')->countAllResults(),
            'total_members' => $builder->selectSum('jumlah_anggota')->get()->getRow()->jumlah_anggota ?? 0
        ];
    }

    public function searchDivisi($keyword)
    {
        return $this->like('nama', $keyword)
                   ->orLike('deskripsi', $keyword)
                   ->orLike('ketua', $keyword)
                   ->where('status', 'aktif')
                   ->findAll();
    }

    public function getDivisiWithKegiatan()
    {
        return $this->select('divisi.*, COUNT(kegiatan.id) as total_kegiatan')
                   ->join('kegiatan', 'kegiatan.divisi_id = divisi.id', 'left')
                   ->where('divisi.status', 'aktif')
                   ->groupBy('divisi.id')
                   ->findAll();
    }

    public function getDivisiByJenisKegiatan($jenisKegiatan)
    {
        return $this->select('divisi.*')
                   ->join('kegiatan', 'kegiatan.divisi_id = divisi.id')
                   ->where('kegiatan.jenis_kegiatan', $jenisKegiatan)
                   ->where('divisi.status', 'aktif')
                   ->groupBy('divisi.id')
                   ->findAll();
    }
}