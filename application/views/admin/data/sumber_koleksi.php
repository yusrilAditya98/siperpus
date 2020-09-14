<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data | Sumber Koleksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sumber Koleksi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Sumber Koleksi</h3>
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
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <button class="float-right btn btn-success mb-2" data-toggle="modal" data-target="#btnAddData">
                                        Tambah Sumber Koleksi
                                    </button>

                                    <div class="modal fade" id="btnAddData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnAddDataLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="btnAddDataLabel">Tambah Sumber Koleksi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?= site_url() ?>data/sumber_koleksi/addData">
                                                        <div class="form-group">
                                                            <label for="nama_sumber">Sumber Koleksi</label>
                                                            <input type="text" class="form-control" id="nama_sumber" name="nama_sumber" required placeholder="Sumber Koleksi..." aria-describedby="emailHelp">
                                                            <small id="emailHelp" class="form-text text-muted">Masukkan Jenis Sumber Koleksi Baru</small>
                                                        </div>
                                                        <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="data" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sumber Koleksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_sumber_koleksi as $data) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $data['nama_sumber'] ?></td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#btnUpdateData<?= $data['id_sumber'] ?>">
                                                    Edit
                                                </button>
                                                <a href="<?= site_url() ?>data/sumber_koleksi/deleteData/<?= $data['id_sumber'] ?>" class="btn btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="btnUpdateData<?= $data['id_sumber'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnUpdateDataLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="btnUpdateDataLabel">Update Sumber Koleksi</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="<?= site_url() ?>data/sumber_koleksi/updateData">
                                                            <div class="form-group">
                                                                <label for="nama_sumber">Sumber Koleksi</label>
                                                                <input type="text" class="form-control" id="nama_sumber" name="nama_sumber" required value="<?= $data['nama_sumber'] ?>">
                                                            </div>
                                                            <input type="hidden" name="id_sumber" value="<?= $data['id_sumber'] ?>">
                                                            <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>