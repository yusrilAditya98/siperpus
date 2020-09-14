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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Katalog Buku</h3>
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
        tampil_data_buku(); //pemanggilan fungsi tampil barang.

        function tampil_data_buku() {
            $.ajax({
                type: 'ajax',
                url: '<?= site_url() ?>data/buku/data_buku',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data[0].length; i++) {
                        html += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td>' + data[0][i].register + '</td>' +
                            '<td>' + data[0][i].judul_buku + '</td>' +
                            '<td>' + data[0][i].pengarang + '</td>' +
                            '<td>' + data[0][i].penerbit + '</td>' +
                            '<td>' + data[0][i].tahun_terbit + '</td>' +
                            `<td>
                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku` + data[0][i].register + `">
                                    <i class="fa fa-info"></i>
                                </button>
                                <a href="<?= site_url() ?>data/buku/ubah/` + data[0][i].register + `" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= site_url() ?>data/buku/deleteDataBuku/` + data[0][i].register + `" class="btn btn-sm btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <div class="modal fade" id="btnDetailBuku` + data[0][i].register + `" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
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
                                                        <h5>` + data[0][i].judul_buku + `</h5>
                                                        <p>` + data[0][i].pengarang + `</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Register
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].register + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        isbn
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].isbn + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Dewey Number
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].no_dewey + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Judul
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].judul_buku + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Pengarang
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].pengarang + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Penerbit
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].penerbit + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Tahun Terbit
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].tahun_terbit + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Kota Terbit
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].kota_terbit + `
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
                                                        ` + data[0][i].author_abrev + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Title Abrev
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].title_abrev + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Volume
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].volume + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Kondisi Fisik
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].kondisi_fisik + `
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        Bibliography
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].bibliography + `
                                                    </div>
                                                </div>
                                                <div class="row bg-light">
                                                    <div class="col-lg-6">
                                                        Subject
                                                    </div>
                                                    <div class="col-lg-6">
                                                        ` + data[0][i].subject + `
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
                }

            });
        }

    });
</script>