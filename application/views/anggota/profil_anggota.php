<style>
    #id {
        width: 450px;
        height: 350px;
        position: relative;
        opacity: 0.88;
        font-family: sans-serif;

        transition: 0.4s;
        /* background-color: #FFFFFF; */
        border-radius: 2%;
        margin-left: 50px;
    }

    #id2 {
        width: 450px;
        height: 350px;
        position: relative;
        opacity: 0.88;
        font-family: sans-serif;

        transition: 0.4s;
        /* background-color: #FFFFFF; */
        border-radius: 2%;
        margin-left: 50px;
    }

    #id::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: url('<?= base_url('assets/kartu_anggota/bkg-2.jpg'); ?>');
        /*if you want to change the background image replace logo.png*/
        /* background-repeat: repeat-x; */
        background-size: 450px 450px;
        border-radius: 2%;
        /* opacity: 0.2; */
        z-index: -1;
        text-align: center;

    }

    #id2::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: url('<?= base_url('assets/kartu_anggota/bkg-2.jpg'); ?>');
        /*if you want to change the background image replace logo.png*/
        /* background-repeat: repeat-x; */
        background-size: 450px 300px;
        border-radius: 2%;
        /* opacity: 0.2; */
        z-index: -1;
        text-align: center;

    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profil Anggota</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profil Anggota</li>
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
                            <h3 class="card-title">Form Profil Anggota</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Profil</a>
                                        <a class="nav-link" id="vert-tabs-kartu-tab" data-toggle="pill" href="#vert-tabs-kartu" role="tab" aria-controls="vert-tabs-kartu" aria-selected="false">Kartu Anggota</a>
                                        <a class="nav-link" id="vert-tabs-password-tab" data-toggle="pill" href="#vert-tabs-password" role="tab" aria-controls="vert-tabs-password" aria-selected="false">Ubah Password</a>
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
                                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="masukan nama..." value="<?= $list_user['nama'] ?>" readonly>
                                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="username" class="col-sm-2 col-form-label">Nomor Induk</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="username" class="form-control" id="username" placeholder="masukan username..." value="<?= $list_user['username'] ?>" readonly>
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
                                                        <select name="status_aktif" class="form-control" id="status_aktif" readonly>
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
                                                        <select name="prodi" class="form-control" id="prodi" readonly>
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
                                                <button type="submit" class="btn btn-info">Ubah anggota</button>
                                            </form>
                                        </div>

                                        <div class="tab-pane fade" id="vert-tabs-kartu" role="tabpanel" aria-labelledby="vert-tabs-kartu-tab">
                                            <div id="id">
                                                <table>
                                                    <tr>
                                                        <h4 style="color:white; margin-top: 10px; padding-top: 10px; text-align: center;"><b>Perpustakaan Fakultas Hukum <br>Universitas Brawijaya</b></h4>
                                                    </tr>
                                                </table>

                                                <table style="margin-left: 50px; margin-top: 50px">
                                                    <tr>
                                                        <td>
                                                            <?php

                                                            // $serial = $list_user['username'];
                                                            // $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                            // $code = $Bar->getBarcode($serial, $Bar::TYPE_CODE_128, 3, 30);

                                                            $profil = $this->db->where('username', $list_user['username'])->from('user')->join('prodi', 'user.p_id_prodi = prodi.id_prodi')->get()->row_array();
                                                            ?>
                                                            <img src="<?= base_url('assets/foto_profil/' . $profil['foto']) ?>" height='170px' width='135px' alt='' style='border: 2px solid black;'>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <p>No Anggota</p>
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <p style="font-weight: bold;margin-top:-4%; ;"><?= $profil['username'] ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <p>Nama</p>
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <p style="font-weight: bold;margin-top:-4%; ;"><?= $profil['nama'] ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <p>Prodi</p>
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <p style="font-weight: bold;margin-top:-4%; ;"><?= $profil['nama_prodi'] ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <p>Alamat</p>
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <p style="font-weight: bold;margin-top:-4%; ;"><?= $profil['alamat'] ?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr style="text-align: center;">
                                                                    <!-- <?= $code; ?> -->
                                                                </tr>
                                                                <br>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div id="id2">
                                                <table>
                                                    <tr>
                                                        <h4 style="color:black; margin-top: 50px; padding-top: 150px; text-align: center;"><b>Perpustakaan Fakultas Hukum <br>Universitas Brawijaya</b></h4>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="vert-tabs-password" role="tabpanel" aria-labelledby="vert-tabs-password-tab">
                                            <form action="<?= base_url('user/Anggota/ubahPassword') ?>" method="post">
                                                <input type="hidden" name="username" id="ubah_password" value="<?= $list_user['username'] ?>">

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="password1" class="col-form-label">Password Baru:</label>
                                                        <input type="password" name="password1" class="form-control" id="password1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password2" class="col-form-label">Konfirmasi Password:</label>
                                                        <input type="password" name="password2" class="form-control" id="password2">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
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