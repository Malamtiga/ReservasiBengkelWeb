<section role="main" class="content-body">
    <header class="page-header">
        <h2>Data User & Akses</h2>


    </header>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">Data User & Akses</h2>
        </header>
        <div class="panel-body">


            <a class="mb-xs mt-xs mr-xs btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</a>

            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Akses</th>
                        <th>Create</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 1;
                    foreach ($user as $user) { ?>
                        <tr>

                            <td class="text-center"><?php echo $no ?></td>
                            <td><?php echo $user['nama'] ?></td>
                            <td><?php echo $user['username'] ?></td>
                            <?php if ($user['akses'] == '1') { ?>
                                <td>Administrator</td>
                            <?php } else if ($user['akses'] == '2') {
                            ?>
                                <td>User</td>
                            <?php } ?>

                            <td><?php echo $user['create_at'] ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="<?php echo base_url('user/edit/' . $user['id_user']) ?>">
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('user/delete/' . $user['id_user']) ?>" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
    </section>


</section>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
            </div>
            <form action="/user/tambah" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault">Nama Lengkap</label>
                        <div class="col-md-12">
                            <input type="text" name="nama" class="form-control" placeholder="masukan nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault">Username</label>
                        <div class="col-md-12">
                            <input type="text" name="username" class="form-control" placeholder="masukan username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault">Password</label>
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="masukan password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault">Akses</label>
                        <div class="col-md-12">
                            <select class="form-control" name="akses" required>
                                <option>- pilih akses -</option>
                                <option value="1">Administrator</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
        </div>



        </form>
    </div>
</div>