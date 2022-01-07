
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Penelitian dan Pengabdian Mayarakat (SIPPMas) UNIRA Malang">
    <meta name="keywords" content="Penelitian, Pengabdian, Sistem Informasi">
    <meta name="author" content="Mahfud Efendi">
    <link rel="icon" href="<?php echo base_url(); ?>asset/images/favicon.jpg">

    <title><?php echo isset($title) ? $title : "SIPPMas (Sistem Informasi Penelitian Dan Pengabdian Masyarakat)"; ?></title>

    <!-- Bootstrap core CSS-->
   <link type="text/css" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Custom fonts for this template-->
   <link type="text/css" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link media="screen" type="text/css" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/css/carousel.css" rel="stylesheet">
   <link media="screen" type="text/css" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/css/mymain.css" rel="stylesheet">
   <!-- Custom fonts for this template-->
   <link type="text/css" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link type="text/css" href="<?php echo base_url(); ?>asset/css/berita.css" rel="stylesheet">
   <script src="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/jquery/jquery.min.js"></script>
   <style>
  .loader_anim {
      display: none;
      z-index:9999999;
      position:fixed;
      top:40%;
      left:45%;
      border: 10px solid #c6c6c6;
      border-radius: 60%;
      border-top: 10px solid #3498db;
      width: 60px;
      height: 60px;
      -webkit-animation: spin 0.7s linear infinite; /* Safari */
      animation: spin 0.7s linear infinite;
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
  </head>
  <?php
/* cek Link Menu */
$u1 = $this->uri->slash_segment(1);
$u2 = $this->uri->slash_segment(2);
?>
  <body class="sticky-footer" id="page-top">
    <header>
      <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
          <a class="navbar-brand" href="#">
              <div class="wrap_brand">
                  <img src="<?php echo base_url(); ?>asset/images/favicon.jpg" width="55" class="d-inline-block align-top" alt="Logo Unira">
                  <div class="title_brand d-xs-block d-sm-block d-md-block d-xl-block d-none">SIPPMas</div>
                  <div class="description_brand d-sm-block d-md-block d-xl-block d-none">Sistem Informasi Penelitian dan Pengabdian Masyarakat</div>
              </div>
         </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php if ($u1 == "main/" && $u2 == "/") {echo 'active';}
;?>">
              <a class="nav-link" href="<?php echo site_url('main/'); ?>"><i class="fa fa-home"></i> Beranda <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if ($u1 == "registrasi/" && $u2 == "kkn/") {echo 'active';}
;?>">
              <a class="nav-link" href="<?php echo site_url('registrasi/kkn/'); ?>"><i class="fa fa-user"></i> Pendaftaran KKN <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if ($u1 == "main/" && $u2 == "link/") {echo 'active';}
;?>">
              <a class="nav-link" href="<?php echo site_url('main/link/'); ?>"><i class="fa fa-newspaper-o"></i> Berita</a>
            </li>
            <?php if ($this->session->userdata('id_user')) {;?>

                <li class="nav-item">
                  <a class="nav-link text-primary" href="<?php echo site_url('member_login/login'); ?>"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('nama'); ?></a>
                </li>
            <?php } else {;?>
            <li class="nav-item <?php if ($u1 == "member_login/" && $u2 == "login/") {echo 'active';}
    ;?>">
              <a class="nav-link" href="<?php echo site_url('member_login/login/'); ?>"><i class="fa fa-sign-in"></i> Login</a>
            </li>
        <?php }
;?>
          </ul>
          <!-- <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
      </nav>
    </header>

    <main role="main">

        <?php echo isset($header) ? $header : ""; ?>

      <div class="container">
        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-md-9 col-lg-9 col-sm-12 featurette" >

                <?php echo isset($content) ? $content : ""; ?>

          </div><!-- /.col-lg-4 -->
          <div class="col-md-3 col-lg-3 col-sm-12">
              <div class="card mb-4">
                  <div class="card-header h5 text-white bg-secondary">
                    Menu
                  </div>
                      <div class="list-group list-group-flush">
                        <a href="<?php echo site_url('main/'); ?>" class="list-group-item list-group-item-action text-secondary"><i class="fa fa-home"></i> Beranda</a>
                      </div>
                       <?php
if (isset($menu)) {
    foreach ($menu as $menus) {
        echo '<div class="list-group list-group-flush">
                                      <a href="' . site_url('main/link/' . $menus->id_kategori) . '" class="list-group-item list-group-item-action text-secondary"><i class="' . $menus->ikon . '"></i> ' . $menus->kategori . '
                                      <span class="badge badge-primary badge-pill float-right">' . $menus->count_berita . '</span></a>
                                    </div>';
    }
}
;?>
              </div>
              <div class="card">
                    <div class="card-header h5 text-white bg-secondary">
                    Recent Post
                    </div>
                    <?php
if (isset($post)) {
    foreach ($post as $posts) {
        $isi = (strlen($posts->judul) > 70) ? substr($posts->judul, 0, 70) . "...." : $posts->judul;
        echo '<div class="list-group list-group-flush">
                              <a href="' . site_url('main/detail/' . $posts->id_berita) . '" class="list-group-item list-group-item-action text-secondary"><small>' . $isi . '</small>
                              <div class="">
                                  <span class="widget_sm" ><small><i class="fa fa-calendar"></i> ' . tgl_indo($posts->tanggal) . '</small></span>
                                  <span class="widget_sm" ><small><i class="fa fa-clock-o"></i> ' . $posts->jam . '</small></span>
                              </div>
                              </a>
                            </div>';
    }
}
?>

              </div>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <!-- <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div> -->

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->

      <div class="sticky-footer">
          <div class="row m-0 p-3" style="background:rgb(26, 26, 26); color:#b6b5b5;">
              <div class="col-md-4 col-lg-4">
                  <div style="border-bottom:1px solid #393939; padding: 0px 0px 6px 0px; margin:10px 0px; font-size:20px; font-weight:bold;">Tentang</div>
                  <p style="font-size:13px;text-align:justify;">SIPPMas (Sistem Informasi Penelitian Dan Pengabdian Masyarakat) merupakan sistem informasi manajemen penelitian dan pengabdian kepada masyarakat
                      yang dikembangkan oleh Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) Universitas Islam Raden Rahmat (UNIRA) Malang yang difungsikan untuk mendukung pelaksanaan, penyiapan, perumusan,
                      koordinasi, dan sinkronisasi pelaksanaan kebijakan, pemantauan, evaluasi, pelaporan di bidang penelitian dan pengembangan serta pengabdian kepada masyarakat yang dilaksanakan oleh civitas academica
                      UNIRA Malang.</p>
              </div>
              <div class="col-md-4 col-lg-4">
                  <div style="border-bottom:1px solid #393939; padding: 0px 0px 6px 0px; margin:10px 0px; font-size:20px; font-weight:bold;">Kontak</div>
                  <div style="font-size:13px;"><p><strong>Lembaga Penelitian dan Pengabdian kepada Masyarakat</strong><br/>
                    Universitas Islam Raden Rahmat Malang</p>
                    <p><strong>Mailing Address:</strong><br/>
                        Gedung Rektorat Lantai 2<br/>
                        Jalan Raya Mojosari No.2, Kepanjen, Jatirejoyoso, Malang, Jawa Timur 65163, Indonesia<br/>
                        Phone: (0341) 399099</p>
                   <p><strong>Email:</strong><br/>
                    <a style="color:#b6b5b5;" href="mailto:lppm.unira@gmail.com"><i class="fa fa-envelope"></i> &nbsp;lppm.unira@gmail.com</a><br/>
                    <a style="color:#b6b5b5;" href="mailto:lppm@uniramalang.ac.id"><i class="fa fa-envelope"></i> &nbsp;lppm@uniramalang.ac.id</a>
                    </p>
                  </div>
              </div>
              <div class="col-md-4 col-lg-4">
                  <div style="border-bottom:1px solid #393939; padding: 0px 0px 6px 0px; margin:10px 0px; font-size:20px; font-weight:bold;">Tautan</div>
                  <div style="font-size:13px; color:#9c9c9c!important;">
                         <a style="padding:10px 5px; color:#b6b5b5;" href="http://simlitabmas.ristekdikti.go.id/" title="SIMLITABMAS" target="_blank"><i class="fa fa-link"></i> SIMLITABMAS</a>
                          <br/>
                          <a style="padding:10px 5px;color:#b6b5b5;" href="http://www.kopertis7.go.id/" title="LLDIKTI WILAYAH 7 " target="_blank"><i class="fa fa-link"></i> LLDIKTI WILAYAH 7 </a>
                          <br/>
                          <a style="padding:10px 5px;color:#b6b5b5;" href="http://uniramalang.ac.id/" title="UNIRA MALANG " target="_blank"><i class="fa fa-link"></i> UNIRA MALANG </a>
                          <br/>
                          <a style="padding:10px 5px;color:#b6b5b5;" href="http://lppm.uniramalang.ac.id/" title="LPPM UNIRA MALANG " target="_blank"><i class="fa fa-link"></i> LPPM UNIRA MALANG </a>
                          <br/>
                          <a style="padding:10px 5px;color:#b6b5b5;" href="http://ejournal.uniramalang.ac.id/index.php/attamkin" title="AT-TAMKIN: JURNAL PENGABDIAN KEPADA MASYARAKAT" target="_blank"><i class="fa fa-link"></i> AT-TAMKIN: JURNAL PENGABDIAN KEPADA MASYARAKAT</a>
                  </div>
              </div>
          </div>
      </div>
      <!-- FOOTER -->
      <footer  class="sticky-footer bg-footer">
        <div class="container">
            <div class="text-center">SIPPMas &copy; 2017-2018 LPPM Unira Malang</div>
        </div>
      </footer>
      <a title="Kembali ke Atas" data-toggle="tooltip" href="#page-top" class="rounded scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </main>
    <div id="ajax_loader" class="loader_anim" ></div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>window.jQuery || document.write('<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/jquery/jquery.slim.min.js"><\/script>')</script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>theme/<?php echo $this->config->item('theme'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script>
        (function($) {
          "use strict"; // Start of use strict
          // Scroll to top button appear
          $(document).scroll(function() {
            var scrollDistance = $(this).scrollTop();
            if (scrollDistance > 100) {
              $('.scroll-to-top').fadeIn();
            } else {
              $('.scroll-to-top').fadeOut();
            }
          });
          // Configure tooltips globally
          $('[data-toggle="tooltip"]').tooltip();
          // Smooth scrolling using jQuery easing
          $(document).on('click', 'a.scroll-to-top', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
              scrollTop: ($($anchor.attr('href')).offset().top)
            }, 1000, 'easeInOutExpo');
            event.preventDefault();
          });
        })(jQuery); // End of use strict

        $(window).scroll(function() {
          if ($(document).scrollTop() > 120) {
            $('nav').addClass('mini_nav');
          } else {
            $('nav').removeClass('mini_nav');
          }
        });
    </script>
  </body>
</html>
