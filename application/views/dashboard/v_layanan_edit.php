<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Edit Layanan</b> <small>Kelola Layanan Website</small></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo base_url('dashboard/layanan'); ?>">
                    <button class="btn btn-sm btn-success">Kembali</button>
                </a>
                <br><br>

                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file"></i> Data Layanan <small>Edit Layanan</small>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/layanan_update') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $layanan[0]->id ?>">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Nama Layanan</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Layanan..." value="<?= htmlspecialchars($layanan[0]->nama) ?>" required>
                                        <br>
                                        <?php echo form_error('nama'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <?php echo form_error('deskripsi'); ?>
                                        <textarea name="deskripsi" class="form-control" rows="5" id="summernote" placeholder="Masukkan Deskripsi Layanan..." required><?= htmlspecialchars($layanan[0]->deskripsi) ?></textarea>
                                        <br>
                                    </div>

									<div class="form-group">
										<label>Status</label>
										<select name="status" class="form-control">
											<option value="0" <?= ($layanan[0]->status == 0) ? 'selected' : '' ?>>Draft</option>
											<option value="1" <?= ($layanan[0]->status == 1) ? 'selected' : '' ?>>Publish</option>
										</select>
										<br>
									</div>

                                    <div class="form-group">
                                        <label>Gambar Saat Ini</label><br>
                                        <?php if ($layanan[0]->gambar): ?>
                                            <img src="<?= base_url('./gambar/layanan/' . $layanan[0]->gambar) ?>" width="150"><br><br>
                                        <?php else: ?>
                                            Tidak ada gambar.
                                        <?php endif; ?>

                                        <label>Ubah Gambar</label>
                                        <input type="file" name="gambar" class="form-control">
                                        <br>
                                        <?php if (isset($gambar_error)) { echo '<div class="text-danger">' . $gambar_error . '</div>'; } ?>
                                        <?php echo form_error('gambar'); ?>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
