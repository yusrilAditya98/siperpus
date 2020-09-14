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
                                                    <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Kata Kunci">
                                                </div>
                                                <select class="custom-select col-sm-5" name="filter" id="filter" id="inlineFormCustomSelect">
                                                    <option selected>Choose...</option>
                                                    <option value="1">Judul</option>
                                                    <option value="2">Pengaran</option>
                                                    <option value="3">Penerbit</option>
                                                    <option value="4">Subjek</option>
                                                    <option value="5">Kategori</option>
                                                    <option value="6">ISBN</option>
                                                </select>
                                                <div class="col-sm-2">
                                                    <button type="button" id="cari" class="btn btn-primary">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="hasil" class="row" style="display:none;">
                                <div class="col-lg-12">
                                    <table id="data" class="table table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register</th>
                                                <th>Judul</th>
                                                <th>Pengarang</th>
                                                <th>Penerbit</th>
                                                <th>Tahun Terbit</th>
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
        </div>
    </section>
</div>
<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // tampil_data_buku(); //pemanggilan fungsi tampil barang.

        $('#cari').click(function(event) {
            document.getElementById('hasil').removeAttribute('style');
            var keywords = document.getElementById('keywords').value;
            var filter = document.getElementById('filter').value;
            // console.log(keywords);
            // console.log(filter);
            $.ajax({
                type: 'GET',
                url: '<?= site_url() ?>data/buku/cariOpac',
                data: {
                    "keywords": keywords,
                    'filter': filter
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td>' + data[i].register + '</td>' +
                            '<td>' + data[i].judul_buku + '</td>' +
                            '<td>' + data[i].pengarang + '</td>' +
                            '<td>' + data[i].penerbit + '</td>' +
                            '<td>' + data[i].tahun_terbit + '</td>' +
                            `<td>
                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku` + data[i].register + `">
                                    <i class="fa fa-info"></i>
                                </button>
                                <div class="modal fade" id="btnDetailBuku` + data[i].register + `" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-12">

                                                    </div>
                                                    <div class="col-lg-8 col-12">
                                                        <h5>` + data[i].judul_buku + `</h5>
                                                        <p>` + data[i].pengarang + `</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Register
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].register + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        isbn
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].isbn + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Dewey Number
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].no_dewey + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Judul
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].judul_buku + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Pengarang
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].pengarang + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Penerbit
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].penerbit + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Tahun Terbit
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].tahun_terbit + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Kota Terbit
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].kota_terbit + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Bahasa
                                                    </div>
                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        CIRCTYPE
                                                    </div>
                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Funding
                                                    </div>
                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Author Abrev
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].author_abrev + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Title Abrev
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].title_abrev + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Volume
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].volume + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Kondisi Fisik
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].kondisi_fisik + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Bibliography
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].bibliography + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Subject
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[i].subject + `
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>` +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                    $('#data').DataTable();
                }

            });
        });

    });
</script>