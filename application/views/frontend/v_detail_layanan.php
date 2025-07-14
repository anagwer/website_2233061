<!--/ Intro Skew Start /-->
<div class="intro intro-single route bg-image" style="background-image: url(<?php echo base_url();?>assets_frontend/img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Detail Layanan</h2>
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('layanan');?>">Layanan</a></li>
                    <li class="breadcrumb-item active"><?php echo $layanan->nama; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Detail Layanan Start /-->
<section class="blog-wrapper sect-pt4" id="layanan">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-box">
                    <div class="post-thumb">
                        <img src="<?php echo base_url('gambar/layanan/'.$layanan->gambar); ?>" class="img-fluid" alt="<?php echo $layanan->nama; ?>">
                    </div>
                    <div class="post-meta">
                        <h1 class="article-title"><?php echo $layanan->nama; ?></h1><hr>
						<ul>
						<li>
						<span class="ion-ios-calendar"></span>
						<a href="#"><?php echo $layanan->tanggal?></a>
						</li>
						<li>
						<span class="ion-ios-person"></span>
						<a href="#"><?php echo $layanan->pengguna_nama?></a>
						</li>
						</ul>
 
                        <p><?php echo nl2br($layanan->deskripsi); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Sidebar atau navigasi lain -->
                <div class="widget-sidebar">
                    <h5 class="sidebar-title">Layanan Lainnya</h5>
                    <div class="sidebar-content">
                        <ul class="list-sidebar">
                            <?php
                                // Ambil semua layanan untuk sidebar
                                $all_layanans = $this->m_data->get_data('layanan')->result();
                                foreach ($all_layanans as $l):
                            ?>
                                <li><a href="<?php echo base_url('layanan/detail/'.$l->id); ?>"><?php echo $l->nama; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Section Detail Layanan End /-->
