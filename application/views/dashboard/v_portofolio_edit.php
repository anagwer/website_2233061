<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Data Portofolio</b> <small>manajemen portofolio</small></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo base_url('dashboard/portofolio'); ?>">
                    <button class="btn btn-sm btn-success">Kembali</button>
                </a>
                <br><br>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-image"></i> Data Portofolio <small>Edit Portofolio</small>
                        </h3>
                    </div>

                    <div class="card-body">
                        <?php foreach ($portofolio as $p) { ?>
                            <form method="post" action="<?php echo base_url('dashboard/portofolio_update'); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>Judul Portofolio</label>
                                            <input type="hidden" name="id" value="<?php echo $p->portofolio_id; ?>">
                                            <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Portofolio..." value="<?php echo $p->portofolio_judul; ?>">
                                            <br>
                                            <?php echo form_error('judul'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Konten Portofolio</label>
                                            <?php echo form_error('konten'); ?>
                                            <textarea class="form-control summernote" name="konten"><?php echo $p->portofolio_konten; ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <input type="file" name="sampul" class="form-control">
                                            <br>
                                            <?php
                                            if (isset($gambar_error)) {
                                                echo $gambar_error;
                                            }
                                            echo form_error('sampul');
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" name="status" value="Draft" class="btn btn-sm btn-warning btn-block">
                                            <input type="submit" name="status" value="Publish" class="btn btn-sm btn-success btn-block">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div>
    </section>
</div>