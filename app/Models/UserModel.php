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

    // Custom methods for statistics
    public function countAll()
    {
        return $this->builder()->countAllResults();
    }

    public function where($field, $value = null)
    {
        return $this->builder()->where($field, $value);
    }

    public function findAll($limit = null, $start = 0)
    {
        if ($limit !== null) {
            return $this->builder()->limit($limit, $start)->get()->getResultArray();
        }
        return $this->builder()->get()->getResultArray();
    }

    public function getApprovedUsers()
    {
        return $this->where('status', 'approved')->findAll();
    }

    public function getPendingUsers()
    {
        return $this->where('status', 'pending')->findAll();
    }

    public function getUsersByAngkatan($angkatan)
    {
        return $this->where('angkatan', $angkatan)->where('status', 'approved')->findAll();
    }
}