<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Inventaris</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Inventaris</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                        <table class="table" style="min-width: 1500px;">
                            <thead>
                                <tr>
                                    <th style="min-width: 50px;">No</th>
                                    <th style="min-width: 100px;">Kode</th>
                                    <th style="min-width: 150px;">Foto</th>
                                    <th style="min-width: 200px;">Nama</th>
                                    <th style="min-width: 120px;">Kondisi</th>
                                    <th style="min-width: 250px;">Keterangan</th>
                                    <th style="min-width: 100px;">Jumlah</th>
                                    <th style="min-width: 150px;">Jenis</th>
                                    <th style="min-width: 150px;">Petugas</th>
                                    <th style="min-width: 150px;">Ruang</th>
                                    <th style="min-width: 200px;">Tanggal Register</th>
                                    <th style="min-width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($inventaris)): ?>
                                    <?php $no = 1;
                                    foreach ($inventaris as $inv): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $inv->kode_inventaris; ?></td>
                                            <td>
                                                <?php if (!empty($inv->foto)): ?>
                                                    <img src="<?= base_url('uploads/' . $inv->foto); ?>" alt="Foto" width="150" height="150">
                                                <?php else: ?>
                                                    <span class="text-muted">Tidak Ada</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $inv->nama; ?></td>
                                            <td><?= $inv->kondisi; ?></td>
                                            <td><?= $inv->keterangan; ?></td>
                                            <td><?= $inv->jumlah; ?></td>
                                            <td><?= $inv->nama_jenis; ?></td>
                                            <td><?= $inv->nama_petugas; ?></td>
                                            <td><?= $inv->nama_ruang; ?></td>
                                            <td><?= date('d-m-Y', strtotime($inv->tanggal_register)); ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#modalEdit<?= $inv->id_inventaris; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="<?= base_url('C_inventaris/hapus/' . $inv->id_inventaris); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="12" class="text-center">Data tidak tersedia</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Inventaris</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('C_inventaris/simpan'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Kode Inventaris</label>
                    <input type="text" name="kode_inventaris" class="form-control" value="<?= uniqid('INV-'); ?>"
                        readonly>

                    <label>Nama Inventaris</label>
                    <input type="text" name="nama" class="form-control" required>

                    <label>Kondisi</label>
                    <select name="kondisi" class="form-control" required>
                        <option value="" disabled selected>Pilih Kondisi</option>
                        <option value="Bagus">Bagus</option>
                        <option value="Sedikit Rusak">Sedikit Rusak</option>
                        <option value="Rusak">Rusak</option>
                    </select>

                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>

                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>

                    <label>Jenis</label>
                    <select name="id_jenis" class="form-control">
                        <option value="" disabled selected>Pilih Jenis</option>
                        <?php foreach ($jenis as $j): ?>
                            <option value="<?= $j->id_jenis; ?>"><?= $j->nama_jenis; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Petugas</label>
                    <select name="id_petugas" class="form-control">
                        <option value="" disabled selected>Pilih Petugas</option>
                        <?php foreach ($petugas as $p): ?>
                            <option value="<?= $p->id_petugas; ?>"><?= $p->nama_petugas; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Ruang</label>
                    <select name="id_ruang" class="form-control">
                        <option value="" disabled selected>Pilih Ruang</option>
                        <?php foreach ($ruang as $r): ?>
                            <option value="<?= $r->id_ruang; ?>"><?= $r->nama_ruang; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Tanggal Register</label>
                    <input type="date" name="tanggal_register" class="form-control" value="<?= date('Y-m-d'); ?>"
                        required>

                    <label>Foto Inventaris</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEdit<?= $inv->id_inventaris; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Inventaris</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('C_inventaris/update/' . $inv->id_inventaris); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Kode Inventaris</label>
                    <input type="text" name="kode_inventaris" class="form-control" value="<?= $inv->kode_inventaris; ?>" readonly>

                    <label>Nama Inventaris</label>
                    <input type="text" name="nama" class="form-control" value="<?= $inv->nama; ?>" required>

                    <label>Kondisi</label>
                    <select name="kondisi" class="form-control" required>
                        <option value="Bagus" <?= ($inv->kondisi == "Bagus") ? 'selected' : ''; ?>>Bagus</option>
                        <option value="Sedikit Rusak" <?= ($inv->kondisi == "Sedikit Rusak") ? 'selected' : ''; ?>>Sedikit Rusak</option>
                        <option value="Rusak" <?= ($inv->kondisi == "Rusak") ? 'selected' : ''; ?>>Rusak</option>
                    </select>

                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"><?= $inv->keterangan; ?></textarea>

                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $inv->jumlah; ?>" required>

                    <label>Jenis</label>
                    <select name="id_jenis" class="form-control">
                        <?php foreach ($jenis as $j): ?>
                            <option value="<?= $j->id_jenis; ?>" <?= ($j->id_jenis == $inv->id_jenis) ? 'selected' : ''; ?>>
                                <?= $j->nama_jenis; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Petugas</label>
                    <select name="id_petugas" class="form-control">
                        <?php foreach ($petugas as $p): ?>
                            <option value="<?= $p->id_petugas; ?>" <?= ($p->id_petugas == $inv->id_petugas) ? 'selected' : ''; ?>>
                                <?= $p->nama_petugas; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Ruang</label>
                    <select name="id_ruang" class="form-control">
                        <?php foreach ($ruang as $r): ?>
                            <option value="<?= $r->id_ruang; ?>" <?= ($r->id_ruang == $inv->id_ruang) ? 'selected' : ''; ?>>
                                <?= $r->nama_ruang; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Tanggal Register</label>
                    <input type="date" name="tanggal_register" class="form-control" value="<?= $inv->tanggal_register; ?>" required>

                    <label>Foto Inventaris</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
