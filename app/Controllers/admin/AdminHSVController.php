<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\DataregistrasiModel;
use Agoenxz21\Datatables\Datatable;
use App\Models\BengkelregistrasiModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class AdminHSVController extends BaseController
{
    public function index()
    {
        return view('tmplt/admin/dataregisthsv_view');  
    }
    public function all(){
        $dtu = new DataregistrasiModel();
        $dtu->select(['id', 'nama_bengkel', 'alamat_bengkel', 'hp_bengkel', 'status']);
        
        return (new DataTable ($dtu))
                ->setFieldFilter(['nama_bengkel', 'alamat_bengkel' , 'hp_bengkel', 'status'])
                ->draw();
    }
    public function show($id){
        $r = (new DataregistrasiModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
   
    public function approve($id)
    {
        $dtu = new BengkelregistrasiModel();
    
        if($dtu->find($id) == null)
            throw PageNotFoundException::forPageNotFound();
    
        $hasil = $dtu->update($id,[
            'status' => 2,
        ]);
        
        return $this->response->setJSON(['result'=>$hasil]);
    }
    
    public function reject($id)
    {
        $dtu = new BengkelregistrasiModel();
    
        if($dtu->find($id) == null)
            throw PageNotFoundException::forPageNotFound();
    
        $hasil = $dtu->update($id,[
            'status' => 3,
        ]);
        
        return $this->response->setJSON(['result'=>$hasil]);
    }
    
}
