<!-- Header Section seperti Artikel -->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/overlay-bg.jpg)">
  <div class="overlay-mf"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h2 class="intro-title mb-4">DETAIL PORTOFOLIO</h2>
        <ol class="breadcrumb d-flex justify-content-center">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('portofolio'); ?>">Portofolio</a></li>
          <li class="breadcrumb-item active"><?php echo $portofolio->portofolio_judul; ?></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- Konten Portofolio -->
<section class="blog-wrapper sect-pt4" id="blog">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="post-box">
          <div class="post-thumb mb-3">
            <img src="<?php echo base_url('gambar/portofolio/' . $portofolio->portofolio_sampul); ?>" alt="" class="img-fluid rounded">
          </div>
          <div class="post-meta">
            <h1 class="article-title"><?php echo $portofolio->portofolio_judul; ?></h1>
            <ul>
              <li>
                <span class="ion-ios-person"></span> <?php echo $portofolio->pengguna_nama; ?>
              </li>
              <li>
                <span class="ion-ios-clock"></span> <?php echo date('d M Y', strtotime($portofolio->portofolio_tanggal)); ?>
              </li>
            </ul>
          </div>
          <div class="article-content">
            <?php echo $portofolio->portofolio_konten; ?>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-md-4">
        <div class="widget-sidebar">
          <h5 class="sidebar-title">Tentang Portofolio</h5>
          <div class="sidebar-content">
            <p>Ini adalah salah satu hasil karya terbaik kami.</p>
          </div>
        </div>
        <div class="widget-sidebar">
          <h5 class="sidebar-title">Portofolio Lainnya</h5>
          <div class="sidebar-content">
            <ul class="list-unstyled">
              <!-- Bisa tampilkan portofolio lain di sini -->
              <li><a href="#">Portofolio Lain 1</a></li>
              <li><a href="#">Portofolio Lain 2</a></li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
