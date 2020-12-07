<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">OPAC</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">OPAC</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">OPAC</h3>
                            <!-- <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <div class="row">
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
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label>Cari</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Kata Kunci" required>
                                                </div>
                                                <select class="custom-select col-sm-5" name="filter" id="filter" id="inlineFormCustomSelect">
                                                    <option selected value="">Choose...</option>
                                                    <option value="judul_buku">Judul</option>
                                                    <option value="pengarang">Pengaran</option>
                                                    <option value="penerbit">Penerbit</option>
                                                    <option value="tahun_terbit">Tahun Terbit</option>
                                                    <option value="subject">Subjek</option>
                                                    <option value="kategori">Kategori</option>
                                                    <option value="isbn">ISBN</option>
                                                </select>
                                                <div class="col-sm-2">
                                                    <button type="button" id="cari" class="btn btn-primary">Cari</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="hasil" class="row" style="display:none; visibility: hidden;">
                                <div class="col-lg-12">
                                    <table id="data-opac" class="table table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register</th>
                                                <th>Judul</th>
                                                <th>Pengarang</th>
                                                <th>Penerbit</th>
                                                <th>Tahun Terbit</th>
                                                <th>Aksi</th>
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
        </div>
    </section>
</div>
<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // tampil_data_buku(); //pemanggilan fungsi tampil barang.

        document.getElementById('hasil').removeAttribute('style');
        // var keywords = null;
        // var filter = null;
        // $('#cari').click(function(event) {

        $('#data-opac').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('data/buku/cariOpac') ?>",
                "type": "POST",
                "data": function(data) {
                    data.keywords = $('#keywords').val()
                    data.filter = $('#filter').val()
                }
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
        $('#hasil').hide();
        $('#cari').on('click', function() { //button filter event click
            $('#hasil').show()
            console.log($('#filter').val())
            console.log($('#keywords').val())
            $('#data-opac').DataTable().ajax.reload(); //just reload table

        });
        // $('#start_date').on('change', function() { //button filter event click
        //     console.log($('#start_date').val())
        //     $('#data').DataTable().ajax.reload(); //just reload table
        //     console.log('cek')
        // });
    });
    // });
</script>