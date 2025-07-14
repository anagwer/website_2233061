<section id="portfolio" class="portfolio-mf sect-pt4 route">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="title-box text-center">
          <h3 class="title-a">Portofolio</h3>
          <p class="subtitle-a">Beberapa hasil pekerjaan kami yang telah kami buat</p>
          <div class="line-mf"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach ($portofolio as $p) { ?>
        <div class="col-md-4">
          <div class="work-box">
            <a href="<?php echo base_url('gambar/portofolio/' . $p->portofolio_sampul); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox">
              <div class="work-img">
                <img src="<?php echo base_url('gambar/portofolio/' . $p->portofolio_sampul); ?>" class="img-fluid" alt="">
              </div>
            </a>
            <div class="work-content">
              <div class="row">
                <div class="col-sm-12">
                  <h2 class="w-title"><?php echo $p->portofolio_judul; ?></h2>
                  <div class="w-more">
                    <span class="w-ctegory"><?php echo $p->pengguna_nama; ?></span> /
                    <span class="w-date"><?php echo date('d M Y', strtotime($p->portofolio_tanggal)); ?></span>
                  </div>
                  <div class="mt-2">
                    <a href="<?php echo base_url('portofolio/' . $p->portofolio_slug); ?>" class="btn btn-sm btn-primary">Lihat Detail</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
