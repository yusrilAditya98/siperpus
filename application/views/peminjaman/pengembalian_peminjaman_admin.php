    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Entri Pengembalian Peminjaman</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Pengembalian Peminjaman</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <?php if ($this->session->flashdata('success')) : ?>
        <input type="hidden" class="toasterSuccess" value="<?= $this->session->flashdata('success')  ?>">
      <?php else : ?>
        <input type="hidden" class="toasterDanger" value="<?= $this->session->flashdata('danger')  ?>">
      <?php endif; ?>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form action="../peminjaman/pengembalian_peminjaman_admin" method="get">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>Masukkan Nomor Anggota</label>
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="Nomor Anggota" name="username">
                      </div>
                      <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
          <?php if ($user != null) : ?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <?php if ($user != 'Kosong') : ?>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label>Detail Peminjaman</label>
                        </div>
                        <div class="col-sm-12">
                          <div class="card">
                            <div class="card-footer">
                              Profil Peminjam
                            </div>
                            <div class="card-body">
                              <p>Nomor Anggota : <?= $user['username'] ?></p>
                              <p>Nama Peminjam : <?= $user['nama'] ?></p>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="card">
                            <div class="card-footer">Daftar Buku Dipinjam</div>
                            <div class="card-body">
                              <?php if ($buku_dipinjam) : ?>
                                <form action="<?= base_url('sirkulasi/peminjaman/kembalikan') ?>" method="post">
                                  <div class="row mb-2">
                                    <div class="col-lg-4">
                                      <select class="form-control" name="pelanggaran" id="pelanggaran">
                                        <option value="">--tidak ada pelanggarang--</option>
                                        <?php foreach ($pelanggaran as $p) : ?>
                                          <option value="<?= $p['id_pelanggaran'] ?>"><?= $p['nama_pelanggaran'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="col-lg-4">
                                      <select class="form-control" name="denda" id="denda">
                                        <option value="">--tidak ada denda--</option>
                                      </select>
                                    </div>
                                    <div class="col-lg-4">
                                      <div class="input-group">
                                        <input type="hidden" name="no_transaksi" id="no_transaksi" value="<?= $buku_dipinjam[0]['no_transaksi'] ?>">
                                        <input type="hidden" name="username" id="username" value="<?= $user['username'] ?>">
                                        <input type="hidden" name="status" value="10">
                                        <input type="text" class="form-control" name="register" id="register" autofocus placeholder="nomer register..." required>
                                        <span class="input-group-append">
                                          <button type="submit" id="validasi_pengembalian" class="btn btn-success btn-flat">validasi</button>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              <?php endif; ?>
                              <div class="table-responsive">
                                <table class="table table-striped table-white" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Register</th>
                                      <th>Judul</th>
                                      <th>Pengarang</th>
                                      <th>Tanggal Peminjaman</th>
                                      <th>Batas Peminjaman</th>
                                      <th>Perpanjangan</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $i = 1;
                                    foreach ($buku_dipinjam as $b) : ?>
                                      <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $b['register'] ?></td>
                                        <td><?= $b['judul_buku'] ?></td>
                                        <td><?= $b['pengarang'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($b['tanggal_mulai'])) ?></td>
                                        <?php if (date('Y-m-d') > $b['tanggal_akhir']) : ?>
                                          <td class="text-danger"><?= ($b['tanggal_akhir'] == '0000-00-00') ? '00-00-0000' : date('d-m-Y', strtotime($b['tanggal_akhir'])); ?></td>
                                        <?php else : ?>
                                          <td class="text-success"><?= ($b['tanggal_akhir'] == '0000-00-00') ? '00-00-0000' : date('d-m-Y', strtotime($b['tanggal_akhir'])); ?></td>
                                        <?php endif; ?>
                                        <?php if ($b['status_sirkulasi'] == 9) : ?>
                                          <?php if (date('Y-m-d') > $b['tanggal_perpanjangan']) : ?>
                                            <td class="text-danger"><?= ($b['tanggal_perpanjangan'] == '0000-00-00') ? '00-00-0000' : date('d-m-Y', strtotime($b['tanggal_perpanjangan'])); ?></td>
                                          <?php else : ?>
                                            <td class="text-success"><?= ($b['tanggal_perpanjangan'] == '0000-00-00') ? '00-00-0000' : date('d-m-Y', strtotime($b['tanggal_perpanjangan'])); ?></td>
                                          <?php endif; ?>
                                        <?php else : ?>
                                          <td>-</td>
                                        <?php endif; ?>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                              </div>

                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-12">
                              <button class="float-right btn btn-success">Kembalikan Buku</button>
                            </div>
                          </div>
                        </div> -->


                      </div>
                    <?php else : ?>
                      <div class="alert alert-warning">Anggota tidak ditemukan</div>
                    <?php endif ?>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
          <?php endif ?>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>



    <!-- /.content-wrapper -->