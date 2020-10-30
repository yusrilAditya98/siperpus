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
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
    <div class="wrapper">