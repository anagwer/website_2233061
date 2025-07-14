<!-- Intro Skew Start -->
<div id="home" class="intro route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/arto.jpg)">
  <div class="overlay-itro"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <p class="display-6 color-d">Selamat Datang di</p>
        <h1 class="intro-title mb-4"><?php echo $pengaturan->nama; ?></h1>
        <p class="intro-subtitle">
         <span class="text-slider-items">Toko Pertanian Modern, Pusat Kebutuhan Petani, Solusi Pertanian Terlengkap, Belanja Mudah untuk Petani, Layanan Cepat dan Nyaman
</span>
          <strong class="text-slider"></strong>
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Intro Skew End -->

<!-- Section Services Start -->
<section id="service" class="services-mf route">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="title-box text-center">
          <h3 class="title-a mt-3">Layanan</h3>
          <p class="subtitle-a">Layanan Yang Kami Tawarkan</p>
          <div class="line-mf"></div>
        </div>
      </div>
    </div>
    <div class="row">

            <?php foreach ($layanan as $l): ?>
				<div class="col-md-4">
					<a href="<?php echo base_url('welcome/layanan_detail/'.$l->id); ?>" style="text-decoration:none;color:black;">
						<div class="service-box">
								<img src="<?php echo base_url('./gambar/layanan/'.$l->gambar); ?>" alt="<?php echo $l->nama; ?>" height="100" style="border-radius:20px; width:100%;object-fit:cover;margin-top:-20px;">
										
								<div class="service-content">
										<h2><?php echo $l->nama; ?></h2>
										<p class="s-description">
												<?php echo substr($l->deskripsi, 0, 100) . '...'; ?>
										</p>
								</div>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
  </div>
</section>
<!-- Section Services End -->

<!-- Section Counter -->
<div class="section-counter paralax-mf bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/counters-bg.jpg)">
  <div class="overlay-mf"></div>
  <div class="container">
    <div class="row">
      <?php $counters = [
        ['icon' => 'ion-checkmark-round', 'number' => 450, 'text' => 'WORKS COMPLETED'],
        ['icon' => 'ion-ios-calendar-outline', 'number' => 15, 'text' => 'YEARS OF EXPERIENCE'],
        ['icon' => 'ion-ios-people', 'number' => 550, 'text' => 'TOTAL CLIENTS'],
        ['icon' => 'ion-ribbon-a', 'number' => 36, 'text' => 'AWARD WON']
      ];
      foreach ($counters as $counter): ?>
      <div class="col-sm-3 col-lg-3">
        <div class="counter-box">
          <div class="counter-ico">
            <span class="ico-circle"><i class="<?php echo $counter['icon']; ?>"></i></span>
          </div>
          <div class="counter-num">
            <p class="counter"><?php echo $counter['number']; ?></p>
            <span class="counter-text"><?php echo $counter['text']; ?></span>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- Portfolio Section Start (Dinamis dari Database) -->
<section id="work" class="portfolio-mf sect-pt4 route">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="title-box text-center">
          <h3 class="title-a">Portofolio</h3>
          <p class="subtitle-a">Karya yang sudah kami buat secara profesional.</p>
          <div class="line-mf"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach ($portofolio as $p): ?>
      <div class="col-md-4">
        <div class="work-box">
         <a href="<?php echo base_url('portofolio/' . $p->portofolio_slug); ?>">
            <div class="work-img">
              <img src="<?php echo base_url('gambar/portofolio/' . $p->portofolio_sampul); ?>" alt="<?php echo $p->portofolio_judul; ?>" class="img-fluid">
            </div>
            <div class="work-content">
              <div class="row">
                <div class="col-sm-8">
                  <h2 class="w-title"><?php echo $p->portofolio_judul; ?></h2>
                  <div class="w-more">
                    <span class="w-ctegory">By <?php echo $p->pengguna_nama; ?></span>
                    / <span class="w-date"><?php echo date('d M Y', strtotime($p->portofolio_tanggal)); ?></span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="w-like">
                    <a href="<?php echo base_url('portofolio/' . $p->portofolio_slug); ?>">
                      <span class="ion-ios-plus-outline"></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- Portfolio Section End -->

<!-- Testimonials Section Start -->
<div class="testimonials paralax-mf bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/overlay-bg.jpg)">
  <div class="overlay-mf"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="testimonial-mf" class="owl-carousel owl-theme">

          <?php foreach ($testimoni as $t): ?>
            <div class="testimonial-box">
              <div class="author-test">
                <img src="<?= base_url('./gambar/testimoni/' . $t->gambar) ?>" alt="" style="width:150px;" class="rounded-circle b-shadow-a">
                <span class="author"><?= htmlspecialchars($t->nama) ?></span>
              </div>
              <div class="content-test">
                <p class="description lead">
                  “<?= htmlspecialchars($t->testi) ?>”
                </p>
                <span class="comit"><i class="fa fa-quote-right"></i></span>
              </div>
            </div>
          <?php endforeach; ?>

        </div>

        <!-- Tombol Tambah Testimoni -->
        <div class="text-center mt-4">
          <a href="<?= site_url('welcome/testimoni_tambah') ?>" class="btn btn-primary">
            Tambah Testimoni
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Testimonials Section End -->

<!-- Blog Section Start -->
<section id="blog" class="blog-mf sect-pt4 route">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="title-box text-center">
          <h3 class="title-a">BERITA</h3>
          <p class="subtitle-a">Artikel terbaru dari kami</p>
          <div class="line-mf"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach ($artikel as $a): ?>
      <div class="col-md-4">
        <div class="card card-blog">
          <div class="card-img">
            <a href="<?php echo base_url() . $a->artikel_slug; ?>">
              <?php if ($a->artikel_sampul != ''): ?>
                <img src="<?php echo base_url('gambar/artikel/' . $a->artikel_sampul); ?>" alt="<?php echo $a->artikel_judul; ?>" class="img-fluid">
              <?php endif; ?>
            </a>
          </div>
          <div class="card-body">
            <div class="card-category-box">
              <div class="card-category">
                <a href="<?php echo base_url('kategori/' . $a->kategori_slug); ?>">
                  <h6 class="category"><?php echo $a->kategori_nama; ?></h6>
                </a>
              </div>
            </div>
            <h3 class="card-title">
              <a href="<?php echo base_url() . $a->artikel_slug; ?>"><?php echo $a->artikel_judul; ?></a>
            </h3>
          </div>
          <div class="card-footer">
            <div class="post-author">
              <span class="author"><?php echo $a->pengguna_nama; ?></span>
            </div>
            <div class="post-date">
              <span class="ion-ios-clock-outline"></span> <?php echo date('D-M-Y', strtotime($a->artikel_tanggal)); ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- Blog Section End -->
