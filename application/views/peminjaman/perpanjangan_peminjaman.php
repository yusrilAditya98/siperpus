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

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                Halaman ini berisikan list dari Buku yang dilakukan perpanjangan peminjaman
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Ajukan Perpanjangan Peminjaman</button>
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
                  <table class="table table-bordered">
                  <thead>
                      <tr>
                        <th>#</th>
                        <th>Register</th>
                        <th>Judul</th>
                        <th>Waktu Akhir Peminjaman</th>
                        <th>Jangka Waktu Perpanjangan</th>
                        <th>Status Perpanjangan</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php $i = 1; foreach($buku_perpanjangan as $b) : ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $b['register']?></td>
                        <td><?= $b['judul_buku']?></td>
                        <td><?= $b['tanggal_pengembalian']?></td>
                        <td><?= $b['tanggal_perpanjangan']?></td>
                        <?php if ($b['status_sirkulasi'] == 1) { ?>
                            <td><span class="badge bg-success">Diterima</span></td>
                            <?php } else if ($b['status_sirkulasi'] == 2) { ?>
                              <td><span class="badge bg-danger">Ditolak</span></td>
                              <?php } else { ?>
                                <td><span class="badge bg-info">Diproses</span></td>
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
          <form action="../peminjaman/perpanjangan/" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="kode_pinjam">Register</label>
              <select name="sirkulasi" id="kode_pinjam" class="form-control">
                      <option value="" selected hidden>Pilih Register...</option>
                    <?php foreach($pinjaman as $p) : ?>
                      <option value="<?= $p['id_sirkulasi']?>"><?= $p['register']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- <div class="form-group">
              <label for="buku">Nama Buku</label>
              <input type="text" name="" id="buku" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="waktu">Waktu Akhir Peminjaman</label>
              <input type="date" name="" id="waktu" class="form-control" readonly>
            </div> -->
            <div class="form-group">
              <label for="panjang">Jangka Waktu Perpanjangan</label>
              <input type="date" name="jangka_waktu" id="panjang" class="form-control">
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