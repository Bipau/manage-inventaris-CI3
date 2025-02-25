<?php echo form_open_multipart('Ruang_Controller/UpdateAction'); ?>

<input type="hidden" name="id_ruang" value="<?= $ruang['id_ruang'] ?>">

<div class="form-group">
    <label for="ruang">Nama ruang</label>
    <input type="text" class="form-control" id="ruang" name="ruang" value="<?= $ruang['nama_ruang'] ?>" required>
    <?php if (form_error('ruang')) : ?>
        <small class="text-danger"><?= form_error('ruang'); ?></small>
    <?php endif; ?>
</div>
<div class="form-group">
    <label for="kode_ruang">Kode ruang</label>
    <input type="text" class="form-control" id="kode_ruang" name="kode_ruang" value="<?= $ruang['kode_ruang'] ?>" required>
    <?php if (form_error('kode_ruang')) : ?>
        <small class="text-danger"><?= form_error('kode_ruang'); ?></small>
    <?php endif; ?>
</div>
<div class="form-group">
    <label for="keterangan">keterangan</label>
    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $ruang['keterangan'] ?>" required>
    <?php if (form_error('keterangan')) : ?>
        <small class="text-danger"><?= form_error('keterangan'); ?></small>
    <?php endif; ?>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
<?php echo form_close(); ?>
