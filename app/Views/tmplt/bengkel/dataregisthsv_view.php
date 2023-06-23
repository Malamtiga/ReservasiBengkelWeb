<?=$this->extend('tmplt/bengkel/template')?>

<?=$this->section('content')?>

<div class="mt-5"></div>


            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Data Registrasi Bengkel</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="mr-5 float-end btn btn-sm btn-dark" id="btn-tambah"  >Daftarkan Bengkel Anda</button>
                <button class="float-end btn btn-sm btn-success"  id="btn-listlyn" onclick="location.href='layanan'"
                >Lihat Daftar Layanan Bengkel Anda</button>
                <table id='table-dataregisthsv' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bengkel</th>
                            <th>Alamat Bengkel</th>
                            <th>NO HP Bengkel</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Registrasi Bengkel</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formDataRegisthsv" method="post" action="<?=base_url('bengkel/registhsv') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Pemilik Bengkel</label>
                                <select name="data_user_id" class="form-control" >
                                <?php

                                                                                use App\Models\DataregistrasiModel;
                                                                                use App\Models\DatauserModel;

                                                                                $session = session();
                                                                                $session_data = $session->get('bengkel');
                                        $r = (new DatauserModel())->findAll();
                                      
                                        foreach($r as $k)
                                        if ($k['id'] == $session_data['id']){
                                            echo "<option value='{$k['id']}'>{$k['nama']} </option>";

                                        }
                                    ?>

                                    
                                                                        
                                                                        
                                                                        
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Bengkel</label>
                                <input type="text" name="nama_bengkel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Bengkel</label>
                                <input type="text" name="alamat_bengkel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Hp Bengkel</label>
                                <input type="text" name="hp_bengkel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control" disabled>
                                    <option value="1" selected>Pending</option>
                                    <option value="2">Approved</option>
                                </select>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-menambahkan" >Menambahkan</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>


            <div id="layananForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Daftar Layanan</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>

                        <div class="modal-body">
                            <form id="formLayanan" method="post" action="<?=base_url('bengkel/layanan') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />

                            <div class="mb-3">
                                <label class="form-label">Pemilik Bengkel</label>
                                <select name="data_user_id" class="form-control" >
                                <?php

                                                                   

                                            $session = session();
                                    $session_data = $session->get('bengkel');
                                        $r = (new DatauserModel())->findAll();
                                      
                                        foreach($r as $k)
                                        if ($k['id'] == $session_data['id']){
                                            echo "<option value='{$k['id']}'>{$k['nama']} </option>";

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
                                <input type="text" name="layanan" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="text" name="harga" class="form-control">
                            </div>

                            </form>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-lyanan" >Menambahkan</button>
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
    $(document).ready(function(){

           
        $('table#table-dataregisthsv').on('click', 'tr', function () {
    var table = $('table#table-dataregisthsv').DataTable();
    var data = table.row(this).data();
    var nama_bengkel = data.nama_bengkel;
    var data_registrasi_id = data.id;

    $('select[name=data_registrasi_id]').val(data_registrasi_id).trigger('change');
    $('input[name=nama_bengkel]').val(nama_bengkel);

    // Menghapus opsi bengkel lainnya dari dropdown
    $('select[name=data_registrasi_id] option').not('[value="' + data_registrasi_id + '"]').remove();
});


$(document).ready(function () {
    var selectedBengkel = $('select[name=data_registrasi_id] option:selected').text();
    $('input[name=nama_bengkel]').val(selectedBengkel);
});


$('select[name=data_registrasi_id]').on('change', function () {
    var selectedBengkel = $('select[name=data_registrasi_id] option:selected').text();
    $('input[name=nama_bengkel]').val(selectedBengkel);
});

        
        
        $('form#formDataRegisthsv').submitAjax({
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
            alert('Maaf data Salah/Data Sudah Ada!');
        }

        });
        $('button#btn-menambahkan').on('click' , function(){
            $('form#formDataRegisthsv').submit();
        

        });
/**batas */

      

        $('form#formLayanan').submitAjax({
        pre:()=>{
            $('button#btn-lyanan').hide();
            
        },
        pasca:()=>{
            $('button#btn-lyanan').show();

        },

        success:(response, status)=>{
            $("#layananForm").modal('hide');
            $("table#table-dataregisthsv").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-lyanan').on('click' , function(){
            $('form#formLayanan').submit();

        });


        


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formDataRegisthsv').trigger('reset');
          
        });

        $('table#table-dataregisthsv').on('click', '.btn-edit', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/bengkel/registhsv/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_bengkel]').val(e.nama_bengkel);
                $('input[name=alamat_bengkel]').val(e.alamat_bengkel);
                $('input[name=hp_bengkel]').val(e.hp_bengkel);
                $('input[name=status]').val(e.status);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-dataregisthsv').on('click', '.btn-lyn', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pengguna/registhsv/${id}`).done((e)=>{
            $('#layananForm').modal('show');

         
        
            });
        });

        $('table#table-dataregisthsv').on('click', '.btn-hapus', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/bengkel/registhsv`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-dataregisthsv').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-dataregisthsv').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('bengkel/registhsv/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }, className: 'text-dark'
                },
               
                {data: 'nama_bengkel', className: 'text-dark'},
                {data: 'alamat_bengkel', className: 'text-dark'},
                {data: 'hp_bengkel', className: 'text-dark'},
                {data: 'status',
                    render: (data,type,row,meta)=>{
                        if(data === '1'){
                            return 'Pending';
                        }
                        else if(data === '2'){
                            return '<span class="text-success">Diterima</span>';}
                        return data;
                    }, className: 'text-dark'
                },
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class='mr-2 btn btn-edit btn-dark' data-id='${data}'> Edit Data</button>`;
                        var btnHapus    = `<button class = 'mr-2 btn btn-hapus btn-danger 'data-id='${data}'> Hapus </button>`;
                        var btnLyn    = `<button class = 'btn-lyn btn btn-success 'data-id='${data}'> Daftarkan Layanan Bengkel </button>`;
                        return btnEdit + btnHapus + btnLyn;
                    }, className: 'text-dark'

                },
            ]
        });
    });
</script>
<?=$this->endSection()?>