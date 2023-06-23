<?php

namespace App\Models;

use CodeIgniter\Model;

class DatareservhomeservModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'data_reservhomeserv';
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
        $session = session();
        $username = $session->get('pengguna')['nama'];
        $view = (new DatareservhomeservModel())
        ->select('data_reservhomeserv.*,  data_user.nama, 
        data_user.alamat,data_registrasi.nama_bengkel,layanan.layanan,layanan.harga')
                ->join('data_user', 'data_user.id=data_user_id')
                ->join('data_registrasi', 'data_registrasi.id=data_registrasi_id')
                ->join('layanan', 'layanan.id=layanan_id') 
                ->where('data_user.nama', $username)
                ->builder();

        $r = db_connect()->newQuery()->fromSubquery($view, 'tbl');
        $r->table = 'tbl';
        return $r;
    }
}
