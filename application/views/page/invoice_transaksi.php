<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Transaksi</title>
    <link rel="stylesheet" href="style.css" media="all" />
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
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
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

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
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

        <h1>BUKTI TRANSAKSI PEMINJAMAN BUKU</h1>
        <div id="company" class="clearfix">
            <img width="100" src="<?= site_url('assets/qrcode/transaksi_' . $buku[0]['no_transaksi'] . '.png') ?>">
            <!-- <div>Fakultas Hukum Univeristas Brawijaya</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div> -->
        </div>
        <div id="project">
            <div><span>NAMA</span><?= $buku[0]['nama'] ?></div>
            <div><span>USERNAME</span><?= $buku[0]['username'] ?></div>
            <div><span>NO TRANSAKSI</span><?= $buku[0]['no_transaksi'] ?></div>
            <div><span>TANGGAL MULAI</span><?= tgl_indo($buku[0]['tanggal_mulai']) ?></div>
            <div><span>TANGGAL SELESAI</span><?= tgl_indo($buku[0]['tanggal_akhir']) ?></div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">NO</th>
                    <th class="desc">REGISTER</th>
                    <th class="desc">JUDUL BUKU</th>
                    <th class="desc">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($buku as $b) : ?>
                    <tr>
                        <td class="service"><?= $i++; ?></td>
                        <td class="desc"><?= $b['register'] ?></td>
                        <td class="desc"><?= $b['judul_buku'] ?></td>
                        <?php if ($b['status_sirkulasi'] == 1) { ?>
                            <td class="desc">proses peminjaman</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 2) { ?>
                            <td class="desc">sedang dipersiapkan</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 3) { ?>
                            <td class="desc">dapat diambil</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 4) { ?>
                            <td class="desc">dipinjam</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 5) { ?>
                            <td class="desc">tolak peminjaman</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 6) { ?>
                            <td class="desc">pelanggaran</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 7) { ?>
                            <td class="desc">pengajuan perpajangan</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 8) { ?>
                            <td class="desc">tolak perpanjangan</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 9) { ?>
                            <td class="desc">valid perpanjangan</span></td>
                        <?php } else if ($b['status_sirkulasi'] == 10) { ?>
                            <td class="desc">selesai pengembalian</span></td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="desc">JUMLAH BUKU</td>
                    <td class="desc"><?= count($buku) ?></td>
                </tr>
            </tbody>
        </table>
        <!-- <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
            <div><img width="100" src="<?= base_url('Cetak/QRtransaksi/' . $buku[0]['no_transaksi']) ?>" alt=""></div>
        </div> -->
    </main>
    <footer>
        <!-- Invoice was created on a computer and is valid without the signature and seal. -->
    </footer>
    <script>
        window.print();
    </script>
</body>

</html>