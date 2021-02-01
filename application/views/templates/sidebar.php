   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <a href="<?= base_url("auth") ?>" class="brand-link text-center text-bold">
           <span class="brand-text" style="color: #f96332;">Sistem</span> <span style="color: #fff;">Perpustakaan</span>
       </a>

       <?php $fotoProfil = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array() ?>
       <!-- Sidebar -->
       <div class="sidebar">
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                   <img src="<?= base_url('assets/foto_profil/' . $fotoProfil['foto']) ?>" class="img-circle elevation-2" alt="User Image">
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
                           <a href="<?= base_url('user/Admin') ?>" class="nav-link ">
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
                                   <a href="<?= base_url('user/Anggota/list') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Anggota</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('user/Non_anggota/list') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Non Anggota</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('user/Admin/list') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Admin</p>
                                   </a>
                               </li>

                           </ul>
                       </li>
                       <li class="nav-header">Menu Admin</li>
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
                                   <a href="<?= site_url() ?>data/Buku/katalog_buku_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Buku</p>
                                   </a>
                               </li>
                               <!-- <li class="nav-item">
                                   <a href="<?= base_url('data/Koleksi_digital') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Koleksi Digital</p>
                                   </a>
                               </li> -->
                           </ul>
                       </li>
                       <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                               <i class="nav-icon fas fa-book-reader"></i>
                               <p>
                                   Baca Ditempat
                                   <i class="fas fa-angle-left right"></i>
                               </p>
                           </a>
                           <ul class="nav nav-treeview">
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Baca_ditmpt/" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pengajuan</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Baca_ditmpt/list" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>List</p>
                                   </a>
                               </li>
                           </ul>
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
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/daftar_buku_dipinjam" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Riwayat</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/peminjaman_buku_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/validasi_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Validasi</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/perpanjangan_peminjaman_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Perpanjangan</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/pelanggaran_peminjaman_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pelanggaran</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/pengembalian_peminjaman_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pengembalian</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Pembayaran/pembayaran_denda_admin" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pembayaran</p>
                                   </a>
                               </li>
                           </ul>
                       </li>

                       <li class="nav-item">
                           <a href="<?= site_url() ?>sirkulasi/Sumbangan_buku/admin" class="nav-link">
                               <i class="nav-icon fas fa-file-archive"></i>
                               <p>
                                   Sumbangan Buku
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= site_url() ?>data/Stock_opname" class="nav-link">
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
                                   <a href="<?= site_url() ?>data/Status_buku" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Status Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Kategori" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Kategori</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Sumber_koleksi" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Sumber Koleksi</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Lama_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Lama Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Jenis_akses" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Jenis Akses</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('data/Pelanggaran') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Jenis Pelanggaran</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Denda" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Jenis Denda</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Jenis_koleksi" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Jenis Koleksi</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Petugas" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Data Petugas</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Kop_surat" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Kop Surat</p>
                                   </a>
                               </li>
                           </ul>
                       </li>
                       <li class="nav-item">
                           <a href="<?= site_url() ?>Cetak/code/" class="nav-link">
                               <i class="nav-icon fas fa-layer-group"></i>
                               <p>
                                   Cetak Barqode / Qrcode
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= site_url() ?>Cetak/bebas_pustaka" class="nav-link">
                               <i class="nav-icon fas fa-layer-group"></i>
                               <p>
                                   Bebas Pustaka
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= site_url() ?>Recall/" class="nav-link">
                               <i class="nav-icon fas fa-layer-group"></i>
                               <p>
                                   Recall
                               </p>
                           </a>
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
                                   <a href="<?= base_url('Laporan/peminjaman') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Peminjaman</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/keranjang_buku') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Keranjang buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/koleksi_buku') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Koleksi Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/perpanjangan') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Perpanjangan</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/sangsi') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Sangsi</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/koleksi_sering_dipinjam') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Koleksi Sering Dipinjam</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/keterlambatan') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Keterlambatan</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/baca_ditempat') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Baca Ditempat</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/stock_opname') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Stock Opname</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/koleksi_digital') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Koleksi Digital</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= base_url('Laporan/pembayaran') ?>" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pembayaran</p>
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
                           <a href="<?= base_url('user/Anggota') ?>" class="nav-link">
                               <i class="nav-icon fas fa-home"></i>
                               <p>
                                   Dashboard
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= base_url('user/Anggota/ubah/' . $this->session->userdata('username')) ?>" class="nav-link">
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
                                   <a href="<?= site_url() ?>data/Buku/buku_anggota" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Buku/opac" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>OPAC</p>
                                   </a>
                               </li>
                           </ul>
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
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/daftar_buku_dipinjam" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Buku Dipinjam</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/keranjang_peminjaman" class="nav-link">

                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Keranjang</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/perpanjangan_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Perpanjangan</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/pelanggaran_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pelanggaran</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Peminjaman/pengembalian_peminjaman" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pengembalian</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>sirkulasi/Pembayaran/pembayaran_denda_anggota" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Pembayaran</p>
                                   </a>
                               </li>
                           </ul>
                       </li>

                       <li class="nav-item">
                           <a href="<?= site_url() ?>sirkulasi/Sumbangan_buku" class="nav-link">
                               <i class="nav-icon fas fa-file-archive"></i>
                               <p>
                                   Sumbangan Buku
                               </p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="<?= site_url() ?>user/Anggota/bebas_pustaka" class="nav-link">
                               <i class="nav-icon fas fa-flag-checkered"></i>
                               <p>
                                   Bebas Pustaka
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
                           <a href="<?= base_url('user/Non_anggota') ?>" class="nav-link">
                               <i class="nav-icon fas fa-home"></i>
                               <p>
                                   Dashboard
                               </p>
                           </a>
                       </li>
                       <!-- <li class="nav-item">
                           <a href="<?= base_url('user/Anggota/ubah/' . $this->session->userdata('username')) ?>" class="nav-link">
                               <i class="nav-icon fas fa-users"></i>
                               <p>
                                   Profil
                               </p>
                           </a>
                       </li> -->

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
                                   <a href="<?= site_url() ?>data/Buku" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>Daftar Buku</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="<?= site_url() ?>data/Buku/opac" class="nav-link">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>OPAC</p>
                                   </a>
                               </li>
                           </ul>
                       </li>
                       <!-- <li class="nav-item">
                           <a href="./index.html" class="nav-link">
                               <i class="nav-icon fas fa-book-reader"></i>
                               <p>
                                   Baca Ditempat
                               </p>
                           </a>
                       </li> -->
                       <!-- <li class="nav-item">
                           <a href="<?= site_url() ?>sirkulasi/Sumbangan_buku" class="nav-link">
                               <i class="nav-icon fas fa-file-archive"></i>
                               <p>
                                   Sumbangan Buku
                               </p>
                           </a>
                       </li> -->
                   </ul>
               </nav>
               <!-- /.sidebar-menu -->
           <?php endif; ?>
       </div>
   </aside>