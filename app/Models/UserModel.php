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
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'agama',
        'program_studi',
        'gol_darah',
        'penyakit',
        'nama_ayah',
        'nama_ibu',
        'alamat_orangtua',
        'no_telp_orangtua',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
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
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'nama_panggilan' => 'required|min_length[2]|max_length[50]',
        'tempat_lahir' => 'required|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
        'alamat' => 'required|min_length[10]',
        'no_telp' => 'required|min_length[10]|max_length[20]',
        'agama' => 'required|min_length[3]|max_length[20]',
        'program_studi' => 'required|min_length[3]|max_length[50]',
        'gol_darah' => 'required|in_list[A,B,AB,O]',
        'nama_ayah' => 'required|min_length[3]|max_length[100]',
        'nama_ibu' => 'required|min_length[3]|max_length[100]',
        'alamat_orangtua' => 'required|min_length[10]',
        'no_telp_orangtua' => 'required|min_length[10]|max_length[20]',
        'pekerjaan_ayah' => 'required|min_length[3]|max_length[100]',
        'pekerjaan_ibu' => 'required|min_length[3]|max_length[100]',
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
                   ->orLike('nama_panggilan', $keyword)
                   ->orLike('program_studi', $keyword)
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