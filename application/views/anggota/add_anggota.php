<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form <?= $title ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url('user/anggota/tambah') ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="masukan nama..." value="<?= set_value('nama') ?>">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Nomor Induk</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control" id="username" placeholder="masukan username...">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="masukan alamat...">
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                    <div class="col-sm-10">
                                        <input type="tel" name="no_hp" class="form-control" id="no_hp" placeholder="masukan nomer hp..." pattern="[0-9]+">
                                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status Aktif</label>
                                    <div class="col-sm-10">
                                        <select name="status_aktif" class="form-control" id="status_aktif">
                                            <option value="1">aktif</option>
                                            <option value="0">tidak aktif</option>
                                        </select>
                                        <?= form_error('status_aktif', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                                    <div class="col-sm-10">
                                        <select name="prodi" class="form-control" id="prodi">
                                            <option value="" selected>Pilih prodi</option>
                                            <?php foreach ($list_prodi as $lp) : ?>
                                                <option value="<?= $lp['id_prodi'] ?>"><?= $lp['nama_prodi'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Foto Profil</label>
                                    <div class="col-sm-2">
                                        <img src="<?= base_url('assets/img/default.png') ?>" class="img-thumbnail img-preview">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input name="foto" onchange="previewImg()" type="file" class="custom-file-input" id="foto">
                                            <label class="custom-file-label" for="foto">Choose file</label>
                                        </div>
                                        <small>*format gambar berupa .jpg dengan ukuran maksimal 1MB</small>
                                        <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label for="password1" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password1" class="form-control" id="password1" placeholder="masukan password...">
                                        <small>password minimal 3 huruf</small>
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password2" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password2" class="form-control" id="password2" placeholder="masukan konfirmasi password...">
                                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Tambah anggota</button>
                                <a href="<?= base_url('user/anggota/list') ?>" class="btn btn-default float-right">Cancel</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>