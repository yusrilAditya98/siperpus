<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Validasi Peminjaman</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Peminjaman</li>
            <li class="breadcrumb-item active">Validasi Peminjaman</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
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
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <form action="<?= base_url('sirkulasi/peminjaman/daftar_buku_dipinjam') ?>" method="get">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar mr-2"></i>Mulai</span>
                      </div>
                      <input type="date" class="form-control" name="start_date" id="start_date">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar mr-2"></i>Selesai</span>
                      </div>
                      <input type="date" class="form-control" name="end_date" id="end_date">
                    </div>
                  </div>
                  <!-- // status sirkulasi terdiri dari
                      // 0 Keranjang peminjaman
                      // 1 proses peminjaman
                      // 2 sedang dipersiapkan
                      // 3 dapat diambil
                      // 4 pinjam
                      // 5 tolak peminjaman
                      // 6 pelanggaran
                      // 7 pengajuan perpajangan
                      // 8 tolak perpanjangan
                      // 9 valid perpanjangan
                      // 10 selesai pengembalian -->
                  <div class="col-lg-4">
                    <div class="input-group">
                      <select name="status_sirkulasi" id="status_sirkulasi" class="form-control">
                        <option value="">-- status --</option>
                        <option value="2">sedang dipersiapkan</option>
                        <option value="3">dapat diambil</option>
                        <option value="4">pinjam</option>
                        <option value="5">tolak peminjaman</option>
                        <option value="6">pelanggaran</option>
                        <option value="7">pengajuan perpanjangan</option>
                        <option value="8">tolak perpanjangan</option>
                        <option value="9">valid perpanjang</option>
                        <option value="10">selesai pengembalian</option>

                      </select>

                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>




        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Peminjaman</h3>

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
                <table id="data" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Sirkulasi</th>
                      <th>No Tranasaksi</th>
                      <th>Username</th>
                      <th>Nama</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Akhir</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">

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

<!-- /.content-wrapper -->
<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script>
  $(document).ready(function() {
    $('#data').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?= site_url('sirkulasi/peminjaman/get_ajax_validasi') ?>",
        "type": "POST",
        "data": function(data) {
          data.status_sirkulasi = $('#status_sirkulasi').val()
          data.start_date = $('#start_date').val()
          data.end_date = $('#end_date').val()
        }
      },
      "coloumnDefs": [{

      }],
      "order": []
    });

    $('#status_sirkulasi').on('change', function() { //button filter event click
      console.log($('#status_sirkulasi').val())
      $('#data').DataTable().ajax.reload(); //just reload table
      console.log('cek')
    });
    $('#start_date').on('change', function() { //button filter event click
      console.log($('#start_date').val())
      $('#data').DataTable().ajax.reload(); //just reload table
      console.log('cek')
    });
    $('#end_date').on('change', function() { //button filter event click
      console.log($('#end_date').val())
      $('#data').DataTable().ajax.reload(); //just reload table
      console.log('cek')
    });
  });
</script>