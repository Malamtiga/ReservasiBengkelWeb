<?=$this->extend('tmplt/bengkel/template')?>

<?=$this->section('content')?>

<div class="mt-5"></div>


            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Layanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <table id='table-layanan' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                        

                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Layanan</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formLayanan" method="post" action="<?=base_url('bengkel/layanan') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3"  >
                                <label class="form-label">Pemilik Bengkel</label>
                                <select name="nama" class="form-control">
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
                            <div class="mb-3" >
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
                            <button class="btn btn-success" id="btn-menambahkan" >Menambahkan</button>
                        </div>
                    </div>
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
    $(document).ready(function(){
          
// Simpan data bengkel yang valid dalam variabel terpisah
$('table#table-layanan').on('click', 'tr', function () {
    var table = $('table#table-layanan').DataTable();
    var data = table.row(this).data();
    var nama_bengkel = data.nama_bengkel;
    var data_registrasi_id = data.id;

    // Simpan data bengkel yang valid dalam variabel
    validBengkelData = {
        id: data_registrasi_id,
        nama: nama_bengkel
    };
  
    $('select[name=data_registrasi_id]').empty().append('<option value="' + data_registrasi_id + '">' + nama_bengkel + '</option>').trigger('change');
    $('input[name=nama_bengkel]').val(nama_bengkel);
});



        
        $('form#formLayanan').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-layanan").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formLayanan').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formLayanan').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-layanan').on('click', '.btn-dark', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/bengkel/layanan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama]').val(e.nama);
                $('input[name=data_registrasi_id]').val(e.data_registrasi_id);
                $('input[name=layanan]').val(e.layanan);
                $('input[name=harga]').val(e.harga);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-layanan').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}bengkel/layanan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-layanan').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-layanan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('bengkel/layanan/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    },className :"text-dark"
                },
                {data: 'layanan',className :"text-dark"},
                {data: 'harga',className :"text-dark"},
                {data: 'id',
                    render: (data,type,meta,row)=>{
      
                        var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'> Hapus </button>`;
                        return  btnHapus;
                    },className :"text-dark"

                },
            ]
        });
    });
</script>
<?=$this->endSection()?>