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
                              <div class="table-responsive">
                                <table  class="table table-striped table-white" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Register</th>
                                      <th>Judul</th>
                                      <th>Pengarang</th>
                                      <th>Tanggal Peminjaman</th>
                                      <th>Batas Peminjaman</th>
                                      <th>Aksi</th>
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
                                        <td><?= ($b['tanggal_akhir'] == '0000-00-00') ? '00-00-0000' : date('d-m-Y', strtotime($b['tanggal_akhir'])); ?></td>
                                        <td><a href="../peminjaman/kembalikan/<?= $b['id_sirkulasi'] ?>?username=<?= $user['username']?>" class="btn btn-sm btn-success"><i class="fas fa-undo"></i></a></td>
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