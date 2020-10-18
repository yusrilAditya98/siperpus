    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Validasi Peminjaman</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Validasi Peminjaman</li>
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
                <div class="card-header">
                  <h3 class="card-title">Data Peminjaman</h3>

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
                  <table id="example" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Register</th>
                        <th>Judul</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Akhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      foreach ($pinjam_proses as $b) : ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $b['register'] ?></td>
                          <td><?= $b['judul_buku'] ?></td>
                          <td><?= $b['nama'] ?></td>
                          <td><?= date('d-m-Y', strtotime($b['tanggal_mulai'])) ?></td>
                          <td><?= date('d-m-Y', strtotime($b['tanggal_akhir'])) ?></td>
                          <?php if ($b['status_sirkulasi'] == 1) { ?>
                            <td><span class="badge bg-info">Diproses</span></td>
                            <td><a href="../peminjaman/valid_pinjam/<?= $b['id_sirkulasi']?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                              <a href="../peminjaman/tolak_pinjam/<?= $b['id_sirkulasi']?>" class="btn btn-danger"><i class="fas fa-times"></i></a></td>
                          <?php } else if ($b['status_sirkulasi'] == 2) { ?>
                            <td><span class="badge bg-success">Diterima</span></td>
                            <td></td>
                          <?php } else if ($b['status_sirkulasi'] == 3) { ?>
                            <td><span class="badge bg-danger">Ditolak</span></td>
                            <td></td>
                          <?php } else { ?>
                          <?php } ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
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


    <!-- /.content-wrapper -->