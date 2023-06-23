<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\LayananModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class LayananController extends BaseController
{
    public function index()
    {
    return view('tmplt/pengguna/layanan_view');  
    }
    public function all(){
        $dtu = new LayananModel();
        $dtu->select(['id',  'layanan', 'harga']);
        
        return (new Datatable ($dtu))
                ->setFieldFilter([ 'layanan', 'harga'])
                ->draw();
    }
    public function show($id){
        $r = (new LayananModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $dtu = new LayananModel();

        $id =  $dtu -> insert([
            'data_user_id'              => $this->request->getVar('data_user_id'),
            'data_registrasi_id'              => $this->request->getVar('data_registrasi_id'),
            'layanan'              => $this->request->getVar('layanan'),
            'harga'              => $this->request->getVar('harga'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $dtu = new LayananModel();
        $id = (int)$this->request->getVar('id');
        
        if($dtu->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $dtu->update($id,[
            'data_user_id'              => $this->request->getVar('data_user_id'),
            'data_registrasi_id'              => $this->request->getVar('data_registrasi_id'),
            'layanan'              => $this->request->getVar('layanan'),
            'harga'              => $this->request->getVar('harga'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $dtu = new LayananModel();
        $id = $this->request->getVar('id');
        $hasil = $dtu->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
