<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manajemen Anggota</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manajemen Anggota</li>
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
                            <h3 class="card-title">Data Anggota</h3>

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
                                    <a href="<?= base_url('user/anggota/tambah') ?>" class="float-right btn btn-success mb-2">Tambah Anggota</a>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Anggota</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Status Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody><?php $i = 1; ?>
                                    <?php foreach ($list_user as $lu) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $lu['username'] ?></td>
                                            <td><?= $lu['nama'] ?></td>
                                            <td><?= $lu['no_hp'] ?></td>
                                            <?php if ($lu['status_aktif'] == 1) : ?>
                                                <td><span class="badge badge-success">aktif</span></td>
                                            <?php else : ?>
                                                <td><span class="badge badge-warning">tidak aktif</span></td>
                                            <?php endif; ?>
                                            <td><a href="<?= base_url('user/anggota/ubah/' . $lu['username']) ?>" class="btn btn-info">Edit</a>
                                                <a href="<?= base_url('user/anggota/hapus/' . $lu['username']) ?>" class="btn btn-danger">Hapus</a></td>
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