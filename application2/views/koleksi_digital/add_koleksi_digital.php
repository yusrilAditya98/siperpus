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
                          <li class="breadcrumb-item"><a href="<?= base_url('data/Koleksi_digital') ?>">Koleksi Digital</a></li>
                          <li class="breadcrumb-item active"><?= $title ?></li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>

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
                          <form class="form-horizontal" action="<?= base_url('data/Koleksi_digital/tambah') ?>" method="POST" enctype="multipart/form-data">
                              <div class="card-body">
                                  <div class="form-group row">
                                      <label for="judul_koleksi" class="col-sm-2 col-form-label">Judul Koleksi</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="judul_koleksi" placeholder="masukan judul koleksi..." name="judul_koleksi">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="pengarang" placeholder="masukan pengarang..." name="pengarang">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="penerbit" placeholder="masukan penerbit..." name="penerbit">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="jenis_koleksi" class="col-sm-2 col-form-label">Jenis Koleksi</label>
                                      <div class="col-sm-10">
                                          <select name="jk_id_jenis" id="jenis_koleksi" class="form-control">
                                              <option value="1">-- pilih jenis koleksi --</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="sampul_koleksi" class="col-sm-2 col-form-label">Sampul Koleksi</label>
                                      <div class="col-sm-2">
                                          <img src="<?= base_url('assets/img/default.png') ?>" class="img-thumbnail img-preview">
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
                                  <button type="submit" class="btn btn-info">Submit</button>
                                  <a href="<?= base_url('data/Koleksi_digital') ?>" class="btn btn-default float-right">Kembali</a>
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