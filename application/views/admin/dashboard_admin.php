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
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-6">
					<div class="small-box bg-warning text-white">
						<div class="inner text-white">
							<h3><?= $status['telat'] ?></h3>
							<p>Buku Telat Pengembalian</p>
						</div>
						<div class="icon ">
							<i class="fas fa-book"></i>
						</div>
						<a href="#" class="small-box-footer "><span class="text-white">More info </span><i class="fas fa-arrow-circle-right text-white"></i></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Jeni Koleksi</h3>
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
										<a href="javascript:void(0)" class="product-title">Buku yang sering dibaca ditempat
											<span class="badge badge-warning float-right"><?= ($baca_ditempat) ? $baca_ditempat[0]['jumlah'] : "0"; ?></span></a>
										<span class="product-description">
											<?= ($baca_ditempat) ? $baca_ditempat[0]['judul_buku'] : "-"; ?>
										</span>
									</div>
								</li>
								<li class="item">
									<div style="margin-left: 12px;">
										<a href="javascript:void(0)" class="product-title">Buku yang sering dipinjam
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
						<div class="card-footer text-center">
							<a href="javascript:void(0)" class="uppercase">View All Products</a>
						</div>
						<!-- /.card-footer -->
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header border-transparent">
							<h3 class="card-title">Buku Akan Dipinjam Hari Ini - <?= tgl_indo(date('Y-m-d')) ?></h3>

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
													<td><a href="pages/examples/invoice.html"><?= $bt['register'] ?></a></td>
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
							<a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
						</div>
						<!-- /.card-footer -->
					</div>
				</div>
			</div>

		</div>
		<!-- /.container-fluid -->
	</section>
</div>