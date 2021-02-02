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
                                <form action="<?= base_url('Laporan/pembayaran') ?>" method="post">
                                    <input type="hidden" value="true" name="show">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h5>Status Pembayaran</h5>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="99">-- Semua Status --</option>
                                                            <option value="0">Belum Validasi</option>
                                                            <option value="1">Telah Upload Bukti Pembayaran</option>
                                                            <option value="2">Pembayaran Valid</option>
                                                            <option value="3">Revisi Pembayaran</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h5>Range Tanggal Mulai</h5>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <input type="date" class="form-control" name="start_date" id="start_date" value="<?= date('Y-m-d') ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h5>Range Tanggal Selesai</h5>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <input type="date" class="form-control" name="end_date" id="end_date" value="<?= date('Y-d-m') ?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-lg-12">
                                            <button class="btn btn-primary">Continue</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if ($show_table) : ?>
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
                                                <?php $index = 1;
                                                $totalPemasukan = 0;
                                                ?>
                                                <?php foreach ($pembayaran as $p) : ?>
                                                    <tr>
                                                        <td><?= $index++ ?></td>
                                                        <td><a href="<?= base_url("sirkulasi/Pembayaran/detail_transaksi_pembayaran/" . $p['no_transaksi']) ?>"><?= $p['no_transaksi'] ?></a></td>
                                                        <td><?= $p['uAnggota'] . '/' . $p['u_username'] ?></td>
                                                        <td><?= date('d-m-Y', strtotime($p['tgl_masuk'])) ?></td>
                                                        <?php if ($p['status'] == 0) : ?>
                                                            <td>Belum Validasi</td>
                                                        <?php elseif ($p['status'] == 1) : ?>
                                                            <td>Telah Upload Bukti Pembayaran</td>
                                                        <?php elseif ($p['status'] == 2) : ?>
                                                            <td>Pembayaran valid</td>
                                                        <?php else : ?>
                                                            <td>Revisi Pembayaran </td>
                                                        <?php endif; ?>
                                                        <td><?= $p['uAdmin'] . '/' . $p['pj_entry'] ?></td>
                                                        <?php if ($p['bukti_foto'] == '') : ?>
                                                            <td>Belum ada bukti bayar</td>
                                                        <?php else : ?>
                                                            <td><a href="<?= base_url("assets/bukti_bayar/" . $p['bukti_foto']); ?>" target="_blank">Lihat Bukti</a></td>
                                                        <?php endif; ?>
                                                        <td><?= rupiah($p['jumlah_bayar']) ?></td>
                                                        <?php $totalPemasukan += $p['jumlah_bayar']; ?>
                                                    </tr>
                                                <?php endforeach ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7">Total Pembayaran</td>
                                                    <!-- <td>Total Pembayaran</td>
                                                    <td>Total Pembayaran</td>
                                                    <td>Total Pembayaran</td>
                                                    <td>Total Pembayaran</td>
                                                    <td>Total Pembayaran</td>
                                                    <td>Total Pembayaran</td> -->

                                                    <td><?= rupiah($totalPemasukan) ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

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