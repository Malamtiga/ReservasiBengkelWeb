<?=$this->extend('tmplt/admin/template')?>

<?=$this->section('content')?>


<div class="mt-5"></div>
            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Data User</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="float-end btn btn-sm btn-dark" id="btn-tambah">Tambah Data</button>
                <table id='table-datauser' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-dark">No</th>
                            <th class="text-dark">Nama</th>
                            <th class="text-dark">Username</th>
                            <th class="text-dark">Level</th>
                            <th class="text-dark">Alamat</th>
                            <th class="text-dark">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Data User</h4>
                            <button class="close text-dark" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formDatauser" method="post" action="<?=base_url('admin/datauser') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label text-dark">Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark">Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark">Level</label>
                                <select name="level" class="form-control">
                                    <option value="pengguna">Pengguna</option>
                                    <option value="bengkel">Bengkel</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark">Alamat</label>
                                <input type="text" name="alamat" class="form-control">
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
        
        
        $('form#formDatauser').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-datauser").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formDatauser').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formDatauser').trigger('reset');
   
        });

   
        $('table#table-datauser').on('click', '.btn-dark', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/admin/datauser/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama]').val(e.nama);
                $('input[name=username]').val(e.username);
                $('input[name=password]').val(e.password);
                $('input[name=level]').val(e.level);
                $('input[name=alamat]').val(e.alamat);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-datauser').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/admin/datauser/`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-datauser').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-datauser').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('admin/datauser/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    },
                    className: 'text-dark'
                },
                {data: 'nama',
                    className: 'text-dark'},
                {data: 'username',
                    className: 'text-dark'},
       
                {data: 'level',
                    render: (data,type,row,meta)=>{
                        if(data === 'pengguna'){
                            return 'Pengguna';
                        }
                        else if(data === 'bengkel'){
                            return 'Bengkel';
                        }
                        else if(data === 'admin'){
                            return 'Admin';
                        }
                        return data;
                    },
                    className: 'text-dark'
                },
                {data: 'alamat',
                    className: 'text-dark'},
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class= 'mr-1 btn btn-dark' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }

                },
            ]
        });
    });
</script>
<?=$this->endSection()?>