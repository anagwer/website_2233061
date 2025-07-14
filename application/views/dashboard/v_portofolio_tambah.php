<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Data Portofolio</b> <small>tambah portofolio</small></h1>
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
                            <i class="fas fa-briefcase"></i> Data Portofolio <small>Tambah Portofolio Baru</small>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?php echo base_url('dashboard/portofolio_aksi'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label>Judul Portofolio</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Portofolio . . ." value="<?php echo set_value('judul'); ?>">
                                        <br>
                                        <?php echo form_error('judul'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi Portofolio</label>
                                        <?php echo form_error('konten'); ?>
                                        <textarea class="form-control summernote" name="konten"><?php echo set_value('konten'); ?></textarea>
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
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="draft">Draft</option>
        <option value="publish">Publish</option>
    </select>
    <?php echo form_error('status'); ?>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary btn-block">Simpan Portofolio</button>
</div>
                                </div> <!-- /.col -->
                            </div> <!-- /.row -->
                        </form>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div>
    </section>
</div>