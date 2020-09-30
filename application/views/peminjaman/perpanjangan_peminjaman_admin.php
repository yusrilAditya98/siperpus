    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Validasi Perpanjangan Peminjaman</h1>
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

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

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
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Register</th>
                        <th>Judul</th>
                        <th>Peminjam</th>
                        <th>Batas Akhir</th>
                        <th>Waktu Perpanjangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      foreach ($buku_perpanjangan as $b) : ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $b['register'] ?></td>
                          <td><?= $b['judul_buku'] ?></td>
                          <td><?= $b['nama'] ?></td>
                          <td><?= $b['tanggal_pengembalian'] ?></td>
                          <td><?= $b['tanggal_perpanjangan'] ?></td>
                          <?php if ($b['status_sirkulasi'] == 0) { ?>
                            <td><span class="badge bg-info">Diproses</span></td>
                            <td><a href="../peminjaman/validPinjam/<?= $b['id_sirkulasi']?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                              <a href="../peminjaman/tolakPinjam/<?= $b['id_sirkulasi']?>" class="btn btn-danger"><i class="fas fa-times"></i></a></td>
                          <?php } else if ($b['status_sirkulasi'] == 1) { ?>
                            <td><span class="badge bg-success">Diterima</span></td>
                            <td></td>
                          <?php } else if ($b['status_sirkulasi'] == 2) { ?>
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