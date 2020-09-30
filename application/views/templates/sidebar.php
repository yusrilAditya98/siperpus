   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <a href="dashboard_admin.html" class="brand-link">
           <img src="<?= base_url("assets/img/AdminLTELogo.png") ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
           <span class="brand-text font-weight-light">Sistem Perpustakaan</span>
       </a>

       <!-- Sidebar -->
       <div class="sidebar">
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                   <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
               </div>
               <div class="info">
                   <a href="#" class="d-block"><?= $this->session->userdata('nama'); ?></a>
               </div>
           </div>
           <!-- Sidebar Menu Admin-->
           <?php if ($this->session->userdata('role_id') == "role_id_1") : ?>
               <nav class="mt-2">
                   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                       <li class="nav-item">
                           <a href="<?= base_url('user/admin') ?>" class="nav-link ">
                               <i class="nav-icon fas fa-home"></i>
                               <p>Dashboard</p>
                           </a>
                       </li>
                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-users"></i>
                               <p>
                                   Manajemen User
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="<?= base_url('user/anggota/list') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Anggota</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('user/non_anggota/list') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Non Anggota</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('user/admin/list') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Admin</p>
                                   </a>
                               </li>

                           </ul>
                       </li>

                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-book"></i>
                               <p>
                                   Katalog
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/buku/katalog_buku_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('data/koleksi_digital') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Koleksi Digital</p>
                                   </a>
                               </li>
                           </ul>
                       </li>
                       <li class="nav-item">
                           <a href="./index.html" class="nav-link">
                               <i class="nav-icon fas fa-book-reader"></i>
                               <p>
                                   Baca Ditempat
                               </p>
                           </a>
                       </li>
                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-copy"></i>
                               <p>
                                   Peminjaman
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/peminjaman_buku_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Peminjaman Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/perpanjangan_peminjaman_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Perpanjangan Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/pelanggaran_peminjaman_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pelanggaran Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/pengembalian_peminjaman_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pengembalian Peminjaman</p>
                                   </a>
                               </li>
                           </ul>
                       </li>

                       <li class="nav-item">
                           <a href="<?= site_url() ?>sirkulasi/sumbangan_buku/admin" class="nav-link">
                               <i class="nav-icon fas fa-file-archive"></i>
                               <p>
                                   Sumbangan Buku
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= site_url() ?>data/stock_opname" class="nav-link">
                               <i class="nav-icon fas fa-layer-group"></i>
                               <p>
                                   Stock Opname
                               </p>
                           </a>
                       </li>

                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-file"></i>
                               <p>
                                   Data
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/kategori" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Kategori</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/sumber_koleksi" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Sumber Koleksi</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/lama_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Lama Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/jenis_akses" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Jenis Akses</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('data/pelanggaran') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Jenis Pelanggaran</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/denda" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Jenis Denda</p>
                                   </a>
                               </li>
                           </ul>
                       </li>

                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-folder"></i>
                               <p>
                                   Laporan
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="laporan/peminjaman.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/keranjang_belanja.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Keranjang Belanja</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/koleksi_buku.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Koleksi Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/perpanjangan_peminjaman.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Perpanjangan Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/sangsi_peminjaman.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Sangsi Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/koleksi_sering_dipinjam.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Koleksi Sering Dipinjam</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/keterlambatan_peminjaman.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Keterlambatan Pengembalian</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/baca_ditempat.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Baca Ditempat</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/stock_opname.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Stock Opname</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="laporan/koleksi_digital.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Koleksi Digital</p>
                                   </a>
                               </li>
                           </ul>
                       </li>
                   </ul>
               </nav>
           <?php elseif ($this->session->userdata('role_id') == "role_id_2") : ?>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                       <li class="nav-item">
                           <a href="<?= base_url('user/anggota') ?>" class="nav-link">
                               <i class="nav-icon fas fa-home"></i>
                               <p>
                                   Dashboard
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= base_url('user/anggota/ubah/' . $this->session->userdata('username')) ?>" class="nav-link">
                               <i class="nav-icon fas fa-user"></i>
                               <p>
                                   Profil
                               </p>
                           </a>
                       </li>

                       <li class="nav-header">Menu Utama</li>
                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-book"></i>
                               <p>
                                   Katalog
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/buku/buku_anggota" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/buku/opac" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>OPAC</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('data/koleksi_digital') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Koleksi Digital</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="digital_collection.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Digital Collection</p>
                                   </a>
                               </li>
                           </ul>
                       </li>
                       <li class="nav-item">
                           <a href="./index.html" class="nav-link">
                               <i class="nav-icon fas fa-book-reader"></i>
                               <p>
                                   Baca Ditempat
                               </p>
                           </a>
                       </li>
                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-copy"></i>
                               <p>
                                   Peminjaman
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <!-- <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/peminjaman_buku" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Peminjaman Buku</p>
                                   </a>
                               </li> -->
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/daftar_buku_dipinjam" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Buku Dipinjam</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/keranjang_peminjaman" class="nav-link">

                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Keranjang Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/perpanjangan_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Perpanjangan Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/pelanggaran_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pelanggaran Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/peminjaman/pengembalian_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pengembalian Peminjaman</p>
                                   </a>
                               </li>
                           </ul>
                       </li>

                       <li class="nav-item">
                           <a href="<?= site_url() ?>sirkulasi/sumbangan_buku" class="nav-link">
                               <i class="nav-icon fas fa-file-archive"></i>
                               <p>
                                   Sumbangan Buku
                               </p>
                           </a>
                       </li>
                   </ul>
               </nav>
               <!-- /.sidebar-menu -->
           <?php else : ?>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                       <li class="nav-item">
                           <a href="<?= base_url('user/non_anggota') ?>" class="nav-link">
                               <i class="nav-icon fas fa-home"></i>
                               <p>
                                   Dashboard
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="profil.html" class="nav-link">
                               <i class="nav-icon fas fa-users"></i>
                               <p>
                                   Profil
                               </p>
                           </a>
                       </li>

                       <li class="nav-header">Menu Utama</li>

                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-book"></i>
                               <p>
                                   Katalog
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/buku" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/buku/opac" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>OPAC</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="daftar_koleksidigital.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Koleksi Digital</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="digital_collection.html" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Digital Collection</p>
                                   </a>
                               </li>
                           </ul>
                       </li>
                       <li class="nav-item">
                           <a href="./index.html" class="nav-link">
                               <i class="nav-icon fas fa-book-reader"></i>
                               <p>
                                   Baca Ditempat
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= site_url() ?>sirkulasi/sumbangan_buku" class="nav-link">
                               <i class="nav-icon fas fa-file-archive"></i>
                               <p>
                                   Sumbangan Buku
                               </p>
                           </a>
                       </li>
                   </ul>
               </nav>
               <!-- /.sidebar-menu -->
           <?php endif; ?>
       </div>
   </aside>