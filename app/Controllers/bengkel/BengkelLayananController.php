<?php

namespace App\Controllers\bengkel;

use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\BengkelLayananModel;
use App\Models\BengkelregistrasiModel;
use App\Models\LayananModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BengkelLayananController extends BaseController
{
    public function index()
    {
    return view('tmplt/bengkel/layanan_view');  
    }
    public function all(){
        
        return(new Datatable(BengkelLayananModel::view()))
        ->setFieldFilter(['layanan','harga'])
                ->draw();
    }
    public function show($id){
        $r = (new BengkelLayananModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store()
    {
        $session = session();
        $session_data = $session->get('bengkel');
    
        $dtu = new BengkelLayananModel();
        $bengkelRegistrasiModel = new BengkelregistrasiModel();
    
        // Memeriksa apakah data_registrasi_id terkait dengan bengkel yang sesuai
        $bengkelRegistrasi = $bengkelRegistrasiModel->find($this->request->getVar('data_registrasi_id'));
        if (!$bengkelRegistrasi || $bengkelRegistrasi['data_user_id'] !== $session_data['id']) {
            return $this->response->setStatusCode(406)->setJSON(['error' => 'Invalid data_registrasi_id']);
        }
    
        $id =  $dtu->insert([
            'data_user_id' => $session_data['id'],
            'data_registrasi_id' => $this->request->getVar('data_registrasi_id'),
            'layanan' => $this->request->getVar('layanan'),
            'harga' => $this->request->getVar('harga'),
        ]);
    
        return $this->response->setJSON(['id' => $id])
            ->setStatusCode(intval($id) > 0 ? 200 : 406);
    }
    

   
    public function delete(){
        $dtu = new BengkelLayananModel();
        $id = $this->request->getVar('id');
        $hasil = $dtu->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
