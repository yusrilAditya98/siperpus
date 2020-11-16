    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Recall Buku</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Recall Buku</li>
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
                                                <h3 class="card-title">Daftar Buku Dipinjam</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <!-- <form action="<?= base_url('cetak/peminjaman/pinjam_admin') ?>" method="post"> -->
                                                    <!-- <div class="row mb-2">
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="register" id="register" autofocus placeholder="nomer register..." required>
                                                                <span class="input-group-append">
                                                                    <button type="button" id="tambah_cetak" class="btn btn-success"><i class="fas fa-cart-plus mr-2"></i>Cetak</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- </form> -->
                                                    <table id="pinjaman_recall" class="table table-striped table-white mt-3" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>No Transaksi</th>
                                                                <th>Register</th>
                                                                <th>Judul</th>
                                                                <th>Peminjam</th>
                                                                <th>Status</th>
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
                                                <h3 class="card-title">Daftar Recall Buku</h3>
                                                <div class="card-tools">

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="data_recall" class="table table-striped table-white" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>No Transaksi</th>
                                                                <th>Register</th>
                                                                <th>Judul</th>
                                                                <th>Peminjam</th>
                                                                <th>Status Recall</th>
                                                                <th>Keterangan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="recall">

                                                        </tbody>
                                                    </table>
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
            // var count_data = document.getElementById("count_data").value;
            // if (count_data > 0) {
            //     document.getElementById("data_tambahan").style.display = "";
            // } else {
            //     document.getElementById("data_tambahan").style.display = "none";
            // }
            // console.log(count_data);
            $('#pinjaman_recall').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('recall/get_pinjaman_recall') ?>",
                    "type": "POST",
                    "data": {

                    }
                },
                "coloumnDefs": [{

                }],
                "order": []
            });
            // $('#data_recall').on('load', function(){
            //     console.log("HAHAHAHA");
            // })
            $('#data_recall').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('recall/get_recall') ?>",
                    "type": "POST",
                    "data": {

                    }
                },
                "coloumnDefs": [{

                }],
                "order": [],
                
            });
        });
        $("#tambah_cetak").on('click', function() {
            var register = $("#register").val();
            register = register.trim();
            // console.log(register);
            $.ajax({
                url: "<?= base_url('cetak/tambahData') ?>",
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
    </script>