<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Petugas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Data Petugas</li>
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
                            <h3 class="card-title">Form Edit Petugas</h3>
                        </div>
                        <div class="card-body">
                            <?php echo form_open_multipart('PetugasController/UpdateAction'); ?>
                            <input type="hidden" name="id_petugas" value="<?= $petugas['id_petugas'] ?>">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $petugas['username'] ?>" required>
                                <?php if (form_error('username')) : ?>
                                    <small class="text-danger"><?= form_error('username'); ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="nama_petugas">Nama Petugas</label>
                                <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?= $petugas['nama_petugas'] ?>" required>
                                <?php if (form_error('nama_petugas')) : ?>
                                    <small class="text-danger"><?= form_error('nama_petugas'); ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                                <?php if (form_error('password')) : ?>
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="id_level">Level</label>
                                <select class="form-control" id="id_level" name="id_level">
                                    <option value="">Pilih Level</option>
                                    <?php foreach ($level as $lvl): ?>
                                        <option value="<?= $lvl['id_level'] ?>" <?= ($lvl['id_level'] == $petugas['id_level']) ? 'selected' : '' ?>>
                                            <?= $lvl['nama_level'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (form_error('id_level')) : ?>
                                    <small class="text-danger"><?= form_error('id_level'); ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg, .jpeg, .png" required>
                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                </div>
                                <small class="text-muted">Format: JPG, PNG, JPEG. Max: 2MB</small>
                                <?php if (!empty($petugas['foto'])): ?>
                                    <div class="mt-2">
                                        <img src="<?= base_url('uploads/' . $petugas['foto']) ?>" alt="Foto Petugas" class="img-thumbnail" width="100">
                                    </div>
                                <?php else: ?>
                                    <small class="text-muted">Belum ada foto.</small>
                                <?php endif; ?>
                                <?php if (form_error('foto')) : ?>
                                    <small class="text-danger"><?= form_error('foto'); ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <a href="<?= base_url('PetugasController/index') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
