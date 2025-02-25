<?php echo form_open_multipart('JenisController/UpdateAction'); ?>
<input type="hidden" name="id_jenis" value="<?= $jenis['id_jenis'] ?>">

<div class="form-group">
    <label for="nama_jenis">Nama Jenis</label>
    <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" value="<?= $jenis['nama_jenis'] ?>" required>
    <?php if (form_error('nama_jenis')) : ?>
        <small class="text-danger"><?= form_error('nama_jenis'); ?></small>
    <?php endif; ?>
</div>

<div class="form-group">
    <label for="kode_jenis">Kode Jenis</label>
    <input type="text" class="form-control" id="kode_jenis" name="kode_jenis" value="<?= $jenis['kode_jenis'] ?>" required>
    <?php if (form_error('kode_jenis')) : ?>
        <small class="text-danger"><?= form_error('kode_jenis'); ?></small>
    <?php endif; ?>
</div>

<div class="form-group">
    <label for="keterangan">Keterangan</label>
    <input type="keterangan" class="form-control" id="keterangan" name="keterangan" value="<?= $jenis['keterangan'] ?>" required>
    <?php if (form_error('keterangan')) : ?>
        <small class="text-danger"><?= form_error('keterangan'); ?></small>
    <?php endif; ?>
</div>

<div class="modal-footer justify-content-between">
    <a href="<?= base_url('JenisController/index') ?>" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</div>
<?php echo form_close(); ?>