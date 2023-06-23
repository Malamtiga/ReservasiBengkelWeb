<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DatauserModel;
use Agoenxz21\Datatables\Datatable;
use App\Database\Migrations\Datauser;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\services;
class DatauserController extends BaseController
{
    public function register()
{
    $validation =  \Config\Services::validation();
    $validationRules = [
        'nama' => [
            'label' => 'Nama',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} tidak boleh kosong.'
            ]
        ],
        'username' => [
            'label' => 'Username',
            'rules' => 'required|is_unique[data_user.username]',
            'errors' => [
                'required' => '{field} tidak boleh kosong.',
                'is_unique' => '{field} sudah terdaftar.',
            ]
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required|min_length[6]',
            'errors' => [

                'required' => '{field} harus diisi.',
                'min_length' => '{field} Minimal {param} Karakter.'
            ]
        ],
        'level' => [
            'label' => 'Level',
            'rules' => 'required',    
            'errors' => [
                'required' => 'Silahkan pilih {field} anda.'
            ]    
        ],
        'alamat' => [
            'label' => 'Alamat',
            'rules' => 'required',
            'errors' => [
                'required' => 'Silahkan Isi {field} Anda.'
            ]    
        ]
    ];

    $validation->setRules($validationRules);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $dtu = new DatauserModel();
    $password = $this->request->getPost('password');

    $dtu->insert([
        'nama' => $this->request->getVar('nama'),
        'username' => $this->request->getVar('username'),
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'level' => $this->request->getVar('level'),
        'alamat' => $this->request->getVar('alamat'),
    ]);

    return redirect()->to('login')->with('success', 'Registrasi akun berhasil. Silakan login untuk melanjutkan.');
}
    public function viewRegister(){
        return view('tmplt/registerakun');
}

public function login() {
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $level = $this->request->getPost('level');
    
   
    $user = (new DatauserModel())->where('username', $username)->first();
    
    if (!$user) {
        return $this->response->setJSON(['message' => 'Username tidak terdaftar'])->setStatusCode(404);
    }
    
    $isPasswordMatched = password_verify($password, $user['password']);
    if (!$isPasswordMatched) {
        return $this->response->setJSON(['message' => 'Username dan Password tidak cocok'])->setStatusCode(403);
    }
    
    if ($user['level'] == 'Pengguna' && $level == 'pengguna') {
        $this->session->set('pengguna', $user);
        return $this->response->setJSON(['message' => "Selamat datang {$user['username']} sebagai Pengguna"])->setStatusCode(200);
    }
    else if ($user['level'] == 'Bengkel' && $level == 'bengkel') {
        $this->session->set('bengkel', $user);
        return $this->response->setJSON(['message' => "Selamat datang {$user['username']} sebagai Bengkel"])->setStatusCode(200);
    }
    else if ($user['level'] == 'Admin' && $level == 'admin') {
        $this->session->set('admin', $user);
        return $this->response->setJSON(['message' => "Selamat datang {$user['username']} sebagai Admin"])->setStatusCode(200);
    }
    else {
        return $this->response->setJSON(['message' => 'Silahkan pilih role sesuai dengan data saat melakukan registrasi!'])->setStatusCode(403);
    }
}




    public function viewLogin(){
        return view('tmplt/login');
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('/login');
    }
    
    public function index()
    {
        return view('tmplt/datauser_view');
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
        $password = $this->request->getPost('password');

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
        $password = $this->request->getPost('password');
        
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
