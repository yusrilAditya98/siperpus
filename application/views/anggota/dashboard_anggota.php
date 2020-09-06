<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>
              <p>Buku Dipinjam</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>2</h3>
              <p>Buku Telat Kembali</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 class="text-white">44</h3>
              <p class="text-white">Buku Telah Dikembalikan</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <button class="small-box-footer text-white text-center btn-block">
              More info
              <i class="fas fa-arrow-circle-right text-white"></i>
            </button>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>2</h3>

              <p>Proses Peminjaman</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Peminjaman Terkini</h3>

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
                      <th>No. Transaksi</th>
                      <th>No. Barcode</th>
                      <th>Judul</th>
                      <th>Penerbit</th>
                      <th>Tgl Peminjaman</th>
                      <th>Jatuh Tempo</th>
                      <th>Hari Terlambat</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>20061600006</td>
                      <td>00000003610</td>
                      <td>Segala-galanya Ambyar / F. Wicaksono</td>
                      <td>Gramedia Widiasarana Indonesia,</td>
                      <td>16-06-2020</td>
                      <td>03-07-2020</td>
                      <td>+-6</td>
                      <th>
                        <span class="bg-danger p-2">Terlambat</span>
                      </th>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>20061600006</td>
                      <td>00000003610</td>
                      <td>Segala-galanya Ambyar / F. Wicaksono</td>
                      <td>Gramedia Widiasarana Indonesia,</td>
                      <td>16-06-2020</td>
                      <td>03-07-2020</td>
                      <td>+-6</td>
                      <th>
                        <span class="bg-success p-2">Dikembalikan</span>
                      </th>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>20061600006</td>
                      <td>00000003610</td>
                      <td>Segala-galanya Ambyar / F. Wicaksono</td>
                      <td>Gramedia Widiasarana Indonesia,</td>
                      <td>16-06-2020</td>
                      <td>03-07-2020</td>
                      <td></td>
                      <th>
                        <span class="bg-primary p-2">Proses</span>
                      </th>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>20061600006</td>
                      <td>00000003610</td>
                      <td>Segala-galanya Ambyar / F. Wicaksono</td>
                      <td>Gramedia Widiasarana Indonesia,</td>
                      <td>16-06-2020</td>
                      <td>03-07-2020</td>
                      <td></td>
                      <th>
                        <span class="bg-primary p-2">Proses</span>
                      </th>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>20061600006</td>
                      <td>00000003610</td>
                      <td>Segala-galanya Ambyar / F. Wicaksono</td>
                      <td>Gramedia Widiasarana Indonesia,</td>
                      <td>16-06-2020</td>
                      <td>03-07-2020</td>
                      <td></td>
                      <th>
                        <span class="bg-primary p-2">Proses</span>
                      </th>
                    </tr>
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
<!-- /.content-wrapper -->