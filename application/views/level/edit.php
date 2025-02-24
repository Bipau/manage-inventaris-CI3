<?php echo form_open_multipart('levelController/UpdateAction'); ?>

<input type="hidden" name="id_level" value="<?= $level['id_level'] ?>">

<div class="form-group">
    <label for="level">Nama Level</label>
    <input type="text" class="form-control" id="level" name="level" value="<?= $level['nama_level'] ?>" required>
    <?php if (form_error('level')) : ?>
        <small class="text-danger"><?= form_error('level'); ?></small>
    <?php endif; ?>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
<?php echo form_close(); ?>
