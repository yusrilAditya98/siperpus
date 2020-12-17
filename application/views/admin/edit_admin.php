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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form <?= $title ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url('user/Admin/ubah/' . $list_admin['username']) ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="old_username" value="<?= $list_admin['username'] ?>">
                            <input type="hidden" name="old_foto" value="<?= $list_admin['foto'] ?>">
                            <input type="hidden" id="prodi" value="p000" name="prodi">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="masukan nama..." value="<?= $list_admin['nama'] ?>">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Nomor Induk</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control" id="username" placeholder="masukan username..." value="<?= $list_admin['username'] ?>">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="masukan alamat..." value=" <?= $list_admin['alamat'] ?>">
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                    <div class="col-sm-10">
                                        <input type="tel" name="no_hp" class="form-control" id="no_hp" placeholder="masukan nomer hp..." pattern="[0-9]+" value="<?= $list_admin['no_hp'] ?>">
                                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status Aktif</label>
                                    <div class="col-sm-10">
                                        <select name="status_aktif" class="form-control" id="status_aktif">
                                            <?php if ($list_admin['status_aktif'] == 1) : ?>
                                                <option selected value="1">aktif</option>
                                                <option value="0">tidak aktif</option>
                                            <?php else : ?>
                                                <option value="1">aktif</option>
                                                <option selected value="0">tidak aktif</option>
                                            <?php endif; ?>

                                        </select>
                                        <?= form_error('status_aktif', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Foto Profil</label>
                                    <div class="col-sm-2">
                                        <img src="<?= base_url('assets/foto_profil/' . $list_admin['foto']) ?>" class="img-thumbnail img-preview">
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

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Ubah admin</button>
                                <a href="<?= base_url('user/Admin/list') ?>" class="btn btn-default float-right">Cancel</a>
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