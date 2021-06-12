<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kunjungan Perpustakaan</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url("assets/css/adminlte.min.css") ?> ">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("plugins/fontawesome-free/css/all.min.css") ?> ">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/coming-soon.css') ?>" rel="stylesheet">

</head>

<body>

    <div class="overlay"></div>

    <img class="cover" src="<?= base_url('assets/img/read-book.jpg') ?>" alt="" srcset="">

    <div class="masthead">
        <div class="masthead-bg"></div>
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 my-auto">
                    <div class="masthead-content text-white py-5 py-md-0">
                        <h1 class="mb-3">Siperpus</h1>
                        <p>Sistem Informasi Perpustakan Fakultas Hukum Universitas Brawijaya.</p>
                        <p><strong>Kunjungan Perpustakaan</strong></p>
                        <form>
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username..." aria-label="Username..." autofocus required>
                            </div>
                            <button class="btn btn-secondary" class="btn btn-default" data-toggle="modal" data-target="#modal-lg" type="button" id="submit_pengunjung">Submit</button>
                        </form>
                        <br><br><br><br><br><br>
                    <a href="<?= base_url('/user/admin') ?>" class="btn btn-warning">Kembali ke Halaman Sebelumnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="social-icons">
        <ul class="list-unstyled text-center mb-0">
            <li class="list-unstyled-item">
                <a href="<?= base_url("Auth") ?>">
                    <i class="fas fa-home"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pengunjung</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row detail-pengunjung">

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- jQuery -->
    <script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <!-- my script -->
    <script>
        var url = $(location).attr("href");
        var segments = url.split("/");

        $('#submit_pengunjung').on('click', function() {
            let username = $('#username').val()
            let urlSampul = ""
            let data = [];
            $.ajax({
                url: segments[0] + '/' + segments[3] + '/sirkulasi/kunjungan/tambah',
                data: {
                    'username': username,
                },
                method: "post",
                dataType: 'json',
                success: function(result) {
                    console.log(result)
                    $('#username').val("")
                    $('.detail-pengunjung').html(``)
                    if (result['status'] == true) {
                        data = result['message']
                        urlSampul = segments[0] + '/' + segments[3] + '/assets/foto_profil/' + data['foto']
                        $('.detail-pengunjung').html(`
				<div class="col-lg-5">
					<img src="` + urlSampul + `" class="img-thumbnail" alt="" srcset="">
				</div>
				<div class="col-lg-7">
					<p class="text-muted" style="margin-bottom: 1px;">
						Username
					</p>
					<h5>` + data['username'] + `</h5>
					<hr>
					<p class="text-muted" style="margin-bottom: 1px;">
						Nama
					</p>
					<h5>` + data['nama'] + `</h5>
					<hr>
                    <br><br><br>
                    <h5>--- Selamat Datang ----<h5>
					
				</div>
				`)
                    } else {
                        $('.detail-pengunjung').html(`<div class="col-lg-12">
				<h6 class="text-center text-danger">` + result['message'] + ` , Silahkan Masukkan Username yang terdaftar !!!</h6>
				</div>`)
                    }
                }
            })
        })

        $('#username').keypress(function(e) {
            if (e.keyCode == 13)
                $('#submit_pengunjung').click();
        });
    </script>

</body>

</html>