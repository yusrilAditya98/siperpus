<html>

<head>
	<title>Invoice Pembayaran</title>
	<style>
		#tabel {
			font-size: 15px;
			border-collapse: collapse;
		}

		#tabel td {
			padding-left: 5px;
			border: 1px solid black;
		}
	</style>
	<?php

	// FUNGSI TERBILANG OLEH : MALASNGODING.COM
	// WEBSITE : WWW.MALASNGODING.COM
	// AUTHOR : https://www.malasngoding.com/author/admin


	function penyebut($nilai)
	{
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " " . $huruf[$nilai];
		} else if ($nilai < 20) {
			$temp = penyebut($nilai - 10) . " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
		} else if ($nilai == 0) {
			$temp = "nol";
		}
		return $temp;
	}

	function terbilang($nilai)
	{
		if ($nilai < 0) {
			$hasil = "minus " . trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}
		return $hasil;
	}
	?>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
	<center>
		<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
			<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
				<span style='font-size:12pt'><b>PERPUSTAKAAN FAKULTAS HUKUM UB</b></span></br>
				Nama / Username : <?= $transaksi['uAnggota'] . "/" . $transaksi['u_username'] ?></br>
				Program Studi : <?= $transaksi['prodiUser'] ?></br>
				Tanggal Proses Pelanggaran : <?= date("d-m-Y", strtotime($transaksi['tgl_masuk']))  ?></br>
			</td>
			<td style='vertical-align:top' width='30%' align='left'>
				<b><span style='font-size:12pt'>Invoice Pembayaran</span></b></br>
				No Transaksi : <?= $transaksi['no_transaksi'] ?></br>
				Keterangan : <?= $transaksi['keterangan'] ?><br>
				Status : <?php if ($transaksi['status'] == 0) : ?>
					Belum Validasi
				<?php elseif ($transaksi['status'] == 1) : ?>
					Telah Upload Bukti Pembayaran
				<?php elseif ($transaksi['status'] == 2) : ?>
					Pembayaran valid
				<?php else : ?>
					Revisi Pembayaran
				<?php endif; ?> <br>


			</td>
		</table>
		<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
			<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>

			</td>
		</table>
		<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

			<tr align='center'>
				<th>No</th>
				<th>No Register</th>
				<th>Judul Buku</th>
				<th>Tanggal Pinjam</th>
				<th>Batas Pengembalian</th>
				<th>Tanggal Dikembalikan</th>
				<th>Tanggal Perpanjangan</th>
				<th>Pelanggaran</th>
				<th>Denda</th>
				<th>Cost (Rp)</th>
			</tr>
			<?php $index = 1; ?>
			<?php $totalCost = 0; ?>
			<?php foreach ($sirkulasi as $s) : ?>
				<tr>
					<td align='center'><?= $index++ ?></td>
					<td align='center'><?= $s['b_register'] ?></td>
					<td><?= $s['judul_buku'] ?></td>
					<td align='center'><?= date('d-m-Y', strtotime($s['tanggal_mulai'])) ?></td>
					<td align='center'><?= date('d-m-Y', strtotime($s['tanggal_akhir'])) ?></td>
					<td align='center'><?= date('d-m-Y', strtotime($s['tanggal_pengembalian'])) ?></td>
					<?php if ($s['tanggal_perpanjangan'] == '0000-00-00') : ?>
						<td align='center'>Tidak perpanjangan</td>
					<?php else : ?>
						<td align='center'><?= date('d-m-Y', strtotime($s['tanggal_perpanjangan'])) ?></td>
					<?php endif; ?>
					<td><?= $s['pelanggaran'] ?></td>
					<td align='center'><?= $s['denda'] ?></td>
					<td align='center'><?= number_format($s['jumlah_bayar'], 2, ',', '.'); ?></td>
					<?php $totalCost +=  $s['jumlah_bayar']; ?>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="9">Total
				</td>
				<td><?= number_format($totalCost, 2, ',', '.');  ?></td>
			</tr>
			<tr>
				<td colspan='10'>
					<div style='text-align:right'>Terbilang : <?= terbilang($totalCost) ?></div>
				</td>
			</tr>
		</table>
		<table style='width:650; font-size:7pt;' cellspacing='2'>
			<tr>
				<td align='center'>Diterima Oleh,</br></br></br></br><u>(............)</u></td>
				<td style='width:30%'>
					<img src="<?= base_url('sirkulasi/Pembayaran/QRcode/' . $transaksi['no_transaksi']) ?>" alt="">
				</td>
				<td align='center'>TTD,</br></br></br></br><u>(...........)</u></td>
			</tr>
		</table>
	</center>
	<script>
		window.print();
	</script>
</body>

</html>