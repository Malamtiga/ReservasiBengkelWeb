<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\AdminReservasiModel;
use App\Models\DataregistrasiModel;
use App\Models\DatareservasiModel;
use App\Models\DatareservhomeservModel;
use App\Models\DatauserModel;
use App\Models\HargaModel;
use App\Models\LayananModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class AdminReservasiController extends BaseController
{
    public function index()
    {
   
    return view('tmplt/admin/datareservasi_view',[
        'nama' => (new DatauserModel())->findAll()
        ]);
            return view('tmplt/admin/datareservasi_view',[
                'alamat' => (new DatauserModel())->findAll()
                ]);
                return view('tmplt/admin/datareservasi_view',[
                    'nama_bengkel' => (new DataregistrasiModel())->findAll()
                    ]);
                    return view('tmplt/admin/datareservasi_view',[
                        'layanan' => (new LayananModel())->findAll()
                        ]);
                  

  
    
    
    }
    public function all(){
        return(new Datatable(AdminReservasiModel::view()))
        ->setFieldFilter(['id','tgl_reservasi','username' ,'nama',  'level', 'alamat', 'nama_bengkel', 'layanan', 'harga', 'status'])
                ->draw();
    }
    public function show($id){
        $r = (new AdminReservasiModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
   
    public function delete(){
        $dtu = new AdminReservasiModel();
        $id = $this->request->getVar('id');
        $hasil = $dtu->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
