<?=$this->extend('tmplt/pengguna/template')?>

<?=$this->section('content')?>

<div class="mb-5"></div>

            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">List Bengkel</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
                <table id='table-dataregisthsv' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-dark">No</th>
                            <th class="text-dark">Nama Bengkel</th>
                            <th class="text-dark">Alamat Bengkel</th>
                            <th class="text-dark">NO HP Bengkel</th>
                          
                            <th class="text-center text-dark">Pilih Jenis Layanan</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Reservasi</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
						<form id="formReservasi" method="post" action="<?=base_url('pengguna/datareservasi') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Tanggal Reservasi</label>
                                <input type="date" name="tgl_reservasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data Pelanggan</label>
                                <select name="data_user_id" class="form-control">
                                <?php

                                                                        use App\Models\BengkelLayananModel;
                                                                        use App\Models\DataregistrasiModel;
                                                                        use App\Models\DatareservasiModel;
                                                                        use App\Models\DatauserModel;
                                                                        use App\Models\LayananModel;

                                                                            $session = session();
                                                                            $session_data = $session->get('pengguna');
                                                                            $r = (new DatauserModel())->findAll();
                                                                            
                                                                            foreach($r as $k){
                                                                              if ($k['id'] == $session_data['id']) {
                                                                                echo "<option value='{$k['id']}' selected>{$k['username']} {$k['nama']} {$k['level']} {$k['alamat']}</option>";
                                                                              } 
                                                                            }
                                                                            ?>
                                </select>
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-label">Nama Bengkel</label>
                                <select name="data_registrasi_id" class="form-control" >
                                <?php

                                        $r = (new DataregistrasiModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama_bengkel']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
    <label class="form-label">Layanan</label>
    
    <select multiple name="layanan_id" class="form-control"  id="layanan" >
        
    <?php
    


    $layanan = (new LayananModel())
        ->select('layanan.id, layanan.layanan, layanan.harga, data_registrasi.nama_bengkel')
        ->join('data_registrasi', 'layanan.data_registrasi_id = data_registrasi.id')
       
        ->findAll();
    foreach($layanan as $k){
      
        echo "<option value='{$k['id']}' >{$k['nama_bengkel']} - {$k['layanan']} {$k['harga']}</option>";
    }
?>
    </select>
</div>

                            <div class="mb-3" style="display: none;">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control" disabled>
                                    <option value="1" selected>Menunggu Konfirmasi Pihak Bengkel</option>
                                    <option value="2">Diterima</option>
                                </select>
                            </div>
                            
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-menambahkan" >Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>

			


            <div id="modalhs" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Reservasi Homeservice</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formReservHome" method="post" action="<?=base_url('pengguna/reservasihsv') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_metod" />
                            <div class="mb-3">
                                <label class="form-label">Tanggal Reservasi</label>
                                <input type="date" name="tgl_reservasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data Pelanggan</label>
                                <select name="data_user_id" class="form-control" >
                                <?php

                                                                           
                                                                              
                                                                            

                                                                                $session = session();
                                                                                $session_data = $session->get('pengguna');
                                        $r = (new DatauserModel())->findAll();
                                      
                                        foreach($r as $k)
                                        if ($k['id'] == $session_data['id']){
                                            echo "<option value='{$k['id']}'>{$k['nama']} {$k['alamat']}</option>";

                                        }
                                    ?>

                                    
                                         
                                                                        
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control" placeholder="Isi NO HP">
                            </div>
                            <div class="mb-3">
    <label class="form-label">Nama Bengkel</label>
    <select name="data_registrasi_id" class="form-control"  id="nama-bengkel">
    <?php
    $data_registrasi = (new DataregistrasiModel())->findAll();
        $r = (new DataregistrasiModel())->findAll();
        foreach($r as $k){
            $selected = ($k['id'] == $data_registrasi) ? "selected" : "";
            echo "<option value='{$k['id']}' $selected>{$k['nama_bengkel']}</option>";
        }
    ?>
    </select>
</div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Kendala Motor dan Jenis Motor</label>
                                <textarea type="text" name="motor" class="form-control" aria-placeholder="Isikan Informasi
                                motor anda dan kendalanya" >

                                </textarea>
                            </div>
                            <div class="mb-3">
    <label class="form-label">Layanan</label>
    
    <select multiple name="layanan_id" class="form-control"  id="layanan" >
        
    <?php
    


    $layanan = (new LayananModel())
        ->select('layanan.id, layanan.layanan, layanan.harga, data_registrasi.nama_bengkel')
        ->join('data_registrasi', 'layanan.data_registrasi_id = data_registrasi.id')
       
        ->findAll();
    foreach($layanan as $k){
      
        echo "<option value='{$k['id']}' >{$k['nama_bengkel']} - {$k['layanan']} {$k['harga']}</option>";
    }
?>
    </select>
</div>

<div class="mb-3" style="display: none;">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control" disabled>
                                    <option value="1" selected>Menunggu Konfirmasi Pihak Bengkel</option>
                                    <option value="2">Diterima</option>
                                </select>
                            </div>

                     
                        </form>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-hs" >Pesan</button>
                        </div>
                        </div>
                </div>
            </div>
            </div>
  
        

            <?=$this->endSection()?>


            <?=$this->section('script')?>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
            ></script>
            <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> 
            <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>



            
<script>
    
// Simpan data bengkel yang valid dalam variabel terpisah
$('table#table-dataregisthsv').on('click', 'tr', function () {
    var table = $('table#table-dataregisthsv').DataTable();
    var data = table.row(this).data();
    var nama_bengkel = data.nama_bengkel;
    var data_registrasi_id = data.id;

    // Simpan data bengkel yang valid dalam variabel
    validBengkelData = {
        id: data_registrasi_id,
        nama: nama_bengkel
    };
    $('select[name=layanan_id]').empty();
    filterLayananByBengkel(nama_bengkel);
    $('select[name=data_registrasi_id]').empty().append('<option value="' + data_registrasi_id + '">' + nama_bengkel + '</option>').trigger('change');
    $('input[name=nama_bengkel]').val(nama_bengkel);
});

function filterLayananByBengkel(nama_bengkel) {
    var layananData = <?php echo json_encode($layanan); ?>;
    var dropdown = $('select[name=layanan_id]');
    
    for (var i = 0; i < layananData.length; i++) {
        var layanan = layananData[i];
        if (layanan.nama_bengkel === nama_bengkel) {
            dropdown.append('<option value="' + layanan.id + '">' + layanan.layanan + ' ' + layanan.harga + '</option>');
        }
    }
}









//batasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss

//batasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss




    
    $(document).ready(function(){
        
        
        $('form#formReservasi').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-dataregisthsv").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });

          
        $('form#formReservHome').submitAjax({
        pre:()=>{
            $('button#btn-hs').hide();
            
        },
        pasca:()=>{
            $('button#btn-hs').show();

        },

        success:(response, status)=>{
            $("#modalhs").modal('hide');
            $("table#table-dataregisthsv").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formReservasi').submit();

        });

        $('button#btn-hs').on('click' , function(){
            $('form#formReservHome').submit();

        });


        $('table#table-dataregisthsv').on('click', '.btn-reservasi', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pengguna/registhsv/${id}`).done((e)=>{
            $('#modalForm').modal('show');
         
            });
        });

        $('table#table-dataregisthsv').on('click', '.btn-reservhs', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pengguna/registhsv/${id}`).done((e)=>{
            $('#modalhs').modal('show');
            $('input[name=_metod]').val('');
            });
        });

        

        $('table#table-dataregisthsv').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pengguna/registhsv/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    },
                    className : "text-dark"
                },
                {data: 'nama_bengkel',
                    className : "text-dark"},
                {data: 'alamat_bengkel',
                    className : "text-dark"},
                {data: 'hp_bengkel',
                    className : "text-dark"},
               
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnRB     = `<button class='btn btn-reservasi mr-5 btn-dark' data-id='${data}'> Reservasi Bengkel</button>`;
                        var btnRHS    = `<button class = 'btn btn-reservhs btn-dark 'data-id='${data}'> Reservasi Home Service </button>`;
                        return btnRB + btnRHS;
                    }

                },
            ]
        });
    });
</script>
<?=$this->endSection()?>