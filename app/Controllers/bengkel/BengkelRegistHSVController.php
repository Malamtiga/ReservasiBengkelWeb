<?php

namespace App\Controllers\bengkel;

use App\Controllers\BaseController;

use Agoenxz21\Datatables\Datatable;
use App\Models\BengkelregistrasiModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class BengkelRegistHSVController extends BaseController
{
    public function index()
    {
        return view('tmplt/bengkel/dataregisthsv_view');  
    }
    public function all(){
        
        return(new Datatable(BengkelregistrasiModel::view()))
        ->setFieldFilter(['nama','nama_bengkel', 'alamat_bengkel' , 'hp_bengkel', 'status'])
                ->draw();
    }
    public function show($id){
        $r = (new BengkelregistrasiModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $session = session();
        $session_data = $session->get('bengkel');
        $dtu = new BengkelregistrasiModel();
        
      
        
        $status = '2'; // set status default menjadi pending
        if ($this->request->getVar('status')) {
            $status = '1';
        }
    
        $id =  $dtu->insert([
            'data_user_id' => $session_data['id'],
            'nama_bengkel' => $this->request->getVar('nama_bengkel'),
            'alamat_bengkel' => $this->request->getVar('alamat_bengkel'),
            'hp_bengkel' => $this->request->getVar('hp_bengkel'),
            'status' => $status, 
        ]);
        
        return $this->response->setJSON(['id' => $id])
            ->setStatusCode(intval($id) > 0 ? 200 : 406);
    }
    
    
    public function update(){
        $session = session();
        $session_data = $session->get('bengkel');
        $dtu = new BengkelregistrasiModel();
        $id = (int)$this->request->getVar('id');
        
        if($dtu->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $dtu->update($id,[
            'data_user_id' => $session_data['id'],
            'nama_bengkel'        => $this->request->getVar('nama_bengkel'),
            'alamat_bengkel'      => $this->request->getVar('alamat_bengkel'),
            'hp_bengkel'          => $this->request->getVar('hp_bengkel'),
            'status'              => $this->request->getVar('status'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $dtu = new BengkelregistrasiModel();
        $id = $this->request->getVar('id');
        $hasil = $dtu->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
