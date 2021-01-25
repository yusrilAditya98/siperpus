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
                <li class="breadcrumb-item active"><?= $title?></li>
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
                Halaman ini berisikan list transaksi pelanggaran yang dilakukan oleh mahasiswa
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form action="<?= base_url('sirkulasi/Peminjaman/daftar_buku_dipinjam') ?>" method="get">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar mr-2"></i>Mulai</span>
                          </div>
                          <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Username">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar mr-2"></i>Selesai</span>
                          </div>
                          <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Username">
                        </div>
                      </div>
                      <!-- // status sirkulasi terdiri dari
                        // 0 Keranjang peminjaman
                        // 1 proses peminjaman
                        // 2 sedang dipersiapkan
                        // 3 dapat diambil
                        // 4 pinjam
                        // 5 tolak peminjaman
                        // 6 pelanggaran
                        // 7 pengajuan perpajangan
                        // 8 tolak perpanjangan
                        // 9 valid perpanjangan
                        // 10 selesai pengembalian -->
                      <div class="col-lg-4">
                        <div class="input-group">
                          <select name="status_sirkulasi" id="status_sirkulasi" class="form-control">
                            <option value="99">-- status --</option>
                            <option value="2">sedang dipersiapkan</option>
                            <option value="3">dapat diambil</option>
                            <option value="4">pinjam</option>
                            <option value="5">tolak peminjaman</option>
                            <option value="6">pelanggaran</option>
                            <option value="7">pengajuan perpanjangan</option>
                            <option value="8">tolak perpanjangan</option>
                            <option value="9">valid perpanjang</option>
                            <option value="10">selesai pengembalian</option>

                          </select>
                          <div class="input-group-prepend">
                            <button class="btn btn-primary" type="submit">Go!</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-striped table-white table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>No Transaksis</th>
                          <th>Nama / Username</th>
                          <th>Tanggal Masuk</th>
                          <th>Status</th>
                          <th>Operator Entry / ID</th>
                          <th>Bukti Foto</th>
                          <th>Jumlah Bayar</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $index = 1; ?>
                          <?php foreach($pembayaran as $p): ?>
                          <tr>
                            <td><?= $index++?></td>
                            <td><a href="<?= base_url("Pembayaran/detail_transaksi_pembayaran")?>"><?= $p['no_transaksi']?></a></td>
                            <td><?= $p['uAnggota'].'/'.$p['u_username']?></td>
                            <td><?= date('d-m-Y', strtotime($p['tgl_masuk']))?></td>
                            <?php if($p['status']== 0):?>
                              <td>Belum Validasi</td>
                            <?php else:?>
                              <td>Selesai Validasi</td>
                            <?php endif;?>
                            <td><?= $p['uAdmin'].'/'.$p['pj_entry']?></td>
                            <?php if($p['bukti_foto'] == ''):?>
                              <td>Belum ada bukti bayar</td>
                            <?php else:?>
                              <td><a href="<?= base_url("bukti_bayar/".$p['bukti_foto']);?>" target="_blank">Lihat Bukti</a></td>
                            <?php endif;?>
                            <td><?= $p['jumlah_bayar']?></td>
                          </tr>
                          <?php endforeach ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>