<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nim', 'nama_lengkap', 'email', 'password', 'no_wa', 'no_hp',
        'tempat_lahir', 'tanggal_lahir', 'tempat_tinggal', 'program_studi',
        'agama', 'penyakit', 'pengalaman_organisasi', 'alasan_mapala',
        'foto', 'role', 'status', 'angkatan'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'nim' => 'required|min_length[8]|max_length[20]|is_unique[users.nim,id,{id}]',
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[6]',
        'no_wa' => 'required|min_length[10]|max_length[20]',
        'no_hp' => 'required|min_length[10]|max_length[20]',
        'tempat_lahir' => 'required|min_length[2]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'tempat_tinggal' => 'required|min_length[10]',
        'program_studi' => 'required|in_list[Akuntansi,Teknologi Informasi,Teknologi Otomotif,Agroindustri,TPT,TRKJ,TRKJJ,Akuntansi Perpajakan,PPA,TRPAB]',
        'agama' => 'required|in_list[Islam,Kristen,Katolik,Hindu,Buddha,Konghucu]',
        'alasan_mapala' => 'required|min_length[20]'
    ];

    protected $validationMessages = [
        'nim' => [
            'required' => 'NIM harus diisi',
            'min_length' => 'NIM minimal 8 karakter',
            'max_length' => 'NIM maksimal 20 karakter',
            'is_unique' => 'NIM sudah terdaftar'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    // Methods
    public function authenticate($email, $password)
    {
        $user = $this->where('email', $email)->first();
        
        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }

    public function getByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    public function getApprovedMembers()
    {
        return $this->where('status', 'approved')
                   ->where('role !=', 'calon_anggota')
                   ->findAll();
    }

    public function getPendingRegistrations()
    {
        return $this->where('status', 'pending')
                   ->where('role', 'calon_anggota')
                   ->findAll();
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

    public function getMembersByDivisi($divisiId)
    {
        // Join dengan tabel id_card untuk mendapatkan anggota berdasarkan divisi
        return $this->select('users.*, id_card.nomor_id, id_card.jabatan')
                   ->join('id_card', 'id_card.user_id = users.id', 'left')
                   ->where('id_card.divisi_id', $divisiId)
                   ->where('users.status', 'approved')
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
            'admin' => $this->where('role', 'admin')->countAllResults(),
            'anggota' => $this->where('role', 'anggota')->countAllResults(),
            'calon' => $this->where('role', 'calon_anggota')->countAllResults()
        ];
    }
}