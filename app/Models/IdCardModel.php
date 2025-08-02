<?php

namespace App\Models;

use CodeIgniter\Model;

class IdCardModel extends Model
{
    protected $table            = 'id_card';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'user_id',
        'nomor_id',
        'divisi_id',
        'jabatan',
        'tanggal_bergabung',
        'masa_berlaku',
        'status',
        'foto_id',
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
        'user_id' => 'required|integer',
        'nomor_id' => 'required|is_unique[id_card.nomor_id,id,{id}]',
        'tanggal_bergabung' => 'required|valid_date',
        'masa_berlaku' => 'required|valid_date',
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
}