<?php

namespace App\Controllers\bengkel;

use App\Controllers\BaseController;

use Agoenxz21\Datatables\Datatable;
use App\Models\BengkelReservasiModel;
use App\Models\DataregistrasiModel;
use App\Models\DatareservasiModel;
use App\Models\DatauserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class BengkelReservasiController extends BaseController
{
    public function index()
    {
    return view('tmplt/bengkel/datareservasi_view',[
        'nama' => (new DatauserModel())->findAll()
        ]);
        return view('tmplt/bengkel/datareservasi_view',[
            'username' => (new DatauserModel())->findAll()
            ]);
            return view('tmplt/bengkel/datareservasi_view',[
                'level' => (new DatauserModel())->findAll()
                ]);
                return view('tmplt/bengkel/datareservasi_view',[
                    'alamat' => (new DatauserModel())->findAll()
                    ]);
                    return view('tmplt/bengkel/datareservasi_view',[
                        'nama_bengkel' => (new DataregistrasiModel())->findAll()
                        ]);
        
    }
    public function all(){
        $session = session();
        $bengkel = $session->get('bengkel');
        return(new Datatable(BengkelReservasiModel::view()))
                ->setFieldFilter(['tgl_reservasi','nama','username','level','alamat',
                'nama_bengkel'
                ])
                ->draw();
    }
    public function show($id){
        $r = (new BengkelReservasiModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
  
    public function approve($id)
    {
        $dtu = new DatareservasiModel();
    
        $reservasi = $dtu->find($id);
        if ($reservasi === null) {
            throw PageNotFoundException::forPageNotFound();
        }
    
        // Cek apakah status reservasi sudah dibatalkan
        if ($reservasi['status'] === '4') {
            return $this->response->setJSON(['result' => 'Reservasi sudah dibatalkan dan tidak dapat diubah.']);
        }
    
        $hasil = $dtu->update($id, [
            'status' => 2,
        ]);
    
        return $this->response->setJSON(['result' => $hasil]);
    }
    
    public function reject($id)
    {
        $dtu = new DatareservasiModel();
    
        $reservasi = $dtu->find($id);
        if ($reservasi === null) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($reservasi['status'] === '4') {
            return $this->response->setJSON(['result' => 'Reservasi sudah dibatalkan dan tidak dapat diubah.']);
        }
        $hasil = $dtu->update($id,[
            'status' => 3,
        ]);
        
        return $this->response->setJSON(['result'=>$hasil]);
    }
}
