<?=$this->extend('tmplt/template')?>

<?=$this->section('content')?>



            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Data Registrasi Homeservice</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="float-end btn btn-sm btn-dark" id="btn-tambah">Tambah Data</button>
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
                            <h4 class="modal-title">Data Registrasi Homeservice</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formDataRegisthsv" method="post" action="<?=base_url('registhsv') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
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
                                <select name="status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
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
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formDataRegisthsv').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formDataRegisthsv').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-dataregisthsv').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/registhsv/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_bengkel]').val(e.nama_bengkel);
                $('input[name=alamat_bengkel]').val(e.alamat_bengkel);
                $('input[name=hp_bengkel]').val(e.hp_bengkel);
                $('input[name=status]').val(e.status);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-dataregisthsv').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/registhsv`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-dataregisthsv').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-dataregisthsv').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('registhsv/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'nama_bengkel',},
                {data: 'alamat_bengkel',},
                {data: 'hp_bengkel',},
                {data: 'status',
                    render: (data,type,row,meta)=>{
                        if(data === '1'){
                            return 'Aktif';
                        }
                        else if(data === '2'){
                            return 'Aktif';}

                            else if(data === '3'){
                            return 'Aktif';

                        }
                        return data;
                    }
                },
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class='btn btn-light' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }

                },
            ]
        });
    });
</script>
<?=$this->endSection()?>