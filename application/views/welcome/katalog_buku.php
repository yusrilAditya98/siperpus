<!-- Content Wrapper. Contains page content -->

<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Get work done <span>faster</span><br> and <span>better</span> with us</h1>
        <a href="" class="btn btn-primary tombol_b">Our Work</a>
    </div>
</div>
<!-- Akhir Jumbotron -->

<div class="container">
    <section class="top m-3">
        <div class="row">
            <h4>Top Books</h4>
            <?php for ($i = 0; $i < 3; $i++) : ?>
                <div class="col-lg-3">
                    <div class="game mt-5 mb-5">
                        <div class="rank text-white">3</div>
                        <div class="front">
                            <img class="thumbnail" src="<?= base_url('assets/') ?>img/5.jpg" alt="">
                            <h3 class="name">Game name</h3>
                            <div class="stats">
                                <p class="viewers">872.2k</p>
                                <div class="streamers">
                                    <img src="<?= base_url('assets/') ?>img/img1.png" alt="">
                                    <img src="<?= base_url('assets/') ?>img/img2.png" alt="">
                                    <img src="<?= base_url('assets/') ?>img/img3.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="streaming-info">
                                <p class="game-stat"> 872.2k<span>Wathcing </span></p>
                                <p class="game-stat">25.8k<span>Streams</span></p>
                            </div>
                            <button class="btn">See more streams</button>
                            <div class="streamers">
                                <div class="streamer">
                                    <p class="name">Gamer 1</p>
                                    <p class="number">36.5k</p>
                                </div>
                                <div class="streamer">
                                    <p class="name">Gamer 2</p>
                                    <p class="number">34.9k</p>
                                </div>
                                <div class="streamer">
                                    <p class="name">Gamer 3</p>
                                    <p class="number">25.8k</p>
                                </div>
                            </div>
                        </div>
                        <div class="background">

                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <section class="content m-3">
        <div class="row">
            <h4>Data Katalog Buku</h4>
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
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

    </section>

    <footer class="main-footer mt-5 mb-3 text-center">
        <!-- Default to the left -->
        <strong>Copyright © 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>



<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script>
    $(document).ready(function() {
        $('#data').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Welcome/get_ajax') ?>",
                "type": "POST"
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
    });
</script>