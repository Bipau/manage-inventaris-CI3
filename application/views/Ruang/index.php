<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Ruang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Ruang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-end">
                            <h3 class="card-title">Data Ruang</h3>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <button type="button" class="btn btn-success mb-4 ms-2">
                                <a href="<?= base_url('Ruang_Controller/create') ?>" class="text-white text-decoration-none">
                                    Tambah Ruang
                                </a>
                            </button>
                            <button type="button" class="btn btn-secondary mb-4 ms-2">
                                <a class="text-white text-decoration-none" href="<?= base_url('Ruang_Controller/print') ?>">
                                    <i class="fa fa-print"> Print</i>
                                </a>
                            </button>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Ruang</th>
                                        <th>Nama Ruang</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($ruang as $data) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['kode_ruang']; ?></td>
                                            <td><?= $data['nama_ruang']; ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td>
                                            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit-<?= $data['id_ruang']; ?>">
													<i class="fa fa-edit"></i>
												</a>
                                                <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="<?= $data['id_ruang']; ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-edit-<?= $data['id_ruang']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Ruang</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<?php $this->load->view('Ruang/edit', ['ruang' => $data]); ?>
													</div>
												</div>
											</div>
										</div>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript untuk konfirmasi hapus -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Tangkap semua tombol hapus
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let id = this.getAttribute("data-id");
            let deleteUrl = "<?= base_url('Ruang_Controller/DeleteRuang/') ?>" + id;

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
