<?php

namespace App\Controllers\pengguna;

use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\DataregistrasiModel;
use App\Models\DatareservasiModel;
use App\Models\DatareservhomeservModel;
use App\Models\DatauserModel;
use App\Models\HargaModel;
use App\Models\LayananModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class DatareservhomeservController extends BaseController
{
    public function index()
    {
     
 
    

                            $session = session();
                            $session_data = $session->get('pengguna');
                            $data_user = (new DatauserModel())->findAll();
                            $data_registrasi = (new DataregistrasiModel())->findAll();
                            
                            return view('tmplt/pengguna/datareservhsv_view', [
                                'data_user' => $data_user,
                                'data_registrasi' => $data_registrasi,
                                'session_data' => $session_data
                            ]);
    
    
    }
    public function all(){
        $session = session();
        $pengguna = $session->get('pengguna');
        return(new Datatable(DatareservhomeservModel::view()))
                ->setFieldFilter(['tgl_reservasi,nama,alamat,no_hp,nama_bengkel,motor,layanan'])
                ->draw();
    }
    public function show($id){
        $r = (new DatareservhomeservModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $session = session();
        $session_data = $session->get('pengguna');
        $dtu = new DatareservhomeservModel();
     
        $id =  $dtu -> insert([
            'tgl_reservasi' => $this->request->getVar('tgl_reservasi'),
            'data_user_id' => $session_data['id'],
            'no_hp'                 => $this->request->getVar('no_hp'),
            'data_registrasi_id'    => $this->request->getVar('data_registrasi_id'),
            'motor'                 => $this->request->getVar('motor'),
            'layanan_id' => $this->request->getVar('layanan_id'),
     
            'status'                 => $this->request->getVar('status'),
           
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    

public function batal($id)
{
    $dtu = new DatareservhomeservModel();

    if($dtu->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $dtu->update($id,[
        'status' => 4,
    ]);
    
    return $this->response->setJSON(['result'=>$hasil]);
}


    
}
