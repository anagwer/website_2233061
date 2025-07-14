<!--/ Intro Skew Star /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url();?>assets_frontend/img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Testimoni</h2>
                <p class="subtitle-a text-white">
                    Tambahkan testimoni Anda di sini
                </p>
                <div class="line-mf" style="color:black;"></div>
            </div>
        </div>
    </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Testimoni Form Start /-->
<section id="testimoni-form" class="services-mf sect-pt4 route">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="<?= base_url() ?>" class="btn btn-sm btn-secondary mb-3">
                    Kembali
                </a>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-comment"></i> Tambah Testimoni
                        </h3>
                    </div>

                    <div class="card-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <form method="post" action="<?= base_url('welcome/testimoni_aksi'); ?>" enctype="multipart/form-data">

                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" value="<?= set_value('nama'); ?>">
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <!-- Testimoni -->
                            <div class="form-group">
                                <label>Testimoni</label>
                                <textarea name="testi" class="form-control" rows="5" placeholder="Tulis testimoni Anda..."><?= set_value('testi'); ?></textarea>
                                <?= form_error('testi', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <!-- Gambar -->
                            <div class="form-group">
                                <label>Gambar Profil</label>
                                <input type="file" name="gambar" class="form-control">
                                <?= form_error('gambar', '<small class="text-danger">', '</small>'); ?>
                                <?php if (isset($error_gambar)) echo '<small class="text-danger">' . $error_gambar . '</small>'; ?>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Kirim Testimoni
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Section Testimoni Form End /-->
