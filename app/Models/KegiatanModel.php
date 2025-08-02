<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'judul', 'slug', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai',
        'lokasi', 'divisi_id', 'jenis_kegiatan', 'status', 'foto_cover',
        'laporan_pdf', 'rencana_anggaran', 'lpj_pdf', 'video_url'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'judul' => 'required|min_length[5]|max_length[200]',
        'slug' => 'required|min_length[5]|max_length[200]|is_unique[kegiatan.slug,id,{id}]',
        'deskripsi' => 'required|min_length[20]',
        'tanggal_mulai' => 'required|valid_date',
        'tanggal_selesai' => 'required|valid_date',
        'lokasi' => 'required|min_length[5]|max_length[200]',
        'divisi_id' => 'permit_empty|integer|is_not_unique[divisi.id]',
        'jenis_kegiatan' => 'required|in_list[pendakian,rock_climbing,arung_jeram,penelitian,sar,pelatihan,lainnya]',
        'status' => 'required|in_list[draft,published,completed]'
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul kegiatan harus diisi',
            'min_length' => 'Judul minimal 5 karakter',
            'max_length' => 'Judul maksimal 200 karakter'
        ],
        'slug' => [
            'required' => 'Slug harus diisi',
            'min_length' => 'Slug minimal 5 karakter',
            'max_length' => 'Slug maksimal 200 karakter',
            'is_unique' => 'Slug sudah digunakan'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi minimal 20 karakter'
        ],
        'tanggal_mulai' => [
            'required' => 'Tanggal mulai harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ],
        'tanggal_selesai' => [
            'required' => 'Tanggal selesai harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
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
            $data['data']['slug'] = url_title($data['data']['judul'], '-', true);
        }
        return $data;
    }

    // Methods
    public function getPublishedKegiatan()
    {
        return $this->where('status', 'published')
                   ->orWhere('status', 'completed')
                   ->orderBy('tanggal_mulai', 'DESC')
                   ->findAll();
    }

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getKegiatanWithDivisi()
    {
        return $this->select('kegiatan.*, divisi.nama as nama_divisi, divisi.slug as divisi_slug')
                   ->join('divisi', 'divisi.id = kegiatan.divisi_id', 'left')
                   ->where('kegiatan.status !=', 'draft')
                   ->orderBy('kegiatan.tanggal_mulai', 'DESC')
                   ->findAll();
    }

    public function getKegiatanByDivisi($divisiId)
    {
        return $this->where('divisi_id', $divisiId)
                   ->where('status !=', 'draft')
                   ->orderBy('tanggal_mulai', 'DESC')
                   ->findAll();
    }

    public function getKegiatanByJenis($jenisKegiatan)
    {
        return $this->where('jenis_kegiatan', $jenisKegiatan)
                   ->where('status !=', 'draft')
                   ->orderBy('tanggal_mulai', 'DESC')
                   ->findAll();
    }

    public function getKegiatanByTahun($tahun)
    {
        return $this->where('YEAR(tanggal_mulai)', $tahun)
                   ->where('status !=', 'draft')
                   ->orderBy('tanggal_mulai', 'DESC')
                   ->findAll();
    }

    public function getUpcomingKegiatan($limit = 5)
    {
        return $this->where('tanggal_mulai >=', date('Y-m-d'))
                   ->where('status', 'published')
                   ->orderBy('tanggal_mulai', 'ASC')
                   ->limit($limit)
                   ->findAll();
    }

    public function getRecentKegiatan($limit = 5)
    {
        return $this->where('status !=', 'draft')
                   ->orderBy('tanggal_mulai', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    public function searchKegiatan($keyword)
    {
        return $this->like('judul', $keyword)
                   ->orLike('deskripsi', $keyword)
                   ->orLike('lokasi', $keyword)
                   ->where('status !=', 'draft')
                   ->orderBy('tanggal_mulai', 'DESC')
                   ->findAll();
    }

    public function getKegiatanStats()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kegiatan');
        
        return [
            'total' => $builder->countAllResults(),
            'published' => $builder->where('status', 'published')->countAllResults(),
            'completed' => $builder->where('status', 'completed')->countAllResults(),
            'draft' => $builder->where('status', 'draft')->countAllResults(),
            'this_year' => $builder->where('YEAR(tanggal_mulai)', date('Y'))->countAllResults(),
            'upcoming' => $builder->where('tanggal_mulai >=', date('Y-m-d'))->countAllResults()
        ];
    }

    public function getKegiatanByDateRange($startDate, $endDate)
    {
        return $this->where('tanggal_mulai >=', $startDate)
                   ->where('tanggal_selesai <=', $endDate)
                   ->where('status !=', 'draft')
                   ->orderBy('tanggal_mulai', 'ASC')
                   ->findAll();
    }

    public function getKegiatanWithPhotos($kegiatanId)
    {
        $kegiatan = $this->find($kegiatanId);
        if (!$kegiatan) return null;

        $db = \Config\Database::connect();
        $builder = $db->table('kegiatan_foto');
        $photos = $builder->where('kegiatan_id', $kegiatanId)
                         ->orderBy('urutan', 'ASC')
                         ->findAll();

        $kegiatan['photos'] = $photos;
        return $kegiatan;
    }

    public function getKegiatanForPublic()
    {
        return $this->select('kegiatan.id, kegiatan.judul, kegiatan.slug, kegiatan.deskripsi, kegiatan.tanggal_mulai, kegiatan.tanggal_selesai, kegiatan.lokasi, kegiatan.foto_cover, kegiatan.jenis_kegiatan, divisi.nama as nama_divisi')
                   ->join('divisi', 'divisi.id = kegiatan.divisi_id', 'left')
                   ->where('kegiatan.status !=', 'draft')
                   ->orderBy('kegiatan.tanggal_mulai', 'DESC')
                   ->findAll();
    }

    public function getKegiatanForMembers()
    {
        return $this->select('kegiatan.*, divisi.nama as nama_divisi')
                   ->join('divisi', 'divisi.id = kegiatan.divisi_id', 'left')
                   ->where('kegiatan.status !=', 'draft')
                   ->orderBy('kegiatan.tanggal_mulai', 'DESC')
                   ->findAll();
    }
}