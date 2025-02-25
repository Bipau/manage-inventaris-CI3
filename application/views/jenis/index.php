<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Data Jenis</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Jenis</li>
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
							<h3 class="card-title">Data Jenis</h3>

						</div>

						<!-- /.card-header -->
						<div class="card-body">
							<button type="button" class="btn btn-success mb-4 ms-2" data-toggle="modal" data-target="#modal-xl">
								Tambah Jenis
							</button>

							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Jenis</th>
										<th>Kode Jenis</th>
										<th>Keterangan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($jenis as $data) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $data['nama_jenis']; ?></td>
											<td><?= $data['kode_jenis']; ?></td>
											<td><?= $data['keterangan']; ?></td>
											<td>
												<a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit-<?= $data['id_jenis']; ?>">
													<i class="fa fa-edit"></i>
												</a>
												<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="<?= $data['id_jenis']; ?>">
													<i class="fa fa-trash"></i>
												</a>

											</td>
										</tr>

										<div class="modal fade" id="modal-edit-<?= $data['id_jenis']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Jenis</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<?php $this->load->view('jenis/edit_jenis', ['jenis' => $data]); ?>
													</div>
												</div>
											</div>
										</div>
										<!-- Modal Edit for each row -->
									
									<?php endforeach; ?>
                                    </tbody>
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
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Jenis</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Form -->
				<?php $this->load->view('jenis/create'); ?>
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
            let deleteUrl = "<?= base_url('JenisController/deleteDataJenis/') ?>" + id;

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
