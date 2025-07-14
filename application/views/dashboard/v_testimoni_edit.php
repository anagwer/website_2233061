<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Edit Testimoni</b> <small>Kelola Testimoni Pengguna</small></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a href="<?= base_url('dashboard/testimoni'); ?>">
                    <button class="btn btn-sm btn-success">Kembali</button>
                </a>
                <br><br>

                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-comments"></i> Data Testimoni <small>Edit Testimoni</small>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/testimoni_update') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $testimoni[0]->id ?>">

                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna..." value="<?= htmlspecialchars($testimoni[0]->nama) ?>" required>
                                <br>
                                <?= form_error('nama'); ?>
                            </div>

                            <!-- Isi Testimoni -->
                            <div class="form-group">
                                <label>Isi Testimoni</label>
                                <textarea name="testi" class="form-control" rows="5" placeholder="Masukkan testimoni..." required><?= htmlspecialchars($testimoni[0]->testi) ?></textarea>
                                <br>
                                <?= form_error('testi'); ?>
                            </div>

							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="0" <?= ($testimoni[0]->status == 0) ? 'selected' : '' ?>>Belum ACC</option>
									<option value="1" <?= ($testimoni[0]->status == 1) ? 'selected' : '' ?>>ACC</option>
								</select>
								<br>
								<?= form_error('testi'); ?>
							</div>

                            <!-- Gambar -->
                            <div class="form-group">
                                <label>Gambar Saat Ini</label><br>
                                <?php if ($testimoni[0]->gambar): ?>
                                    <img src="<?= base_url('./gambar/testimoni/' . $testimoni[0]->gambar) ?>" width="150" class="img-thumbnail"><br><br>
                                <?php else: ?>
                                    Tidak ada gambar.
                                <?php endif; ?>

                                <label>Ubah Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                                <br>
                                <?php if (isset($gambar_error)) { echo '<div class="text-danger">' . $gambar_error . '</div>'; } ?>
                                <?= form_error('gambar'); ?>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
