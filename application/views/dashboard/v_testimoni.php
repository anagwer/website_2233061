<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Data Testimoni</b> <small>Kelola Testimoni Pengguna</small></h1>
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
                            <h3 class="card-title"><i class="fas fa-comments"></i> Data Testimoni</h3>
                        </div>

                        <div class="card-body">
                            <a href="<?= base_url('dashboard/testimoni_tambah') ?>">
                                <button class="btn btn-sm btn-success">
                                    Tambah Testimoni <i class="fas fa-plus"></i>
                                </button>
                            </a>
                            <hr>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Gambar</th>
                                        <th>Nama</th> <!-- Kolom Nama -->
                                        <th>Testimoni</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($testimoni as $t): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php if ($t->gambar): ?>
                                                    <img style="width:150px;" class="img-thumbnail" src="<?= base_url('./gambar/testimoni/' . $t->gambar) ?>" alt="Testimoni">
                                                <?php else: ?>
                                                    Tanpa Gambar
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($t->nama) ?></td> <!-- Tampilkan Nama -->
                                            <td><?= nl2br(htmlspecialchars($t->testi)) ?></td>
                                            <td><?= date('d M Y, H:i', strtotime($t->tanggal)) ?></td>
                                            <td><?php if($t->status=='0'){
												echo 'Belum ACC';
											}else{
												echo 'ACC';
											} ?></td>
                                            <td>
                                                <a href="<?= base_url('dashboard/testimoni_edit/' . $t->id) ?>">
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="<?= base_url('dashboard/testimoni_hapus/' . $t->id) ?>" onclick="return confirm('Yakin hapus testimoni ini?')">
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
