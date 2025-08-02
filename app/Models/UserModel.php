<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nim',
        'nama_lengkap',
        'email',
        'no_wa',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'tempat_tinggal',
        'program_studi',
        'agama',
        'penyakit',
        'pengalaman_organisasi',
        'alasan_mapala',
        'foto',
        'status',
        'angkatan',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nim' => 'required|min_length[8]|max_length[20]|is_unique[users.nim,id,{id}]',
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'no_wa' => 'required|min_length[10]|max_length[20]',
        'no_hp' => 'required|min_length[10]|max_length[20]',
        'tempat_lahir' => 'required|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'tempat_tinggal' => 'required|min_length[10]',
        'program_studi' => 'required|min_length[3]|max_length[50]',
        'agama' => 'required|min_length[3]|max_length[20]',
        'alasan_mapala' => 'required|min_length[20]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Custom methods
    public function getApprovedMembers()
    {
        return $this->where('status', 'approved')->findAll();
    }

    public function getPendingRegistrations()
    {
        return $this->where('status', 'pending')->findAll();
    }

    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    public function getByAngkatan($angkatan)
    {
        return $this->where('angkatan', $angkatan)
                   ->where('status', 'approved')
                   ->findAll();
    }

    public function searchMembers($keyword)
    {
        return $this->like('nama_lengkap', $keyword)
                   ->orLike('nim', $keyword)
                   ->orLike('email', $keyword)
                   ->where('status', 'approved')
                   ->findAll();
    }

    public function getRegistrationStats()
    {
        return [
            'total' => $this->countAll(),
            'approved' => $this->where('status', 'approved')->countAllResults(),
            'pending' => $this->where('status', 'pending')->countAllResults(),
            'rejected' => $this->where('status', 'rejected')->countAllResults(),
            'angkatan_2021' => $this->where('angkatan', 2021)->where('status', 'approved')->countAllResults(),
            'angkatan_2022' => $this->where('angkatan', 2022)->where('status', 'approved')->countAllResults(),
            'angkatan_2023' => $this->where('angkatan', 2023)->where('status', 'approved')->countAllResults(),
            'angkatan_2024' => $this->where('angkatan', 2024)->where('status', 'approved')->countAllResults(),
        ];
    }
}