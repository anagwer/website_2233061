<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Data Layanan</b> <small>Kelola Layanan Website</small></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-file"></i> Data Layanan</h3>
                        </div>

                        <div class="card-body">
                            <a href="<?= base_url('dashboard/layanan_tambah') ?>">
                                <button class="btn btn-sm btn-success">
                                    Buat Layanan Baru <i class="fas fa-plus"></i>
                                </button>
                            </a>
                            <hr>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($layanan as $l): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
											<td>
                                                <?php if ($l->gambar): ?>
                                                    <img style="width:300px;" class="img-responsive" src="<?= base_url('./gambar/layanan/' . $l->gambar) ?>" alt="<?= $l->nama ?>">
                                                <?php else: ?>
                                                    Tanpa Gambar
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($l->nama) ?></td>
                                            <td><?= htmlspecialchars($l->pengguna_nama) ?></td>
                                            <td><?= htmlspecialchars($l->deskripsi) ?></td>
                                            
                                            <td>
                                                <a href="<?= base_url('dashboard/layanan_edit/' . $l->id) ?>">
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="<?= base_url('dashboard/layanan_hapus/' . $l->id) ?>" onclick="return confirm('Yakin Hapus Data Ini?')">
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
