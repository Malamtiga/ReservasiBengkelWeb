<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\DatauserModel;
use Agoenxz21\Datatables\Datatable;
use App\Database\Migrations\Datauser;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\services;
class AdminUserController extends BaseController
{
 
    public function index()
    {
        return view('tmplt/admin/datauser_view');
    }
    
    public function all(){
        $dtu = new DatauserModel();
        $dtu->select(['id', 'nama', 'username', 'password', 'level', 'alamat']);
        
        return (new DataTable ($dtu))
                ->setFieldFilter(['nama', 'username' , 'password', 'level', 'alamat'])
                ->draw();
    }
    public function show($id){
        $r = (new DatauserModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $dtu = new DatauserModel();
        $password = $this->request->getVar('password');

        $id =  $dtu -> insert([
            'nama'              => $this->request->getVar('nama'),
            'username'          => $this->request->getVar('username'),
            'password'          => password_hash($password, PASSWORD_BCRYPT),
            'level'             => $this->request->getVar('level'),
            'alamat'            => $this->request->getVar('alamat'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $dtu = new DatauserModel();
        $id = (int)$this->request->getVar('id');
        $password = $this->request->getVar('password');
        
        if($dtu->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $dtu->update($id,[
            'nama'              => $this->request->getVar('nama'),
            'username'          => $this->request->getVar('username'),
            'password'          => password_hash($password, PASSWORD_BCRYPT),
            'level'             => $this->request->getVar('level'),
            'alamat'            => $this->request->getVar('alamat'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $dtu = new DatauserModel();
        $id = $this->request->getVar('id');
        $hasil = $dtu->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
