    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Pengembalian Peminjaman</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Pengembalian Peminjaman</li>
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
            <div class="col-sm-12">
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                Halaman ini digunakan untuk melakukan pengembalian peminjaman buku
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-striped table-white" style="width:100%">
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
                            <!-- <?php if ($b['status_sirkulasi'] == 2) { ?>
                            <td><span class="bg-success p-2">Peminjaman</span></td>
                          <?php } else if ($b['status_sirkulasi'] == 7) { ?>
                            <td><span class="bg-info p-2">Perpanjangan</span></td>
                          <?php } else { ?>
                          <?php } ?> -->
                            <td><a href="../Peminjaman/kembalikan/<?= $b['id_sirkulasi'] ?>" class="btn btn-sm btn-success"><i class="fas fa-undo"></i></a></td>

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