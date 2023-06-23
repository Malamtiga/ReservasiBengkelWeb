<?php

namespace App\Controllers\pengguna;

use App\Controllers\BaseController;
use App\Models\DataregistrasiModel;
use Agoenxz21\Datatables\Datatable;
use CodeIgniter\Exceptions\PageNotFoundException;
class DataregistrasihsvController extends BaseController
{
    public function index()
    {
        return view('tmplt/pengguna/dataregisthsv_view');  
    }
    public function all(){
        $dtu = new DataregistrasiModel();
        $dtu->select(['id', 'nama_bengkel', 'alamat_bengkel', 'hp_bengkel', 'status'])
        ->where('status',2);
        
        return (new Datatable ($dtu))
                ->setFieldFilter(['nama_bengkel', 'alamat_bengkel' , 'hp_bengkel', 'status'])
                ->draw();
    }
    public function show($id){
        $r = (new DataregistrasiModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
}
