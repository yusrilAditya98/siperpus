<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Stock Opname</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Stock Opname</li>
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
                            <h3 class="card-title">Stock Opname</h3>
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
                                    <?php if ($this->session->flashdata('success')) : ?>
                                        <input type="hidden" class="toasterSuccess" value="<?= $this->session->flashdata('success')  ?>">
                                    <?php else : ?>
                                        <input type="hidden" class="toasterDanger" value="<?= $this->session->flashdata('danger')  ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="callout callout-info">
                                        <h5>Halaman ini digunakan untuk melakukan Stock Opaname</h5>

                                        <p>Jika akan dilakukan perhitungan stock opname maka bisa melalui halaman ini</p>
                                        <a href="<?= site_url() ?>data/Stock_opname/create" style="text-decoration:none;" class="btn btn-info text-white">
                                            Tambah
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Stock Opname</h3>

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
                                                        <th>Tanggal</th>
                                                        <th>Tahun</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($data_opname as $lp) : ?>
                                                        <tr>
                                                            <form action="<?= base_url('data/Stock_opname/ubah/' . $lp['id_opname']) ?>" method="post">
                                                                <td><?= $i++; ?></td>
                                                                <td>
                                                                    <input type="date" class="form-control" name="tanggal" value="<?= substr($lp['tanggal'], 0, 10) ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="tahun" value="<?= $lp['tahun'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="keterangan" value="<?= $lp['keterangan'] ?>">
                                                                </td>
                                                                <td>
                                                                    <button type="submit" style="font-size:12px;" class="btn btn-primary">
                                                                        <i class="fa fa-edit"></i> Koreksi
                                                                    </button>
                                                                    <a href="<?= base_url('data/Stock_opname/hapus/' . $lp['id_opname']) ?>" style="font-size:12px;" class="btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
                                                                        <i class="fa fa-trash"></i> Hapus
                                                                    </a>
                                                                    |
                                                                    <a href="<?= base_url('data/Stock_opname/detail/' . $lp['id_opname']) ?>" style="font-size:12px;" class="ml-2 btn btn-info">
                                                                        <i class="fa fa-list"></i> Detail
                                                                    </a>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                    <?php endforeach; ?>
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