    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Entri Peminjaman Buku</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peminjaman</li>
                <li class="breadcrumb-item active">Peminjaman Buku</li>
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
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label>Masukkan Nomor Anggota</label>
                    </div>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" placeholder="Kode Peminjaman">
                    </div>
                    <div class="col-sm-1">
                      <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label>Detail Peminjam</label>
                    </div>
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="card-footer">
                          Profil Peminjam
                        </div>
                        <div class="card-body">
                          <p>Nomor Anggota : 1324355</p>
                          <p>Nama Anggota : Alexander Del Piero</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header border-transparent">
                          <h3 class="card-title">Daftar Katalog Buku</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="example" class="table table-striped table-white" style="width:100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>No. Barcode</th>
                                  <th>Judul</th>
                                  <th>Edisi</th>
                                  <th>Penerbit/Publikasi</th>
                                  <th>Deskripsi Fisik</th>
                                  <th>Subjek</th>
                                  <th>Eksemplar</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>00000003610</td>
                                  <td>Segala-galanya Ambyar / F. Wicaksono</td>
                                  <td>Cet.2</td>
                                  <td>Gramedia Widiasarana Indonesia,</td>
                                  <td>156 hlm. ; 20 cm.</td>
                                  <td>Pemasaran</td>
                                  <td>1</td>
                                  <td>
                                    <!-- <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a> -->
                                    <!-- <a href="peminjaman/keranjang_peminjaman.html" class="btn btn-sm btn-success"><i
                                                    class="fas fa-cart-plus"></i> Pinjam</a> -->
                                                    <input type="checkbox" name="" id="" class="form-control">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-12">
                            <button class="float-right btn btn-success">Pinjam Buku</button>
                            <button class="float-right btn btn-info mr-2">Jumlah Buku Dipinjam: 2</button>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
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