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
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="fas fa-shopping-cart"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
              </a>

          </li>

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