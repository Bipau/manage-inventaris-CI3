<?php echo form_open_multipart('levelController/CreateAction'); ?>
<div class="form-group">
	<label for="level">Nama Level</label>
	<input type="text" class="form-control" id="level" name="level" required>
	<?php if (form_error('level')) : ?>
		<small class="text-danger"><?= form_error('level'); ?></small>
	<?php endif; ?>
</div>
<div class="modal-footer justify-content-between">
	<a href="<?= base_url('levelController/index') ?>" class="btn btn-secondary">Kembali</a>
	<button type="submit" class="btn btn-primary">Save changes</button>
</div>
<?php echo form_close(); ?>
