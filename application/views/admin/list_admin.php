<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manajemen Admin</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manajemen Admin</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php if ($this->session->flashdata('success')) : ?>
        <input type="hidden" class="toasterSuccess" value="<?= $this->session->flashdata('success')  ?>">
    <?php else : ?>
        <input type="hidden" class="toasterDanger" value="<?= $this->session->flashdata('danger')  ?>">
    <?php endif; ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Admin</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="<?= base_url('user/admin/tambah') ?>" class="float-right btn btn-success mb-2">Tambah Admin</a>
                                    <button data-toggle="modal" data-target="#importAdmin" class="float-right btn btn-info mb-2 mr-2">
                                        Import Admin
                                    </button>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor admin</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Status Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody><?php $i = 1; ?>
                                    <?php foreach ($list_admin as $la) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $la['username'] ?></td>
                                            <td><?= $la['nama'] ?></td>
                                            <td><?= $la['no_hp'] ?></td>
                                            <?php if ($la['status_aktif'] == 1) : ?>
                                                <td><span class="badge badge-success">aktif</span></td>
                                            <?php else : ?>
                                                <td><span class="badge badge-warning">tidak aktif</span></td>
                                            <?php endif; ?>
                                            <td>
                                                <button class="btn btn-warning ubah-password" data-toggle="modal" data-target="#passwordModal" data-id="<?= $la['username'] ?>">Password</button>
                                                <a href="<?= base_url('user/admin/ubah/' . $la['username']) ?>" class="btn btn-info">Edit</a>
                                                <a href="<?= base_url('user/admin/hapus/' . $la['username']) ?>" class="btn btn-danger">Hapus</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/admin/ubahPassword') ?>" method="post">
                <input type="hidden" name="username" id="ubah_password">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password1" class="col-form-label">Password Baru:</label>
                        <input type="password" name="password1" class="form-control" id="password1">
                    </div>
                    <div class="form-group">
                        <label for="password2" class="col-form-label">Konfirmasi Password:</label>
                        <input type="password" name="password2" class="form-control" id="password2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

            <div class="modal fade koleksi-digital" id="importAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="btnDetailBukuLabel">Import Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="<?= site_url() ?>user/admin/import" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="" target="_blank" class="btn btn-info">Download Template Data Admin</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="import_admin" class="col-sm-2 col-form-label">File Import</label>
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input name="import_admin" onchange="previewImg()" type="file" class="custom-file-input" id="foto">
                                            <label class="custom-file-label" for="import_admin">Choose file</label>
                                        </div>
                                        <small>*file upload harus berekstensi *xls maksimal ukuran 5MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>