<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem Informasi Penelitian dan Pengabdian Mayarakat (SIPPMas) UNIRA Malang">
  <meta name="author" content="LPPM Unira Malang">
  <link rel="icon" href="<?php echo base_url();?>asset/images/favicon.jpg">
  <title><?php echo isset($title)?$title:"LPPM";?></title>
   <!-- Bootstrap core CSS-->
  <link type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/css/sb-admin.min.css" rel="stylesheet">
<!-- Custom styles-->
  <link media="screen" type="text/css" href="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/css/mystyle.css" rel="stylesheet">
  <link media="screen" type="text/css" href="<?php echo base_url();?>asset/css/berita.css" rel="stylesheet">

  <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/jquery/jquery.min.js"></script>
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

<body id="page-top">

  <div class="content-wrapper bg-dark  mb-5">
      <div class="container-fluid" >
          <div class="card">
              <div class="card-body">
                  <?php echo  isset($content)?$content:"";?>
              </div>
          </div>
      </div>
    <!-- /.container-fluid-->
    <?php echo isset($footer)?$footer:"";?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
  </div>

<div id="ajax_loader" class="loader_anim" ></div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/bootstrap/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url();?>theme/<?php echo $this->config->item('theme');?>/js/sb-admin.min.js"></script>

</body>

</html>
