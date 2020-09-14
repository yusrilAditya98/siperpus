<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data | Lama Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lama Peminjaman</li>
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
                            <h3 class="card-title">Data Lama Peminjaman</h3>
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
                                        Tambah Lama Peminjaman
                                    </button>

                                    <div class="modal fade" id="btnAddData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnAddDataLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="btnAddDataLabel">Tambah Lama Peminjaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?= site_url() ?>data/lama_peminjaman/addData">
                                                        <div class="form-group">
                                                            <label for="durasi_peminjaman">Lama Peminjaman</label>
                                                            <input type="number" class="form-control" id="durasi_peminjaman" name="durasi_peminjaman" required placeholder="60" aria-describedby="emailHelp">
                                                            <small id="emailHelp" class="form-text text-muted">Terhitung Dalam Hari (contoh: 60 hari)</small>
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
                                        <th>Lama Peminjaman (Hari)</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_lama_peminjaman as $data) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $data['durasi_peminjaman'] ?></td>
                                            <td>
                                                <?php if ($data['status_peminjaman'] == 0) { ?>
                                                    <span class="badge bg-danger">Tidak Di Pakai</span>
                                                <?php } else { ?>
                                                    <span class="badge bg-success">Di Pakai</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#btnUpdateData<?= $data['id_lama_peminjaman'] ?>">
                                                    Edit
                                                </button>
                                                <a href="<?= site_url() ?>data/lama_peminjaman/deleteData/<?= $data['id_lama_peminjaman'] ?>" class="btn btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="btnUpdateData<?= $data['id_lama_peminjaman'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnUpdateDataLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="btnUpdateDataLabel">Update Lama Peminjaman</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="<?= site_url() ?>data/lama_peminjaman/updateData">
                                                            <div class="form-group">
                                                                <label for="durasi_peminjaman">Lama Peminjaman</label>
                                                                <input type="number" class="form-control" id="durasi_peminjaman" name="durasi_peminjaman" required value="<?= $data['durasi_peminjaman'] ?>">
                                                                <small id="emailHelp" class="form-text text-muted">Terhitung Dalam Hari (contoh: 60 hari)</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="label">Status Durasi</div>
                                                                <select class="form-control" name="status_peminjaman">
                                                                    <?php if ($data['status_peminjaman'] == 0) { ?>
                                                                        <option value="0">Tidak Di Pakai</option>
                                                                        <option value="1">Pakai</option>
                                                                    <?php } else { ?>
                                                                        <option value="1">Pakai</option>
                                                                        <option value="0">Tidak Di Pakai</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="id_lama_peminjaman" value="<?= $data['id_lama_peminjaman'] ?>">
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