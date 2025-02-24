<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Data Petugas</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Petugas</li>
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
							<h3 class="card-title">Form Tambah Petugas</h3>

						</div>

						<!-- /.card-header -->
						<div class="card-body">
							<?php echo form_open_multipart('PetugasController/CreateAction'); ?>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" required>
								<?php if (form_error('username')) : ?>
									<small class="text-danger"><?= form_error('username'); ?></small>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="nama_petugas">Nama Petugas</label>
								<input type="text" class="form-control" id="nama_petugas" name="nama_petugas" required>
								<?php if (form_error('nama_petugas')) : ?>
									<small class="text-danger"><?= form_error('nama_petugas'); ?></small>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" required>
								<?php if (form_error('password')) : ?>
									<small class="text-danger"><?= form_error('password'); ?></small>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="id_level">Level</label>
								<select class="form-control" id="id_level" name="id_level">
									<option value="">Pilih Level</option>
									<?php foreach ($level as $lvl): ?>
										<option value="<?= $lvl['id_level'] ?>"><?= $lvl['nama_level'] ?></option>
									<?php endforeach; ?>
								</select>
								<?php if (form_error('id_level')) : ?>
									<small class="text-danger"><?= form_error('id_level'); ?></small>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="foto">Foto</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="foto" name="foto" required>
									<label class="custom-file-label" for="foto">Pilih file</label>
								</div>
								<small class="text-muted">Format: JPG, PNG, JPEG. Max: 2MB</small>
								<?php if (form_error('foto')) : ?>
									<small class="text-danger"><?= form_error('foto'); ?></small>
								<?php endif; ?>
							</div>
							<div class="modal-footer justify-content-between">
								<a href="<?= base_url('PetugasController/index') ?>" class="btn btn-secondary">Kembali</a>
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

