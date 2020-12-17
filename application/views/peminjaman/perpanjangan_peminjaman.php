    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Perpanjangan Peminjaman</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Perpanjangan Peminjaman</li>
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
              <button class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Ajukan Perpanjangan Peminjaman</button>
            </div>
            <div class="col-sm-12">
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                Halaman ini berisikan list dari Buku yang dilakukan perpanjangan peminjaman
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form action="<?= base_url('sirkulasi/Peminjaman/perpanjangan_peminjaman') ?>" method="get">
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
                        // 7 pengajuan perpajangan
                        // 8 tolak perpanjangan
                        // 9 valid perpanjangan -->
                      <div class="col-lg-4">
                        <div class="input-group">
                          <select name="status_sirkulasi" id="status_sirkulasi" class="form-control">
                            <option value="99">-- status --</option>
                            <option value="7">pengajuan perpanjangan</option>
                            <option value="8">tolak perpanjangan</option>
                            <option value="9">valid perpanjang</option>
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

          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Perpanjangan Peminjaman</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="data">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Register</th>
                          <th>Judul</th>
                          <th>Batas Akhir</th>
                          <th>Waktu Perpanjangan</th>
                          <th>Status</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                        foreach ($buku_perpanjangan as $b) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $b['register'] ?></td>
                            <td><?= $b['judul_buku'] ?></td>
                            <td><?= date('d-m-Y', strtotime($b['tanggal_akhir'])) ?></td>
                            <td><?= date('d-m-Y', strtotime($b['tanggal_perpanjangan'])) ?></td>
                            <?php if ($b['status_sirkulasi'] == 7) { ?>
                              <td><span class="badge bg-primary">pengajuan perpanjangan</span></td>
                            <?php } else if ($b['status_sirkulasi'] == 8) { ?>
                              <td><span class="badge bg-danger">tolak perpanjangan</span><br>
                                <p>Harap buku segera dikembalikan sebelum batas akhir</p>
                              </td>
                            <?php } else if ($b['status_sirkulasi'] == 9) { ?>
                              <td><span class="badge bg-success">valid perpanjangan</span></td>
                            <?php } else { ?>
                            <?php } ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->


        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Perpanjangan Peminjaman</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="../Peminjaman/perpanjangan/" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="kode_pinjam">Register</label>
                <select name="sirkulasi" id="kode_pinjam" class="form-control">
                  <option value="" selected hidden>Pilih Register...</option>
                  <?php foreach ($pinjaman as $p) : ?>
                    <option value="<?= $p['id_sirkulasi'] ?>"><?= $p['register'] . ' - ' . $p['judul_buku'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-success">Ajukan Perpanjangan</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- /.content-wrapper -->