    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Daftar Sangsi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Sangsi</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                            Halaman ini berisikan list dari anggota yang terkena sangsi
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= base_url('Laporan/sangsi') ?>" method="get">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h5>Status Pembayaran</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group mb-3">
                                                        <select name="id_pelanggaran" id="id_pelanggaran" class="form-control">
                                                            <option value="">-- Semua Status --</option>
                                                            <?php foreach ($pelanggaran as $s) : ?>
                                                                <option value="<?= $s['id_pelanggaran'] ?>"> <?= $s['nama_pelanggaran'] ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h5>Range Mulai Tanggal Pembayaran</h5>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group mb-3">
                                                        <select name="id_pelanggaran" id="id_pelanggaran" class="form-control">
                                                            <option value="">-- Semua Status --</option>
                                                            <?php foreach ($pelanggaran as $s) : ?>
                                                                <option value="<?= $s['id_pelanggaran'] ?>"> <?= $s['nama_pelanggaran'] ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar mr-2"></i>Selesai</span>
                                                </div>
                                                <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <select name="id_pelanggaran" id="id_pelanggaran" class="form-control">
                                                    <option value="">-- nama pelanggaran --</option>
                                                    <?php foreach ($pelanggaran as $s) : ?>
                                                        <option value="<?= $s['id_pelanggaran'] ?>"> <?= $s['nama_pelanggaran'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary" type="submit">Go!</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data-peminjaman" class="table table-striped table-white table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Transaksis</th>
                                            <th>Nama / Username</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Status</th>
                                            <th>Operator Entry / ID</th>
                                            <th>Bukti Foto</th>
                                            <th>Jumlah Bayar</th>
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
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-peminjaman').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print', {
                        extend: 'pdf',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                ]
            });
        });
    </script>