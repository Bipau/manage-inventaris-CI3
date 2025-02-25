<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Register</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php echo form_open_multipart('RegisterController/register_action'); ?>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
                            <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama_petugas" class="form-label">Nama</label>
                            <input type="text" name="nama_petugas" class="form-control" value="<?php echo set_value('nama_petugas'); ?>">
                            <?php echo form_error('nama_petugas', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                       
                        
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                        
                        <?php echo form_close(); ?>
                    </div>
                    <div class="card-footer text-center">
                        <p>Sudah punya akun? <a href="<?php echo base_url('AuthController/index'); ?>" class="btn btn-link">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
