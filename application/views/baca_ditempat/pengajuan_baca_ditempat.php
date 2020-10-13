  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark"><?= $title ?></h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active"><?= $title ?></li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>


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
                          <div class="card-header border-transparent">
                              <h3 class="card-title">Daftar Buku</h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table id="data" class="table table-striped table-white" style="width:100%">
                                      <thead>
                                          <tr>
                                              <th>No</th>
                                              <th>Sampul</th>
                                              <th>Judul</th>
                                              <th>Pengarang</th>
                                              <th>Penerbit</th>
                                              <th>Jenis Koleksi</th>
                                              <th>Status Buku</th>
                                              <th>Aksi</th>
                                          </tr>
                                      </thead>
                                      <tbody id="show_data">

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header border-transparent">
                              <h3 class="card-title">Daftar Buku Baca Ditempat</h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="card card-primary card-tabs">
                                  <div class="card-header p-0 pt-1">
                                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                          <li class="nav-item">
                                              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Terkini</a>
                                          </li>
                                          <li class="nav-item">
                                              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Riwayat</a>
                                          </li>
                                      </ul>
                                  </div>
                                  <div class="card-body">
                                      <div class="tab-content" id="custom-tabs-one-tabContent">
                                          <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                              <div class="card-body">
                                                  <div class="table-responsive">
                                                      <table class="table table-striped table-white" style="width:100%">
                                                          <thead>
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>Tanggal Sirkulasi</th>
                                                                  <th>Id Register</th>
                                                                  <th>Judul</th>
                                                                  <th>Pengarang</th>
                                                                  <th>Status Sirkulasi</th>
                                                                  <th>Aksi</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                              <?php $i = 1; ?>
                                                              <?php foreach ($baca_ditempat as $bd) : ?>
                                                                  <tr>
                                                                      <td><?= $i++; ?></td>
                                                                      <td><?= $bd['tanggal_sirkulasi'] ?></td>
                                                                      <td><?= $bd['register'] ?></td>
                                                                      <td><?= $bd['judul_buku'] ?></td>
                                                                      <td><?= $bd['pengarang'] ?></td>
                                                                      <?php if ($bd['status_sirkulasi'] == 0) : ?>
                                                                          <td><span class="badge badge-secondary">belum proses</span></td>
                                                                      <?php elseif ($bd['status_sirkulasi'] == 1) : ?>
                                                                          <td><span class="badge badge-primary">proses</span></td>
                                                                      <?php endif; ?>

                                                                      <td><a href="<?= base_url('sirkulasi/baca_ditmpt/hapus/' . $bd['id_sirkulasi']) ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
                                                                  </tr>
                                                              <?php endforeach; ?>
                                                          </tbody>
                                                      </table>

                                                  </div>
                                              </div>
                                              <?php if ($baca_ditempat) : ?>
                                                  <div class="card-footer">
                                                      <form action="<?= base_url('sirkulasi/baca_ditmpt/pengajuan') ?>" method="post">
                                                          <div class="row">
                                                              <div class="col-sm-6">
                                                                  <!-- text input -->
                                                                  <div class="form-group">
                                                                      <label>Tanggal Mulai</label>
                                                                      <input type="date" name="tanggal_mulai" class="form-control" required>
                                                                  </div>
                                                              </div>
                                                              <div class="col-sm-6">
                                                                  <div class="form-group">
                                                                      <label class="text-success">*Ajukan Baca Ditempat</label>
                                                                      <button type="submit" class="btn btn-success d-block">Submit</button>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </form>
                                                  </div>
                                              <?php endif; ?>
                                          </div>
                                          <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                              <div class="card-body">
                                                  <div class="table-responsive">
                                                      <table id="example" class="table table-striped table-white" style="width:100%">
                                                          <thead>
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>Tanggal Baca</th>
                                                                  <th>Tanggal Selesai</th>
                                                                  <th>Id Register</th>
                                                                  <th>Judul</th>
                                                                  <th>Pengarang</th>
                                                                  <th>Status Sirkulasi</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                              <?php $i = 1; ?>
                                                              <?php foreach ($riwayat_baca as $rb) : ?>
                                                                  <tr>
                                                                      <td><?= $i++; ?></td>
                                                                      <td><?= $rb['tanggal_mulai'] ?></td>
                                                                      <td><?= $rb['tanggal_akhir'] ?></td>
                                                                      <td><?= $rb['register'] ?></td>
                                                                      <td><?= $rb['judul_buku'] ?></td>
                                                                      <td><?= $rb['pengarang'] ?></td>
                                                                      <?php if ($rb['status_sirkulasi'] == 1) : ?>
                                                                          <td><span class="badge badge-primary">proses</span></td>
                                                                      <?php elseif ($rb['status_sirkulasi'] == 2) : ?>
                                                                          <td><span class="badge badge-success">pinjam</span></td>
                                                                      <?php elseif ($rb['status_sirkulasi'] == 3) : ?>
                                                                          <td><span class="badge badge-danger">tolak</span></td>
                                                                      <?php elseif ($rb['status_sirkulasi'] == 8) : ?>
                                                                          <td><span class="badge badge-warning">selesai</span></td>
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
                                  <!-- /.card -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>

  <script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
  <script>
      $(document).ready(function() {
          $('#data').DataTable({
              "processing": true,
              "serverSide": true,
              "ajax": {
                  "url": "<?= site_url('sirkulasi/baca_ditmpt/get_ajax') ?>",
                  "type": "POST"
              },
              "coloumnDefs": [{

              }],
              "order": []
          });
      });
  </script>