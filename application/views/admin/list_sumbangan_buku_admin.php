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
                        <li class="breadcrumb-item active">Sumbangan Buku</li>
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
                            <h3 class="card-title">Sumbangan Buku</h3>
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
                                <div class="col-12">
                                    <div class="callout callout-info">
                                        <h5>Halaman ini digunakan untuk melakukan sumbangan buku</h5>

                                        <p>Jika anda berminat menyumbangkan koleksi yang anda punya. bisa melalui halaman ini</p>
                                        <a href="<?= site_url() ?>sirkulasi/sumbangan_buku/tambah_sumbangan_buku_admin" style="text-decoration:none;" class="btn btn-info text-white">
                                            Tambah Sumbangan Buku
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Validasi Sumbangan Anggota</h3>

                                            <div class="card-tools">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="data-anggota" class="table table-bordered display">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Register</th>
                                                        <th>Judul Buku</th>
                                                        <th>Penyumbang</th>
                                                        <th>Tanggal Sumbangan</th>
                                                        <th>Status Sumbangan</th>
                                                        <th width="15%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Validasi Sumbangan Non-Anggota</h3>

                                            <div class="card-tools">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="data-nonanggota" class="table table-bordered display">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Register</th>
                                                        <th>Judul Buku</th>
                                                        <th>Penyumbang</th>
                                                        <th>Tanggal Sumbangan</th>
                                                        <th>Status Sumbangan</th>
                                                        <th width="15%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Riwayat Sumbangan - Admin</h3>

                                            <div class="card-tools">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="data-admin" class="table table-bordered display">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Register</th>
                                                        <th>Judul Buku</th>
                                                        <th>Penyumbang</th>
                                                        <th>Tanggal Sumbangan</th>
                                                        <th>Status Sumbangan</th>
                                                        <th width="15%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script>
    $(document).ready(function() {

        $('#data-anggota').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('sirkulasi/sumbangan_buku/get_ajax') ?>",
                "type": "POST",
                "data": {
                    "role_id": '2',
                }
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
        $('#data-nonanggota').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('sirkulasi/sumbangan_buku/get_ajax') ?>",
                "type": "POST",
                "data": {
                    "role_id": '3',
                }
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
        $('#data-admin').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('sirkulasi/sumbangan_buku/get_ajax_admin') ?>",
                "type": "POST"
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
    });
</script>