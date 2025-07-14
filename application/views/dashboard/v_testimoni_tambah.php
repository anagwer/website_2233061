<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Tambah Testimoni</b> <small>Kelola Testimoni Pengguna</small></h1>
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

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-comments"></i> Data Testimoni <small>Tambah Testimoni Baru</small>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/testimoni_aksi') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-9">

                                    <!-- Input Nama -->
                                    <div class="form-group">
                                        <label>Nama Pengguna</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna..." value="<?= set_value('nama'); ?>" required>
                                        <br>
                                        <?= form_error('nama'); ?>
                                    </div>

                                    <!-- Input Testimoni -->
                                    <div class="form-group">
                                        <label>Isi Testimoni</label>
                                        <textarea class="form-control" name="testi" rows="5" placeholder="Masukkan testimoni pengguna..."><?= set_value('testi'); ?></textarea>
                                        <br>
                                        <?= form_error('testi'); ?>
                                    </div>
									
                                    <!-- Input Gambar -->
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar" class="form-control">
                                        <br>
                                        <?php if (isset($gambar_error)) { echo '<div class="text-danger">' . $gambar_error . '</div>'; } ?>
                                        <?= form_error('gambar'); ?>
                                    </div>

                                    <!-- Tombol Simpan -->
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
