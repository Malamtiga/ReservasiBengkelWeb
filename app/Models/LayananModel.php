<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'layanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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

    static function view(){
        $view = (new LayananModel())
        ->select('layanan.*,  data_registrasi.nama_bengkel, ')
                ->join('data_registrasi', 'data_registrasi.id=data_registrasi_id')
                ->builder();

        $r = db_connect()->newQuery()->fromSubquery($view, 'tbl');
        $r->table = 'tbl';
        return $r;
    }
}
