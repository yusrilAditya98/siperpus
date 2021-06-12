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
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>data/Stock_opname">Opname</a></li>
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
                <div id="notice" class="col-lg-12">
                    <?php if ($this->session->flashdata('success')) : ?>
                        <input type="hidden" class="toasterSuccess" value="<?= $this->session->flashdata('success')  ?>">
                    <?php else : ?>
                        <input type="hidden" class="toasterDanger" value="<?= $this->session->flashdata('danger')  ?>">
                    <?php endif; ?>
                </div>

            </div>

            <div class="row card pt-4 pl-4 pb-3">
                <div class="col-lg-12">
                    <a href="<?= site_url() ?>data/Stock_opname/" style="font-size:12px; color:white" class="btn btn-secondary">
                        <i class="fa fa-hourglass-half mr-2"></i> Simpan Sementara
                    </a>
                    <a href="<?= site_url() ?>data/Stock_opname/doneOpname/<?= $this->uri->segment(4) ?>" style="font-size:12px; color:white" class="btn btn-success" onclick='return confirm("Apakah yakin untuk mengakhiri proses Stock Opname pada Periode ini?")'>
                        <i class="fa fa-check mr-2"></i> Selesai
                    </a>
                    <span class="ml-2 mr-2">
                        |
                    </span>
                    <button id="undo_stock_opname" type="button" style="font-size:12px; color:white" class="btn btn-warning text-white" onclick=''>
                        <i class="fa fa-undo-alt mr-2"></i> Tampil Buku Status "Tidak Ada"
                    </button>
                    <!-- <a href="<?= site_url() ?>data/Stock_opname/updateNonAktifToAktif" style="font-size:12px; color:white" class="btn btn-warning text-white">
                        <i class="fa fa-undo-alt mr-2"></i> Tampil Buku Status "Tidak Ada"
                    </a> -->
                </div>
                <small style="font-weight:bold" class="mt-2">*Buku yang TIDAK dilakukan PENGECEKAN, Setelah menekan tombol konfirmasi "SELESAI" akan otomatis diubah status menjadi TIDAK ADA</small>
                <hr>
                <div class="col-lg-12">
                    <form class="form-inline" method="POST" action="<?= site_url('data/Stock_opname/add_buku_opname') ?>">
                        <div class="form-group mb-2">
                            <input type="text" id="opname_add" required name="b_register" autofocus placeholder="Masukkan No.Register" class="form-control">
                            <input type="hidden" name="o_id_opname" value="<?= $this->uri->segment(4) ?>" class="form-control">
                        </div>
                        <button id="btn_add_opname" type="submit" class="btn btn-primary mb-2" style="color:white;"><i class="fa fa-check"></i> Ok</button>
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
                                        <th>No</th>
                                        <th>Register</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Status Sebelumnya</th>
                                        <th>Status Sekarang</th>
                                        <th>Akses Sebelumnya</th>
                                        <th>Akses Sekarang</th>
                                        <th>Aksi</th>
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
                            <div class="row">
                                <div class="col-lg-4">
                                    <select name="koleksi_digital" id="koleksi_digital" class="form-control">
                                        <option value="">-- koleksi digital --</option>
                                        <?php foreach ($koleksi_digital as $kd) : ?>
                                            <option value="<?= $kd['status'] ?>"><?= $kd['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <select name="jenis_koleksi" id="jenis_koleksi" class="form-control">
                                            <option value="">-- Jenis Koleksi --</option>
                                            <?php foreach ($jenis_koleksi as $jk) : ?>
                                                <option value="<?= $jk['id_jenis'] ?>"><?= $jk['nama_jenis'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
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
        $("#undo_stock_opname").on('click', function() {
            if (confirm("Apakah yakin untuk mengubah status buku TIDAK ADA menjadi TERSEDIA?")) {
                // Save it!
                alert('Berhasil merubah');
                $.ajax({
                    type: "POST",
                    url: '<?= site_url() ?>data/Stock_opname/updateNonAktifToAktif',
                    success: function(data) {
                        location.reload();
                    }
                });
                location.reload();
            } else {
                // Do nothing!
                alert('Berhasil membatalkan');
            }
        });
        countStock();
        $('#data_opname').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('data/Stock_opname/get_ajax_opname') ?>",
                "type": "POST",
                "data": {
                    "id_opname": "<?= $this->uri->segment(4) ?>"
                },
            },
            "dom": 'Bfrtip',
            "buttons": [
                'copy', 'csv', 'excel', 'print', {
                    "extend": 'pdf',
                    "orientation": 'landscape',
                    "pageSize": 'LEGAL'
                }
            ],
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
                                    <form action="<?= base_url('data/Stock_opname/ubah_status_buku_opname/' . $so['id_buku_opname']) . '/' . $so['o_id_opname'] ?>" method="post">
                                        <input type="hidden" name="id_buku_opname" value="<?= $so['id_buku_opname'] ?>">
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
                                    <form action="<?= base_url('data/Stock_opname/ubah_jenis_akses_opname/' . $so['id_buku_opname']) . '/' . $so['o_id_opname'] ?>" method="post">
                                        <input type="hidden" name="id_buku_opname" value="<?= $so['id_buku_opname'] ?>">
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
                "url": "<?= site_url('data/Stock_opname/get_ajax_buku') ?>",
                "type": "POST",
                // "data": {
                //     "id_opname": "<?= $this->uri->segment(4) ?>"
                // },
                "data": function(data) {
                    data.id_opname = "<?= $this->uri->segment(4) ?>"
                    data.status = $('#status').val()
                    data.jenis_koleksi = $('#jenis_koleksi').val()
                    data.koleksi_digital = $('#koleksi_digital').val()
                }
            },
            "coloumnDefs": [{

            }],
            "order": []
        });

    });
    $('#jenis_koleksi').on('change', function() { //button filter event click
        console.log($('#jenis_koleksi').val())
        $('#data').DataTable().ajax.reload(); //just reload table
        console.log('cek')
    });
    $('#koleksi_digital').on('change', function() { //button filter event click
        console.log($('#koleksi_digital').val())
        $('#data').DataTable().ajax.reload(); //just reload table
        console.log('cek')
    });

    function countStock() {
        $.ajax({
            url: "<?= site_url('data/Stock_opname/get_count_stock') ?>",
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