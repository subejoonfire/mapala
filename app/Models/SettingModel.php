<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'key',
        'value',
        'description',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'key' => 'required|min_length[3]|max_length[100]|is_unique[settings.key,id,{id}]',
        'value' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Methods
    public function getValue($key, $default = null)
    {
        $setting = $this->where('key', $key)->first();
        return $setting ? $setting['value'] : $default;
    }

    public function setValue($key, $value, $description = null)
    {
        $setting = $this->where('key', $key)->first();
        
        if ($setting) {
            return $this->update($setting['id'], [
                'value' => $value,
                'description' => $description
            ]);
        } else {
            return $this->insert([
                'key' => $key,
                'value' => $value,
                'description' => $description
            ]);
        }
    }

    public function getAllSettings()
    {
        $settings = $this->findAll();
        $result = [];
        
        foreach ($settings as $setting) {
            $result[$setting['key']] = $setting['value'];
        }
        
        return $result;
    }
}