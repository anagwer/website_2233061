<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Data Portofolio</b> <small>manajemen portofolio</small></h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-briefcase"></i> Data Portofolio
              </h3>
            </div>

            <div class="card-body">
              <a href="<?php echo base_url('dashboard/portofolio_tambah'); ?>">
                <button class="btn btn-sm btn-success">
                  Buat Portofolio Baru <i class="fas fa-plus"></i>
                </button>
              </a>
              <hr>

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th width="10%">Gambar</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php $no = 1; foreach ($portofolio as $p) { ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo date('d/m/y H:i', strtotime($p->portofolio_tanggal)); ?></td>
                      <td>
                        <?php echo $p->portofolio_judul; ?><br>
                        <small class="text-muted d-none"><?php echo base_url('portofolio/' . $p->portofolio_slug); ?></small>
                      </td>
                      <td><?php echo $p->pengguna_nama; ?></td>
                      <td>
                        <img width="100%" class="img-fluid" src="<?php echo base_url('gambar/portofolio/' . $p->portofolio_sampul); ?>">
                      </td>
                      <td>
                        <?php if ($p->portofolio_status == "Publish") { ?>
                          <span class="badge badge-success">Publish</span>
                        <?php } else { ?>
                          <span class="badge badge-danger">Draft</span>
                        <?php } ?>
                      </td>
                      <td>
                        <a target="_blank" href="<?php echo base_url('portofolio/' . $p->portofolio_slug); ?>">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
                        </a>

                        <?php if ($this->session->userdata('level') == 'penulis') { ?>
                          <?php if ($this->session->userdata('id') == $p->portofolio_author) { ?>
                            <a href="<?php echo base_url('dashboard/portofolio_edit/' . $p->portofolio_id); ?>">
                              <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                            </a>
                            <a href="<?php echo base_url('dashboard/portofolio_hapus/' . $p->portofolio_id); ?>" onclick="return confirm('Yakin Hapus Data Ini ?')">
                              <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </a>
                          <?php } ?>
                        <?php } else { ?>
                          <a href="<?php echo base_url('dashboard/portofolio_edit/' . $p->portofolio_id); ?>">
                            <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                          </a>
                          <a href="<?php echo base_url('dashboard/portofolio_hapus/' . $p->portofolio_id); ?>" onclick="return confirm('Yakin Hapus Data Ini ?')">
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                          </a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>