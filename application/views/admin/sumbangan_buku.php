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

                                        <button class="btn btn-info" data-toggle="modal" data-target="#modal-default">Sumbangkan Buku</button>
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
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal Sumbangan</th>
                                                        <th>Penyumbang</th>
                                                        <th>Keterangan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>20 Agustus 2020</td>
                                                        <td>Kharis</td>
                                                        <td>Semoga bermanfaat</td>
                                                        <td><span class="badge bg-info">Diproses</span></td>
                                                        <td>
                                                            <button class="btn btn-secondary">Detail</button>
                                                            <button class="btn btn-success"><i class="fas fa-check"></i></button>
                                                            <button class="btn btn-danger"><i class="fas fa-times"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>22 Agustus 2020</td>
                                                        <td>Kharis</td>
                                                        <td>Semoga bermanfaat</td>
                                                        <td><span class="badge bg-success">Diterima</span></td>
                                                        <td>
                                                            <button class="btn btn-secondary">Detail</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>23 Agustus 2020</td>
                                                        <td>Kharis</td>
                                                        <td>Semoga bermanfaat</td>
                                                        <td><span class="badge bg-danger">Ditolak</span></td>
                                                        <td><button class="btn btn-secondary">Detail</button></td>
                                                    </tr>
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
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal Sumbangan</th>
                                                        <th>Penyumbang</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>20 Agustus 2020</td>
                                                        <td>Kharis</td>
                                                        <td>Semoga bermanfaat</td>
                                                        <td>
                                                            <button class="btn btn-secondary">Detail</button>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>22 Agustus 2020</td>
                                                        <td>Kharis</td>
                                                        <td>Semoga bermanfaat</td>
                                                        <td>
                                                            <button class="btn btn-secondary">Detail</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>23 Agustus 2020</td>
                                                        <td>Kharis</td>
                                                        <td>Semoga bermanfaat</td>
                                                        <td><button class="btn btn-secondary">Detail</button></td>
                                                    </tr>
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