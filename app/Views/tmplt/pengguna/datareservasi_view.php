<?=$this->extend('tmplt/pengguna/template')?>

<?=$this->section('content')?>



<div class="mb-5"></div>
            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Reservasi Saya</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <table id='table-datareservasi'  class="datatable table table-bordered " >
                    <thead>
                        <tr>
                            <th class="text-dark">No</th>
                            <th class="text-dark">Tanggal Reservasi</th>
                            <th class="text-dark">Nama Bengkel</th>
                            <th class="text-dark">Layanan</th>
                            <th class="text-dark">Status</th>
    
                            <th>Aksi</th>
             
                        </tr>
                    </thead>
                </table>
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
    $('table#table-datareservasi').on('click', '.btn-danger', function (){
    let id = $(this).data('id');
    let baseurl = "<?=base_url()?>";
    $.ajax({
        url: `${baseurl}/pengguna/datareservasi/${id}`,
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
    
    $('#table-datareservasi').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('pengguna/datareservasi/all')?>",
            method: 'GET'
        },
        columns:[
            {data: 'id',sortable:false, searchable:false,
                render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                },  className : "text-dark"
            },
            { data: 'tgl_reservasi', render:(data,type,row,meta)=>{
                    return `${data}`;
                },  className : "text-dark"},
                
              
                { data: 'nama_bengkel', render:(data,type,row,meta)=>{
                    return `${data}`;
                },  className : "text-dark"},
                { data: 'layanan', render:(data,type,row,meta)=>{
                    return `${data} ${row['harga']}`  ;
                },  className : "text-dark"},
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
                     var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'>Batalkan Reservasi</button>`;
                     return  btnHapus;
       
                    },
                    className : "text-dark"

                },
        ]
    });
});


</script>
<?=$this->endSection()?>