  <?php
    $buku_dipinjam = count($this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $this->session->userdata('username')])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array());
    ?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <?php if ($this->session->userdata('role_id') == 'role_id_2') : ?>
              <!-- Messages Dropdown Menu -->
              <li class="nav-item dropdown">
                  <a class="nav-link" href="<?= base_url('/sirkulasi/peminjaman/keranjang_peminjaman') ?>" aria-expanded="false">
                      <i class="fas fa-shopping-cart"></i>
                      <span class="badge badge-danger navbar-badge"><?php if ($buku_dipinjam) {
                                                                        echo $buku_dipinjam;
                                                                    } ?></span>
                  </a>
              </li>
          <?php endif; ?>

          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-user-circle"></i>
              </a>

              <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                  <a href="<?= base_url('auth/logout') ?>" class="dropdown-item">
                      <i class="fas fa-sign-out-alt"></i> Logout
                  </a>
              </div>
          </li>


      </ul>
  </nav>
  <!-- /.navbar -->