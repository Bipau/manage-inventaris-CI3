<aside class="main-sidebar sidebar-light-orange elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link bg-orange bg-gray-dark">
		<img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminLTE 3</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">ADMIN</a>
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



		<!-- BACA INI -->
		<!-- Fungsi dari sidebar ini adalah untuk menampilkan menu-menu yang ada di dalam aplikasi. 
		 Menu-menu ini nantinya akan diarahkan ke halaman-halaman 
		 tertentu sesuai dengan menu yang dipilih. Untuk membuat menu baru, 
		 Anda bisa menambahkan kode seperti di bawah ini: 

		 sudah dinamis ya, jadi tinggal di copy paste aja,

		 
		 -->

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

				<!-- Petugas -->
				<li class="nav-item">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == 'pengaduan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-user-alt"></i>
						<p>Petugas</p>
					</a>
				</li>
				<!-- level -->
				<li class="nav-item">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == 'pengaduan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-user-alt"></i>
						<p>Level</p>
					</a>
				</li>
				<!-- Pegawai -->
				<li class="nav-item">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == 'pengaduan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>Pegawai</p>
					</a>
				</li>

				<!-- Ruang -->
				<li class="nav-item">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == 'tanggapan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-handshake"></i>
						<p>Ruang</p>
					</a>
				</li>
				<!-- Jenis -->
				<li class="nav-item">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == 'tanggapan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-handshake"></i>
						<p>Jenis</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == 'tanggapan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-handshake"></i>
						<p>Inventaris</p>
					</a>
				</li>
				<!-- Peminjaman -->
				<li class="nav-item">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == 'pengaduan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-comments"></i>
						<p>Peminjaman</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>