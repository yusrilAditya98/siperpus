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
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item">Validasi Peminjaman</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-footer">
                          Profile Peminjam
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <img src="<?= site_url('sirkulasi/peminjaman/QRcode/' . $this->uri->segment(4)) ?>">
                            </div>
                            <div class="col-lg-6">
                              <div class="mt-4">
                                <h6 class="text-secondary mb-n1">Nama</h6>
                                <h2></h2>
                              </div>
                              <div class="mt-4">
                                <h6 class="text-secondary mb-n1">Username</h6>
                                <h2></h2>
                              </div>
                              <div class="mt-4">
                                <h6 class="text-secondary mb-n1">No Transaksi</h6>
                                <h2></h2>
                              </div>
                              <div class="mt-4">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <h6 class="text-secondary mb-n1">Tanggal Mulai</h6>
                                    <h2></h2>
                                  </div>
                                  <div class="col-lg-6">
                                    <h6 class="text-secondary mb-n1">Tanggal Selesai</h6>
                                    <h2></h2>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="row mb-2">
                        <div class="col-lg-6">
                          <h5>Daftar Buku Dipinjam</h5>
                        </div>
                        <div class="col-lg-6">

                          <form action="<?= base_url('sirkulasi/peminjaman/validasiPeminjaman') ?>" method="post">
                            <div class="input-group">
                              <input type="hidden" name="no_transaksi" id="no_transaksi" value="<?= $this->uri->segment(4) ?>">
                              <input type="hidden" name="status" value="4">
                              <input type="text" class="form-control" name="register" id="register" autofocus placeholder="nomer register...">
                              <span class="input-group-append">
                                <button type="submit" id="validasi_peminjaman" class="btn btn-success btn-flat">validasi</button>
                              </span>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-white" style="width:100%">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Register</th>
                              <th>Judul</th>
                              <th>Pengarang</th>
                              <th>Penerbit</th>
                              <th>Tahun Terbit</th>
                              <th>Status</th>
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
                                <td><?= $b['penerbit'] ?></td>
                                <td><?= $b['tahun_terbit'] ?></td>
                                <?php if ($b['status_sirkulasi'] == 3) : ?>
                                  <td><span id="buku_<?= $b['register'] ?>" class="badge badge-info">dapat segera diambil</span></td>
                                <?php elseif ($b['status_sirkulasi'] == 4) : ?>
                                  <td><span id="buku_<?= $b['register'] ?>" class="badge badge-success">dipinjam</span></td>
                                <?php endif; ?>
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
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->