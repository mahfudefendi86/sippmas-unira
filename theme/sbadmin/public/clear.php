
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Penelitian dan Pengabdian Mayarakat (SIPPMas) UNIRA Malang">
    <meta name="author" content="LPPM Unira Malang">
    <link rel="icon" href="<?php echo base_url();?>asset/images/favicon.jpg">

    <title><?php echo isset($title)?$title:"SIPPMas";?></title>

    <!-- Bootstrap core CSS-->
   <link type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Custom fonts for this template-->
   <link type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link media="screen" type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/css/carousel.css" rel="stylesheet">
   <link media="screen" type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/css/floating-labels.css" rel="stylesheet">
   <!-- Custom fonts for this template-->
   <link type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

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
      $u1=$this->uri->slash_segment(1);
      $u2=$this->uri->slash_segment(2);
    ?>
  <body class="sticky-footer" id="page-top">
    <main role="main">
        <div class="container">
        <!-- Three columns of text below the carousel -->

                    <?php echo isset($content)?$content:"";?>

        </div><!-- /.container -->


      <!-- FOOTER -->
      <footer  class="sticky-footer bg-footer">
        <div class="container">
            <div class="text-center">SIPPMas &copy; 2017-2018 LPPM Unira Malang</div>
        </div>
      </footer>
    </main>
    <div id="ajax_loader" class="loader_anim" ></div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/jquery/jquery.min.js"></script>
    <script>window.jQuery || document.write('<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/jquery/jquery.slim.min.js"><\/script>')</script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>
</html>
