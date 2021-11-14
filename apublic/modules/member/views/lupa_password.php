
<form class="go-right" name="login" id="login" action="<?php echo site_url('member_login/reset_password');?>" method="post" onsubmit="return confirm('Apakah anda yakin akan me-Reset Password anda ?')">
    <div class="text-center">
        <img class="mb-4" src="<?php echo base_url();?>asset/images/favicon.jpg" alt="" width="100">
        <h1 class="h3 mb-3 font-weight-normal">SIPPMas</h1>
        <p>(Sistem Informasi Penelitian dan Pengabdian Masyarakat)</p>
        </div>
        <?php
        if(isset($info)){
            if($status=="error"){
                echo '<div class="alert alert-danger"><h5>'.$info.'</h5>'.$content.'</div>';
            }
            if($status=="warning"){
                echo '<div class="alert alert-warning"><h5>'.$info.'</h5>'.$content.'</div>';
            }
            if($status=="sukses"){
                echo '<div class="alert alert-success"><h5>'.$info.'</h5>'.$content.'</div>';
            }
        }else{
            echo '<div class="alert alert-light">Silahkan masukan alamat e-mail yang terdaftar pada sistem kami.</div>';
        }
        ?>
        <?php
        if(isset($info) && $status!="sukses"){
        ?>
        <div class="form-label-gr">
        <input type="text" id="email" name="email" class="form-control form-control-lg" value="" placeholder="ex. emailanda@gmail.com" required>
        <label for="namauser"><i class="fa fa-user-circle"></i> e-Mail</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        <?php 
        };
        ?>
        <div class="mt-4">
            <a href="<?php echo site_url('/');?>" class="mt-4"><i class="fa fa-chevron-circle-left"></i> Kembali ke halaman utama</a>
        </div>

        
</form>
