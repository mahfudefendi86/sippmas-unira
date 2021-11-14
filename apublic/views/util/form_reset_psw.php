<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reset Password | Login</title>
<link href="<?php echo base_url();?>asset/css/login-dark.css" rel="stylesheet" type="text/css" />

</head>
<body>
            
<div class="right_content">
     
    <div class="group" >
      <div align="center">
	 </div><br />
     <h2 align="center">Reset Password</h2>
     <div class="login-form nolabel vdgray">
		 <?php
         if(isset($info)){
            echo $info;
         }else{
         ?>
    
          <form  name="loginform"  method="post" action="<?php site_url('ganti_psw/link_reset_psw');?>">
                        <label>Masukkan Email Anda</label>
                        <input type="text" name="email" id="email" class="login-input" placeholder="Email" />
                        
                        <input type="submit" class="login-btn" value="reset" />
          </form>
         
          <?php
          }
	  	?>
       </div>
    </div>
</div>
</body>
</html>