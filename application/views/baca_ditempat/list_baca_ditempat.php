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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data <?= $title ?></h3>
                        </div>
                        <div class="card-body">
                            <table id="list_baca" class="table table-bordered display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Baca</th>
                                        <th>Username</th>
                                        <th>Pembaca</th>
                                        <th>Register</th>
                                        <th>Judul</th>
                                        <th>Penerbit</th>
                                        <th>Pengarang</th>
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
        $('#list_baca').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('sirkulasi/Baca_ditmpt/list_ajax') ?>",
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