<?php

namespace App\Controllers\bengkel;

use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\BengkelHSVModel;
use App\Models\BengkelReservasiModel;
use App\Models\DataregistrasiModel;
use App\Models\DatareservasiModel;
use App\Models\DatareservhomeservModel;
use App\Models\DatauserModel;
use App\Models\HargaModel;
use App\Models\LayananModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class BengkelReservhsController extends BaseController
{
    public function index()
    {
 
    return view('tmplt/bengkel/datareservhsv_view',[
        'nama' => (new DatauserModel())->findAll()
        ]);
            return view('tmplt/bengkel/datareservhsv_view',[
                'alamat' => (new DatauserModel())->findAll()
                ]);
                return view('tmplt/bengkel/datareservhsv_view',[
                    'nama_bengkel' => (new DataregistrasiModel())->findAll()
                    ]);
                    return view('tmplt/bengkel/datareservhsv_view',[
                        'layanan' => (new LayananModel())->findAll()
                        ]);
                        
    

  
    
    
    }
    public function all(){
        return(new Datatable(BengkelHSVModel::view()))
                ->setFieldFilter(['tgl_reservasi,nama,alamat,no_hp,nama_bengkel,motor,layanan,harga'])
                ->draw();
    }
    public function show($id){
        $r = (new BengkelHSVModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
   

    public function approve($id)
    {
        $dtu = new DatareservhomeservModel();
    
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
    $dtu = new DatareservhomeservModel();

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
