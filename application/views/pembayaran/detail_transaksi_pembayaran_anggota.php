    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Pembayaran</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
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
                Halaman ini berisikan detail transaksi pelanggaran yang dilakukan oleh mahasiswa
              </div>
            </div>

            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="<?= base_url('sirkulasi/Pembayaran/uploadPembayaran') ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="no_transaksi" value="<?= $transaksi['no_transaksi'] ?>">
                      <input type="hidden" name="status" value="<?= $transaksi['status'] ?>">
                      <table class="table table-striped table-white table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th colspan="2">Informasi Detail Pelanggarang</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>No Transaksi</td>
                            <td>:<?= $transaksi['no_transaksi'] ?></td>
                          </tr>
                          <tr>
                            <td>Nama / Username</td>
                            <td>:<?= $transaksi['uAnggota'] . "/" . $transaksi['u_username'] ?></td>
                          </tr>
                          <tr>
                            <td>Program Studi</td>
                            <td>:<?= $transaksi['prodiUser'] ?></td>
                          </tr>
                          <tr>
                            <td>Tanggal Proses Pelanggaran</td>
                            <td>:<?= $transaksi['tgl_masuk'] ?></td>
                          </tr>
                          <tr>
                            <td>Operator Entry / ID</td>
                            <td>:<?= $transaksi['uAdmin'] . "/" . $transaksi['pj_entry'] ?></td>
                          </tr>
                          <tr>
                            <td>Bukti Foto - <input type="file" name="bukti_foto"></td>
                            <?php if ($transaksi['bukti_foto'] == '') : ?>
                              <td>:Belum ada bukti bayar</td>
                            <?php else : ?>
                              <td><a href="<?= base_url("assets/bukti_bayar/" . $transaksi['bukti_foto']); ?>" target="_blank">:Lihat Bukti</a></td>
                            <?php endif; ?>
                          </tr>
                          <tr>
                            <td>Keterangan</td>
                            <td>:<?= $transaksi['keterangan'] ?></td>
                          </tr>
                          <tr>
                            <td>Status</td>
                            <?php if ($transaksi['status'] == 0) : ?>
                              <td>:Belum Validasi</td>
                            <?php elseif ($transaksi['status'] == 1) : ?>
                              <td>:Telah Upload Bukti Pembayaran</td>
                            <?php elseif ($transaksi['status'] == 2) : ?>
                              <td>:Pembayaran valid</td>
                            <?php else : ?>
                              <td>:Revisi Pembayaran </td>
                            <?php endif; ?>
                          </tr>
                          <tr>
                            <td>Invoice</td>
                            <td><a target="_blank" href="<?= base_url('sirkulasi/Pembayaran/invoicePembayaran/' . $transaksi['no_transaksi']) ?>">Cetak Invoice</a> </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table table-striped table-white table-bordered table-sm" style="width:100%">
                        <thead>
                          <tr>
                            <th colspan="10">Informasi Detail Pelanggarang</th>
                          </tr>
                          <tr>
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
                        </thead>
                        <tbody>
                          <?php $index = 1; ?>
                          <?php $totalCost = 0; ?>
                          <?php foreach ($sirkulasi as $s) : ?>
                            <input type="hidden" name="id_sirkulasi[]" value="<?= $s['id_sirkulasi'] ?>">
                            <tr>
                              <td><?= $index++ ?></td>
                              <td><?= $s['b_register'] ?></td>
                              <td><?= $s['judul_buku'] ?></td>
                              <td><?= date('d-m-Y', strtotime($s['tanggal_mulai'])) ?></td>
                              <td><?= date('d-m-Y', strtotime($s['tanggal_akhir'])) ?></td>
                              <td><?= date('d-m-Y', strtotime($s['tanggal_pengembalian'])) ?></td>
                              <?php if ($s['tanggal_perpanjangan'] == '0000-00-00') : ?>
                                <td>Tidak perpanjangan</td>
                              <?php else : ?>
                                <td><?= date('d-m-Y', strtotime($s['tanggal_perpanjangan'])) ?></td>
                              <?php endif; ?>
                              <td><?= $s['pelanggaran'] ?></td>
                              <td><?= $s['denda'] ?></td>
                              <td><?= rupiah($s['jumlah_bayar']) ?></td>
                              <?php $totalCost +=  $s['jumlah_bayar']; ?>
                            </tr>
                          <?php endforeach; ?>
                          <tr>
                            <td colspan="9">Total
                            </td>
                            <td><?= rupiah($totalCost) ?></td>
                            <input type="hidden" name="jumlah_bayar" value="<?= $totalCost ?>">
                          </tr>
                          <tr>
                            <td colspan="10">
                              <a href="<?= base_url('sirkulasi/Pembayaran/pembayaran_denda_anggota') ?>" class="btn btn-secondary">Kembali</a>
                              <?php if ($transaksi['status'] == 0 || $transaksi['status'] == 3) : ?>
                                <button type="submit" class="btn btn-primary">Upload Bukti Pembayaran</button>
                              <?php endif; ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>