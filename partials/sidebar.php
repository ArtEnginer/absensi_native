  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="dist/img/bpjs.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">APLIKASI BPJS </span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nm_pegawai'] ?></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="?page=home" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav-treeview">
              <li class="nav-item">
                <a href="?page=jabatanread" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=pegawairead" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pegawai</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="?page=ab" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Presensi Karyawan
              </p>
            </a>
          </li>
          <?php
          if ($_SESSION['peran'] == 'user') {
          ?>
            <li class="nav-item">
              <a href="?page=ab" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Presensi Mahasiswa
                </p>
              </a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a href="?page=cutiread" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Surat Cuti
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=kread" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Kagiatan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav-treeview">
              <li class="nav-item">
                <a href="?page=userread" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
            <ul class="nav-treeview">
              <li class="nav-item">
                <a href="?page=ttdread" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tanda Tangan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="?page=logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sing Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>