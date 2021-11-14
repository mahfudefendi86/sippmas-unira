       <?php if(validation_errors()){ ?>
         <div class="alert alert-danger text-center pb-0"><?php echo validation_errors();?></div>
        <?php } ?>
        <?php $v =& $this->form_validation;?>
              <form class="go-right" name="login" id="login" action="<?php echo site_url('member_login/login');?>" method="post">
                <div class="text-center">
                   <img class="mb-4" src="<?php echo base_url();?>asset/images/favicon.jpg" alt="" width="100">
                   <h1 class="h3 mb-3 font-weight-normal">SIPPMas</h1>
                   <p>(Sistem Informasi Penelitian dan Pengabdian Masyarakat)</p>
                 </div>

                 <div class="form-label-gr">
                   <input type="text" id="namauser" name="username" class="form-control form-control-lg" value="" placeholder="Username" required>
                   <label for="namauser"><i class="fa fa-user-circle"></i> Username</label>
                 </div>

                 <div class="form-label-gr">
                   <input type="password" id="inputPassword" name="password" class="form-control form-control-lg" value="" placeholder="Password" required>
                   <label for="inputPassword"><i class="fa fa-lock"></i> Password</label>
                 </div>

                 <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input  ml-2" id="customControlAutosizing">
                    <label class="custom-control-label" for="customControlAutosizing">Remember my preference</label>
                  </div>
                 <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

                <div class="mt-4 mb-3">
                  <i class="fa fa-leaf"></i> Lupa password, silahkan <a class="" href="">klik disini</a>
                </div>
           </form>
