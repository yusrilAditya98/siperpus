<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Katalog Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Katalog Buku</li>
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
                            <h3 class="card-title">Data Katalog Buku</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <a href="<?= site_url() ?>data/buku/tambah" class="float-right btn btn-success mb-2">
                                        Tambah Katalog Buku
                                    </a>
                                    <button data-toggle="modal" data-target="#importBuku" class="float-right btn btn-info mb-2 mr-2">
                                        Import Buku
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="data" class="table table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Register</th>
                                            <th>Judul</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Digital</th>
                                            <th>Status</th>
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
        </div>
    </section>
</div>
<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script>
    $(document).ready(function() {
        $('#data').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('data/buku/get_ajax_admin') ?>",
                "type": "POST"
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
    });
</script>

            <div class="modal fade koleksi-digital" id="importBuku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="btnDetailBukuLabel">Import Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="<?= site_url() ?>data/buku/import" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="<?= base_url('/assets/import/Buku.xls') ?>" target="_blank" class="btn btn-info">Download Template Data Buku</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="import-data" class="col-sm-2 col-form-label">File Import</label>
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input name="import-data" onchange="previewImg()" type="file" class="custom-file-input" id="foto">
                                            <label class="custom-file-label" for="import-data">Choose file</label>
                                        </div>
                                        <small>*file upload harus berekstensi *xls maksimal ukuran 4MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>