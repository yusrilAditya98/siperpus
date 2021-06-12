<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $card_status['buku_dipinjam']['total'] ?></h3>
              <p>Jumlah Buku Yang Pernah Dipinjam</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="<?= base_url('sirkulasi/Peminjaman/daftar_buku_dipinjam') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $card_status['buku_dibaca']['total'] ?></h3>
              <p>Jumlah Buku Yang Dibaca</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="#" class="small-box-footer" style="cursor:default">.</a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $card_status['pelanggaran_buku']['total'] ?></h3>
              <p>Jumlah Pelanggaran Buku</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="<?= base_url('sirkulasi/Peminjaman/pelanggaran_peminjaman') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- Recall -->
      <?php $i = 1;
      if ($recall != null) : ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-warning text-white"><strong>
                <h3>Pemberitahuan</h3>
              </strong> <br>
              <ol>
                <?php foreach ($recall as $r) : ?>
                  <li><?= 'Nomor Transasksi ' . $r['no_transaksi'] . ' - ' . $r['judul_buku'] . ' [' . $r['keterangan'] . ']' ?></li>
                <?php endforeach ?>
              </ol>
            </div>
          </div>
        </div>
      <?php endif ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Peminjaman Terkini</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-white table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No. Transaksi</th>
                      <th>Judul</th>
                      <th>Penerbit</th>
                      <th>Tgl Peminjaman</th>
                      <th>Jatuh Tempo</th>
                      <th>Hari Terlambat</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($card_peminjaman as $cp) : ?>
                      <tr>
                        <td><?= $index++ ?></td>
                        <td><?= $cp['no_transaksi'] ?></td>
                        <td><?= $cp['judul_buku'] ?></td>
                        <td><?= $cp['penerbit'] ?></td>
                        <td><?= format_tgl($cp['tanggal_mulai']) ?></td>
                        <td><?= format_tgl($cp['tanggal_akhir']) ?></td>
                        <td><?= tgl_selisih(date("Y-m-d"), $cp['tanggal_akhir'], null, $cp['status_sirkulasi']) ?></td>
                        <?php if ($cp['status_sirkulasi'] == 1) { ?>
                          <td><span class="badge badge-primary">proses peminjaman</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 2) { ?>
                          <td><span class="badge badge-warning">sedang dipersiapkan</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 3) { ?>
                          <td><span class="badge badge-info">dapat diambil</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 4) { ?>
                          <td><span class="badge badge-success">dipinjam</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 5) { ?>
                          <td><span class="badge badge-danger">tolak peminjaman</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 6) { ?>
                          <td><span class="badge badge-warning">pelanggaran</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 7) { ?>
                          <td><span class="badge badge-primary">pengajuan perpajangan</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 8) { ?>
                          <td><span class="badge badge-danger">tolak perpanjangan</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 9) { ?>
                          <td><span class="badge badge-success">valid perpanjangan</span></td>
                        <?php } else if ($cp['status_sirkulasi'] == 10) { ?>
                          <td><span class="badge badge-success">selesai pengembalian</span></td>
                        <?php } ?>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->