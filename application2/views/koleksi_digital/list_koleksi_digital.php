  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Koleksi Digital</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Koleksi Digital</li>
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
                <h3 class="card-title">Daftar Koleksi Digital</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <?php if ($this->session->userdata('role_id') == 'role_id_1') : ?>
                  <a href="<?= base_url('data/Koleksi_digital/tambah') ?>" class="btn btn-success float-right mb-2">Tambah Koleksi</a>
                <?php endif; ?>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-white" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Jenis Koleksi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $index = 1; ?>
                      <?php foreach ($list_koleksi as $lk) : ?>
                        <tr>
                          <td><?= $index++ ?></td>
                          <td><img src="<?= ($lk['sampul_koleksi'] != 'default.png') ? base_url('assets/koleksi_digital/' . $lk['sampul_koleksi']) : base_url('assets/img/default.png') ?>" class="img-thumbnail" style="width: 100px;"></td>
                          <td><?= $lk['judul_koleksi'] ?></td>
                          <td><?= $lk['pengarang'] ?></td>
                          <td><?= $lk['penerbit'] ?></td>
                          <td><?= $lk['nama_jenis'] ?></td>
                          <td>
                            <div class="btn-group">
                              <?php if ($this->session->userdata('role_id') == 'role_id_1') : ?>
                                <a type="button" href="<?= base_url('data/Koleksi_digital/ubah/' . $lk['id_koleksi']) ?>" class="btn btn-primary text-white"><i class="fas fa-edit mr-2"></i>Edit</a>
                                <a onclick="return confirm('Apakah yakin akan dihapus?')" type="button" href="<?= base_url('data/Koleksi_digital/hapus/' . $lk['id_koleksi']) ?>" class="btn btn-danger text-white"><i class="fas fa-trash mr-2"></i> Hapus</a>
                              <?php endif; ?>
                              <a type="button" target="_blank" href="<?= base_url('data/Koleksi_digital/lihat/' . $lk['id_koleksi']) ?>" class="btn btn-info text-white"><i class="fas fa-eye mr-2"></i>View</a>
                            </div>

                          </td>
                        </tr>
                      <?php endforeach; ?>
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
  </div>