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
							<h3 class="card-title">Data Petugas</h3>

						</div>

						<!-- /.card-header -->
						<div class="card-body">
							<button type="button" class="btn btn-success mb-4 ms-2">
								<a href="<?= base_url('PetugasController/create') ?>" class="text-white text-decoration-none">
									Tambah Petugas
								</a>
							</button>
							<button type="button" class="btn btn-secondary mb-4 ms-2">
								
								<a class="text-white text-decoration-none" href="<?= base_url('PetugasController/print') ?>">
									<i class="fa da-print">Print</i>
								</a>
							</button>


							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Foto</th>
										<th>Username</th>
										<th>Nama Petugas</th>
										<th>Level</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($petugas as $data) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td>
												<img src="<?= base_url('assets/img/' . $data['foto']); ?>" alt="Foto Petugas" class="avatar-img rounded-circle" width="50" height="50" style="object-fit: cover;">
											</td>
											<td><?= $data['username']; ?></td>
											<td><?= $data['nama_petugas']; ?></td>
											<td><?= $data['nama_level']; ?></td>
											<td>
												<a href="<?= base_url('PetugasController/Edit/'.$data['id_petugas'] ); ?>" class="btn btn-sm btn-warning" >
													<i class="fa fa-edit"></i>
												</a>
												<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="<?= $data['id_petugas']; ?>">
													<i class="fa fa-trash"></i>
												</a>

											</td>
										</tr>

										<!-- Modal Edit for each row -->
										<div class="modal fade" id="modal-edit-<?= $data['id_petugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-xl" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<?php $this->load->view('petugas/edit', ['petugas' => $data]); ?>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</tbody>

								<tfoot>
									<tr>
										<th>No</th>
										<th>Foto</th>
										<th>Username</th>
										<th>Nama Petugas</th>
										<th>Level</th>
										<th>Aksi</th>
									</tr>
								</tfoot>
							</table>
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

<!-- Modal -->
<div class="modal fade" id="modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Petugas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Form -->
				<?php $this->load->view('petugas/create'); ?>
			</div>
		</div>
	</div>
</div>



<!--  -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Tangkap semua tombol hapus
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let id = this.getAttribute("data-id");
            let deleteUrl = "<?= base_url('PetugasController/deletePetugas/') ?>" + id;

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    <?php if ($this->session->flashdata('success')) : ?>
        toastr.success("<?= $this->session->flashdata('success'); ?>");
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        toastr.error("<?= $this->session->flashdata('error'); ?>");
    <?php endif; ?>
});
</script>
