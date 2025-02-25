<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?php echo $title; ?></h1>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<?php if ($this->session->flashdata('success')) : ?>
				<div class="alert alert-success" role="alert">
					<?= $this->session->flashdata('success') ?>
				</div>
			<?php endif; ?>
			<div class="row">
				<!-- Data Peminjaman -->
				<div class="col-md-6">
					<div class="card shadow-sm">
						<div class="card-header bg-primary text-white d-flex align-items-center">
							<button class="btn btn-success btn-sm px-3 py-2 me-auto" data-toggle="modal" data-target="#modalTambah">
								<i class="fas fa-plus"></i> Tambah
							</button>
							<h5 class="m-0">Data Peminjaman</h5>
						</div>
						<div class="card-body p-3">
							<table class="table table-hover table-striped">
								<thead class="thead-dark text-center">
									<tr class="fs-6">
										<th>ID</th>
										<th>Pegawai</th>
										<th>Barang</th>
										<th>Pinjam</th>
										<th>Kembali</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($peminjaman as $p) : ?>
										<?php if ($p->status_peminjaman == 'Dipinjam') : ?>
											<tr class="text-center">
												<td class="fw-bold"><?= $p->id_peminjaman; ?></td>
												<td><?= $p->nama_pegawai; ?></td>
												<td>
													<?php
													$detail_pinjam = $this->Peminjaman_model->get_detail_pinjam_by_peminjaman($p->id_peminjaman);
													foreach ($detail_pinjam as $dp) {
														echo $dp->nama_barang . ' (Jumlah: ' . $dp->jumlah . ')<br>';
													}
													?>
												</td>
												<td><?= date('d-m-Y', strtotime($p->tanggal_pinjam)); ?></td>
												<td><?= date('d-m-Y', strtotime($p->tanggal_kembali)); ?></td>
												<td><span class="badge badge-warning"><?= $p->status_peminjaman; ?></span></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-light btn-sm" type="button" id="dropdownMenu<?= $p->id_peminjaman; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fas fa-ellipsis-v"></i>
														</button>
														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu<?= $p->id_peminjaman; ?>">
															<button class="dropdown-item" data-toggle="modal" data-target="#modalEdit<?= $p->id_peminjaman; ?>">
																Edit
															</button>
															<a class="dropdown-item text-danger" href="<?= base_url('peminjaman/hapus/' . $p->id_peminjaman); ?>" onclick="return confirm('Yakin ingin menghapus?')">
																Hapus
															</a>
															<a class="dropdown-item text-success" href="<?= base_url('peminjaman/kembalikan/' . $p->id_peminjaman); ?>" onclick="return confirm('Yakin ingin mengembalikan barang ini?')">
																Kembalikan
															</a>
														</div>
													</div>
												</td>
											</tr>
										<?php endif; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- Data Pengembalian -->
				<div class="col-md-6">
					<div class="card">
						<div class="card-header bg-success text-white">
							<h3 class="card-title">Data Pengembalian</h3>
						</div>
						<div class="card-body">
							<table class="table table-hover table-striped">
								<thead class="thead-dark">
									<tr>
										<th>ID</th>
										<th>Pegawai</th>
										<th>Barang</th>
										<th>Tanggal Pinjam</th>
										<th>Tanggal Kembali</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($peminjaman as $p) : ?>
										<?php if ($p->status_peminjaman == 'Dikembalikan' || $p->status_peminjaman == 'Terlambat') : ?>
											<tr>
												<td><?= $p->id_peminjaman; ?></td>
												<td><?= $p->nama_pegawai; ?></td>
												<td>
													<?php
													$detail_pinjam = $this->Peminjaman_model->get_detail_pinjam_by_peminjaman($p->id_peminjaman);
													foreach ($detail_pinjam as $dp) {
														echo $dp->nama_barang . ' (Jumlah: ' . $dp->jumlah . ')<br>';
													}
													?>
												</td>
												<td><?= date('d-m-Y', strtotime($p->tanggal_pinjam)); ?></td>
												<td><?= date('d-m-Y', strtotime($p->tanggal_kembali)); ?></td>
												<td>
													<span class="badge <?= ($p->status_peminjaman == 'Terlambat') ? 'badge-danger' : 'badge-success'; ?>">
														<?= $p->status_peminjaman; ?>
													</span>
												</td>
											</tr>
										<?php endif; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalTambahLabel">Tambah Peminjaman</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('peminjaman/tambah'); ?>" method="post">
					<?php if ($this->session->flashdata('error')): ?>
						<div class="alert alert-danger">
							<?php echo $this->session->flashdata('error'); ?>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label for="tanggal_pinjam">Tanggal Pinjam</label>
						<input type="date"
							id="tanggal_pinjam"
							name="tanggal_pinjam"
							class="form-control"
							value="<?php echo set_value('tanggal_pinjam'); ?>"
							required>
						<?php if (form_error('tanggal_pinjam')): ?>
							<span class="help-block text-danger"><?php echo form_error('tanggal_pinjam'); ?></span>
						<?php endif; ?>
					</div>
					<div class="form-group">
						<label for="tanggal_kembali">Tanggal Kembali</label>
						<input type="date"
							id="tanggal_kembali"
							name="tanggal_kembali"
							class="form-control"
							value="<?php echo set_value('tanggal_kembali'); ?>"
							required>
						<?php if (form_error('tanggal_kembali')): ?>
							<span class="help-block text-danger"><?php echo form_error('tanggal_kembali'); ?></span>
						<?php endif; ?>
					</div>
					<div class="form-group">
						<label for="id_pegawai">Pegawai</label>
						<select name="id_pegawai" id="id_pegawai" class="form-control" required>
							<option value="">Pilih Pegawai</option>
							<?php foreach ($pegawai as $pegawai) : ?>
								<option value="<?php echo $pegawai->id_pegawai; ?>"><?php echo $pegawai->nama_pegawai; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_inventaris">Barang</label>
						<select name="id_inventaris" id="id_inventaris" class="form-control" required>
							<option value="">Pilih Barang</option>
							<?php foreach ($inventaris as $inventaris) : ?>
								<option value="<?php echo $inventaris->id_inventaris; ?>"><?php echo $inventaris->nama; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="jumlah">Jumlah</label>
						<input type="number"
							id="jumlah"
							name="jumlah"
							class="form-control"
							value="<?php echo set_value('jumlah'); ?>"
							required>
						<?php if (form_error('jumlah')): ?>
							<span class="help-block text-danger"><?php echo form_error('jumlah'); ?></span>
						<?php endif; ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php foreach ($peminjaman as $p): ?>
    <div class="modal fade" id="modalEdit<?php echo $p->id_peminjaman; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel<?php echo $p->id_peminjaman; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEditLabel<?php echo $p->id_peminjaman; ?>">Edit Peminjaman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('peminjaman/edit/' . $p->id_peminjaman); ?>" method="post">
                        <div class="form-group">
                            <label for="tanggal_pinjam">Tanggal Pinjam</label>
                            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="<?php echo $p->tanggal_pinjam; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Kembali</label>
                            <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" value="<?php echo $p->tanggal_kembali; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_pegawai">Pegawai</label>
                            <select name="id_pegawai" id="id_pegawai" class="form-control" required>
                                <option value="">Pilih Pegawai</option>
                                <?php foreach ($pegawai as $pegawai) : ?>
                                    <option value="<?php echo $pegawai->id_pegawai; ?>" <?php echo ($pegawai->id_pegawai == $p->id_pegawai) ? 'selected' : ''; ?>><?php echo $pegawai->nama_pegawai; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_inventaris">Barang</label>
                            <select name="id_inventaris" id="id_inventaris" class="form-control" required>
                                <option value="">Pilih Barang</option>
                                <?php foreach ($inventaris as $inventaris) : ?>
                                    <option value="<?php echo $inventaris->id_inventaris; ?>" <?php echo ($inventaris->id_inventaris == $p->id_inventaris) ? 'selected' : ''; ?>><?php echo $inventaris->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php
                        $detail_pinjam = $this->Peminjaman_model->get_detail_pinjam_by_peminjaman($p->id_peminjaman);
                        foreach ($detail_pinjam as $dp) {
                            ?>
                            <div class="form-group">
                                <label for="jumlah_<?php echo $dp->id_inventaris; ?>">Jumlah</label>
                                <input type="number" id="jumlah_<?php echo $dp->id_inventaris; ?>" name="jumlah[]" class="form-control" value="<?php echo $dp->jumlah; ?>" required>
                            </div>
                        <?php } ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
