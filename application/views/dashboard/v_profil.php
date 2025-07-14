<div class="content-wrapper">
  <!-- Header Halaman -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Data Pengguna</b> <small>profil pengguna</small></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Konten Utama -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">

          <!-- Kartu Profil Pengguna -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-user"></i> Profil Pengguna <small>update profil pengguna</small>
              </h3>
            </div><!-- /.card-header -->

            <div class="card-body">
              <?php
              if (isset($_GET['alert'])) {
                if ($_GET['alert'] == "sukses") {
                  echo "<div class='alert alert-success'>Profil Pengguna Berhasil diupdate!</div>";
                }
              }

              foreach ($pengguna as $p) {
              ?>
                <form action="<?php echo base_url('dashboard/profil_update'); ?>" method="post">

                  <!-- Username (readonly) -->
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $p->pengguna_username; ?>" disabled>
                  </div>

                  <!-- Level (readonly) -->
                  <div class="form-group">
                    <label>Level Pengguna</label>
                    <input type="text" name="level" class="form-control" value="<?php echo $p->pengguna_level; ?>" disabled>
                  </div>

                  <!-- Nama -->
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama..." value="<?php echo $p->pengguna_nama; ?>">
                    <?php echo form_error('nama'); ?>
                  </div>

                  <!-- Email -->
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukan Email..." value="<?php echo $p->pengguna_email; ?>">
                    <?php echo form_error('email'); ?>
                  </div>

                  <!-- Tombol Submit -->
                  <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-success btn-block">
                  </div>

                </form>
              <?php } ?>
            </div><!-- /.card-body -->

          </div><!-- /.card -->
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
