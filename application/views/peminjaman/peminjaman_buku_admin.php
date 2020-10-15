    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Entri Peminjaman Buku</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Peminjaman Buku</li>
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
                  <form action="../peminjaman/peminjaman_buku_admin" method="get">
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
                          <label>Detail Peminjam</label>
                        </div>
                        <div class="col-sm-12">
                          <div class="card">
                            <div class="card-footer">
                              Profil Peminjam
                            </div>
                            <div class="card-body">
                              <p>Nomor Anggota : <span id="username"><?= $user['username'] ?></span></p>
                              <p>Nama Anggota : <?= $user['nama'] ?></p>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="card">
                            <div class="card-header border-transparent">
                              <h3 class="card-title">Daftar Katalog Buku</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="data2" class="table table-striped table-white" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Register</th>
                                      <th>Judul</th>
                                      <th>Pengarang</th>
                                      <th>Penerbit</th>
                                      <th>Tahun Terbit</th>
                                      <th>Status Buku</th>
                                      <th width="15%">Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody id="show_data_peminjaman_admin">

                                  </tbody>
                                  <!-- <input type="checkbox" name="" id="" class="form-control"> -->
                                </table>
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="card">
                            <div class="card-header border-transparent">
                              <h3 class="card-title">Keranjang Buku Dipinjam</h3>
                              <div class="card-tools">
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button> -->
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-striped table-white" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Register</th>
                                      <th>Judul</th>
                                      <th>Pengarang</th>
                                      <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $i = 1;
                                    foreach ($keranjang_pinjam as $b) : ?>
                                      <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $b['register'] ?></td>
                                        <td><?= $b['judul_buku'] ?></td>
                                        <td><?= $b['pengarang'] ?></td>
                                        <td>
                                          <a href="../peminjaman/hapusPinjam/<?= $b['id_sirkulasi'] ?>?username=<?= $user['username'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                          <!-- <a href="../peminjaman/pinjamBuku/<?= $b['id_sirkulasi'] ?>" class="btn btn-sm btn-success"><i class="fas fa-cart-plus"></i></a> -->
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.table-responsive -->
                              <?php if (count($keranjang_pinjam) != 0) : ?>
                                <div class="card-footer">
                                  <form action="../peminjaman/pinjamSemua?username=<?= $user['username'] ?>" method="post">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                          <label>Tanggal Pinjam</label>
                                          <input type="date" name="tanggal_pinjam" class="form-control" required>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="text-success">*Ajukan Peminjaman</label>
                                          <button type="submit" class="btn btn-success d-block">Pinjam</button>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              <?php endif; ?>

                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-12">
                              <!-- <button class="float-right btn btn-success">Pinjam Buku</button>
                              <button class="float-right btn btn-info mr-2">Jumlah Buku Dipinjam: <span id="jumlah_dipinjam"></span></button> -->
                            </div>
                          </div>
                        </div>


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

    <script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#data2').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            "url": "<?= site_url('sirkulasi/peminjaman/get_ajax_peminjaman') ?>",
            "type": "POST",
            "data": {
              "role_id": "<?= $this->session->userdata('role_id') ?>",
              "username": "<?= $user['username'] ?>",
            }
          },
          "coloumnDefs": [{

          }],
          "order": []
        });
      });
    </script>