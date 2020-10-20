test
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Detail Opname</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>data/stock_opname">Opname</a></li>
                        <li class="breadcrumb-item active">Detail Opname</li>
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
                    <?php if ($this->session->flashdata('success')) : ?>
                        <input type="hidden" class="toasterSuccess" value="<?= $this->session->flashdata('success')  ?>">
                    <?php else : ?>
                        <input type="hidden" class="toasterDanger" value="<?= $this->session->flashdata('danger')  ?>">
                    <?php endif; ?>
                </div>

            </div>

            <div class="row card pt-4 pl-4 pb-3">
                <div class="col-lg-12">
                    <a href="<?= site_url() ?>data/stock_opname" style="font-size:12px; color:white" class="btn btn-success">
                        <i class="fa fa-check mr-2"></i> Selesai
                    </a>
                </div>
                <hr>
                <div class="col-lg-12">
                    <form class="form-inline" action="<?= site_url() ?>data/stock_opname/add_buku_opname" method="POST">
                        <div class="form-group mb-2">
                            <input type="text" name="b_register" autofocus placeholder="Masukkan No.Register" class="form-control">
                            <input type="hidden" name="o_id_opname" value="<?= $this->uri->segment(4) ?>" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-warning mb-2" style="color:white;"><i class="fa fa-check"></i> Ok</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Koleksi Hasil Opname</h3>
                        </div>
                        <div class="card-body">
                            <table id="data_opname" class="table table-bordered  table-responsive display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Register</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Status Sebelumnya</th>
                                        <th>Status Sekarang</th>
                                        <th>Akses Sebelumnya</th>
                                        <th>Akses Sekarang</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rekap Jumlah Koleksi Hasil Stock Opname</h3>
                        </div>
                        <div class="card-body">
                            <table id="data_count" class="table table-bordered  table-striped  table-responsive display" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Jumlah Stock Opname</th>
                                        <?php foreach ($data_status_buku as $sb) : ?>
                                            <th>
                                                Tercatat <?= ucwords($sb['nama_status']) ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody id="count_stock">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Koleksi Buku Belum Diperiksa</h3>
                        </div>
                        <div class="card-body">
                            <table id="data" class="table table-bordered  table-responsive display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Register</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Status</th>
                                        <th>Jenis Akses</th>
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
<script>
    $(document).ready(function() {
        countStock();
        $('#data_opname').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('data/stock_opname/get_ajax_opname') ?>",
                "type": "POST",
                "data": {
                    "id_opname": "<?= $this->uri->segment(4) ?>"
                }
            },
            "coloumnDefs": [{

            }],
            "order": [],
            "fnDrawCallback": function(oSettings) {
                <?php foreach ($data_stock_opname as $so) : ?>
                    $('#menu_status<?= $so['id_buku_opname'] ?>').popover({
                        html: true,
                        placement: 'left',
                        sanitize: false,
                        title: '<span class="text-info"><strong>Ubah Status Buku</strong></span>' +
                            '<button type="button" id="close" class="close" onclick="$(&quot;#menu_status<?= $so['id_buku_opname'] ?>&quot;).popover(&quot;hide&quot;);">&times;</button>',
                        content: `<div id="PopoverContent<?= $so['id_buku_opname'] ?>">
                                    <form action="<?= base_url('data/stock_opname/ubah_status_buku_opname/' . $so['id_buku_opname']) . '/' . $so['o_id_opname'] ?>" method="post">
                                        <div class="form-group mt-2">
                                            <select class="form-control" name="status_buku">
                                                <option value="">Pilih Status Buku Sekarang</option>
                                                <?php foreach ($data_status_buku as $sb) : ?>
                                                    <option value="<?= $sb['id_status'] ?>" ><?= $sb['nama_status'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-block mt-2" style="font-size:12px">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>`
                    });
                    $('#menu_akses<?= $so['id_buku_opname'] ?>').popover({
                        html: true,
                        placement: 'left',
                        sanitize: false,
                        title: '<span class="text-info"><strong>Ubah Jenis Akses</strong></span>' +
                            '<button type="button" id="close" class="close" onclick="$(&quot;#menu_akses<?= $so['id_buku_opname'] ?>&quot;).popover(&quot;hide&quot;);">&times;</button>',
                        content: `<div id="PopoverContent<?= $so['id_buku_opname'] ?>">
                                    <form action="<?= base_url('data/stock_opname/ubah_jenis_akses_opname/' . $so['id_buku_opname']) . '/' . $so['o_id_opname'] ?>" method="post">
                                        <div class="form-group mt-2">
                                            <select class="form-control" name="jenis_akses">
                                                <option value="">Pilih Jenis Akses Sekarang</option>
                                                <?php foreach ($data_jenis_akses as $sb) : ?>
                                                    <option value="<?= $sb['id_jenis'] ?>" ><?= $sb['nama_jenis'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-block mt-2" style="font-size:12px">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>`
                    });
                <?php endforeach; ?>
            }
        });
        $('#data').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('data/stock_opname/get_ajax_buku') ?>",
                "type": "POST",
                "data": {
                    "id_opname": "<?= $this->uri->segment(4) ?>"
                }
            },
            "coloumnDefs": [{

            }],
            "order": []
        });

    });

    function countStock() {
        $.ajax({
            url: "<?= site_url('data/stock_opname/get_count_stock') ?>",
            type: 'POST',
            data: {
                "id_opname": "<?= $this->uri->segment(4) ?>",
            },
            success: function(data) {
                $("#count_stock").html(data);
            }
        });
    }
</script>