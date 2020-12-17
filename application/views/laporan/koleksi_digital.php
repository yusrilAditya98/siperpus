<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
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
                            <h3 class="card-title">Data Koleksi Digital</h3>
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
                            <div class="table-responsive">
                                <table id="data" class="data table table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Register</th>
                                            <th>Judul</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Pdf</th>
                                            <th>No ISBN</th>
                                            <th>No Dewey</th>
                                            <th>Kota Terbit</th>
                                            <th>Bahasa</th>
                                            <th>Circ Type</th>
                                            <th>Funding</th>
                                            <th>Sumber Buku</th>
                                            <th>Author Abrev</th>
                                            <th>Title Abrev</th>
                                            <th>Volume</th>
                                            <th>Kondisi Fisik</th>
                                            <th>Bibliography</th>
                                            <th>Subject</th>
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
                "url": "<?= site_url('Laporan/get_ajax_koleksi_digital') ?>",
                "type": "POST",
                "data": function(data) {
                    data.status = $('#status').val()
                    data.jenis_koleksi = $('#jenis_koleksi').val()
                }
            },
            "columnDefs": [{
                "sortable": false,
                "targets": [0, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
            }],
            "dom": 'Bfrtip',
            "buttons": [
                'copy', 'csv', 'excel', 'print', {
                    extend: 'pdf',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }
            ],
            // initComplete: function() {
            //     // Apply the search
            //     this.api().columns().every(function() {
            //         var that = this;

            //         $('input', this.footer()).on('keyup change clear', function() {
            //             if (that.search() !== this.value) {
            //                 that
            //                     .search(this.value)
            //                     .draw();
            //             }
            //         });
            //     });
            // }
        });

        // $('#data thead td').each(function() {
        //     var title = $(this).text();
        //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        // });
        $('#status').on('change', function() { //button filter event click
            console.log($('#status').val())
            $('#data').DataTable().ajax.reload(); //just reload table
            console.log('cek')
        });
        $('#jenis_koleksi').on('change', function() { //button filter event click
            console.log($('#jenis_koleksi').val())
            $('#data').DataTable().ajax.reload(); //just reload table
            console.log('cek')
        });
    });
</script>