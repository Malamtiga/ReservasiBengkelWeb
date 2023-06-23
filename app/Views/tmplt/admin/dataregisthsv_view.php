<?=$this->extend('tmplt/admin/template')?>

<?=$this->section('content')?>

<div class="mt-5"></div>

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
                            <h4 class="modal-title text-dark">List Bengkel</h4>
                            <button class="close text-dark" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formDataRegisthsv" method="post" action="<?=base_url('admin/registhsv') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label text-dark">Nama Bengkel</label>
                                <input type="text" name="nama_bengkel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark">Alamat Bengkel</label>
                                <input type="text" name="alamat_bengkel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark">No Hp Bengkel</label>
                                <input type="text" name="hp_bengkel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" id="1">Pending</option>
                                    <option value="2" id="2">Approved</option>
                                    <option value="3" id="3">Rejected</option>
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

       

    $('table#table-dataregisthsv').on('click', '.btn-success', function (){
    let id = $(this).data('id');
    let baseurl = "<?=base_url()?>";
    $.ajax({
        url: `${baseurl}/admin/registhsv/${id}`,
        type: 'PATCH',
        success: function(data){
        
            $(`#status_${id}`).text('Approved');
            // Tampilkan pesan sukses
            alert('Status updated successfully');
            $("table#table-dataregisthsv").DataTable().ajax.reload();
        },
        error: function(xhr,status,error){

            alert('Status update failed');
        }
    });
});

$('table#table-dataregisthsv').on('click', '.btn-danger', function (){
    let id = $(this).data('id');
    let baseurl = "<?=base_url()?>";
    $.ajax({
        url: `${baseurl}/admin/registhsv/${id}`,
        type: 'GET',
        success: function(data){
          
            $(`#status_${id}`).text('Rejected');
            // Tampilkan pesan sukses
            alert('Status updated successfully');
            $("table#table-dataregisthsv").DataTable().ajax.reload();
        },
        error: function(xhr,status,error){
           
            alert('Status update failed');
            $("table#table-dataregisthsv").DataTable().ajax.reload();
        }
    });
});



   

        $('table#table-dataregisthsv').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('admin/registhsv/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    },
                    className: 'text-dark'
                },
                {data:  'nama_bengkel',
                className: 'text-dark'},
                {data: 'alamat_bengkel',
                    className: 'text-dark'},
                {data: 'hp_bengkel',
                    className: 'text-dark'},
                {data: 'status',
                    render: (data,type,row,meta)=>{
                        if(data === '1'){
                            return 'Pending';
                        }
                        else if(data === '2'){
                            return '<span class="text-success">Bengkel Diterima</span>';
                        }
                            else if(data === '3'){
                            return '<span class="text-danger">Bengkel Ditolak</span>';
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
                    }

                },
            ]
            
        });
        
    });
    
</script>

<?=$this->endSection()?>