<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Buku</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Buku</h3>
                        </div>
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="col-lg-12">
                                    <?php if ($this->session->flashdata('warning') != null) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $this->session->flashdata('warning') ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('success') != null) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= $this->session->flashdata('success') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div> -->
                            <?php if ($this->session->userdata('role_id') == "role_id_1") : ?>
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <a href="<?= site_url() ?>data/buku/tambah" class="float-right btn btn-success mb-2">
                                            Tambah Katalog Buku
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <table id="data" class="table table-bordered display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Register</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Status Buku</th>
                                        <th width="15%">Aksi</th>
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
    </section>
</div>
<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('data/buku/get_ajax') ?>",
                "type": "POST",
                "data": {
                    "role_id": "<?= $this->session->userdata('role_id') ?>"
                }
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
    });
</script>