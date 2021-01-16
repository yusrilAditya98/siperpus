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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Profil</a>
                                        <a class="nav-link" id="vert-tabs-kartu-tab" data-toggle="pill" href="#vert-tabs-kartu" role="tab" aria-controls="vert-tabs-kartu" aria-selected="false">Kartu Anggota</a>
                                        <a class="nav-link" id="vert-tabs-peminjaman-tab" data-toggle="pill" href="#vert-tabs-peminjaman" role="tab" aria-controls="vert-tabs-peminjaman" aria-selected="false">Peminjaman</a>
                                        <a class="nav-link" id="vert-tabs-pelanggaran-tab" data-toggle="pill" href="#vert-tabs-pelanggaran" role="tab" aria-controls="vert-tabs-pelanggaran" aria-selected="false">Pelanggaran</a>
                                        <a class="nav-link" id="vert-tabs-sumbangan -tab" data-toggle="pill" href="#vert-tabs-sumbangan " role="tab" aria-controls="vert-tabs-sumbangan " aria-selected="false">Sumbangan </a>
                                        <a class="nav-link" id="vert-tabs-perpanjang-tab" data-toggle="pill" href="#vert-tabs-perpanjang" role="tab" aria-controls="vert-tabs-perpanjang" aria-selected="false">Perpanjang</a>

                                    </div>
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                            <!-- form start -->
                                            <form class="form-horizontal" action="<?= base_url('user/Anggota/ubah/' . $list_user['username']) ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="old_username" value="<?= $list_user['username'] ?>">
                                                <input type="hidden" name="old_foto" value="<?= $list_user['foto'] ?>">
                                                <div class="form-group row">
                                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="masukan nama..." value="<?= $list_user['nama'] ?>">
                                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="username" class="col-sm-2 col-form-label">Nomor Induk</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="username" class="form-control" id="username" placeholder="masukan username..." value="<?= $list_user['username'] ?>">
                                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="masukan alamat..." value="<?= $list_user['alamat'] ?>">
                                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="email" class="form-control" id="email" placeholder="masukan email..." value="<?= $list_user['email'] ?>">
                                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class=" form-group row">
                                                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                                    <div class="col-sm-10">
                                                        <input type="tel" name="no_hp" class="form-control" id="no_hp" placeholder="masukan nomer hp..." pattern="[0-9]+" value="<?= $list_user['no_hp'] ?>">
                                                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-2 col-form-label">Status Aktif</label>
                                                    <div class="col-sm-10">
                                                        <select name="status_aktif" class="form-control" id="status_aktif">
                                                            <?php if ($list_user['status_aktif'] == 1) : ?>
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
                                                    <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                                                    <div class="col-sm-10">
                                                        <select name="prodi" class="form-control" id="prodi">
                                                            <option value="" selected>Pilih prodi</option>
                                                            <?php foreach ($list_prodi as $lp) : ?>
                                                                <?php if ($lp['id_prodi'] == $list_user['p_id_prodi']) : ?>
                                                                    <option selected value="<?= $lp['id_prodi'] ?>"><?= $lp['nama_prodi'] ?></option>
                                                                <?php else : ?>
                                                                    <option value="<?= $lp['id_prodi'] ?>"><?= $lp['nama_prodi'] ?></option>
                                                                <?php endif; ?>

                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Foto Profil</label>
                                                    <div class="col-sm-2">
                                                        <img src="<?= base_url('assets/foto_profil/' . $list_user['foto']) ?>" class="img-thumbnail img-preview">
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
                                                    <label for="date_ended" class="col-sm-2 col-form-label">Masa Berlaku Akun</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="date_ended" class="form-control" id="date_ended" value="<?= $list_user['date_ended'] ?>">
                                                        <?= form_error('date_ended', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info">Ubah anggota</button>
                                            </form>
                                        </div>

                                        <div class="tab-pane fade" id="vert-tabs-kartu" role="tabpanel" aria-labelledby="vert-tabs-kartu-tab">
                                            Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                                        </div>
                                        <div class="tab-pane fade" id="vert-tabs-peminjaman" role="tabpanel" aria-labelledby="vert-tabs-peminjaman-tab">
                                            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                        </div>
                                        <div class="tab-pane fade" id="vert-tabs-pelanggaran" role="tabpanel" aria-labelledby="vert-tabs-pelanggaran-tab">

                                        </div>
                                        <div class="tab-pane fade" id="vert-tabs-sumbangan" role="tabpanel" aria-labelledby="vert-tabs-sumbangan-tab">

                                        </div>
                                        <div class="tab-pane fade" id="vert-tabs-perpanjang" role="tabpanel" aria-labelledby="vert-tabs-perpanjang-tab">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>















                        <!-- /.card-body -->
                        <div class="card-footer">

                            <a href="<?= base_url('user/Anggota/list') ?>" class="btn btn-default float-right">Cancel</a>
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