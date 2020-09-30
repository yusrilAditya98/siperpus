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
                          <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                          <li class="breadcrumb-item"><a href="<?= base_url('data/koleksi_digital') ?>">Koleksi Digital</a></li>
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
                      <div class="card card-info">
                          <div class="card-header">
                              <h3 class="card-title">Form <?= $title ?></h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form class="form-horizontal" action="<?= base_url('data/koleksi_digital/ubah/' . $koleksi_digital['id_koleksi']) ?>" method="POST" enctype="multipart/form-data">
                              <input type="hidden" value="<?= $koleksi_digital['sampul_koleksi'] ?>" name="old_sampul_koleksi">
                              <div class="card-body">
                                  <div class="form-group row">
                                      <label for="judul_koleksi" class="col-sm-2 col-form-label">Judul Koleksi</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="judul_koleksi" placeholder="masukan judul koleksi..." name="judul_koleksi" value="<?= $koleksi_digital['judul_koleksi'] ?>">
                                          <?= form_error('judul_koleksi', '<small class="text-danger pl-3">', '</small>'); ?>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="pengarang" placeholder="masukan pengarang..." name="pengarang" value="<?= $koleksi_digital['pengarang'] ?>">
                                          <?= form_error('pengarang', '<small class="text-danger pl-3">', '</small>'); ?>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="penerbit" placeholder="masukan penerbit..." name="penerbit" value="<?= $koleksi_digital['penerbit'] ?>">
                                          <?= form_error('penerbit', '<small class="text-danger pl-3">', '</small>'); ?>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="jenis_koleksi" class="col-sm-2 col-form-label">Jenis Koleksi</label>
                                      <div class="col-sm-10">
                                          <select name="jk_id_jenis" id="jenis_koleksi" class="form-control">
                                              <?php foreach ($jenis_koleksi as $jk) : ?>
                                                  <?php if ($jk['id_jenis'] == $koleksi_digital['jk_id_jenis']) : ?>
                                                      <option selected value="<?= $jk['id_jenis'] ?>"><?= $jk['nama_jenis'] ?></option>
                                                  <?php else : ?>
                                                      <option value="<?= $jk['id_jenis'] ?>"><?= $jk['nama_jenis'] ?></option>
                                                  <?php endif; ?>
                                              <?php endforeach; ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="sampul_koleksi" class="col-sm-2 col-form-label">Sampul Koleksi</label>
                                      <div class="col-sm-2">
                                          <?php if ($koleksi_digital['jk_id_jenis'] == 'default.png') : ?>
                                              <img src="<?= base_url('assets/img/default.png') ?>" class="img-thumbnail img-preview">
                                          <?php else : ?>
                                              <img src="<?= base_url('assets/koleksi_digital/' . $koleksi_digital['sampul_koleksi']) ?>" class="img-thumbnail img-preview">
                                          <?php endif; ?>
                                      </div>
                                      <div class="col-sm-8">
                                          <div class="custom-file">
                                              <input name="sampul_koleksi" onchange="previewImg()" type="file" class="custom-file-input" id="foto">
                                              <label class="custom-file-label" for="sampul_koleksi">Choose file</label>
                                          </div>
                                          <small>*format sampul berupa .jpg dengan ukuran maksimal 1MB</small>
                                          <?= form_error('sampul_koleksi', '<small class="text-danger pl-3">', '</small>'); ?>
                                      </div>
                                  </div>

                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-info">Edit</button>
                                  <a href="<?= base_url('data/koleksi_digital') ?>" class="btn btn-default float-right">Kembali</a>
                              </div>
                              <!-- /.card-footer -->
                          </form>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>