<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Perpustakaan FH UB | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("plugins/fontawesome-free/css/all.min.css") ?> ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") ?> ">
    <!-- Toaster -->
    <link rel="stylesheet" href="<?= base_url("plugins/toastr/toastr.min.css")  ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url("plugins/icheck-bootstrap/icheck-bootstrap.min.css")  ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url("plugins/jqvmap/jqvmap.min.css") ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/css/adminlte.min.css") ?> ">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") ?> ">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url("plugins/daterangepicker/daterangepicker.css") ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url("plugins/summernote/summernote-bs4.css") ?>">
    <!-- <link rel="stylesheet" href="<?= base_url("plugins/datatables/dataTables.bootstrap4.css") ?>" /> -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/css/style2.css") ?> ">
    <style>
        td {
            height: 50px;
            width: 50px;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body onload="window.print()" class="hold-transition sidebar-mini layout-fixed">

    <div class="container mt-4">
        <!-- <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="print" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </div>
            <hr>
        </div> -->
        <div class="cetak">
            <div class="row justify-content-center">
                <?php $a = 0; ?>
                <?php for ($i = 0; $i < count($cetak_buku); $i++) : ?>
                    <?php $cetak = explode('^', $cetak_buku[$i]) ?>
                    <?php if ($cetak[4] == '1') : ?>
                        <?php $a++ ?>

                        <div class="col-lg-6 col-6">
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <h5> <b>PERPUSTAKAAN FH UB</b></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:65%">
                                            <b><?= $cetak[1] ?></b>
                                            <br>
                                            <img height="100" class="pt-2" src="<?= site_url('data/Buku/QRcode/' . $cetak[0]) ?>">
                                            <br>
                                            <b>*<?= $cetak[0] ?>*</b>
                                        </td>
                                        <td>
                                            <h5><b><?= $cetak[2] ?></b></h5>
                                            <h5><b><?= $cetak[3] ?></b></h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <?php if ($cetak[5] == '1') : ?>
                        <?php $a++ ?>

                        <div class="col-lg-6 col-6">
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <h5> <b>PERPUSTAKAAN FH UB</b></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:65%">
                                            <b><?= $cetak[1] ?></b>
                                            <br>
                                            <img height="100" class="pt-2" src="<?= site_url('data/Buku/Barcode/' . $cetak[0]) ?>">
                                        </td>
                                        <td>
                                            <h5><b><?= $cetak[2] ?></b></h5>
                                            <h5><b><?= $cetak[3] ?></b></h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <?php if ($a == 10) : ?>
                        <div class="col-lg-12 mt-5">
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>

            </div>

        </div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url("plugins/jquery-ui/jquery-ui.min.js") ?> "></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <!-- ChartJS -->
    <script src="<?= base_url("plugins/chart.js/Chart.min.js") ?>"></script>
    <!-- Toaster -->
    <script src="<?= base_url("plugins/toastr/toastr.min.js") ?>"></script>

    <!-- daterangepicker -->
    <script src="<?= base_url("plugins/moment/moment.min.js") ?>"></script>
    <script src="<?= base_url("plugins/daterangepicker/daterangepicker.js") ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") ?>"></script>
    <!-- Summernote -->
    <script src="<?= base_url("plugins/summernote/summernote-bs4.min.js") ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("assets/js/adminlte.js") ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url("assets/js/pages/dashboard.js") ?>"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- <script src="<?= base_url("plugins/datatables/dataTables.bootstrap4.js") ?>"></script> -->
    <!-- <script src="<?= base_url("plugins/datatables/jquery.dataTables.js") ?>"></script> -->
    <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

    <!-- my script -->
    <script src="<?= base_url("assets/js/alluser.js") ?>"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#data').DataTable();
        });

        $('#print').click(function() {
            // $('.btn').remove();
            Popup($('.cetak')[0].outerHTML);

            function Popup(data) {
                window.print();
                return true;
            }
        });

        if ($('.toasterSuccess').val()) {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Berhasil',

                body: $('.toasterSuccess').val()
            })

        }

        if ($('.toasterDanger').val()) {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Gagal',

                body: $('.toasterDanger').val()
            })
        }
    </script>
</body>

</html>