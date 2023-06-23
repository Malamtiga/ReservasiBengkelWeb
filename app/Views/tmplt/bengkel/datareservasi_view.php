<?=$this->extend('tmplt/bengkel/template')?>

<?=$this->section('content')?>

<div class="mt-5"></div>


            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Data Reservasi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <table id='table-datareservasi' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Reservasi</th>
                            <th>Data Pelanggan</th>
                       
                            <th>Layanan</th>
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
                            <h4 class="modal-title">Data Reservasi</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formDatauser" method="post" action="<?=base_url('bengkel/datareservasi') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Tanggal Reservasi</label>
                                <input type="date" name="tgl_reservasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">USERNAME NAMA LEVEL ALAMAT</label>
                                <select name="data_user_id" class="form-control" >
                                <?php

                                                                            use App\Models\DataregistrasiModel;
                                                                            use App\Models\DatauserModel;


                                        $r = (new DatauserModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['username']} {$k['nama']} {$k['level']} {$k['alamat']}</option>";
                                        }
                                    ?>
                                </select>
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

$('table#table-datareservasi').on('click', '.btn-success', function (){
    let id = $(this).data('id');
    let baseurl = "<?=base_url()?>";
    $.ajax({
        url: `${baseurl}/bengkel/datareservasi/${id}`,
        type: 'PATCH',
        success: function(data){
            // Jika sukses, update label status pada tabel
            $(`#status_${id}`).text('Approved');
            // Tampilkan pesan sukses
            alert('Status updated successfully');
            $("table#table-datareservasi").DataTable().ajax.reload();
        },
        error: function(xhr,status,error){
            // Jika gagal, tampilkan pesan error
            alert('Status update failed');
        }
    });
});

$('table#table-datareservasi').on('click', '.btn-danger', function (){
    let id = $(this).data('id');
    let baseurl = "<?=base_url()?>";
    $.ajax({
        url: `${baseurl}/bengkel/datareservasi/${id}`,
        type: 'GET',
        success: function(data){
            // Jika sukses, update label status pada tabel
            $(`#status_${id}`).text('Rejected');
            // Tampilkan pesan sukses
            alert('Status updated successfully');
            $("table#table-datareservasi").DataTable().ajax.reload();
        },
        error: function(xhr,status,error){
            // Jika gagal, tampilkan pesan error
            alert('Status update failed');
            $("table#table-datareservasi").DataTable().ajax.reload();
        }
    });
});
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
            $("table#table-datareservasi").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formDatauser').submit();

        });


    
    


        $('table#table-datareservasi').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('bengkel/datareservasi/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }, className: 'text-dark'
                },
                {data: 'tgl_reservasi', className: 'text-dark'},
                { data: 'username', render:(data,type,row,meta)=>{
                    return `${data} ${row['nama']} ${row['level']} ${row['alamat']}`;
                }, className: 'text-dark'},
          
                { data: 'layanan', render:(data,type,row,meta)=>{
                    return `${data} ${row['harga']} `;
                }, className: 'text-dark'},
                {data: 'status',
                    render: (data,type,row,meta)=>{
                        if(data === '1'){
                            return '<span class="text-dark">Menunggu Konfirmasi</span>';
                        }
                        else if(data === '2'){
                            return '<span class="text-success">Reservasi Diterima</span>';}

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
               
                     var btnAPP     = `<button class='mr-1 btn btn-success' data-id='${data}'>Terima</button>`;
                     var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'>Tolak</button>`;
                     return btnAPP + btnHapus;
                        return btnEdit + btnHapus;
                    }, className: 'text-dark'

                },
            ]
        });
    });
</script>
<?=$this->endSection()?>