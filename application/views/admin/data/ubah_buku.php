<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>data/buku">Katalog Buku</a></li>
                        <li class="breadcrumb-item active">Tambah Buku</li>
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
                <div class="col-lg-12">
                    <!-- <?= var_dump($data_katalog_buku); ?> -->
                    <form enctype="multipart/form-data" method="POST" action="<?= site_url() ?>data/buku/ubahDataBuku">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">No. Register</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="register" required value="<?= $data_katalog_buku[0]['register'] ?>" class="form-control" placeholder="Masukkan No. Register...">
                                                <input type="hidden" name="register_lama" required value="<?= $data_katalog_buku[0]['register'] ?>" class="form-control" placeholder="Masukkan No. Register...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Sampul Buku</label>
                                            <div class="col-sm-10">
                                                <img src="<?= base_url(); ?>assets/sampul_buku/<?= $data_katalog_buku[0]['sampul'] ?>" class="w-25" alt="<?= $data_katalog_buku[0]['sampul'] ?>">
                                                <input type="hidden" name="sampul" required value="<?= $data_katalog_buku[0]['sampul'] ?>" class="form-control">
                                                <br><br>
                                                <div id="btn-change">
                                                    <button type="button" onclick="openPict()" class="btn btn-sm btn-success btn-change-pict">
                                                        Ubah Sampul Buku
                                                    </button>
                                                </div>

                                                <input type="hidden" value="<?= $data_katalog_buku[0]['sampul'] ?>" required name="pict" class="form-control-file center-block file-upload picture" style="text-align: center; margin: auto;">
                                                <input type="hidden" value="tidak" name="ubah-pict" class="ubah-pict" id="ubah-pict">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Judul Buku</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="judul_buku" required value="<?= $data_katalog_buku[0]['judul_buku'] ?>" class="form-control" placeholder="Masukkan Judul Buku...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Pengarang</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="pengarang" required value="<?= $data_katalog_buku[0]['pengarang'] ?>" class="form-control" placeholder="Masukkan Pengarang...">
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
                                                <input type="text" name="penerbit" required value="<?= $data_katalog_buku[0]['penerbit'] ?>" class="form-control" placeholder="Masukkan Penerbit...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tahun Terbit</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="tahun_terbit" required value="<?= $data_katalog_buku[0]['tahun_terbit'] ?>" class="form-control" placeholder="Masukkan Tahun Terbit...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kota Terbit</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="kota_terbit" required value="<?= $data_katalog_buku[0]['kota_terbit'] ?>" class="form-control" placeholder="Masukkan Kota Terbit...">
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
                                                <input type="text" name="kondisi_fisik" required value="<?= $data_katalog_buku[0]['kondisi_fisik'] ?>" class="form-control" placeholder="Masukkan Kondisi Fisik...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Volume</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="volume" required value="<?= $data_katalog_buku[0]['volume'] ?>" class="form-control" placeholder="Masukkan Volume...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Bibliography</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="bibliography" required value="<?= $data_katalog_buku[0]['bibliography'] ?>" class="form-control" placeholder="Masukkan Bibliography...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">ISBN</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="isbn" required value="<?= $data_katalog_buku[0]['isbn'] ?>" class="form-control" placeholder="Masukkan ISBN...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Dewey Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="no_dewey" required value="<?= $data_katalog_buku[0]['no_dewey'] ?>" class="form-control" placeholder="Masukkan No Dewey...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Author Abrev</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="author_abrev" required value="<?= $data_katalog_buku[0]['author_abrev'] ?>" class="form-control" placeholder="Masukkan Author Abrev...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Title Abrev</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title_abrev" required value="<?= $data_katalog_buku[0]['title_abrev'] ?>" class="form-control" placeholder="Masukkan Title Abrev...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Subject</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="subject" required value="<?= $data_katalog_buku[0]['subject'] ?>" class="form-control" placeholder="Masukkan Subject...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Bahasa</label>
                                            <select id="selectBox" name="b_id_bahasa" class="form-control col-sm-10">
                                                <?php foreach ($data_bahasa as $bahasa) : ?>
                                                    <?php if ($bahasa['id_bahasa'] == $data_katalog_buku[0]['b_id_bahasa']) : ?>
                                                        <option value="<?= $data_katalog_buku[0]['b_id_bahasa'] ?>">
                                                            <?= $bahasa['nama_bahasa'] ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php foreach ($data_bahasa as $bahasa) : ?>
                                                    <option value="<?= $bahasa['id_bahasa'] ?>"><?= $bahasa['nama_bahasa'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">CIRC Type</label>
                                            <select id="selectBox2" name="ct_id_circ_type" class="form-control col-sm-10">
                                                <?php foreach ($data_circ as $circ_type) : ?>
                                                    <?php if ($circ_type['id_circ_type'] == $data_katalog_buku[0]['ct_id_circ_type']) : ?>
                                                        <option value="<?= $data_katalog_buku[0]['ct_id_circ_type'] ?>">
                                                            <?= $circ_type['nama_circ_type'] ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php foreach ($data_circ as $circ_type) : ?>
                                                    <option value="<?= $circ_type['id_circ_type'] ?>"><?= $circ_type['nama_circ_type'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Funding</label>
                                            <select id="selectBox3" name="f_id_funding" class="form-control col-sm-10">
                                                <?php foreach ($data_funding as $funding) : ?>
                                                    <?php if ($funding['id_funding'] == $data_katalog_buku[0]['f_id_funding']) : ?>
                                                        <option value="<?= $data_katalog_buku[0]['f_id_funding'] ?>">
                                                            <?= $funding['nama_funding'] ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php foreach ($data_funding as $funding) : ?>
                                                    <option value="<?= $funding['id_funding'] ?>"><?= $funding['nama_funding'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Sumber Koleksi</label>
                                            <select id="selectBox3" name="sk_id_sumber" class="form-control col-sm-10">
                                                <?php foreach ($data_sumber as $sumber) : ?>
                                                    <?php if ($sumber['id_sumber'] == $data_katalog_buku[0]['sk_id_sumber']) : ?>
                                                        <option value="<?= $data_katalog_buku[0]['sk_id_sumber'] ?>">
                                                            <?= $sumber['nama_sumber'] ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php foreach ($data_sumber as $sumber) : ?>
                                                    <option value="<?= $sumber['id_sumber'] ?>"><?= $sumber['nama_sumber'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kategori Buku</label>
                                            <select id="selectBox3" name="k_id_kategori" class="form-control col-sm-10">
                                                <?php foreach ($data_kategori as $kategori) : ?>
                                                    <?php if ($kategori['id_kategori'] == $data_katalog_buku[0]['k_id_kategori']) : ?>
                                                        <option value="<?= $data_katalog_buku[0]['k_id_kategori'] ?>">
                                                            <?= $kategori['nama_kategori'] ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php foreach ($data_kategori as $kategori) : ?>
                                                    <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jenis Akses</label>
                                            <select id="selectBox3" name="jenis_akses" class="form-control col-sm-10">
                                                <?php foreach ($data_jenis_akses as $jenis) : ?>
                                                    <?php if ($jenis['id_jenis'] == $data_katalog_buku[0]['jenis_akses']) : ?>
                                                        <option value="<?= $data_katalog_buku[0]['jenis_akses'] ?>">
                                                            <?= $jenis['nama_jenis'] ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php foreach ($data_jenis_akses as $jenis) : ?>
                                                    <option value="<?= $jenis['id_jenis'] ?>"><?= $jenis['nama_jenis'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Status Buku</label>
                                            <select id="selectBox3" name="status_buku" class="form-control col-sm-10">
                                                <?php if ($data_katalog_buku[0]['status_buku'] == 1) { ?>
                                                    <option value="1">Tersedia</option>
                                                    <option value="2">Sedang Dipinjam</option>
                                                <?php } else { ?>
                                                    <option value="2">Sedang Dipinjam</option>
                                                    <option value="1">Tersedia</option>
                                                <?php } ?>
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
<script>
    function openPict() {
        $('.btn-change-pict').remove();
        $('#btn-change').append(`
            <a href="#" onclick="closePict()" class="btn btn-sm btn-danger btn-change-pict">
                Tidak Ubah Sampul
            </a>
        `);
        document.getElementById('ubah-pict').value = "ya";
        $(".picture").replaceWith($('.picture').clone().attr('type', 'file'));
    }

    function closePict() {
        $('.btn-change-pict').remove();
        $('#btn-change').append(`
            <a href="#" onclick="openPict()" class="btn btn-sm btn-success btn-change-pict">
                Ubah Sampul Buku
            </a>
        `);
        document.getElementById('ubah-pict').value = "tidak";
        $(".picture").replaceWith($('.picture').clone().attr('type', 'hidden'));
    }
</script>