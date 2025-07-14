<!--/ Intro Skew Star /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url();?>assets_frontend/img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Layanan</h2>
                <p class="subtitle-a text-white">
                    Berikut merupakan layanan yang tersedia di Artomart
                </p>
                <div class="line-mf" style="color:black;"></div>
            </div>
        </div>
    </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Services Start /-->
<section id="service" class="services-mf sect-pt4 route">
    <div class="container">

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
    </div>
</section>
<!--/ Section Services End /-->
