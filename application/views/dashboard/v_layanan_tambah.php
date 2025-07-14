<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Tambah Layanan</b> <small>Kelola Layanan Website</small></h1>
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

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file"></i> Data Layanan <small>Tambah Layanan Baru</small>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/layanan_aksi') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label>Nama Layanan</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Layanan..." value="<?php echo set_value('nama'); ?>" required>
                                        <br>
                                        <?php echo form_error('nama'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
										<textarea class="form-control" name="deskripsi" id="summernote" placeholder="Masukkan Deskripsi Layanan..."></textarea>
                                        <br>
                                        <?php echo form_error('deskripsi'); ?>
                                    </div>

									<div class="form-group">
										<label>Status</label>
										<select name="status" class="form-control">
											<option value="0">Draft</option>
											<option value="1">Publish</option>
										</select>
										<br>
									</div>

                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar" class="form-control">
                                        <br>
                                        <?php if (isset($gambar_error)) { echo '<div class="text-danger">' . $gambar_error . '</div>'; } ?>
                                        <?php echo form_error('gambar'); ?>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <!-- Kolom kosong untuk konsistensi layout -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
