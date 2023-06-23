
<?=$this->extend('tmplt/admin/template')?>

<?=$this->section('content')?>


<div class="mt-5"></div>
            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">List Reservasi Homeservice</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
       
                <table id='table-datareservhsv' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-dark">No</th>
                            <th class="text-dark">Tanggal Reservasi</th>
                            <th class="text-dark">Data Pelanggan</th>
                       
                            <th class="text-dark">Nama Bengkel</th>
                        
                            <th class="text-dark">Layanan</th>
                            <th class="text-dark">Status</th>
                       
                            <th class="text-dark">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            

            
            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Reservasi Homeservice</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formDatareservhsv" method="post" action="<?=base_url('admin/reservhs') ?>">
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

                                                                            use App\Models\DataregistrasiModel;
                                                                            use App\Models\DatauserModel;
                                                                              
                                                                                use App\Models\LayananModel;

                                        $r = (new DatauserModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama']} {$k['alamat']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Bengkel</label>
                                <select name="data_registrasi_id" class="form-control">
                                <?php

                                                                         

                                        $r = (new DataregistrasiModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama_bengkel']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Motor</label>
                                <input type="text" name="motor" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Layanan</label>
                                <select name="layanan_id" class="form-control">
                                <?php

                                                                                

                                        $r = (new LayananModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['layanan']} {$k['harga']}</option>";
                                        }
                                    ?>
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
        
        
        $('form#formDatareservhsv').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-datareservhsv").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formDatareservhsv').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formDatareservhsv').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-datareservhsv').on('click', '.btn-dark', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/admin/reservhs/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl_reservasi]').val(e.tgl_reservasi);
                $('input[name=data_user_id]').val(e.data_user_id);
                $('input[name=no_hp]').val(e.no_hp);
                $('input[name=data_registrasi_id]').val(e.data_registrasi_id);
                $('input[name=motor]').val(e.motor);
                $('input[name=layanan_id]').val(e.layanan_id);
            
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-datareservhsv').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/admin/reservhs`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-datareservhsv').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-datareservhsv').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('admin/reservhs/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    },
                    className:'text-dark'
                },
                { data: 'tgl_reservasi', render:(data,type,row,meta)=>{
                    return `${data}`;
                },
                className:'text-dark'},
                { data: 'nama', render:(data,type,row,meta)=>{
                    return `${data} ${row['alamat']}`;
                },
                 className:'text-dark'},
                
                { data: 'nama_bengkel', render:(data,type,row,meta)=>{
                    return `${data}`;
                }, className:'text-dark'},
               
                { data: 'layanan', render:(data,type,row,meta)=>{
                    return `${data}`;
                }, className:'text-dark'},
                {data: 'status',
                    render: (data,type,row,meta)=>{
                        if(data === '1'){
                            return 'Pending';
                        }
                        else if(data === '2'){
                            return '<span class="text-success">Reservasi Diterima</span>';
                        }
                            else if(data === '3'){
                            return '<span class="text-danger">Reservasi Ditolak</span>';
                        }
                        else if(data === '4'){
                            return '<span class="text-danger">Reservasi Dibatalkan</span>';
                        }
                        return data;
                    },
                       className: 'text-dark'
                },
               
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class='mr-1 btn btn-dark' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'mt-1 btn btn-danger 'data-id='${data}'> Hapus </button>`;
                        return  btnHapus;
                    }

                },
            ]
        });
    });
</script>
<?=$this->endSection()?>