    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Cetak QRCode & Barcode</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Cetak</li>
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

                <!-- /.row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
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
                                                    <table id="data2" class="table table-striped table-white mt-3" style="width:100%">
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
                                                        <tbody id="show_data_peminjaman_admin">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header border-transparent">
                                                <h3 class="card-title">Keranjang Buku Dicetak</h3>
                                                <div class="card-tools">

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="data3" class="table table-striped table-white" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Register</th>
                                                                <th>Judul</th>
                                                                <th>Pengarang</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="keranjang">

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <input type="hidden" id="count_data" value="<?= count($cetak_code) ?>">
                                                <div id="data_tambahan" style="display:none">
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <form target="_blank" action="<?= site_url() ?>Cetak/view" method="POST">
                                                                    <!-- text input -->
                                                                    <div class="form-group">
                                                                        <label>Pilih cetak</label>
                                                                        <select name="pilihan" id="pilihan" class="form-control">
                                                                            <option value="1">QRCode</option>
                                                                            <option value="2">BarCode</option>
                                                                            <option value="3">QRCode + Barcode</option>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit" id="cetak_buku" class="btn btn-success btn-block">Cetak</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-12">

                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>



    <!-- /.content-wrapper -->

    <script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var count_data = document.getElementById("count_data").value;
            if (count_data > 0) {
                document.getElementById("data_tambahan").style.display = "";
            } else {
                document.getElementById("data_tambahan").style.display = "none";
            }
            console.log(count_data);
            $('#data2').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('Cetak/get_katalog') ?>",
                    "type": "POST",
                    "data": {

                    }
                },
                "coloumnDefs": [{

                }],
                "order": [],
                "fnDrawCallback": function(oSettings) {
                    <?php foreach ($katalog_buku as $so) : ?>
                        $("#tambah_cetak<?= $so['register'] ?>").on('click', function() {
                            var register = $("#register<?= $so['register'] ?>").val();
                            register = register.trim();
                            // console.log(register);
                            $.ajax({
                                url: "<?= base_url('Cetak/tambahData') ?>",
                                type: "POST",
                                data: {
                                    "register": register,
                                },
                                success: function(data) {
                                    $('#data3').DataTable().ajax.reload();
                                    alert("Added Successfully");
                                    var count_data = document.getElementById("count_data").value;
                                    var logic = parseInt(count_data) + 1;
                                    document.getElementById("count_data").value = logic;
                                    if (logic > 0) {
                                        document.getElementById("data_tambahan").style.display = "";
                                    } else {
                                        document.getElementById("data_tambahan").style.display = "none";
                                    }
                                }
                            });
                        });
                    <?php endforeach; ?>
                }
            });
            $('#data3').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('Cetak/get_data_cetak') ?>",
                    "type": "POST",
                    "data": {

                    }
                },
                "coloumnDefs": [{

                }],
                "order": [],
                "fnDrawCallback": function(oSettings) {
                    <?php foreach ($cetak_code as $so) : ?>
                        $("#btn_delete<?= $so['id_cetak'] ?>").on('click', function() {
                            $.ajax({
                                url: "<?= base_url() ?>Cetak/hapusData/<?= $so['id_cetak'] ?>",
                                type: "POST",
                                data: {},
                                success: function(data) {
                                    $('#data3').DataTable().ajax.reload();
                                    var count_data = document.getElementById("count_data").value;
                                    var logic = parseInt(count_data) - 1;
                                    document.getElementById("count_data").value = logic;
                                    if (logic > 0) {
                                        document.getElementById("data_tambahan").style.display = "";
                                    } else {
                                        document.getElementById("data_tambahan").style.display = "none";
                                    }
                                    alert("Deleted Successfully");
                                }
                            });
                        });
                    <?php endforeach; ?>
                }
            });
        });

        $("#tambah_cetak").on('click', function() {
            var register = $("#register").val();
            register = register.trim();
            // console.log(register);
            $.ajax({
                url: "<?= base_url('Cetak/tambahData') ?>",
                type: "POST",
                data: {
                    "register": register,
                },
                success: function(data) {
                    document.getElementById("register").value = "";
                    $('#data3').DataTable().ajax.reload();
                    alert("Added Successfully");
                    var count_data = document.getElementById("count_data").value;
                    var logic = parseInt(count_data) + 1;
                    document.getElementById("count_data").value = logic;
                    if (logic > 0) {
                        document.getElementById("data_tambahan").style.display = "";
                    } else {
                        document.getElementById("data_tambahan").style.display = "none";
                    }
                }
            });
        });
        $("#cetak_buku").on('click', function() {
            document.getElementById("keranjang").innerHTML = '<tr><td class="text-center" colspan="5">Data Not Available</td></tr>';
            var count_data = 0;
            if (count_data > 0) {
                document.getElementById("data_tambahan").style.display = "";
            } else {
                document.getElementById("data_tambahan").style.display = "none";
            }
        });
    </script>