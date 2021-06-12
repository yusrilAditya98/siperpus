<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Transaksi</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            /* text-align: center; */
            margin-bottom: 10px;
        }

        #logo img {
            width: 800px;
        }

        h1 {
            /* border-top: 1px solid #5D6975; */
            /* border-bottom: 1px solid #5D6975; */
            color: #000;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        h5 {
            color: #000;
            font-size: 1.4em;
            line-height: 1.4em;
            font-weight: normal;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 100px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }


        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
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

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
    <header class="clearfix">
        <div id="logo">
            <img src="<?= site_url() ?>assets/img/kopSurat/<?= $kop_surat[0]['nama_file'] ?>" alt="" srcset="">
        </div>
        <?php if ($status == 'bebas') : ?>
            <h1 class="text-center pt-4"> SURAT KETERANGAN </h1>
            <!-- <h4 class="text-center">No: </h4> -->
            <h5 class="p-5">
                Menerangkan bahwa Mahasiswa dibawah ini tidak mempunyai tunggakan pinjaman buku maupun administrasi Ruang Baca FHUB.
            </h5>
        <?php else : ?>
            <h1 class="text-center"> SURAT STATUS PEMINJAMAN BUKU </h1>
            <!-- <h4 class="text-center">No: </h4> -->
            <h5 class="p-5">
                Menerangkan bahwa mahasiswa tersebut di bawah ini masih mempunyai tanggungan pinjaman buku di Ruang Baca FHUB.
            </h5>
        <?php endif; ?>
        <!-- <h1>SURAT KETERANGAN</h1> -->
        <div id="company" class="clearfix">
            <!-- <img width="100" src="<?= site_url('assets/qrcode/transaksi_' . $buku[0]['no_transaksi'] . '.png') ?>"> -->
            <!-- <div>Fakultas Hukum Univeristas Brawijaya</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div> -->
        </div>
        <div id="project">
            <!-- <div><span>NAMA</span><?= $buku[0]['nama'] ?></div>
            <div><span>USERNAME</span><?= $buku[0]['username'] ?></div>
            <div><span>NO TRANSAKSI</span><?= $buku[0]['no_transaksi'] ?></div>
            <div><span>TANGGAL MULAI</span><?= tgl_indo($buku[0]['tanggal_mulai']) ?></div>
            <div><span>TANGGAL SELESAI</span><?= tgl_indo($buku[0]['tanggal_akhir']) ?></div> -->
        </div>
    </header>
    <main>
        <table>
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
        <br><br>
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
                        <td style="width:72%">
                        </td>
                        <td style="width:28% text-center">
                            <h5>Malang, <?= date("d F Y") ?></h5>
                            <h5>Petugas Ruang Baca FHUB</h5>
                            <!-- <?php $link = base_url() . 'Cetak/bebas_pustaka_view/' . $mhs['username'] . '/' . $status ?> -->
                            <!-- <img width="150" src="<?= site_url('Cetak/QRPustaka/' . $link) ?>"> -->
                            <img width="150" src="<?= site_url('assets/qrcode/bebaspustaka_' . $mhs['username'] . '_' . $status . '.png') ?>">
                            <h5><?= $petugas[0]['nama'] ?></h5>
                            <?php if ($petugas[0]['jenis_no_induk'] == 1) : ?>
                                <h5>NIK.<?= $petugas[0]['no_induk'] ?></h5>
                            <?php else : ?>
                                <h5>NIP.<?= $petugas[0]['no_induk'] ?></h5>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
    </footer>
    <!-- jQuery -->
    <script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url("plugins/jquery-ui/jquery-ui.min.js") ?> "></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script>
        window.print();
    </script>
</body>

</html>