    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Keranjang Buku Dipinjam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Keranjang Buku Dipinjam</li>
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
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-footer">
                        Profile Peminjam
                      </div>
                      <div class="card-body">
                        <p>Nama Anggota : <?= $this->session->userdata('nama')?></p>
                        <p>Nomor Anggota : <?= $this->session->userdata('username')?></p>
                        <!-- <p>Tanggal : 12 Agustus 2020</p> -->
                      </div>
                    </div>
                  </div>
                </div>
                <h5 class="text-center">Daftar Keranjang Buku Dipinjam</h5>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-white" style="width:100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Register</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach($buku_dipinjam as $b) : ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $b['register']?></td>
                        <td><?= $b['judul_buku']?></td>
                        <td><?= $b['pengarang']?></td>
                        <td><?= $b['tanggal_mulai']?></td>
                        <td><?= $b['tanggal_pengembalian']?></td>
                        <td>
                          <a href="../peminjaman/hapusPinjam/<?= $b['id_sirkulasi']?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                          <a href="../peminjaman/pinjamBuku/<?= $b['id_sirkulasi']?>" class="btn btn-sm btn-success"><i
                                class="fas fa-cart-plus"></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- <a href="../peminjaman/pinjamSemua" class="btn btn-primary"><i class="fas fa-arrow-right"></i> Lanjutkan</a> -->
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->