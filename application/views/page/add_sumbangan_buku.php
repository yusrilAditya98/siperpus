<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sumbangan Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>sirkulasi/Sumbangan_buku">Sumbangan Buku</a></li>
                        <li class="breadcrumb-item active">Tambah Sumbangan Buku</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form enctype="multipart/form-data" method="POST" action="<?= site_url() ?>sirkulasi/Sumbangan_buku/addDataSumbangan">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Sumbangan Buku</h3>
                                <!-- <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
    
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if ($this->session->flashdata('warning') != null) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $this->session->flashdata('warning') ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('success') != null) : ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= $this->session->flashdata('success') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-footer">
                                            Data Buku
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">No. Register</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="username" value="<?= $this->session->userdata('username') ?>" required class="form-control" placeholder="Masukkan ID...">
                                                    <input type="text" name="role_id" value="<?= substr($this->session->userdata('role_id'), -1) ?>" required class="form-control" placeholder="Masukkan ID...">
                                                    <input type="number" name="register" required class="form-control" placeholder="Masukkan No. Register...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Sampul Buku</label>
                                                <div class="col-sm-2">
                                                    <img src="<?= base_url('assets/img/default.png') ?>" class="img-thumbnail img-preview">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="custom-file">
                                                        <input name="sampul" onchange="previewImg()" type="file" class="custom-file-input" id="foto">
                                                        <label class="custom-file-label" for="foto">Choose file</label>
                                                    </div>
                                                    <small>*format gambar berupa .jpg dengan ukuran maksimal 1MB</small>
                                                    <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <!-- <label class="col-sm-2 col-form-label">Sampul Buku</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="sampul" required class="form-control">
                                                </div> -->
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Judul Buku</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="judul_buku" required class="form-control" placeholder="Masukkan Judul Buku...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pengarang</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="pengarang" required class="form-control" placeholder="Masukkan Pengarang...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-footer">
                                            Penerbitan
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Penerbit</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="penerbit" required class="form-control" placeholder="Masukkan Penerbit...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tahun Terbit</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="tahun_terbit" required class="form-control" placeholder="Masukkan Tahun Terbit...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Kota Terbit</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="kota_terbit" required class="form-control" placeholder="Masukkan Kota Terbit...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-footer">
                                            Deskripsi Fisik
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Kondisi Fisik</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="kondisi_fisik" required class="form-control" placeholder="Masukkan Kondisi Fisik...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Volume</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="volume" required class="form-control" placeholder="Masukkan Volume...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Bibliography</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="bibliography" required class="form-control" placeholder="Masukkan Bibliography...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ISBN</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="isbn" required class="form-control" placeholder="Masukkan ISBN...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Dewey Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="no_dewey" required class="form-control" placeholder="Masukkan No Dewey...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Author Abrev</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="author_abrev" required class="form-control" placeholder="Masukkan Author Abrev...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Title Abrev</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title_abrev" required class="form-control" placeholder="Masukkan Title Abrev...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Subject</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="subject" required class="form-control" placeholder="Masukkan Subject...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Bahasa</label>
                                                <select id="selectBox" name="b_id_bahasa" class="form-control col-sm-10">
                                                    <option>Pilih Bahasa</option>
                                                    <?php foreach ($data_bahasa as $bahasa) : ?>
                                                        <option value="<?= $bahasa['id_bahasa'] ?>"><?= $bahasa['nama_bahasa'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">CIRC Type</label>
                                                <select id="selectBox2" name="ct_id_circ_type" class="form-control col-sm-10">
                                                    <option>Pilih CIRC Type</option>
                                                    <?php foreach ($data_circ as $circ_type) : ?>
                                                        <option value="<?= $circ_type['id_circ_type'] ?>"><?= $circ_type['nama_circ_type'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Funding</label>
                                                <select id="selectBox3" name="f_id_funding" class="form-control col-sm-10">
                                                    <option>Pilih Funding</option>
                                                    <?php foreach ($data_funding as $funding) : ?>
                                                        <option value="<?= $funding['id_funding'] ?>"><?= $funding['nama_funding'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Sumber Koleksi</label>
                                                <select id="selectBox3" name="sk_id_sumber" class="form-control col-sm-10">
                                                    <option>Pilih Sumber Koleksi</option>
                                                    <?php foreach ($data_sumber as $sumber) : ?>
                                                        <option value="<?= $sumber['id_sumber'] ?>"><?= $sumber['nama_sumber'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Kategori Buku</label>
                                                <select id="selectBox3" name="k_id_kategori" class="form-control col-sm-10">
                                                    <option>Pilih Kategori Buku</option>
                                                    <?php foreach ($data_kategori as $kategori) : ?>
                                                        <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Jenis Akses</label>
                                                <select id="selectBox3" name="jenis_akses" class="form-control col-sm-10">
                                                    <option>Pilih Jenis Akses</option>
                                                    <?php foreach ($data_jenis_akses as $jenis) : ?>
                                                        <option value="<?= $jenis['id_jenis'] ?>"><?= $jenis['nama_jenis'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Status Buku</label>
                                                <select id="selectBox3" name="status_buku" class="form-control col-sm-10">
                                                    <option>Pilih Status Buku</option>
                                                    <option value="1">Tersedia</option>
                                                    <option value="2">Sedang Dipinjam</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>