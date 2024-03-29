<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			</div>
		</div>
	</div>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?= $status['pengajuan'] ?></h3>
							<p>Pengajuan Validasi</p>
						</div>
						<div class="icon">
							<i class="fas fa-book"></i>
						</div>
						<a href="<?= base_url('sirkulasi/Peminjaman/validasi_peminjaman') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?= $status['pinjam'] ?></h3>
							<p>Buku dipinjam</p>
						</div>
						<div class="icon">
							<i class="fas fa-book"></i>
						</div>
						<a href="<?= base_url('sirkulasi/Peminjaman/validasi_peminjaman') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-6">
					<div class="small-box bg-danger text-white">
						<div class="inner text-white">
							<h3><?= $status['pelanggaran'] ?></h3>
							<p>Pelanggaran Buku</p>
						</div>
						<div class="icon ">
							<i class="fas fa-book"></i>
						</div>
						<a href="<?= base_url('sirkulasi/Peminjaman/pelanggaran_peminjaman_admin') ?>" class="small-box-footer "><span class="text-white">More info </span><i class="fas fa-arrow-circle-right text-white"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-6">
					<div class="small-box bg-primary text-white">
						<div class="inner text-white">
							<h3><?= $log_pengunjung ?></h3>
							<p>Jumlah Akses Sistem Hari Ini <?= date('d m Y')?></p>
						</div>
						<div class="icon ">
							<i class="fas fa-user"></i>
						</div>
						<a href="<?= base_url('laporan/pengunjung_web') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-6">
					<div class="small-box bg-warning text-white">
						<div class="inner text-white">
							<h3><?= $pengunjung ?></h3>
							<p>Jumlah Pengunjung Hari Ini <?= date('d m Y')?></p>
						</div>
						<div class="icon">
							<i class="fas fa-user"></i>
						</div>
						<a href="<?= base_url('laporan/pengunjung_perpus') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Jenis Koleksi</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<ul class="nav nav-pills flex-column">
										<?php foreach ($jenis_koleksi as $jk) : ?>
											<li class="nav-item">
												<a href="#" class="nav-link">
													<?= $jk['nama_jenis'] ?>
													<span class="float-right text-primary"><?= $jk['jumlah'] ?></span>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.card-body -->

					</div>
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Status Buku Terkini</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<ul class="products-list product-list-in-card pl-2 pr-2">
								<li class="item">
									<div style="margin-left: 12px;">
										<a href="<?= site_url() ?>sirkulasi/Baca_ditmpt/list" class="product-title">Buku yang sering dibaca ditempat
											<span class="badge badge-warning float-right"><?= ($baca_ditempat) ? $baca_ditempat[0]['jumlah'] : "0"; ?></span></a>
										<span class="product-description">
											<?= ($baca_ditempat) ? $baca_ditempat[0]['judul_buku'] : "-"; ?>
										</span>
									</div>
								</li>
								<li class="item">
									<div style="margin-left: 12px;">
										<a href="<?= site_url() ?>sirkulasi/Peminjaman/daftar_buku_dipinjam" class="product-title">Buku yang sering dipinjam
											<span class="badge badge-warning float-right"><?= ($dipinjam) ? $dipinjam[0]['jumlah'] : "0"; ?></span></a>
										<span class="product-description">
											<?= ($dipinjam) ? $dipinjam[0]['judul_buku'] : "-"; ?>
										</span>
									</div>
								</li>
								<!-- /.item -->
							</ul>
						</div>
						<!-- /.card-body -->
						<!-- <div class="card-footer text-center">
							<a href="javascript:void(0)" class="uppercase">View Detail</a>
						</div> -->
						<!-- /.card-footer -->
					</div>
				</div>

				<!-- Buku Akan Dipinjam Hari Ini  -->
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header border-transparent">
							<h3 class="card-title">Buku Akan Dipinjam Hari Ini | <?= date('d-m-Y') ?></h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table m-0">
									<thead>
										<tr>
											<th>No</th>
											<th>Peminjam</th>
											<th>Register</th>
											<th>Nama Buku</th>
											<th>Pengarang</th>
											<th>Penerbit</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($buku_today) : ?>
											<?php $i = 1; ?>
											<?php foreach ($buku_today as $bt) : ?>
												<tr>
													<td><?= $i++ ?></td>
													<td><i class="fas fa-user mr-2"></i><?= $bt['nama'] ?><br><?= $bt['username'] ?></td>
													<td><?= $bt['register'] ?></td>
													<td><?= $bt['judul_buku'] ?></td>
													<td><?= $bt['pengarang'] ?></td>
													<td>
														<div class="sparkbar" data-color="#00a65a" data-height="20"><?= $bt['penerbit'] ?></div>
													</td>
													<?php if ($bt['status_sirkulasi'] == 2) : ?>
														<td><span class="badge badge-warning">sedang dipersiapkan</span></td>
													<?php else : ?>
														<td><span class="badge badge-info">dapat segera diambil</span></td>
													<?php endif; ?>
												</tr>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="7">
													<h4 class="text-center">Data Buku Hari Ini Tidak Ada</h4>
												</td>
											</tr>
										<?php endif; ?>


									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
						<!-- /.card-body -->
						<div class="card-footer clearfix">
							<a href="<?= base_url('Laporan/peminjaman') ?>" class="btn btn-sm btn-secondary float-right">View Detail</a>
						</div>
						<!-- /.card-footer -->
					</div>
				</div>

				<!-- Top 10 Buku -->
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header border-transparent">
							<h3 class="card-title">Top 10 Buku sampai Hari Ini | <?= date('d-m-Y') ?></h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table m-0">
									<thead>
										<tr>
											<th>No</th>
											<th>Judul Buku</th>
											<th>Jumlah Pinjam</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($top10_buku) : ?>
											<?php $i = 1; ?>
											<?php foreach ($top10_buku as $b10) : ?>
												<tr class="text-center">
													<td><?= $i++ ?></td>
													<td><?= $b10['judul'] ?></td>
													<td><?= $b10['jumlah_pinjam'] ?></td>
												</tr>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="7">
													<h4 class="text-center">Data Buku Hari Ini Tidak Ada</h4>
												</td>
											</tr>
										<?php endif; ?>


									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
						<!-- /.card-body -->
						<div class="card-footer clearfix">
							<a href="<?= base_url('Laporan/koleksi_sering_dipinjam') ?>" class="btn btn-sm btn-secondary float-right">View Detail</a>
						</div>
						<!-- /.card-footer -->
					</div>
				</div>

				<!-- Top 10 Buku -->
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header border-transparent">
							<h3 class="card-title">Top 10 Pelanggaran (Denda) sampai Hari Ini | <?= date('d-m-Y') ?></h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table m-0">
									<thead>
										<tr>
											<th>No</th>
											<th>No Anggota</th>
											<th>Nama</th>
											<th>Jumlah Pelanggaran</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($top10_denda) : ?>
											<?php $i = 1; ?>
											<?php foreach ($top10_denda as $d10) : ?>
												<tr class="text-center">
													<td><?= $i++ ?></td>
													<td><?= $d10['username'] ?></td>
													<td><?= $d10['nama'] ?></td>
													<td><?= $d10['jumlah_denda'] ?></td>
												</tr>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="7">
													<h4 class="text-center">Denda Buku Hari Ini Tidak Ada</h4>
												</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
						<!-- /.card-body -->
						<div class="card-footer clearfix">
							<a href="<?= base_url('Laporan/sangsi') ?>" class="btn btn-sm btn-secondary float-right">View Detail</a>
						</div>
						<!-- /.card-footer -->
					</div>
				</div>
			</div>

		</div>
		<!-- /.container-fluid -->
	</section>
</div>