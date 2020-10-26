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
        "data": {

        }
      },
      "coloumnDefs": [{

      }],
      "order": []
    });
  });
</script>