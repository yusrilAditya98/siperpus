    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Pelanggaran Peminjaman</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Pelanggaran Peminjaman</li>
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
            <div class="col-sm-12">
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                Halaman ini berisikan pelanggaran dari peminjaman yang telah dilakukan
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pelanggaran Peminjaman</h3>

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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>No Transaksi</th>
                          <th>Register</th>
                          <th>Judul Buku</th>
                          <th>Jenis Pelanggaran</th>
                          <th>Denda</th>
                          <th>Keterangan</th>
                          <th>Status Pelanggaran</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                        foreach ($buku as $b) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $b['no_transaksi'] ?></td>
                            <td><?= $b['register'] ?></td>
                            <td><?= $b['judul_buku'] ?></td>
                            <td><?= $b['nama_pelanggaran'] ?></td>
                            <td><?= $b['nama_denda'] ?> <?= ' - ' . $b['denda'] ?></td>
                            <td><?= $b['keterangan'] ?></td>
                            <?php if ($b['status_pelanggaran'] == 1) { ?>
                              <td><span class="badge bg-danger">Belum Tuntas</span></td>
                            <?php } else if ($b['status_pelanggaran'] == 2) { ?>
                              <td><span class="badge bg-success">Tuntas</span></td>
                            <?php } ?>
                            <td><button data-toggle="modal" data-target="#modalPelanggaran<?= $b['s_id_sirkulasi']  ?>" class="btn btn-primary btn-sm"><i class="fas fa-info mr-2"></i>detail</button></td>
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
    <?php foreach ($buku as $b) : ?>
      <!-- Modal -->
      <div class="modal fade" id="modalPelanggaran<?= $b['s_id_sirkulasi']  ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPelanggaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-4 col-12">
                  <img class="img-thumbnail" src="<?= base_url('assets/sampul_buku/' . $b['sampul']) ?>">
                  <div class="row pt-4">
                    <div class="col-lg-12 text-center">
                      <img src="<?= site_url('data/Buku/QRcode/' . $b['register'])   ?>">
                    </div>
                    <div class="col-lg-12 text-center">
                      <button class="btn btn-warning mb-2"><i class="fas fa-print mr-2"></i>Cetak</button>
                    </div>

                  </div>
                </div>
                <div class="col-sm-8 col-12">
                  <h5><?= $b['judul_buku'] ?></h5>
                  <p>No Transaksi : <?= $b['no_transaksi'] ?></p>
                  <div class="row">
                    <div class="col-sm-6">
                      Username
                    </div>
                    <div class="col-sm-6">
                      <?= $b['username'] ?>
                    </div>
                  </div>
                  <div class="row bg-light">
                    <div class="col-sm-6">
                      Nama Peminjam
                    </div>
                    <div class="col-sm-6">
                      <?= $b['nama'] ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      Register
                    </div>
                    <div class="col-sm-6">
                      <?= $b['register'] ?>
                    </div>
                  </div>
                  <div class="row bg-light">
                    <div class="col-sm-6">
                      Pengarang
                    </div>
                    <div class="col-sm-6">
                      <?= $b['pengarang'] ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      Penerbit
                    </div>
                    <div class="col-sm-6">
                      <?= $b['penerbit'] ?>
                    </div>
                  </div>
                  <div class="row bg-light">
                    <div class="col-sm-6">
                      Tahun Terbit
                    </div>
                    <div class="col-sm-6">
                      <?= $b['tahun_terbit'] ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      Tanggal Sirkulasi
                    </div>
                    <div class="col-sm-6">
                      <?= $b['tanggal_sirkulasi'] ?>
                    </div>
                  </div>
                  <div class="row bg-light">
                    <div class="col-sm-6">
                      Tanggal Mulai
                    </div>
                    <div class="col-sm-6">
                      <?= $b['tanggal_mulai'] ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      Tanggal Akhir
                    </div>
                    <div class="col-sm-6">
                      <?= $b['tanggal_akhir'] ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      Tanggal Pengembalian
                    </div>
                    <div class="col-sm-6">
                      <?= $b['tanggal_pengembalian'] ?>
                    </div>
                  </div>
                  <div class="row bg-light">
                    <div class="col-sm-6">
                      Jenis Pelangarang
                    </div>
                    <div class="col-sm-6">
                      <?= $b['nama_pelanggaran'] ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      Denda
                    </div>
                    <div class="col-sm-6">
                      <?= $b['nama_denda'] ?> <?= ' - ' . $b['denda'] ?>
                    </div>
                  </div>
                  <div class="row bg-light">
                    <div class="col-sm-6">
                      Status Pelanggaran
                    </div>
                    <div class="col-sm-6">
                      <?php if ($b['status_pelanggaran'] == 1) { ?>
                        <span class="badge bg-danger">Belum Tuntas</span>
                      <?php } else if ($b['status_pelanggaran'] == 2) { ?>
                        <span class="badge bg-success">Tuntas</span>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      Keterangan
                    </div>
                    <div class="col-sm-6">
                      <?= $b['keterangan'] ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
      <!-- /.modal -->
    <?php endforeach; ?>
    <!-- /.modal -->


    <!-- /.content-wrapper -->