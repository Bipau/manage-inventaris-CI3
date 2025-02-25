<!-- Modal Create -->
<div class="modal fade <?php echo $this->session->flashdata('show_modal') ? 'show' : ''; ?>" id="modalMahasiswa"
    tabindex="-1" aria-labelledby="modalMahasiswaLabel"
    aria-hidden="<?php echo $this->session->flashdata('show_modal') ? 'false' : 'true'; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMahasiswaLabel">Input Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <?php echo form_open_multipart('PegawaiController/createPegawai'); ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Pegawai</label>
                        <input type="text"
                            class="form-control <?php echo $this->session->flashdata('error_nama_pegawai') ? 'is-invalid' : ''; ?>"
                            name="nama_pegawai" id="nama_pegawai"
                            value="<?php echo $this->session->flashdata('old_data')['nama_pegawai'] ?? ''; ?>">
                        <div class="invalid-feedback">
                            <?php echo $this->session->flashdata('error_nama_pegawai'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="number"
                            class="form-control <?php echo $this->session->flashdata('error_nip') ? 'is-invalid' : ''; ?>"
                            name="nip" id="nip"
                            value="<?php echo $this->session->flashdata('old_data')['nip'] ?? ''; ?>">
                        <div class="invalid-feedback">
                            <?php echo $this->session->flashdata('error_nip'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text"
                            class="form-control <?php echo $this->session->flashdata('error_alamat') ? 'is-invalid' : ''; ?>"
                            name="alamat" id="alamat"
                            value="<?php echo $this->session->flashdata('old_data')['alamat'] ?? ''; ?>">
                        <div class="invalid-feedback">
                            <?php echo $this->session->flashdata('error_alamat'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file"
                            class="form-control <?php echo $this->session->flashdata('error_foto') ? 'is-invalid' : ''; ?>"
                            name="foto" id="foto"
                            value="<?php echo $this->session->flashdata('old_data')['foto'] ?? ''; ?>">
                        <div class="invalid-feedback">
                            <?php echo $this->session->flashdata('error_foto'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<?php foreach ($pegawai as $pegawais): ?>
    <div class="modal fade" id="modalUpdate<?= $pegawais['id_pegawai'] ?>" tabindex="-1" aria-labelledby="modalPegawaiLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPegawaiLabel">Edit Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm<?= $pegawais['id_pegawai'] ?>" method="post"
                        action="<?php echo base_url('PegawaiController/updatePegawai/' . $pegawais['id_pegawai']); ?>">
                        <div class="mb-3">
                            <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama_pegawai"
                                value="<?= $pegawais['nama_pegawai'] ?>" id="nama_pegawai">
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="number" class="form-control" name="nip" value="<?= $pegawais['nip'] ?>" id="nip">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?= $pegawais['alamat'] ?>"
                                id="alamat">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" onclick="updateConfirm(<?= $pegawais['id_pegawai'] ?>)"
                                class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Users</h1>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                        data-bs-target="#modalMahasiswa">
                        Create User
                    </button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Pegawai</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <tr>
                                    <th>Nama Pegawai</th>
                                    <th>NIP</th>
                                    <th>Alamat</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                foreach ($pegawai as $pegawais): ?>
                                    <tr>
                                        <td><?php echo $pegawais['nama_pegawai'] ?></td>
                                        <td><?php echo $pegawais['nip'] ?></td>
                                        <td><?php echo $pegawais['alamat'] ?></td>
                                        <td><?php echo $pegawais['created_at'] ?></td>
                                        <td><?php echo $pegawais['updated_at'] ?></td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="deleteConfirm(<?php echo $pegawais['id_pegawai']; ?>)"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdate<?php echo $pegawais['id_pegawai'] ?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
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