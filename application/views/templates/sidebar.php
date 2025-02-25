<aside class="main-sidebar sidebar-light-orange elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('DashboardController/render') ?>" class="brand-link bg-orange bg-gray-dark">
        <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Inventaris App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata('nama_petugas') ?? 'Guest' ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('DashboardController/render') ?>" class="nav-link <?= ($this->uri->segment(1) == 'DashboardController') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Menu Umum -->
                <li class="nav-header">MENU UMUM</li>
                <li class="nav-item">
                    <a href="<?= base_url('PegawaiController/index') ?>" class="nav-link <?= ($this->uri->segment(1) == 'PegawaiController') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Ruang_Controller/index') ?>" class="nav-link <?= ($this->uri->segment(1) == 'Ruang_Controller') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>Ruang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('JenisController/index') ?>" class="nav-link <?= ($this->uri->segment(1) == 'JenisController') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Jenis</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('C_inventaris/inventaris') ?>" class="nav-link <?= ($this->uri->segment(1) == 'C_inventaris') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Inventaris</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Peminjaman/index') ?>" class="nav-link <?= ($this->uri->segment(1) == 'Peminjaman') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>

                <!-- Menu Admin -->
                <?php if ($this->session->userdata('id_level') == 1): ?>
                    <li class="nav-header">MENU ADMIN</li>
                    <li class="nav-item">
                        <a href="<?= base_url('PetugasController/index') ?>" class="nav-link <?= ($this->uri->segment(1) == 'PetugasController') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Petugas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('LevelController/index') ?>" class="nav-link <?= ($this->uri->segment(1) == 'LevelController') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Level</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Menu Logout -->
                <li class="nav-header">AKUN</li>
                <li class="nav-item">
                    <a href="<?= base_url('AuthController/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
