    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Daftar Stock Opname</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Stock Opname</li>
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
                            Halaman ini berisikan list dari stock opname
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= base_url('Laporan/stock_opname') ?>" method="get">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar mr-2"></i>Mulai</span>
                                                </div>
                                                <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Username">
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
                                                <th>Keterangan</th>
                                                <th>Tanggal Opname</th>
                                                <th>Jumlah Stock Opname</th>
                                                <?php foreach ($data_status_buku as $sb) : ?>
                                                    <th>
                                                        Tercatat <?= ucwords($sb['nama_status']) ?>
                                                    </th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($data_opname); $i++) : ?>
                                                <?php $temp_opname = explode("/", $data_opname[$i]) ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $temp_opname[1] ?></td>
                                                    <td><?= date('d-m-Y', strtotime($temp_opname[2])) ?></td>
                                                    <?php if ($count_opname[$temp_opname[0]][0] != null) : ?>
                                                        <td><?= count($count_opname[$temp_opname[0]]) ?></td>
                                                        <?php foreach ($data_status_buku as $sb) : ?>
                                                            <?php $count[$sb['id_status']] = []; ?>
                                                            <?php for ($z = 0; $z < count($count_opname[$temp_opname[0]]); $z++) : ?>
                                                                <?php if ($sb['id_status'] == $count_opname[$temp_opname[0]][$z]) : ?>
                                                                    <?php $count[$sb['id_status']][] = 1; ?>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                            <td>
                                                                <?= array_sum($count[$sb['id_status']]) ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <td>0</td>
                                                        <?php foreach ($data_status_buku as $sb) : ?>
                                                            <td>
                                                                0
                                                            </td>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

                                                </tr>
                                            <?php endfor; ?>
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