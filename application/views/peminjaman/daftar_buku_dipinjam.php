    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Daftar Buku Dipinjam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Daftar Buku Dipinjam</li>
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
                Halaman ini berisikan list dari semua buku yang telah dipinjam oleh anggota
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
                          <?php if ($this->session->userdata('role_id') == 'role_id_1') : ?>
                            <th>Username</th>
                            <th>Nama</th>
                          <?php endif; ?>
                          <th>Register</th>
                          <th>Judul</th>
                          <th>Pengarang</th>
                          <th>Tanggal Peminjaman</th>
                          <th>Batas Peminjaman</th>
                          <th>Tanggal Pengembalian</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php $i = 1;
                        foreach ($buku_dipinjam as $b) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <?php if ($this->session->userdata('role_id') == 'role_id_1') : ?>
                              <td><?= $b['username'] ?></td>
                              <td><?= $b['nama'] ?></td>
                            <?php endif; ?>
                            <td><?= $b['register'] ?></td>
                            <td><?= $b['judul_buku'] ?></td>
                            <td><?= $b['pengarang'] ?></td>
                            <td><?= date('d-m-Y', strtotime($b['tanggal_mulai'])) ?></td>
                            <td><?= date('d-m-Y', strtotime($b['tanggal_akhir'])) ?></td>
                            <td><?= ($b['tanggal_pengembalian'] == '0000-00-00') ? '<span class="badge badge-warning p-2">Belum Dikembalikan</span>' : date('d-m-Y', strtotime($b['tanggal_pengembalian'])); ?></td>
                            <?php if ($b['status_sirkulasi'] == 2) { ?>
                              <td><span class="badge badge-success">Peminjaman</span></td>
                            <?php } else if ($b['status_sirkulasi'] == 1) { ?>
                              <td><span class="badge badge-warning">Proses</span></td>
                            <?php } else if ($b['status_sirkulasi'] == 7) { ?>
                              <td><span class="badge badge-info">Perpanjangan</span></td>
                            <?php } else if ($b['status_sirkulasi'] == 8) { ?>
                              <td><span class="badge badge-secondary">Dikembalikan</span></td>
                            <?php } else if ($b['status_sirkulasi'] == 4 || $b['status_sirkulasi'] == 9) { ?>
                              <td><span class="badge badge-danger">Telat</span></td>
                            <?php } else if ($b['status_sirkulasi'] == 3) { ?>
                              <td><span class="badge badge-danger">Ditolak</span></td>
                            <?php } else { ?>
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
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>