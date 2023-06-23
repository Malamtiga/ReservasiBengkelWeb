<?php

namespace App\Controllers\pengguna;

use App\Controllers\BaseController;
use App\Models\DatareservasiModel;
use Agoenxz21\Datatables\Datatable;
use App\Models\DataregistrasiModel;
use App\Models\DatauserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DataReservasiController extends BaseController
{
    public function index()
    {
        $session = session();
        $session_data = $session->get('pengguna');
        $data_user = (new DatauserModel())->findAll();
        $data_registrasi = (new DataregistrasiModel())->findAll();
        $data_reservasi = (new DatareservasiModel())->findAll();
        
        
        return view('tmplt/pengguna/datareservasi_view', [
            'data_user' => $data_user,
            'data_reservasi' => $data_reservasi,
            'data_registrasi' => $data_registrasi,
            'session_data' => $session_data
        ]);
        
    }
    
    public function all()
    {
       
        $session = session();
        $pengguna = $session->get('pengguna');
        return (new Datatable(DatareservasiModel::view()))
        ->setFieldFilter(['id','tgl_reservasi','username' ,'nama',  'level', 'alamat', 'nama_bengkel'])
        ->draw();
    }
    
    public function show($id)
    {
        $r = (new DatareservasiModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $session = session();
        $session_data = $session->get('pengguna');
        $dtu = new DatareservasiModel();
        
        $layanan_ids = $this->request->getVar('layanan_id');
        if (!is_array($layanan_ids)) {
            $layanan_ids = [$layanan_ids];
        }
        $id = $dtu->insert([
            'tgl_reservasi' => $this->request->getVar('tgl_reservasi'),
            'data_user_id' => $session_data['id'], 
            'data_registrasi_id' => $this->request->getVar('data_registrasi_id'),
            'layanan_id' => implode(',', $layanan_ids),
            'status' => $this->request->getVar('status'),
        ]);
        
        
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }


    public function batal($id)
{
    $dtu = new DatareservasiModel();

    if($dtu->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $dtu->update($id,[
        'status' => 4,
    ]);
    
    return $this->response->setJSON(['result'=>$hasil]);
}
    
}
