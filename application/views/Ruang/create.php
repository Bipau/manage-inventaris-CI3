<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Data Ruang</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Ruang</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-between align-items-end">
							<h3 class="card-title">Form Tambah Ruang</h3>

						</div>

						<!-- /.card-header -->
						<div class="card-body">
							<?php echo form_open_multipart('Ruang_Controller/CreateAction'); ?>
							<div class="form-group">
								<label for="ruang">Nama Ruang</label>
								<input type="text" class="form-control" id="ruang" name="ruang" required>
								<?php if (form_error('ruang')) : ?>
									<small class="text-danger"><?= form_error('ruang'); ?></small>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="kode_ruang">Kode Ruang</label>
								<input type="text" class="form-control" id="kode_ruang" name="kode_ruang" required>
								<?php if (form_error('kode_ruang')) : ?>
									<small class="text-danger"><?= form_error('kode_ruang'); ?></small>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="keterangan">Keterangan</label>
								<input type="text" class="form-control" id="keterangan" name="keterangan" required>
								<?php if (form_error('keterangan')) : ?>
									<small class="text-danger"><?= form_error('keterangan'); ?></small>
								<?php endif; ?>
							</div>
							<div class="modal-footer justify-content-between">
								<a href="<?= base_url('Ruang_Controller/index') ?>" class="btn btn-secondary">Kembali</a>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
							<?php echo form_close(); ?>


						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->