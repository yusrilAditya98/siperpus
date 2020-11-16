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
        .borderless td,
        .borderless th {
            border: none;
        }
    </style>
</head>

<body onload="window.print()" class="hold-transition sidebar-mini layout-fixed">

    <div class="container mt-5">
        <!-- <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="print" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </div>
            <hr>
        </div> -->
        <div class="cetak">
            <div class="row justify-content-center">
                <img src="<?= site_url() ?>assets/img/header_bebas_pustaka.jpg" alt="" srcset="">
            </div>
            <?php if ($status == 'bebas') : ?>
                <h3 class="text-center pt-4"> SURAT KETERANGAN </h3>
                <h4 class="text-center">No: </h4>
                <h5 class="p-5">
                    Menerangkan bahwa Mahasiswa dibawah ini tidak mempunyai tunggakan pinjaman buku maupun administrasi Ruang Baca FHUB.
                </h5>
            <?php else : ?>
                <h3 class="text-center"> SURAT STATUS PEMINJAMAN BUKU </h3>
                <h4 class="text-center">No: </h4>
                <h5 class="p-5">
                    Menerangkan bahwa mahasiswa tersebut di bawah ini masih mempunyai tanggungan pinjaman buku di Ruang Baca FHUB
                </h5>
            <?php endif; ?>
            <div class="row pl-5 pr-5">
                <table class="table border-0 borderless" style="border:0">
                    <tbody>
                        <tr>
                            <td style="width:15%">
                                <h5>Nama </h5>
                            </td>
                            <td style="width:60%">
                                <h5> : <?= ucfirst($mhs['nama']) ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <h5>NIM </h5>
                            </td>
                            <td style="width:60%">
                                <h5> : <?= ucfirst($mhs['username']) ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <h5>Program Studi </h5>
                            </td>
                            <td style="width:60%">
                                <h5> : <?= str_replace("S1", "Sarjana", $mhs['nama_prodi']) ?></h5>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <?php if ($status == 'bebas') : ?>
                <h5 class="p-5">
                    Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
                </h5>
            <?php else : ?>
                <h5 class="p-5">
                    Demikian Surat Keterangan ini dibuat, untuk dipergunakan sebagai prasyarat mengikuti <strong>Yudisium</strong>.
                </h5>
                <p>
                    *) Diharap menyelesaikan semua pinjaman ketika akan mengikuti Wisuda
                </p>
            <?php endif; ?>
            <div class="row pl-5 pr-5">
                <table class="table border-0 borderless" style="border:0">
                    <tbody>
                        <tr>
                            <td style="width:60%">
                            </td>
                            <td style="width:40%">
                                <h5>Malang, <?= date("d F Y") ?></h5>
                                <h5>Petugas Ruang Baca FHUB</h5>
                                <img src="<?= site_url() ?>assets/img/ttd_bebas_pustaka.jpg">
                                <h5>Mar’atun Sholikhah A.Md</h5>
                                <h5>NIK.2012058704292001</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
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