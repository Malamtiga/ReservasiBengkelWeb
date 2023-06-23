<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\AdminHSVModel;
use App\Models\DataregistrasiModel;
use App\Models\DatareservasiModel;
use App\Models\DatareservhomeservModel;
use App\Models\DatauserModel;
use App\Models\HargaModel;
use App\Models\LayananModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class AdminReservhsController extends BaseController
{
    public function index()
    {
   
    return view('tmplt/admin/datareservhsv_view',[
        'nama' => (new DatauserModel())->findAll()
        ]);
            return view('tmplt/admin/datareservhsv_view',[
                'alamat' => (new DatauserModel())->findAll()
                ]);
                return view('tmplt/admin/datareservhsv_view',[
                    'nama_bengkel' => (new DataregistrasiModel())->findAll()
                    ]);
                    return view('tmplt/admin/datareservhsv_view',[
                        'layanan' => (new LayananModel())->findAll()
                        ]);
                  

  
    
    
    }
    public function all(){
        return(new Datatable(AdminHSVModel::view()))
                ->setFieldFilter(['tgl_reservasi,nama,,alamat,no_hp,nama_bengkel,motor,layanan'])
                ->draw();
    }
    public function show($id){
        $r = (new AdminHSVModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
   
    public function delete(){
        $dtu = new AdminHSVModel();
        $id = $this->request->getVar('id');
        $hasil = $dtu->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
