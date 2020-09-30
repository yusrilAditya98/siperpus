<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Stock Opname</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>data/stock_opname">Stock Opname</a></li>
                        <li class="breadcrumb-item active">Create Stock Opname</li>
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
                    <form enctype="multipart/form-data" method="POST" action="<?= site_url() ?>data/stock_opname/addData">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Stock Opname</h3>
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
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nama Project</label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>" required class="form-control" placeholder="Masukkan ID...">
                                                    <input type="hidden" name="role_id" value="<?= substr($this->session->userdata('role_id'), -1) ?>" required class="form-control" placeholder="Masukkan ID...">
                                                    <input type="text" name="nama_project" required class="form-control" placeholder="Masukkan Nama Project...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                                <div class="col-sm-10">
                                                    <input type="date" name="tanggal_mulai" required class="form-control" placeholder="Masukkan Judul Buku...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="keterangan" required class="form-control" placeholder="Masukkan keterangan...">
                                                </div>
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